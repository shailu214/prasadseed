<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fare extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->pageParam->nav = 'fare';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

	
	public function index( $pg=null ) {
		$post = $this->input->post('data');
		$search = null;
		if(!empty( $post )) {
			$search = $post['search_year'];
		}
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$rows = $this->db->get('fare_gadi_bada')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'fare/index/';
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

		$data['result'] = $this->db->get("fare_gadi_bada")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fare/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("fare_gadi_bada")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}

		$data = ['obj' => $obj];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fare/info',$data);
		$this->load->view('admin/footer');
	}


	public function add($id = null)
	{

		$post = $this->input->post('data');
		if(!empty($post)) {
			if($this->pageParam->role != 1) {
				redirect("fare");
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
				redirect("fare/add");
			}

			$pkid = $this->input->post('pkid');
			$this->db->where('id', $pkid);
			$obj = $this->db->get('fare_gadi_bada')->row();
			if($obj) {
				$this->session->set_flashdata('success_entry', 'success update');
				$this->db->where('id', $pkid);
				$this->db->update('fare_gadi_bada', $post);
				redirect("fare/add/".$pkid);
			} else {
				$this->session->set_flashdata('success_entry', 'success');
				$this->db->insert("fare_gadi_bada", $post );
				
				redirect("fare/add");
			}
				
		}
		
		$data['obj'] = null;
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get('fare_gadi_bada')->row();
			if($obj) {
				$data['obj'] = $obj;
			} else {
				redirect("fare/add");
			}
		}
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fare/add',$data);
		$this->load->view('admin/footer');
	}

	public function farmerajax()
	{
		$term = $this->input->post('searchTerm');
		
		$this->db->like('name', $term);
		$this->db->or_like('mobile', $term);
		$this->db->or_like('father_name', $term);
		$this->db->or_like('reference_name', $term);
		$this->db->limit(5);
		$data = $this->db->get('fare_gadi_bada');
		$result = [];
		foreach($data->result_array() as $val) {
			$string = $val['name'].', '.$val['mobile'];
			if($val['father_name'] != null) {
				$string .= ', '.$val['father_name'];
			}
			if($val['reference_name'] != null) {
				$string .= ', '.$val['reference_name'];
			}
			$result[] = ['id' => $val['id'], 'search' => $string];
		}
		echo json_encode($result);
	}
	
	public function delete($fareid) {
		if($this->pageParam->role == 1) {
			$this->db->where('id', $fareid);
			$fare = $this->db->get('fare_gadi_bada')->row();
			if($fare) {
				$this->db->where('id', $fareid);
				$this->db->delete('fare_gadi_bada');
			}
		}
		redirect("fare");
	}
	
}
