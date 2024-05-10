<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		//if(empty($_SESSION[ADMIN])) { redirect(''); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index( $pg=null )	{
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(5,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

		if(!empty($_POST)) {

			$role = $this->input->post('role');

			if(strlen($_FILES['file']['name'])) {
				$file =  $_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], "files/".$file);
			}

			$str = file_get_contents('files/'.$file);
			$data = $this->custom->getStrArray( $str );
			// print_r($data);
			if( $role == 2 ) {
				foreach ($data as $key => $val) {

					$ymd = explode('-', $val['date']);

					$this->db->where("DATE(at_date) = DATE('".$val['date']."')");
					$this->db->where("staff_id", $val['code']);
					$this->db->where("logout_time", 0);
					$row = $this->db->get("attendance_staff")->row();

						$arr = array(
								"staff_id" => $val['code'],
								"at_day" => ltrim($ymd[2],'0'),
								"at_month" => ltrim($ymd[1],'0'),
								"at_year" => $ymd[0],
								"at_date" => $val['date'],
								"login_time" => $val['time'],
								"status" => 1,
						);

				// 		print_r($arr);

					$stf = $this->db->get_where("staff", array("status" => 1, "code" => $val['code']))->row_array();

					if(!empty( $stf ) ) {
						if($row->id > 0) {

							if($val['status'] == 'Out') {
								$arr2['logout_time'] = $val['time'];
								$arr2["work_hour"] = $this->gethour($row->login_time, $val['time']);
								$this->db->update("attendance_staff", $arr2, "id='".$row->id."'");
							}

						} else {

								$this->db->insert("attendance_staff", $arr);
						}
					}

				}

			} elseif( $role == 1 ) {

				foreach ($data as $key => $val) {

					$ymd = explode('-', $val['date']);

					$this->db->where("DATE(at_date) = DATE('".$val['date']."')");
					$this->db->where("student_id", $val['code']);
					$row = $this->db->get("attendance_student")->row();

						$arr = array(
								"student_id" => $val['code'],
								"at_day" => ltrim($ymd[2],'0'),
								"at_month" => ltrim($ymd[1],'0'),
								"at_year" => $ymd[0],
								"at_date" => $val['date'],
								"login_time" => $val['time'],
						);

					if($row->id > 0) {
						if($val['status'] == 'In') {
							$arr2['login_time'] = $val['time'];
							$this->db->update("attendance_student", $arr2, "id='".$row->id."'");

						} else {

							$arr2['logout_time'] = $val['time'];
							$this->db->update("attendance_student", $arr2, "id='".$row->id."'");

						}

					} else {
						$chk = $this->db->get_where("student", array("code"=>$val['code']))->num_rows();
						if($chk) {
							$this->db->insert("attendance_student", $arr);
						}
					}

				}

			}
			$data['alert'] = 1;
			// unlink("files/".$file);
		}

		$head['nav'] = 4;

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/attd/add', $data);
		$this->load->view('admin/footer');

	}

	public function gethour($login=null, $logout=null ) {

		$time1 = strtotime($login);
		$time2 = strtotime($logout);
		$difference = round(abs($time2 - $time1) / 3600,2);
		$hour =  floor($difference);
		return $hour;

	}


	public function staff($m=null, $y=null) {

		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(6, $_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

		if(!$m) { $m = date('n'); }
		if(!$y) {	$y = date('Y'); }

		$staff = $this->db->select("id, code, designation, fname, lname, fx_sallery, ph_sallery, work_hour")->where("status",1)->get("staff")->result_array();

		$days = cal_days_in_month(CAL_GREGORIAN,$m,$y);
		// $sun = $this->custom->countSunday($days, $m, $y);

		foreach ($staff as $key => $val) {

			$wd = $this->db->where(array("staff_id"=>$val['code'], "at_month"=>$m, "at_year"=>$y))->group_by("at_date")->get('attendance_staff')->num_rows();

			$sun =	$this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->num_rows();
			if($wd==0) { $sun = 0; }

			$hr = $wd*$val['work_hour'];
			$wr = $this->db->select_sum("work_hour")->where(array("staff_id"=>$val['code'], "at_month"=>$m, "at_year"=>$y))->get('attendance_staff')->row()->work_hour;
			$dsal = floor($val['fx_sallery']/$days);
			$exhr = 0;

			if( $wr > $hr ) {
				$exhr = $wr-$hr;
				if($exhr)  {
					$sal = (($wd+$sun)*$dsal)+($val['ph_sallery']*$exhr);
				}
			} else {
				$sal = (($wd+$sun)*$dsal);
			}

			$val['sallary'] = $sal;
			$val['wday'] = $wd;
			$val['absent'] = ($days-$sun)-$wd;
			$val['sunday'] = $sun;
			$val['whr'] = $wr;
			$val['ex_hr'] = $exhr;

			$res[] = $val;
		}

		$data['result'] = $res;
		$data['m'] = $m;
		$data['y'] = $y;

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/attd/view', $data);
		$this->load->view('admin/footer');

	}


	public function stf_download($m=null, $y=null) {

		$staff = $this->db->select("id, code, fname, lname, fx_sallery, ph_sallery, work_hour")->where("status",1)->get("staff")->result_array();

		$days = cal_days_in_month(CAL_GREGORIAN,$m,$y);
		// $sun = $this->custom->countSunday($days, $m, $y);

		foreach ($staff as $key => $val) {

			$wd = $this->db->where(array("staff_id"=>$val['code'], "at_month"=>$m, "at_year"=>$y))->group_by("at_date")->get('attendance_staff')->num_rows();
			$sun =	$this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->num_rows();
			if($wd==0){ $sun = 0; }

			$hr = $wd*$val['work_hour'];
			$wr = $this->db->select_sum("work_hour")->where(array("staff_id"=>$val['code'], "at_month"=>$m, "at_year"=>$y))->get('attendance_staff')->row()->work_hour;
			$dsal = floor($val['fx_sallery']/$days);
			$exhr = 0;

			if( $wr > $hr ) {
				$exhr = $wr-$hr;
				if($exhr)  {
					$sal = (($wd+$sun)*$dsal)+($val['ph_sallery']*$exhr);
				}
			} else {
				$sal = (($wd+$sun)*$dsal);
			}

			$val['sallary'] = $sal;
			$val['wday'] = $wd;
			$val['absent'] = ($days-$sun)-$wd;
			$val['sunday'] = $sun;
			$val['whr'] = $wr;
			$val['ex_hr'] = $exhr;

			$res[] = $val;
		}
		$data['my'] = date("F - Y", strtotime("1-".$m.'-'.$y));
		$data['result'] = $res;
		$this->load->view('admin/attd/stf-excel',$data);
	}


//------------------------------------------------------------------------------------//
//=======================	Student Section : Begin ===================================//
//----------------------------------------------------------------------------------//

public function student ($b_id=null, $m=null, $y=null) {
	// echo $m;
	if($_SESSION[ADMIN]['role'] != 1 && !in_array(7, $_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

	if(!$m) { $m = date('m'); }
	if(!$y) {	$y = date('Y'); }
	$m = ltrim($m, "0");
	$staff = $this->db->select("id, code, fname, lname")->where(array("batch"=>$b_id, "status"=>1))->get("student")->result_array();

	$days = cal_days_in_month(CAL_GREGORIAN,$m,$y);
	// $sun = $this->custom->countSunday($days, $m, $y);
	$sun = $this->db->select("h_day")->where( array("h_month"=> ltrim($m,'0'), "h_year" => $y) )->get('holiday')->num_rows();
	foreach ($staff as $key => $val) {

		$atd = $this->db->where(array("student_id"=>$val['code'], "at_month"=>$m, "at_year"=>$y))->get('attendance_student')->num_rows();

		$val['attendance'] = $atd;
		$val['atd'] = $atd;
		$val['absent'] = ($days-$sun)-$atd;
		$val['sunday'] = $sun;
		$val['prc'] = floor($atd/($days-$sun)*100);
		$res[] = $val;
	}

	$data['result'] = $res;
	$data['m'] = $m;
	$data['y'] = $y;
	$data['b_id'] = $b_id;
	$this->load->view('admin/head');
	$this->load->view('admin/header', $head);
	$this->load->view('admin/attd/sview', $data);
	$this->load->view('admin/footer');
}


	public function std_download($b_id=null, $m=null, $y=null) {

		$staff = $this->db->select("id, code, fname, lname")->where(array("batch"=>$b_id, "status"=>1))->get("student")->result_array();

		$days = cal_days_in_month(CAL_GREGORIAN,$m,$y);
		$sun = $this->custom->countSunday($days, $m, $y);

		foreach ($staff as $key => $val) {

			$atd = $this->db->where(array("student_id"=>$val['code'], "at_month"=>$m, "at_year"=>$y))->get('attendance_student')->num_rows();

			$val['attendance'] = $atd;
			$val['atd'] = $atd;
			$val['absent'] = ($days-$sun)-$atd;
			$val['sunday'] = $sun;
			$val['prc'] = floor($atd/($days-$sun)*100);
			$res[] = $val;

		}

		$data['my'] = date("F - Y", strtotime("1-".$m.'-'.$y));
		$data['result'] = $res;
		$btc = $this->db->select('course_id, batch_name')->where("id", $b_id)->get("batch")->row();

		$data['course'] = $this->db->select("course")->where("id", $btc->course_id)->get("course")->row()->course;
		$data['batch'] = $btc->batch_name;

		// print_r($data);
		$this->load->view('admin/attd/std-excel',$data);
	}


	public function batch() {

		$batch = $this->db->get_where("batch", array("status"=>1))->result_array();
		$date = date("Y-m-d");

		foreach ($batch as $key => $val) {

			$stud = $this->db->get_where("student", array("batch"=>$val['id'], "status"=>1))->num_rows();

			$this->db->select("st.id")
			->from("student st")
			->where("st.batch", $val['id']);
			$this->db->where("st.code IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d')."') )",NULL,FALSE);

			$atd = $this->db->get()->num_rows();

			$val['studs'] = $stud;
			$val['attds'] = $atd;
			$res[] = $val;
		}

		$data['batch'] = $res;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/attd/batch', $data);
		$this->load->view('admin/footer');
	}


	public function absent_list( $id=null, $date=null ) {


		$data['result'] = $this->custom->getAbsentList($id, $date);
		$data['info'] = $this->db->get_where("batch", array("id"=> $id))->row_array();
		$data['date'] = $date;
		$data['prs'] = 'absent_list';

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/attd/abs_list', $data);
		$this->load->view('admin/footer');
	}


	public function present_list( $id=null, $date=null ) {


		$data['result'] = $this->custom->getPresentList($id, $date);
		$data['info'] = $this->db->get_where("batch", array("id"=> $id))->row_array();
		$data['date'] = $date;
		$data['prs'] = 'present_list';
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/attd/abs_list', $data);
		$this->load->view('admin/footer');
	}


}
