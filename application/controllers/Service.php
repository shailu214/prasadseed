<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

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

		$data['result'] = $this->db->get('service')->result_array();

		$head['nav'] = 3;

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/service/view', $data);
		$this->load->view('admin/footer');

	}

	public function add() {
		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->insert("service", $post);
			$data['alert'] = $this->db->insert_id();
		}

		$head['nav'] = 3;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/service/add', $data);
		$this->load->view('admin/footer');
	}


		public function edit( $id=null ) {

			$post = $this->input->post('data');

			if(!empty($post)) {
				$this->db->update("service", $post, "id='".$id."'");
				$alert = $this->db->affected_rows();
			}

			$data = $this->db->get_where("service", array("id" => $id))->row_array();

			$data['alert'] = $alert;
			$data['edit'] = 1;

			$head['nav'] = 3;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $head);
			$this->load->view('admin/service/add', $data);
			$this->load->view('admin/footer');
		}

}
