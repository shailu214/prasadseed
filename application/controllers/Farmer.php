<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Farmer extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		//$this->load->model('custom');
		$this->pageParam->nav = 'farmer';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

	
	public function index( $pg=null ) {
		$post = $this->input->get('src');
		$request = http_build_query($_GET);
		if(!empty( $post )) {
			//echo '<pre>'; print_r($post);
			if($post['name'] != '') {
				$this->db->like('name', $post['name']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer.id', $post['farmer_id']);
			}
			
			if($post['mobile'] != '') {
				$this->db->like('mobile', $post['mobile']);
			}
			
			if($post['address'] != '') {
				$this->db->where('address.address', $post['address']);
			}
			
			/*if($post['address'] != '') {
				$this->db->where('farmer.id', $post['address']);
			}*/
		}
		$this->db->join('address', 'address.id = farmer.address');
		$rows = $this->db->get('farmer')->num_rows();
		$lim = 10;
		
		
		if(!empty( $post )) {
			//echo '<pre>'; print_r($post);
			if($post['name'] != '') {
				$this->db->like('name', $post['name']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer.id', $post['farmer_id']);
			}
			
			if($post['mobile'] != '') {
				$this->db->like('mobile', $post['mobile']);
			}
			
			if($post['address'] != '') {
				$this->db->where('address.address', $post['address']);
			}
			
			/*if($post['address'] != '') {
				$this->db->where('farmer.id', $post['address']);
			}*/
		}

		$this->load->library('pagination');
		$config['suffix'] = '?'.$request;
		$config['base_url'] = base_url().'farmer/index/';
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


		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);
		$this->db->select('farmer.*');
		$this->db->join('address', 'address.id = farmer.address');
		$data['result'] = $this->db->get("farmer")->result_array();
		
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/farmer/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function view($id) {
		$post = $this->input->post('data');
		$search = null;
		if(!empty( $post )) {
			$search = $post['search_year'];
		}
		$this->db->where('id', $id);
		$obj = $this->db->get("farmer")->row();
		
		$this->db->where('id', $obj->address);
		$address = $this->db->get("address")->row();
		if($address) {
			$obj->address = $address->address;
		}
		$data = [];
		$data['obj'] = $obj;
		$data['db'] = $this->db;
		$data['entry'] = $this->entryList($id, $search);
		$data['bardana'] = $this->bardanaList($id, $search);
		$data['amount'] = $this->amountList($id, $search);
		$data['fare'] = $this->fareList($id, $search);
		
		//$this->db->where('farmer_id', $id);
		//$obj = $this->db->get("sell")->result();
		//$data['lots'] = $obj;
		
		$this->db->where('farmer_id', $id);
		$data['resultsell'] = $this->db->get("sell")->result_array();
		//echo '<pre>'; print_r($data['lots']); die;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/farmer/info',$data);
		$this->load->view('admin/footer');
	}
	
	private function amountList($farmer_id, $search = null) {
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$this->db->where('farmer_id', $farmer_id);
		return $this->db->get('amount')->result_array();
	}
	
	private function fareList($farmer_id, $search = null) {
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$this->db->where('farmer_id', $farmer_id);
		return $this->db->get('fare_gadi_bada')->result_array();
	}

	private function entryList($farmer_id, $search = null) {
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$this->db->where('farmer_id', $farmer_id);
		return $this->db->get('entry_management')->result_array();
	}
	
	private function bardanaList($farmer_id, $search = null) {
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$this->db->where('bardana.farmer_id', $farmer_id);
		//$this->db->select('bardana_detail.*, bardana.year');
		//$this->db->join('bardana_detail', 'bardana.id = bardana_detail.bardana_id');
		return $this->db->get('bardana')->result_array();
	}

	public function add($id=null)
	{

		$post = $this->input->post('data');
		
		if(!empty($post)) {
			$pkid = $this->input->post('pkid');
			$fromway = $this->input->post('fromway');
			
			/* $pkid = $this->input->post('pkid');
			if($this->pageParam->role != 1) {
				$this->session->set_flashdata('error', 'Not allow');
				redirect("farmer/add/".$pkid);
			} */
			$errors = [];
			if(empty($post['name'])) {
				$errors[] = 'Name is required';
			}
			if(empty($post['mobile'])) {
				$errors[] = 'Mobile is required';
			}
			if(empty($post['father_name'])) {
				$errors[] = 'Father Name is required';
			}
			
			$addressid = $this->input->post('addressid');
			if(isset($addressid) && $addressid == null) {
				$errors[] = 'Address is required';
			}
			
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				if($fromway != null) {
					redirect($fromway);
				}
				redirect("farmer/add");
			}
			$address = 0;
			if($addressid > 0) {
				$this->db->where('id', $addressid);
				$addressObj = $this->db->get('address')->row();
				$address = $addressObj->id;
			} else {
				$addressname = $this->input->post('addressname');
				$this->db->insert("address", ['address' => $addressname] );
				$address = $this->db->insert_id();
			}
			if($address > 0) {
				$post['address'] = $address;
				if($pkid > 0) {
					$this->db->where('id', $pkid);
					$this->db->update('farmer', $post);

					if($this->db->affected_rows() > 0){
					   redirect("farmer/add/".$pkid);
					} else {
						if($fromway != null) {
							redirect($fromway);
						}
						$this->session->set_flashdata('error', 'Not update value');
					   redirect("farmer/add");
					}
				} else {
					$this->db->insert("farmer", $post );
					$data['alert'] = $this->db->insert_id();
					if($fromway != null) {
						redirect($fromway);
					}
				}
				
			} else {
				$this->session->set_flashdata('error', 'Address not found');
				if($fromway != null) {
					redirect($fromway);
				}
				redirect("farmer/add");
			}
		}

		$data['obj'] = null;
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get("farmer")->row();
			if($obj == null) {
				$this->session->set_flashdata('error', 'Record not found');
				redirect("farmer/add");
			}
			if($this->pageParam->role != 1) {
				redirect("farmer");
			}
			$data['obj'] = $obj;
		}
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/farmer/add',$data);
		$this->load->view('admin/footer');
	}

	public function ajax()
	{
		$term = $this->input->post('searchTerm');
		
		$this->db->like('address', $term);
		$this->db->limit(5);
		$data = $this->db->get('address');
		$result = [];
		if($data->num_rows() == 0) {
			
			$result[] = ['id' => -1, 'address' => $term];
			echo json_encode($result);
		} else {
			foreach($data->result_array() as $val) {
				$result[] = ['id' => $val['id'], 'address' => $val['address']];
			}
			echo json_encode($result);
		}
		  
		
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
			$result[] = ['id' => $val['id'], 'search' => $string, 'lots' => $lots];
		}
		echo json_encode($result);
	}
	
	public function farmerlots()
	{
		$farmer_id = $this->input->post('farmer_id');
		
		$this->db->where('farmer_id', $farmer_id);
		$data = $this->db->get('farmer_lots');
		$result = [];
		foreach($data->result_array() as $val) {
			
			$result[] = ['id' => $val['id'], 'lots' => $val['id']];
		}
		echo json_encode($result);
	}
	
	public function delete($farmerid) {
		if($this->pageParam->role == 1) {
			
			$this->db->where('id', $farmerid);
			$farmer = $this->db->get('farmer')->row();
			if($farmer) {
				$farmerid = $farmer->id;
				$this->db->where('farmer_id', $farmerid);
				$this->db->delete('farmer_lots');
				
				$this->db->where('farmer_id', $farmerid);
				$this->db->delete('entry_management');
				
				$this->db->where('farmer_id', $farmerid);
				$this->db->delete('fare_gadi_bada');
				
				$this->db->where('farmer_id', $farmerid);
				$bardanas = $this->db->get('bardana')->result();
				foreach($bardanas as $bardana) {
					$this->db->where('bardana_id', $bardana->id);
					$this->db->delete('bardana_detail_return');
					
					$this->db->where('id', $bardana->id);
					$this->db->delete('bardana');
				}
				
				$this->db->where('farmer_id', $farmerid);
				$amounts = $this->db->get('amount')->result();
				foreach($amounts as $amount) {
					$this->db->where('amount_id', $amount->id);
					$this->db->delete('amount_deposit');
					
					$this->db->where('id', $amount->id);
					$this->db->delete('amount');
				}
				
				$this->db->where('id', $farmerid);
				$this->db->delete('farmer');
				
			}
		}
		redirect("farmer");
	}
}
