<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		// if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['perm'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();

	}


	public function index( $pg ) {
		if(!empty($_POST)) {
			$pass = $this->input->post('newpass');
			$this->db->update("users", array("password"=>$pass), "id='".$_SESSION[ADMIN]['id']."'");
			$data['alert'] = 1;
		}
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/password',$data);
		$this->load->view('admin/footer');
	}


}
