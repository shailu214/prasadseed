<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renew extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('fconst');
		$this->load->model('custom');
		$this->custom->setConfig();
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index()
	{

		$post = $this->input->post('data');

		if(!empty($post)) {
			$key = $post['key'];
			$apkey = $this->fconst->getKey();
			$conf = array(
								"key" => $key,
									"appkey" => $apkey,
								);
		if (	$this->cmsval->renewApp( $conf ) ) {
			header("location:renew/finish.html");
		} else {
			$data['alert'] = 1;
		}

		}

		$this->load->view('admin/renew', $data);
	}

	public function finish() {
		$data['msg'] = 'Activation Completed.';
		$this->load->view('admin/finish', $data);

	}

}
