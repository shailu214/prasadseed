<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->pageParam->nav = 'challan';
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
		$rows = $this->db->get('challan')->num_rows();
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
		$config['base_url'] = base_url().'challan/index/';
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

		$data['result'] = $this->db->get("challan")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/challan/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("challan")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}
		
		//$this->db->where('amount_id', $id);
		//$amount_deposit = $this->db->get("amount_deposit")->result_array();

		$data = ['obj' => $obj, 'amount_deposit' => $amount_deposit];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/challan/info',$data);
		$this->load->view('admin/footer');
	}


	public function add($id=null)
	{
		$data = [];

		$post = $this->input->post('data');
		if(!empty($post)) {
			$pkid = $this->input->post('pkid');
			if($this->pageParam->role != 1) {
				redirect("challan");
			}
			$errors = [];
			if(empty($post['year'])) {
				$errors[] = 'Year is required';
			}
			if(empty($post['farmer_id'])) {
				$errors[] = 'Farmer Name is required';
			}
			$post['account_name'] = '';
			$post['account_number'] = '';
			$post['ifsc_code'] = '';
			if($post['bank_account'] == 'Prasad Agro Industries') {
				$post['account_name'] = 'Prasad Agro Industries';
				$post['bank_name'] = 'INDIAN BANK';
				$post['account_number'] = '7486253753';
				$post['ifsc_code'] = 'IDIB000L514';
				$post['address'] = 'RURA, KANPUR DEHAT';
			} else if($post['bank_account'] == 'Krishna Trading Company PNB Account') {
				$post['account_name'] = 'KRISHNA TRADING COMPANY';
				$post['bank_name'] = 'PUNB BANK';
				$post['account_number'] = '6431002100002355';
				$post['ifsc_code'] = 'PUNB0643100';
				$post['address'] = 'VIKASH NAGAR, LAKHANPUR, KANPUR NAGAR';
			}
			else if($post['bank_account'] == 'Krishna Trading Company HDFC Account') {
				$post['account_name'] = 'KRISHNA TRADING COMPANY';
				$post['bank_name'] = 'HDFC BANK';
				$post['account_number'] = '50200096112200';
				$post['ifsc_code'] = 'HDFC0007255';
				$post['address'] = 'RURA, KANPUR DEHAT';
			}
			
			//echo '<pre>'; print_r($post); die;
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("challan/add");
				
			}

			$post['no_of_bori_count'] = ($post['no_of_bori']+$post['no_of_bori1']+$post['no_of_bori2']+$post['no_of_bori3']+$post['no_of_bori4']+$post['no_of_bori5']+$post['no_of_bori6']+$post['no_of_bori7']+$post['no_of_bori8']+$post['no_of_bori9']);

			if($pkid > 0){
				$this->db->where('id', $pkid);
				$this->db->update("challan", $post );
				redirect("challan/add/".$id);
			} else{
			$this->db->insert("challan", $post );
			redirect("challan/add");
			}
			
			
			
			
		}
		
		$data['obj'] = $data['farmer_lot_id'] = $data['advanced'] = $data['persent'] = null;
		$data['lots'] = [];
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get('challan')->row();
			if($obj) {

				
				$data['obj'] = $obj;
				$data['persent'] = $obj->per;
				$this->db->where('farmer_id', $obj->farmer_id);
				$data['lots'] = $this->db->get('farmer_lots')->result_array();
				$data['farmer_lot_id'] = $obj->farmer_lot_id;
			} else {
				redirect("challan/add");
			}
			
		}
		
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/challan/add',$data);
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
			$amt = $this->db->get('challan')->row();
			if($amt) {
				$this->db->where('id', $amt->id);
				$this->db->delete('challan');
			}
		}
		
		redirect("challan");
	}
}
