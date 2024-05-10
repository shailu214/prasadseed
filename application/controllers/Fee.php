<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fee extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		$this->load->model('custom');
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(5,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();

	}

	public function index () {
			$batch = $this->db->where("status",1)->get('batch')->result_array();
			foreach ($batch as $key => $val) {
				$val['paid'] = $this->db->select_sum("paid")->where(array("batch_id"=>$val['id']))->get('fee_reciept')->row()->paid;
				$due = $this->db->select_sum("due")->where(array("batch"=>$val['id']))->get('student')->row()->due;
				$fdue = $this->db->select_sum("f_due")->where(array("batch"=>$val['id']))->get('student')->row()->f_due;
				$val['due'] = $due+$fdue;
				$val['amt'] =	$val['paid']+$val['due'];
				$res[] = $val;
			}

		$data['results'] = $res;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fee/dsb', $data);
		$this->load->view('admin/footer');
	}



	public function batch ( $id=null, $pg=null ) {

		if($_SESSION['fee']['type'] == 2) {
			$rows = $this->custom->getUnpaidReciept(0, $id);
		} else {
			$rows = $this->custom->getPaidReciept(0, $id);
		}
		// $rows = $this->db->get_where('fee_reciept', array("batch_id"=>$id))->num_rows();
		$lim = 20;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'fee/batch/page/'.$id.'/';
		$config['total_rows'] = $rows;
		$config['per_page'] = $lim;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$pages = $this->pagination->create_links();

		if($pg>0) { $pg--; }
		$start = $pg*$lim;

		if($_SESSION['fee']['type'] == 2) {
			$data['result'] = $this->custom->getUnpaidReciept(1, $id, $lim, $start);
		} else {
			$data['result'] = $this->custom->getPaidReciept(1, $id, $lim, $start);
		}

		$data['pages'] = $pages;
		$data['sn'] = $start;

		$this->db->select("cs.course, bt.batch_name, bt.id");
		$this->db->from("batch bt, course cs");
		$this->db->where("bt.course_id = cs.id");
		$this->db->where("bt.id", $id);
		$data['btc'] = $this->db->get()->row_array();

		$data['paid'] = $this->db->select_sum("paid")->where(array("batch_id"=>$id))->get('fee_reciept')->row()->paid;
		// $data['due'] = $this->db->select_sum("due")->where(array("batch"=>$id))->get('student')->row()->due;
		$due = $this->db->select_sum("due")->where(array("batch"=>$id))->get('student')->row()->due;
		$fdue = $this->db->select_sum("f_due")->where(array("batch"=>$id))->get('student')->row()->f_due;
		$data['due'] = $due+$fdue;
		// print_r($data['btc']);
		$data['m'] = date('m');
		$data['y'] = date('Y');
		// $data['btc'] = $id;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fee/view', $data);
		$this->load->view('admin/footer');

	}


	public function main( $pg=null )
	{

		$rows = $this->db->get('fee_reciept')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'student/page/';
		$config['total_rows'] = $rows;
		$config['per_page'] = $lim;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

 		$pages = $this->pagination->create_links();

		if($pg>0) { $pg--; }
		$start = $pg*$lim;

		$this->db->select("fe.*, st.fname, cs.course");
		$this->db->from("fee_reciept fe, course cs, student st");
		$this->db->where("fe.student_id=st.id");
		$this->db->where("fe.course_id=cs.id");
		$this->db->order_by("fe.id", "desc");
		$this->db->limit($lim, $start);
		$data['result'] = $this->db->get()->result_array();
		$data['pages'] = $pages;
		$data['sn'] = $start;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fee/view', $data);
		$this->load->view('admin/footer');

	}


	public function add( $id=null )
	{

		$this->db->select("st.*, cs.course, cs.fee,cs.package_fee, cs.validity ");
		$this->db->from("course cs, student st");
		$this->db->where("st.course_id=cs.id");
		$this->db->where("st.code", $id);
		$data = $this->db->get('')->row_array();
        
		if(!empty($_POST)) {

			$type = $this->input->post('type');
			$packageamount = $this->input->post('package_amount');
			$fees = $this->input->post('fee');
			$srv = $this->input->post('srv');
			$rfee = $this->input->post('rfee');
			$dfee = $this->input->post('dfee');
			$amt = $this->input->post('amt');
			$otc = $this->input->post('otc');
			$otc_rm = $this->input->post('otc_rm');
			$disc = $this->input->post('disc');
			if($type == '1') {
			    $num = count($fees);
			} else {
			  $num = '1';
			}
			//print_r($type); die;
			if($type == '1') {
			    $sbt = ($data['fee']*$num)+$rfee;
			} else {
			  $sbt = $packageamount;
			}

			$sms = $this->input->post('sms');
			// $fee = ($data['fee']*$num)+($rfee+$dfee)+$otc;


			// $sn = count( $srv );
	
			foreach ($srv as $sk => $sv) {

				$samt = $this->db->select("amount")->where("id", $sv)->get('service')->row()->amount;
				$srr = array(
					"student_id" => $data['id'],
					"srv_id" => $sv,
					"amount" => $samt,
					"srv_month" => date('n'),
					"srv_year" => date('Y')
				);
				$this->db->insert("std_srv", $srr);
				$srv_sum[] = $samt;
			}

			$sbt = $sbt+array_sum($srv_sum);
			$fee = ($sbt+$dfee)+$otc;
			$due = ($fee-$amt)-$disc;
			//	 print_r($sbt); print_r($due); die;
			
            // print_r($sbt);print_r($due); die;
			if(!$dfee) { $dfee2 = $data['due']; }
            
			if($fee >= $amt) {
				$pay = array(
				    "fee_type" => $this->input->post('type') ,
					"code" => $this->custom->unique_code("fee_reciept", "FEE"),
					"student_id" => $data['id'],
					"course_id" => $data['course_id'],
					"batch_id" => $data['batch'],
					"name" => $data['fname'].' '.$data['lname'],
					"mobile" => $data['mobile'],
					"amount" => $sbt,
					"other_fee" => $otc,
					"other_remark" => $otc_rm,
					"disc" => $disc,
					"total" => ($fee-$disc),
					"paid" => $amt,
					"due" => $due
				);


			if($rfee>0) {
				$this->db->update("student", array("rfee"=>1,"f_due"=>0), "id='".$data['id']."'");
				$data['rfee'] = 1;
				$data['due_date'] = 1;
				$pay['rfee'] = 1;
				$pay['rfee_amt'] = $rfee;
				
			}

			if($dfee > 0 ){
				$nd = $data['due'] - $dfee;
				$due = $due+$nd;
			}

			if($dfee2 > 0) {
				$due = $due+$dfee2;
			}
			if($sbt < $data['f_due']) { $fdue=$data['f_due']-$sbt; } else { $fdue=0;}
			$this->db->update("student", array("due_date" => $this->input->post('due_date'),  "due"=>$due, "f_due"=> $fdue), "id='".$data['id']."'");
			// print_r($pay);
			$this->db->insert("fee_reciept", $pay );
			$fid = $this->db->insert_id();

			foreach ($fees as $key => $val) {
				$dt = explode('-', $val);
				$this->db->insert("fee", array(
					"pay_id" => $fid,
					"student_id" => $data['id'],
					"course_id" => $data['course_id'],
					"batch_id" => $data['batch'],
					"month" => ltrim($dt[0], '0'),
					"year" => $dt[1],
					"fee" => $data['fee'],
					"paid" => $data['fee'],
					
				));

				$m[] = ltrim($dt[0], '0');
				$y[] = ltrim($dt[0], '0').$dt[1];
				// $feepay[] = $data['fee'];
			}

			$this->db->update("fee_reciept", array("month" => implode(",", $m), "f_year" => implode(",", $y) ), "id='".$fid."'" );

			$data['alert'] = 1;

			if($sms) {
				$msg = "Dear ".$data['fname'].", Your fee ".$amt . " received successfully.";
				$this->custom->sendSMS($data['mobile2'], $msg);
			}

			} else {
				$data['alert'] = 2;
			}

		}

		if(!empty($data)) {
			$data['created'];
			// echo $data['validity'];
			$valid = date("d-m-Y", strtotime($data['created'] . " +".($data['validity'])." month" ));

		$data['join_m']= date("d-m-Y", strtotime($data['created']));
		$data['curr_m'] = date("m-Y");
		$data['crs_end'] = $valid;

		$data['dates'] = $this->getMonthNo($data['join_m'], $valid, $data['id']);

		$amt = $this->db->select_sum("amount")->where(array("student_id"=>$data['id'], "type"=>1))->get('fee_reciept')->row()->amount;
		$data['fee_type'] = $this->db->select("fee_type")->where(array("student_id"=>$data['id'], "type"=>1))->get('fee_reciept')->row()->fee_type;
		$paid = $this->db->select_sum("paid")->where(array("student_id"=>$data['id'], "type"=>1))->get('fee_reciept')->row()->paid;
		$data['discs'] = $this->db->select_sum("disc")->where(array("student_id"=>$data['id'], "type"=>1))->get('fee_reciept')->row()->disc;

		$data['paid'] = $paid;
		
		$data['due'] = $this->db->select('due')->where("id", $data['id'])->get('student')->row()->due;
	}
		$data['code'] = $id;

		$this->db->select("*");
		$this->db->where("student_id", $data['id']);
		$this->db->where("course_id", $data['course_id']);
		$this->db->where("batch_id", $data['batch']);
		$data['feelist'] = $this->db->get('fee_reciept')->result_array();

		$srv = explode(",",$data['services']);
		// print_r($srv);
		$this->db->where_in("id", $srv);
		$data['services'] = $this->db->get("service")->result_array();

		$srvs = $this->db->select('srv_id')->where(array("student_id"=>$data['id']))->get("std_srv")->result_array();

		$data['srvs'] = array_column($srvs, 'srv_id');
		$data['custom'] = $this->db->where(array("student_id"=>$data['id']))->get("custom_val")->result_array();
		//echo "<pre>"; print_r($data); die;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/fee/add', $data);
		$this->load->view('admin/footer');

	}


	public function pending( $id=null, $pg =null) {

		$m =  date('n');

		$qry =	$this->db->query("SELECT st.id, st.code, st.fname, st.lname, st.mobile FROM `tbl_student` st
														WHERE  NOT EXISTS (
														SELECT * FROM   `tbl_fee` fe
														WHERE  fe.student_id = st.id
														AND fe.batch_id = '$id'
														AND fe.month = '$m')" );

			$rows = $qry->num_rows();
			$lim = 10;

			$this->load->library('pagination');
			$config['base_url'] = base_url().'fee/pending/';
			$config['total_rows'] = $rows;
			$config['per_page'] = $lim;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';

			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:;">';
			$config['cur_tag_close'] = '</a></li>';
			$config['attributes'] = array('class' => 'page-link');
			$this->pagination->initialize($config);

	 		$pages = $this->pagination->create_links();

			if($pg>0) { $pg--; }
			$start = $pg*$lim;

			$qry =	$this->db->query("SELECT st.id, st.code, st.fname, st.lname, st.mobile, st.course_id FROM `tbl_student` st
															WHERE  NOT EXISTS (
													   	SELECT * FROM   `tbl_fee` fe
													   	WHERE  fe.student_id = st.id
															AND fe.month = '$m') LIMIT $start, $lim");

			$result = $qry->result_array();
			// print_r($res);
			foreach ($result as $key => $val) {

				$cs = $this->db->select("course, fee")->where("id", $val['course_id'])->get("course")->row();
				$val['course'] = $cs->course;
				$val['fee'] = $cs->fee;
				$res[] = $val;
			}

			$data['result'] = $res;
			// print_r($data);
			$data['pages'] = $pages;
			$data['sn'] = $start;

			$this->load->view('admin/head');
			$this->load->view('admin/header');
			$this->load->view('admin/fee/pview', $data);
			$this->load->view('admin/footer');

	}





		public function due( $id=null, $pg =null) {

			$m =  date('n');

			$this->db->where("due > 0");
			$this->db->where("batch", $id);
			$qry =	$this->db->get("student");
			// $this->db->
				$rows = $qry->num_rows();
				$lim = 10;

				$this->load->library('pagination');
				$config['base_url'] = base_url().'fee/due/page/'.$id.'/';
				$config['total_rows'] = $rows;
				$config['per_page'] = $lim;
				$config['use_page_numbers'] = TRUE;
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';

				$config['cur_tag_open'] = '<li class="page-item"><a class="page-link" href="javascript:;">';
				$config['cur_tag_close'] = '</a></li>';
				$config['attributes'] = array('class' => 'page-link');
				$this->pagination->initialize($config);

		 		$pages = $this->pagination->create_links();

				if($pg>0) { $pg--; }
				$start = $pg*$lim;


				$this->db->where("due > 0 or f_due>0");
				$this->db->where("batch", $id);
				$this->db->order_by("due", "desc");
				$this->db->limit($lim, $start);

				$qry =	$this->db->get("student");

				$data['result'] = $qry->result_array();

				$data['pages'] = $pages;
				$data['sn'] = $start;
				$due = $this->db->select_sum('due')->where("batch", $id)->get('student')->row()->due;
				$fdue = $this->db->select_sum('f_due')->where("batch", $id)->get('student')->row()->f_due;
				$data['due'] = $due+$fdue;

				$this->load->view('admin/head');
				$this->load->view('admin/header');
				$this->load->view('admin/fee/dview', $data);
				$this->load->view('admin/footer');

		}





public function feeprint( $id=null ) {

	$this->db->select("fee.*, cs.course, bt.batch_name");
	$this->db->from("course cs, batch bt, fee_reciept fee");
	$this->db->where("cs.id=fee.course_id");
	$this->db->where("bt.id=fee.batch_id");
	$this->db->where("fee.id", $id);
	$data = $this->db->get()->row_array();
	// echo ;
	// print_r($data);
	// $data = $this->db->get_where("fee_reciept", array("id"=> $id))->row_array();
	// $data['course'] = $this->db->select("course")->where("id", $id)->get("course")->row()->course;
	$this->load->view('admin/fee/print', $data);

}


public function getMonthNo ($date1=null,  $date2=null, $id=null) {
	$begin = new DateTime( $date1 );
	$end = new DateTime( $date2 );
	// $end = $end->modify( '+1 month' );
	// echo $id;
	$interval = new DateInterval('P1M');
	$daterange = new DatePeriod($begin, $interval ,$end);

		foreach($daterange as $date){
			$dt['m'] = $date->format("n");
			$dt['y'] = $date->format("Y");
			$dt['my'] = $date->format("n-Y");

		 	$chk = $this->db->get_where("fee", array("student_id"=>$id, "month" => ltrim($dt['m'], '0'), "year" => $dt['y']))->num_rows();

			if($chk) {
				$dt['paid'] = 1;
			}

			$res[] = $dt;
			unset($dt);
		}
		// print_r($res);
		return $res;

}



}
