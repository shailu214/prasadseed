<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {

	public function __construct() {
		parent::__construct();
// 		$this->load->model('custom');
// 		$this->custom->setConfig();
	}

	public function index()
	{

		$post = $this->input->post('data');
		$dbinfo = $this->input->post('db');

		if(!empty($post)) {
			$key = $post['key'];
			if($this->cmsval->verifyKey( $key, $post, $dbinfo ) == false) {
				$data['alert'] = 1;
			}
		}

		$this->load->view('admin/install', $data);
	}


	public function step_1() {

		if( $_SESSION['step'] != 1 ) {
			header("location:index.php");
		}

		if( $this->input->post('process') == 1 ) {
			$this->load->model('fconst');
			$this->fconst->setSql();
		}

		$this->load->view('admin/install_1', $data);

	}

	public function finish() {
		$data['msg'] = 'Installation Complete';
		$this->load->view('admin/finish', $data);

	}


}
