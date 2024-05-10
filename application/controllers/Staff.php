<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(2,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}


	public function index( $pg=null ) {

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

		if( $_SESSION['src']['status'] ) {
			$this->db->where("status", $_SESSION['src']['status']);
		}

		$rows = $this->db->get('staff')->num_rows();
		$lim = 20;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'staff/index/';
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


		// $this->db->select("st.*, att.id as att_id, att.logout_time,att.login_time, att.work_hour ");
		// $this->db->from('staff st');
		// $this->db->join("attendance_staff att","att.staff_id = st.id and DATE(att.at_date) = DATE('".date("Y-m-d")."')", left);
		// $this->db->group_by('att.staff_id');

		$this->db->select("*");

		if( strlen($_SESSION['src']['code']) ) {
			$this->db->where("code", $_SESSION['src']['code']);
		}

		if( strlen($_SESSION['src']['name']) ) {
			$this->db->like("fname", $_SESSION['src']['name']);
		}

		if( $_SESSION['src']['status'] ) {
			$this->db->where("status", $_SESSION['src']['status']);
		}

		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);
		$staff = $this->db->get("staff")->result_array();

		foreach ($staff as $key => $val) {
			$this->db->where("DATE(at_date) = DATE('".date("Y-m-d")."')");
			$this->db->where("staff_id", $val['code']);
			$row = $this->db->get("attendance_staff")->row();
			$val['logout_time'] = $row->logout_time;
			$val['login_time'] = $row->login_time;
			$val['att_id'] = $row->id;
			$res[] = $val;
		}

		// print_r($res);
		$data['result'] = $res;
		// $data['result'] = $this->db->get("staff")->result_array();
		$data['pages'] = $pages;
		// print_r($data);
		$data['sno'] = $start;
		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/staff/view',$data);
		$this->load->view('admin/footer');
	}


	public function add()
	{
		$post = $this->input->post('data');
		if(!empty($post)) {

			if(strlen($_FILES['image']['name'])>0) {
					$img = $_FILES['image']['name'];
					$ext = pathinfo($img);
					$ext = $ext['extension'];
					$img_name = "img-".time().".".$ext;
					move_uploaded_file($_FILES['image']['tmp_name'], 'media/staff/'.$img_name);
					$post['image'] = $img_name;
			}
			$this->db->insert( "staff", $post );
			$data['alert'] = $this->db->insert_id();
		}


		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/staff/add',$data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{

		$post = $this->input->post('data');
		if(!empty($post)) {

			if(strlen($_FILES['image']['name'])>0) {
					$img = $_FILES['image']['name'];
					$ext = pathinfo($img);
					$ext = $ext['extension'];
					$img_name = "img-".time().".".$ext;
					move_uploaded_file($_FILES['image']['tmp_name'], 'media/staff/'.$img_name);
					$post['image'] = $img_name;
			}
			$this->db->update( "staff", $post,  "id='".$id."'" );
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("staff", array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/staff/add',$data);
		$this->load->view('admin/footer');

	}

	public function attendance($id=null, $m=null, $y=null) {

		$usr = $this->db->get_where("staff", array("code"=> $id))->row_array();
		// print_r($usr);
		// $m = 11;
		if(!$y) {	$y = date('Y'); }
		if(!$m) {	$m = date('n'); }

		$this->db->select("at_day, login_time, logout_time");
		$this->db->where(array("staff_id"=>$id, "at_month"=>$m, "at_year"=>$y));
		$this->db->group_by('DATE(at_date)');
		$atd = $this->db->get('attendance_staff')->result_array();
		// print_r($atd);
		$data['attd'] = array_column($atd, "at_day");

		foreach ($atd as $key => $val) {
			$log['login'] = $val['login_time'];
			$log['logout'] = $val['logout_time'];
			$log['date'] = $val['at_date'];
			$res[$val['at_day']] = $log;
		}


		$data['logs'] = $res;
		// print_r($attd);
		$data['days'] = cal_days_in_month(CAL_GREGORIAN,$m,$y);

		// Sallary Calculation //

		// $sday = $data['days']-$sun;
	 $dsal = floor($usr['fx_sallery']/$data['days']);

		$wd = $this->db->where(array("staff_id"=>$id, "at_month"=>$m, "at_year"=>$y))->group_by('DATE(at_date)')->get('attendance_staff')->num_rows();
		// $sun =  ($wd >0)? $this->custom->countSunday($data['days'], $m, $y) : '0';
		$sun =	$this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->num_rows();

		$hr = $wd*$usr['work_hour'];
		$wr = $this->db->select_sum("work_hour")->where(array("staff_id"=>$id, "at_month"=>$m, "at_year"=>$y))->get('attendance_staff')->row()->work_hour;

	if($usr['fx_sallery']) {

		if( $wr > $hr ) {
			$exhr = $wr-$hr;
			if($exhr)  {
				$sal = (($wd+$sun)*$dsal)+($usr['ph_sallery']*$exhr);
			} else {
			}
		} else {
			$sal = (($wd+$sun)*$dsal);
		}

	} else {
		$sal = ($usr['ph_sallery']*$wr);
	}
		$data['sallary'] = $sal;
		$data['work_day'] = $wd;

		$data['name'] = $usr['fname']. ' &nbsp;' .$usr['lname'];
		$data['id'] = $id;

		$data['m'] = $m;
		$data['y'] = $y;

		$hday =	$this->db->select("h_day")->where( array("h_month"=> $m, "h_year" => $y) )->get('holiday')->result_array();
		$data['hday'] = array_column($hday, 'h_day');
		// print_r($data['hday']);

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/staff/attd',$data);
		$this->load->view('admin/footer');

	}


	public function download( $f=null ) {

	}



}
