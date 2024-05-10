<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index()
	{
		$data['result'] = $this->db->get("subject")->result_array();

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/subject/view',$data);
		$this->load->view('admin/footer');
	}

	public function add()
	{

		$post = $this->input->post('data');

		if( !empty( $post ) ) {
			$this->db->insert('subject', $post);
			$data['alert'] = $this->db->insert_id();
		}

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/subject/add',$data);
		$this->load->view('admin/footer');
	}

	public function edit( $id=null )
	{

		$post = $this->input->post('data');

		if( !empty( $post ) ) {
			$this->db->update('subject', $post, "id='".$id."'");
			$alert = $this->db->insert_id();
		}

		$data = $this->db->get_where('subject', array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/subject/add',$data);
		$this->load->view('admin/footer');
	}

}
