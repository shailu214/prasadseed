<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(4, $_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index( $pg=null )
	{

		$post = $this->input->post('src');

		if(!empty( $post )) {
			$this->session->src = $post;
		}

		if( $_SESSION['src']['course_id'] ) {
			$this->db->where("course_id", $_SESSION['src']['course_id']);
		}

		$rows = $this->db->get('batch')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'batch/page/';
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

		if( $_SESSION['src']['course_id'] ) {
			$this->db->where("bt.course_id", $_SESSION['src']['course_id']);
		}

		$this->db->select('bt.*, cr.course');
		$this->db->from('batch bt, course cr');
		$this->db->where('bt.course_id = cr.id');
		$this->db->limit($lim, $start);
		$data['result'] = $this->db->get()->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['course'] = $this->db->get_where("course", array("status"=>1))->result_array();
		$head['nav'] = 3;

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/batch/view', $data);
		$this->load->view('admin/footer');
	}


	public function add()
	{
		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->insert("batch", $post);
			$data['alert'] = $this->db->insert_id();
		}

		$data['course'] = $this->db->get_where("course", array("status" => 1))->result_array();

		$head['nav'] = 3;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/batch/add', $data);
		$this->load->view('admin/footer');
	}


	public function edit( $id )
	{
		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->update("batch", $post, "id='".$id."'");
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("batch", array("id" => $id))->row_array();
		$data['course'] = $this->db->get_where("course", array("status" => 1))->result_array();
		$data['alert'] = $alert;

		$head['nav'] = 3;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/batch/add', $data);
		$this->load->view('admin/footer');

	}

}
