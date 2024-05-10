<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendsms extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(22,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();

	}


	public function index( $pg ) {

		$post = $this->input->post('set');
		if( !empty($post) ) {

			extract( $post );

			if( $type == 1) {
				if($to == 1) {
					$this->db->select("mobile2 as mob");
				} elseif($to == 2) {
					$this->db->select("mobile as mob");
				} elseif( $to == 3) {
					$this->db->select("CONCAT(mobile,',',mobile2) as mob");
				}

				$this->db->where('batch', $batch);
				$this->db->where('status', 1);
				$res = $this->db->get("student")->result_array();

				foreach ($res as $key => $val) {
				 	$mob = str_replace(' ','', $val['mob']);
					$this->custom->sendSMS($mob, $msg);
				}
			$data['alert'] = 1;

		} elseif( $type == 2 ) {
				$data = $this->db->select("mobile")->where("status",1)->get("staff")->result_array();
				foreach ($data as $sk => $sv) {
					$this->custom->sendSMS($sv['mobile'], $msg);
				}
				$data['alert'] = 1;
		} elseif( $type == 3 ) {
			$data = $this->db->select("mobile")->get("admission_query")->result_array();
			foreach ($data as $sk => $sv) {
				$this->custom->sendSMS($sv['mobile'], $msg);
			}
			$data['alert'] = 1;
		} elseif( $type == 4 ) {
			$data = $this->db->select("mobile")->get("customer")->result_array();
			foreach ($data as $sk => $sv) {
				$this->custom->sendSMS($sv['mobile'], $msg);
			}
			$data['alert'] = 1;
		}

		}

		$data['batch'] = $this->db->get_where("batch", array("status" => 1))->result_array();
		// $data['batch'] = $this->db->get_where("batch", array("status" => 1))->result_array();

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/sendsms',$data);
		$this->load->view('admin/footer');

	}



}
