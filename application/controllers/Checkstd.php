<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkstd extends CI_Controller {

	public function index( $code=null )
	{

		$code = $this->security->xss_clean($code);
		$data = $this->db->get_where("student", array("code"=> $code))->row_array();
		// print_r($data);
		if(!empty($data)) {
			$this->db->where("student_id", $data['id']);
			$this->db->where("DATE(at_year) = DATE('".date('Y-m-d')."')");
			$row = $this->db->get("attendance_student")->row();

			if( $row->id > 0 ) {
				$this->db->update("attendance_student", array("logout_time" => date("h:i:s")), "id='".$row->id."'");
			} else {
				$atd = array (
					"student_id" => $data['id'],
					"at_day" => date("d"),
					"at_month" => date('m'),
					"at_year" => date('Y'),
					"at_date" => date("Y-m-d"),
					"login_time" => date("h:i:s")
				);
				$this->db->insert("attendance_student", $atd);

				}
		}

		$this->load->view("admin/check_student", $data);

	}


}
