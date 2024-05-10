<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		// if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(3,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index()
	{

		$data['result'] = $this->db->get('course')->result_array();

		$head['nav'] = 3;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/course/view', $data);
		$this->load->view('admin/footer');
	}

	public function add() {
		$post = $this->input->post('data');
		//echo '<pre>'; print_r($post); die;
		if(!empty($post)) {
			$this->db->insert("course", $post);
			$data['alert'] = $this->db->insert_id();
		}

		$head['nav'] = 3;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/course/add', $data);
		$this->load->view('admin/footer');
	}


		public function edit( $id =null) {

			$post = $this->input->post('data');

			if(!empty($post)) {
				$this->db->update("course", $post, "id='".$id."'");
				$alert = $this->db->affected_rows();
			}

			$data = $this->db->get_where("course", array("id" => $id))->row_array();

			$data['alert'] = $alert;
			$data['edit'] = 1;

			$head['nav'] = 3;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $head);
			$this->load->view('admin/course/add', $data);
			$this->load->view('admin/footer');
		}

}
