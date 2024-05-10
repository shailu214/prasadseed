<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Student extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();
			$this->load->library("qrlib");
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}


	public function index( $pg =null) {

		$post = $this->input->post('src');

		if(!empty( $post )) {
			$this->session->src = $post;
		}

		if( strlen($_SESSION['src']['code']) ) {
			$this->db->where("code", $_SESSION['src']['code']);
		}

		if( strlen($_SESSION['src']['name']) ) {
			$this->db->like("fname", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['mob']) ) {
			$this->db->where("mobile", $_SESSION['src']['mob']);
		}

		if( $_SESSION['src']['course_id'] ) {
			$this->db->where("course_id", $_SESSION['src']['course_id']);
		}

		if( $_SESSION['src']['batch_id'] ) {
			$this->db->where("batch", $_SESSION['src']['batch_id']);
		}

		if( $_SESSION['src']['status'] ) {
			$this->db->where("status", $_SESSION['src']['status']);
		}

		$rows = $this->db->get('student')->num_rows();
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

		$this->db->select('st.*, cr.course, bt.batch_name');
		$this->db->from("student st, course cr, batch bt");
		$this->db->where("st.course_id=cr.id");
		$this->db->where("st.batch=bt.id");

				if( strlen($_SESSION['src']['code']) ) {
					$this->db->where("code", $_SESSION['src']['code']);
				}

				if( strlen($_SESSION['src']['name']) ) {
					$this->db->like("st.fname", $_SESSION['src']['name']);
				}

				if( strlen($_SESSION['src']['mob']) ) {
					$this->db->where("st.mobile", $_SESSION['src']['mob']);
				}

				if( $_SESSION['src']['course_id'] ) {
					$this->db->where("st.course_id", $_SESSION['src']['course_id']);
				}

				if( $_SESSION['src']['batch_id'] ) {
					$this->db->where("st.batch", $_SESSION['src']['batch_id']);
				}

				if( $_SESSION['src']['status'] == 1 ) {
					$this->db->where("st.status", 1);
				} elseif( $_SESSION['src']['status'] == 2 ) {
					$this->db->where("st.status", 0);
				}

		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$rows = $this->db->get()->result_array();

		foreach ($rows as $key => $val) {
			$srv = explode(",", $val['services']);
			$stds = $this->db->select("srv_id")->where("student_id", $val['id'])->get("std_srv")->result_array();
// 			Print_r($stds);
			$val['act'] = array_column($stds, "srv_id");
			$res[] = $val;
		}

		$data['services'] = $this->db->select("id, service_name")->where("status",1)->get('service')->result_array();
		// $data['services'] = $this->db->get('service')->result_array();

		$data['result'] = $res;
		$data['pages'] = $pages;

		$data['course'] = $this->db->get_where("course", array("status"=>1))->result_array();
		if( $_SESSION['src']['course_id'] ) {
			$data['batch'] = $this->db->get_where("batch", array("status"=>1,"course_id"=>$_SESSION['src']['course_id']))->result_array();
		}
		$data['total'] = $this->getSumStudent(1);
		$data['active'] = $this->getSumStudent(2);
		$data['inactive'] = $this->getSumStudent(3);
		$data['sno'] = $start;

		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/student/view',$data);
		$this->load->view('admin/footer');
	}


	public function add()
	{

		$post = $this->input->post('data');
		$sms = $this->input->post('sms');
		$srv = $this->input->post('srv');
		$col = $this->input->post('col');
		$val = $this->input->post('val');


		if(!empty($post)) {

			$chk = $this->db->get_where("student", array("code"=>$post['code']))->num_rows();

			if($chk == 0 ) {
			if(strlen($_FILES['image']['name'])>0) {
					$img = $_FILES['image']['name'];
					$ext = pathinfo($img);
					$ext = $ext['extension'];
					$img_name = "img-".time().".".$ext;
					move_uploaded_file($_FILES['image']['tmp_name'], 'media/student/'.$img_name);
					$post['image'] = $img_name;
			}
			if(!empty($srv)) { $post['services'] = implode(",", $srv); }
			$post['qr_img'] = $this->qrlib->setQrCode($post['code'], base_url().'checkstd/'.$post['code']);

			$rfee = REG_FEE;
			$fee = $this->db->select('fee')->where("id", $post['course_id'])->get("course")->row()->fee;

			$fm = $this->getMonthNo($post['created'],date("d-m-Y"));

			$post['f_due'] = ($fee*$fm)+$rfee;
			$post['created'] = date("Y-m-d h:i:s", strtotime($post['created']));
			$this->db->insert( "student", $post );
			$sid = $this->db->insert_id();

			$co = count($col);

			if( $co > 0 ) {
				$co--;

				for($i=0; $i<=$co; $i++) {
					$arr = array(
						"student_id" => $sid,
						"title" => $col[$i],
						"sval" => $val[$i]
					);

					$this->db->insert("custom_val", $arr);
				}

			}

			$data['alert'] = 1;

			if($data['alert']) {
				if( $sms == 1 ) {
					$msg = "Dear ".$post['fname'].", Your Registration Completed.";
					//$this->custom->sendSMS($post['mobile'], $msg );
				}
			}
			$this->session->set_flashdata('success_msg', 'record saved successfully');
			redirect('/student/add', 'refresh');
		} else {
			$data = $post;
			unset($data['course_id']);
			$data['services'] = implode(",", $srv);
			$data['alert'] = 2;
		}

		}

		$data['course'] = $this->db->get_where("course", array("status"=>1))->result_array();
		$data['srvdata'] = $this->db->get_where("service", array("status"=>1))->result_array();

		//$data['batches'] = $this->db->get_where("tbl_batch", array("status"=>1))->result_array();

		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/student/add',$data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{

		$post = $this->input->post('data');
		$srv = $this->input->post('srv');
		$col = $this->input->post('col');
		$val = $this->input->post('val');

		if(!empty($post)) {

			if(strlen($_FILES['image']['name'])>0) {
					$img = $_FILES['image']['name'];
					$ext = pathinfo($img);
					$ext = $ext['extension'];
					$img_name = "img-".time().".".$ext;
					move_uploaded_file($_FILES['image']['tmp_name'], 'media/student/'.$img_name);
					$post['image'] = $img_name;
				}

					$co = count($col);

					if( $co > 0 ) {
						$co--;

						for($i=0; $i<=$co; $i++) {
							$arr = array(
								"student_id" => $id,
								"title" => $col[$i],
								"sval" => $val[$i]
							);

							$this->db->insert("custom_val", $arr);
						}

					}

					$post['services'] = implode(",", $srv);
					$post['qr_img'] = $this->qrlib->setQrCode($post['code'], base_url().'checkstd/'.$post['code']);
					$post['created'] = date("Y-m-d h:i:s", strtotime($post['created']));
					if($post['qr_img'] == 0) {
						unset($post['qr_img']);
					}
					//echo '<pre>'; print_r($post); die;
					$this->db->update( "student", $post, "id='".$id."'" );
					$alert = $this->db->affected_rows();

		}

		$data = $this->db->get_where("student", array("id"=>$id))->row_array();
		$data['course'] = $this->db->get_where("course", array("status"=>1))->result_array();
		$data['batches'] = $this->db->get_where("batch", array("status"=>1, "course_id"=>$data['course_id']))->result_array();
		$data['srvdata'] = $this->db->get_where("service", array("status"=>1))->result_array();
		$data['custom'] = $this->db->get_where("custom_val", array("student_id"=>$id))->result_array();
		$data['alert'] = $alert;

		$data['edit'] = 1;
		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/student/add',$data);
		$this->load->view('admin/footer');

	}



		public function attendance($id=null, $m=null, $y=null) {

			$usr = $this->db->get_where("student", array("code"=> $id))->row_array();
			// print_r($usr);
			if(!$m) { $m = ltrim(date("m"),'0'); }

			$y = ($y)? $y : date('Y');

			$atd = $this->db->select("at_day, login_time, logout_time")->where(array("student_id"=>$id, "at_month"=>$m, "at_year"=>$y))->get('attendance_student')->result_array();
			$data['attd'] = array_column($atd, "at_day");

			foreach ($atd as $key => $val) {
				$log['login'] = $val['login_time'];
				$log['logout'] = $val['logout_time'];
				$log['date'] = $val['at_date'];
				$res[$val['at_day']] = $log;
			}


			$data['logs'] = $res;
			// print_r($atd);
			$data['days'] = cal_days_in_month(CAL_GREGORIAN,$m,$y);

			$ad = $this->db->where(array("student_id"=>$id, "at_month"=>$m, "at_year"=>$y))->get('attendance_student')->num_rows();
			$sun =  ($wd >0)? $this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->num_rows() : '0';

			$data['prestnt'] = $ad;
			$data['absent'] = ($data['days']-$ad)-$sun;

			$data['name'] = $usr['fname']. ' &nbsp;' .$usr['lname'];
			$data['id'] = $id;

			$data['m'] = $m;
			$data['y'] = $y;
			$data['leave'] = explode(",", $this->db->select("lv_days")->where(array("code"=>$usr['code'], "lv_month" => $m))->get("leave")->row()->lv_days);
			$hday =	$this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->result_array();
			$data['hday'] = array_column($hday, 'h_day');

			$this->load->view('admin/head');
			$this->load->view('admin/header', $head);
			$this->load->view('admin/student/attd',$data);
			$this->load->view('admin/footer');

		}


		public function getSumStudent($type=null) {

			if( $_SESSION['src']['course_id'] ) {
				$this->db->where("course_id", $_SESSION['src']['course_id']);
			}
			if( $_SESSION['src']['batch_id'] ) {
				$this->db->where("batch", $_SESSION['src']['batch_id']);
			}

			if( $type == 2) {
				$this->db->where("status", 1);
			} elseif ( $type == 3 ) {
				$this->db->where("status", 0);
			}
			$rows = $this->db->from('student')->count_all_results();
			return $rows;
		}


		public function download ( $id =null) {

			$this->load->model('custom');

			$usr = $this->db->get_where("student", array("code"=>$id))->row_array();
			$crs = $this->db->get_where("course", array("id"=> $usr['course_id']))->row_array();
			$join = date("Y-m-d", strtotime($usr['created']));

				if( date('d', strtotime( $join) )>28 ) {
					$join = date("Y-m-d", strtotime($usr['created']." -5 days"));
				}

			$drs = $crs['validity'];
			$drs--;
			for($i=0; $i<=$drs; $i++) {
				$m = date("m", strtotime($join." +".$i." months"));
				$y = date("Y", strtotime($join." +".$i." month"));
				$res[] = array("month" => $m, "year" => $y);
			}
			// print_r($res);

			foreach ($res as $key => $val) {

				$this->db->where("at_month", ltrim($val['month'],"0"));
				$this->db->where("at_year", $val['year']);
				$this->db->where("student_id", $id);
				$this->db->where("type", 0);
				$atds = $this->db->get("attendance_student")->num_rows();
				$days = cal_days_in_month(CAL_GREGORIAN,$val['month'],$val['year']);
				$sun = $this->custom->countSunday($days, $val['month'], $val['year']);
				// echo $val['month'];
				$sun = $this->db->select("h_day")->where( array("h_month"=> ltrim($val['month'],"0"), "h_year" => ltrim($val['year'],"0")) )->get('holiday')->num_rows();

				$wday = ($days-$sun);
				$abs = ($wday-$atds);
				$prc = ($atds/$wday) * 100;
				$data[] = array(
					"month" => date('M', strtotime('05'.'-'.$val['month'].'-'. $val['year'])),
					"year" => date('Y', strtotime('05'.'-'.$val['month'].'-'. $val['year'])),
					"atd" => $atds,
					"sun" => $sun,
					"abs" => $abs,
					"wday" => $wday,
					"prc" => $prc
				);

			}

			$reps['result'] = $data;
			// print_r($reps);
			$this->load->view('admin/student/excel', $reps);
			// print_r( $data );

		}

		public function info( $id =null) {

			$this->db->select("st.*, cs.course, bt.batch_name");
			$this->db->from("student st, course cs, batch bt");
			$this->db->where("st.course_id = cs.id");
			$this->db->where("st.batch = bt.id");
			$this->db->where("st.id", $id);
			$data = $this->db->get( )->row_array();

			$ids = explode(",", $data['prev_ids']);
			$this->db->select("st.*, cs.course, bt.batch_name");
			$this->db->from("student st, course cs, batch bt");
			$this->db->where("st.course_id = cs.id");
			$this->db->where("st.batch = bt.id");
			$this->db->where_in("st.code", $ids);
			// $this->db->where("st.id", $id);
			$data['pres'] = $this->db->get( )->result_array();
			// print_r($data['pres']);

			$this->load->view('admin/head');
			$this->load->view('admin/header', $head);
			$this->load->view('admin/student/info',$data);
			$this->load->view('admin/footer');

		}

		public function getMonthNo ($date1=null,  $date2 =null) {

			$start = strtotime($date1);
			$end = strtotime($date2);

			$days = ceil(abs($end - $start) / 86400);
			$m = ceil($days/30);
			return $m;

		}
		
	//https://foxyknight29.medium.com/generate-pdf-from-view-using-dompdf-in-codeigniter-3-2cd1865aa68d
	public function marksheet ( $id =null) {
	//
		
		require_once(APPPATH."third_party/tcpdf/tcpdf.php");
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
		
		$pdf->setTitle('pdf');
		$pdf->addPage();
		$html = $this->generatePdfData($id, 'marksheet');
		
		$pdf->writeHtml($html);
		return $pdf->output("test.pdf","I");
		/*  $this->load->view('admin/pdfreport');
        
        // Get output html
        $html = $this->output->get_output();
        
        // Load pdf library
        $this->load->library('pdf');
		
        
        // Load HTML content
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0)); */
		
		

	}
	
	public function certificate( $id =null) {
		require_once(APPPATH."third_party/tcpdf/tcpdf.php");
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
		
		$pdf->setTitle('pdf');
		$pdf->addPage();
		$html = $this->generatePdfData($id, 'certificate');
		
		$pdf->writeHtml($html);
		return $pdf->output("test.pdf","D");
		exit;
	}
	
	private function generatePdfData($id, $type) {
		if($type == 'marksheet') {
			$this->db->select('tbl_exam.*');
			$this->db->where("student_id", $id);
		//	echo 1; die;
			$query = $this->db->get('tbl_exam')->row();
			
			
			$this->db->select('tbl_marks.sub_name, tbl_marks.marks as sub_marks, tbl_marks.max_marks as sub_max_marks');
			$this->db->from('tbl_marks');
			$this->db->where("ex_id", $query->id);
			$this->db->join('tbl_subject', 'tbl_marks.sub_id = tbl_subject.id');
			$query->marks = $this->db->get()->result();
			
			return $this->load->view('admin/marksheet', ['data' => $query], true);
		} else if($type == 'certificate') {
			$this->db->select('tbl_exam.*');
			$this->db->where("student_id", $id);
		//	echo 1; die;
			$query = $this->db->get('tbl_exam')->row();
			return $this->load->view('admin/certificate', ['data' => $query], true);
		}
		
	}
}
