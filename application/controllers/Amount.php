<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amount extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->pageParam->nav = 'amount';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

	
	public function index( $pg=null ) {
		$post = $this->input->get('data');
		$request = http_build_query($_GET);
		$search = null;
		if(!empty( $post )) {
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$rows = $this->db->get('amount')->num_rows();
		$lim = 10;
		
		$search = null;
		if(!empty( $post )) {
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
	
		$this->load->library('pagination');
		$config['suffix'] = '?'.$request;
		$config['base_url'] = base_url().'amount/index/';
		$config['total_rows'] = $rows;
		$config['per_page'] = $lim;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$pages = $this->pagination->create_links();

		if($pg>0) { $pg--; }
		$start = $pg*$lim;
		if($search != null) {
			$this->db->where('year(year)', $search);
		}

		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get("amount")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/amount/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("amount")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}

		$this->db->where('amount_id', $id);
		$amount_deposit = $this->db->get("amount_deposit")->result_array();

		$data = ['obj' => $obj, 'amount_deposit' => $amount_deposit];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/amount/info',$data);
		$this->load->view('admin/footer');
	}


	public function add($id=null)
	{

		$post = $this->input->post('data');
		if(!empty($post)) {
			if($this->pageParam->role != 1) {
				redirect("amount");
			}
			$errors = [];
			if(empty($post['year'])) {
				$errors[] = 'Year is required';
			}
			if(empty($post['farmer_id'])) {
				$errors[] = 'Farmer Name is required';
			}
			
			//echo '<pre>'; print_r($post); die;
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("amount/add");
			}
			
			$pkid = $this->input->post('pkid');
			$this->db->where('id', $pkid);
			$obj = $this->db->get('amount')->row();
			
			if($obj) {
				$post['cal_per'] = ($post['credit_amount']*$post['per'])/100;
				$post['balance_amount'] = ($post['cal_per']+$post['credit_amount']);
				
				$this->session->set_flashdata('success_entry', 'success update');
				$this->db->where('id', $pkid);
				$this->db->update('amount', $post);
				redirect("amount/add/".$pkid);
			} else {
				$post['cal_per'] = ($post['credit_amount']*$post['per'])/100;
				$post['balance_amount'] = ($post['cal_per']+$post['credit_amount']);
				$post['lending_sync_date'] = $post['lending_date'];
				$this->session->set_flashdata('success_entry', 'success');
				$this->db->insert("amount", $post );
				redirect("amount/add");
			}
		}
		
		$data['obj'] = $data['farmer_lot_id'] = $data['advanced'] = $data['persent'] = null;
		$data['lots'] = [];
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get('amount')->row();
			if($obj) {
				$data['obj'] = $obj;
				$data['advanced'] = $obj->advanced;
				$data['persent'] = $obj->per;
				$this->db->where('farmer_id', $obj->farmer_id);
				$data['lots'] = $this->db->get('farmer_lots')->result_array();
				$data['farmer_lot_id'] = $obj->farmer_lot_id;
			} else {
				redirect("amount/add");
			}
			
		}
		
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/amount/add',$data);
		$this->load->view('admin/footer');
	}

	public function farmerajax()
	{
		$term = $this->input->post('searchTerm');
		$this->db->select('farmer.*, address.address as addr');
		$this->db->like('farmer.name', $term);
		$this->db->or_like('address.address', $term);
		$this->db->or_like('farmer.mobile', $term);
		$this->db->or_like('farmer.father_name', $term);
		$this->db->or_like('farmer.reference_name', $term);
		$this->db->limit(5);
		$this->db->join('address', 'address.id = farmer.address');
		$data = $this->db->get('farmer');
		$result = [];
		foreach($data->result_array() as $val) {
			$string = $val['name'].', '.$val['mobile'];
			if($val['father_name'] != null) {
				$string .= ', '.$val['father_name'];
			}
			if($val['reference_name'] != null) {
				$string .= ', '.$val['reference_name'];
			}
			$string .= ', '.$val['addr'];
			$lots = [];
			$this->db->where('farmer_id', $val['id']);
			$data = $this->db->get('farmer_lots');
			foreach($data->result_array() as $obj) {
			
				$lots[] = ['id' => $obj['id'], 'lots' => $obj['lots']];
			}
			$result[] = ['id' => $val['id'], 'search' => $string, 'lots' => $lots];
		}
		echo json_encode($result);
	}
	
	
	public function deposit($id) {
		
		$post = $this->input->post('data');
		$search = null;
		if(!empty( $post )) {
			$pkid = $this->input->post('pkid');
			$errors = [];
			if(empty($post['date'])) {
				$errors[] = 'Date is required';
			}
			if(empty($post['amount'])) {
				$errors[] = 'Amount is required';
			}
			
			if($post['amount'] > 0 && $pkid > 0) {
				$this->db->where('id', $pkid);
				$row = $this->db->get("amount")->row();
				
				$this->db->where('amount_id', $pkid);
				$this->db->select_sum('amount');

				$totalPreAmount = $this->db->get("amount_deposit")->row();
				
				if(($totalPreAmount->amount+$post['amount']) > $row->balance_amount) {
					$errors[] = 'Amount should not be more then balance amount';
				}
				
			}
			
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("amount/deposit/".$pkid);
			}
			
			if($post['amount'] > 0) {
				$post['amount_id'] = $pkid;
				$this->db->insert("amount_deposit", $post );
				//$lastid = $this->db->insert_id();
				
				$this->db->where('id', $pkid);
				$row = $this->db->get("amount")->row();
				$deposit = $row->deposit_amount + $post['amount'];
				$balance_amount = $row->balance_amount - $post['amount'];
				$this->db->where('id', $pkid);
				$this->db->update('amount', ['deposit_amount' => $deposit, 'balance_amount' => $balance_amount]);
				redirect("amount");
			} else {
				$errors[] = 'Enter Valid Amount';
				if(count($errors) > 0) {
					$this->session->set_flashdata('errors', $errors);
					redirect("amount/deposit/".$pkid);
				}
			}
		}
		$this->db->where('id', $id);
		$obj = $this->db->get("amount")->row();
		if($obj == null) {
			redirect("amount");
		}

		$data = ['obj' => $obj];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/amount/deposit',$data);
		
	}
	
	public function delete($amountid) {
		if($this->pageParam->role == 1) {
			$this->db->where('id', $amountid);
			$amt = $this->db->get('amount')->row();
			if($amt) {
				$this->db->where('amount_id', $amt->id);
				$this->db->delete('amount_deposit');
				
				$this->db->where('id', $amt->id);
				$this->db->delete('amount');
			}
		}
		
		redirect("amount");
	}
}
