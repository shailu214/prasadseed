<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends CI_Controller {

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


	public function index( $m=null, $y=null )
	{

		$post = $this->input->post('leave');
		$cap = $this->input->post('caption');

			$m = ($m)? $m : date('n');
			$y = ($y)? $y : date('Y');


			if(!empty( $post )) {

				foreach ($post as $k => $d) {
					$row =	$this->db->get_where("holiday", array( "h_day"=> $d, "h_month"=> $m, "h_year" => $y))->row_array();
					if(empty($row)) {
						$ar = array(
							"h_day" =>$d,
							"h_month" => $m,
							"h_year" => $y,
							"h_date" => $y.'-'.$m.'-'.$d
						);

						if(strlen($cap)) {
							$ar['caption'] = $cap;
						}
						$this->db->insert("holiday", $ar);

						$alert = $this->db->insert_id();
					}
				}

				// if( !empty($row) ) {
				//
				// 		$this->db->update("leave", array("lv_days"=> implode(",",$day)), "id='".$row['id']."'");
				// 		$data['alert'] = 1;
				//
				// 	} else {
				//
				// 		$arr = array (
				// 			"code" => $code,
				// 			"lv_month" => $m,
				// 			"lv_year" => $y,
				// 			"lv_days" => implode(",",$day)
				// 		);
				// 		$this->db->insert("leave", $arr);
				// 		$data['alert'] = 1;
				// 	}
			}

			$hday =	$this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->result_array();

			$data['logs'] = $res;
			$data['days'] = cal_days_in_month(CAL_GREGORIAN,$m,$y);
			$data['leave'] = explode(",", $lvday);
			$data['m'] = $m;
			$data['y'] = $y;
			$data['id'] = $code;
			$data['name'] = $usr['fname'].' '.$usr['lname'];
			$data['alert'] = $alert;
			$data['hday'] = array_column($hday, 'h_day');


		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/holiday',$data);
		$this->load->view('admin/footer');

	}


}
