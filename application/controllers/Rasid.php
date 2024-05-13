<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rasid extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->pageParam->nav = 'rasid';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

    public function index( $pg=null ) {
		$post = $this->input->get('data');
		$request = http_build_query($_GET);
		//echo '<pre>'; print_r($request); die;
		$search = null;
		if(!empty( $post )) {
			if($post['fdate'] != '' && $post['tdate'] != '') {
				//$start_date = $post['fdate'];
				//$end_date = $post['tdate'];
				//$this->db->where('due_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
				//$this->db->join('sell_deposit', 'sell.id = sell_deposit.sell_id');
			}
			
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
		$rows = $this->db->get('rasid')->num_rows();
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
		$config['base_url'] = base_url().'rasid/index/';
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
		$this->db->select("rasid.*");
		if(!empty( $post )) {
			if($post['fdate'] != '' && $post['tdate'] != '') {
				$start_date = $post['fdate'];
				$end_date = $post['tdate'];
				
				$this->db->where('sell_deposit.due_date >=', $start_date);
				$this->db->where('sell_deposit.due_date <=', $end_date);
				$this->db->join('sell_deposit', 'sell.id = sell_deposit.sell_id');
			}
		}

		$this->db->order_by("rasid.id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get("rasid")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/rasid/view',$data);
		$this->load->view('admin/footer');
	}

    public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("rasid")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}
		$this->db->where('id', $obj->vendor_id);
		$vendors = $this->db->get("vendors")->row();
		if($vendors) {
			$obj->vendor_id = $vendors->name;
		}

		//$this->db->where('amount_id', $id);
		//$amount_deposit = $this->db->get("amount_deposit")->result_array();

		$this->db->where('sell_id', $id);
		$amount_deposit = $this->db->get("sell_deposit")->result_array();
		
		$data = ['obj' => $obj, 'amount_deposit' => $amount_deposit];

		//ECHO '<pre>'; print_R($data); DIE;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/rasid/info',$data);
		$this->load->view('admin/footer');
	}
    public function add($id=null)
	{
		$post = $this->input->post('data');
		if(!empty($post)) {
			if($this->pageParam->role != 1) {
				redirect("rasid");
			}
			$errors = [];
			if(empty($post['year'])) {
				$errors[] = 'Year is required';
			}
			if(empty($post['farmer_id'])) {
				$errors[] = 'Farmer Name is required';
			}
			if(empty($post['farmer_lot_id'])) {
				$errors[] = 'Farmer Lot is required';
			}
			if($post['self'] == 0) {
				if(empty($post['vendor_id'])) {
					$errors[] = 'Vendor is required';
				}
			}
			
			$lotid = $post['farmer_lot_id'];
			$this->db->where('id', $lotid);
			$farmerlot = $this->db->get('farmer_lots')->row();
			if($farmerlot == null) {
				$errors[] = 'Lot Not Found ';
				$this->session->set_flashdata('errors', $errors);
				redirect("rasid/add");
			}
			
			$this->db->select_sum('quantity');
			$this->db->where('farmer_lot_id', $farmerlot->id);
			$objcount = $this->db->get('tbl_sell')->result_array();
			$objcount[0]['quantity'];
			
			$this->db->where('id', $farmerlot->entry_management_id);
			$entryCheck = $this->db->get('entry_management')->row();
			
			if(($entryCheck->qty - $objcount[0]['quantity']) < $post['quantity']) {
				$errors[] = 'Qty should be '.($entryCheck->qty - $objcount[0]['quantity']);
			}
			
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("rasid/add");
			}
			
			$pkid = $this->input->post('pkid');
			$this->db->where('id', $pkid);
			$obj = $this->db->get('rasid')->row();
			//echo '<pre>'; print_r($_POST); die;
			
			if($obj) {
				
				$this->session->set_flashdata('success_entry', 'success update');
				$this->db->where('id', $pkid);
				$this->db->update('rasid', $post);
				redirect("rasid/add/".$pkid);
			} else {
				$this->session->set_flashdata('success_entry', 'success');
				$this->db->insert("rasid", $post );
				$insert_id = $this->db->insert_id();
				//$this->db->where('bardana_id', $insert_id);
				foreach($this->input->post('bardanacomment') as $k => $bardanacmt) {//echo 1111; print_r($bardanacmt);
					$this->db->insert("bardana_comment", ['sell_id'=>$insert_id,'bardana_id'=>$k,'comment'=>$bardanacmt]);
				}
				//echo '<pre>'; print_r($_POST); print_r($this->input->post('bardanacomment')); die;
				
				//die;
				redirect("rasid/add");
			}
		}
		//echo 123; die;
		$result = ['obj' => null, 'lots' => [], 'bardana' => []];
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get('rasid')->row();
			if($obj) {
				$result['obj'] = $obj;
				
				//$this->db->where('farmer_id', $entry_management->farmer_id);
				//$result['bardana'] = $this->db->get('bardana')->result_array();
				
				$lots = [];
				$this->db->where('farmer_id', $obj->farmer_id);
				$data = $this->db->get('farmer_lots');
				foreach($data->result_array() as $obj) {
					$lots[] = $obj;
				}
				
				$result['lots'] = $lots;
		
			} else {
				redirect("rasid/add");
			}
			
		}
		//echo '<pre>'; print_r($result['obj']);  die;
		$result['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/rasid/add',$result);
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
    public function delete($amountid) {
		if($this->pageParam->role == 1) {
			$this->db->where('id', $amountid);
			$amt = $this->db->get('rasid')->row();
			if($amt) {
				$this->db->where('id', $amt->id);
				$this->db->delete('rasid');
			}
		}
		
		redirect("rasid");
	}

}