<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

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


	public function index( $code=null, $m=null, $y=null )
	{

			$post = $this->input->post('leave');

			$m = ($m)? $m : date('n');
			$y = ($y)? $y : date('Y');

			$row =	$this->db->get_where("leave", array("code" => $code, "lv_month"=> $m, "lv_year" => $y))->row_array();
			$usr = $this->db->get_where("student", array("code"=> $code))->row_array();

			if(!empty( $post )) {

				foreach ($post as $k => $d) {
					$day[] = $d;
				}

					// print_r($day);
					// $lv_id =	$this->db->get_where("leave", array("code" => $code, "lv_month"=> $m, "lv_year" => $y))->row()->id;

					if( !empty($row) ) {

						$this->db->update("leave", array("lv_days"=> implode(",",$day)), "id='".$row['id']."'");
						$data['alert'] = 1;
					} else {

						$arr = array (
							"code" => $code,
							"lv_month" => $m,
							"lv_year" => $y,
							"lv_days" => implode(",",$day)
						);
						$this->db->insert("leave", $arr);
						$data['alert'] = 1;
					}

			}

			$lvday =	$this->db->select("lv_days")->where( array("code" => $code, "lv_month"=> $m, "lv_year" => $y))->get('leave')->row()->lv_days;

			$data['logs'] = $res;
			$data['days'] = cal_days_in_month(CAL_GREGORIAN,$m,$y);
			$data['leave'] = explode(",", $lvday);
			$data['m'] = $m;
			$data['y'] = $y;
			$data['id'] = $code;
			$data['name'] = $usr['fname'].' '.$usr['lname'];
			print_r($leave);
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/student/leave',$data);
		$this->load->view('admin/footer');

	}


}
