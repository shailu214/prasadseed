<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cmsval');
		$this->cmsval->verify();
		if( $this->cmsval->validateApp() ) {
			$this->cmsval->appAlert();
		}
		$this->load->model('custom');
		$this->custom->setConfig();
	}

	public function index()
	{

		$post = $this->input->post();

		if(!empty($post)) {
			extract($post);
			$row = $this->db->get_where("users",array("username" => $username, "status"=> 1))->row_array();
			// print_r($row);

			if( $this->cmsval->validateApp() == 0) {
			if(!empty($row)) {
				if($row['password'] == $password) {

					$_SESSION[ADMIN]['id'] = $row['id'];
					$_SESSION[ADMIN]['fname'] = $row['fname'];
					$_SESSION[ADMIN]['role'] = $row['role'];
					$_SESSION[ADMIN]['prms'] = explode(",", $row['perm_opt']);

					header("location:".base_url().'dashboard');
				} else {
					$data['alert'] = 1;
				}
			} else {
				$data['alert'] = 1;
			}
		}

		}


		$this->load->view('admin/login', $data);
	}


	public function logout(  ) {
		session_destroy();
		redirect("login");
	}


}
