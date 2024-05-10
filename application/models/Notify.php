<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notify extends CI_Model {

	public function __construct() {
		parent::__construct();
	}


	public function getFeeInfo( $tp=0, $date=null,$batch_id='' ) {

		
		
		$m = ($date)? date('n', strtotime($date)): date("n");
		$y = ($date)? date("Y", strtotime($date)) : date("Y");
		// echo $y;
		$this->db->select("st.*,  cs.course, cs.fee, bt.batch_name")
		->from("course cs, student st, batch bt")
		->where("st.course_id=cs.id");
			

		if($_SESSION['src_btc']>0) {
			$this->db->where("st.batch", $_SESSION['src_btc']);
		}
		
		if($batch_id!='')
		{
		  $this->db->where("bt.id",$batch_id);	
		}
		
		if($date) {
			$due_date = date('Y-m-d', strtotime($date));
			$this->db->like("st.due_date",$due_date);
		}

		$this->db->where("st.batch=bt.id");
		if($date) {
			$this->db->where("st.id NOT IN (select student_id from tbl_fee where student_id = st.id and month ='".$m."' and year ='".$y."' )",NULL,FALSE);
		}
		
		if($tp == 1) {
			$this->db->order_by("st.fname", "asc");
			// $this->db->limit($lim, $start);
			$data = $this->db->get()->result_array();
			return $data;
		} else {
			$data = $this->db->get()->num_rows();
			define("NTF_DUE", $data);
		}
	}


	public function getStdInfo( $tp=null ) {

		$d = date("j");
		$m = date("n");
		$y = date("Y");

		// $this->db->
		// $
		$this->db->select("st.*,  cs.course, bt.batch_name")
		->from("course cs, student st, batch bt")
		->where("st.course_id=cs.id")
		->where("st.status",1)
		->where("st.batch=bt.id")
		->where("st.code NOT IN (select code from tbl_leave where code=st.code and find_in_set('".$d."', lv_days) > 0 )",NULL,FALSE);
		$this->db->where("st.code NOT IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d')."') )",NULL,FALSE);

		if($tp == 1) {
			$this->db->order_by("st.id", "desc");
			// $this->db->limit($lim, $start);
			$data = $this->db->get()->result_array();
			// print_r($data);
			return $data;
		} else {
			$data = $this->db->get()->num_rows();
			define("NTF_ABS", $data);
		}
	}
	
	public function getStdInfo_BY_filter( $tp=null,$batch_id ) {

		$d = date("j");
		$m = date("n");
		$y = date("Y");

		// $this->db->
		// $
		$this->db->select("st.*,  cs.course, bt.batch_name")
		->from("course cs, student st, batch bt")
		->where("st.course_id=cs.id")
		->where("st.status",1)
		->where("bt.id",$batch_id)
		->where("st.batch=bt.id")
		->where("st.code NOT IN (select code from tbl_leave where code=st.code and find_in_set('".$d."', lv_days) > 0 )",NULL,FALSE);
		$this->db->where("st.code NOT IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d')."') )",NULL,FALSE);

		if($tp == 1) {
			$this->db->order_by("st.id", "desc");
			// $this->db->limit($lim, $start);
			$data = $this->db->get()->result_array();
			// print_r($data);
			return $data;
		} else {
			$data = $this->db->get()->num_rows();
			define("NTF_ABS", $data);
		}
	}
	



}
