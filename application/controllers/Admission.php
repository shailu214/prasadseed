<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(19,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
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

		if( strlen($_SESSION['src']['name']) ) {
			$this->db->like("name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['mob']) ) {
			$this->db->where("mobile", $_SESSION['src']['mob']);
		}

		$rows = $this->db->get('admission_query')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'admission/page/';
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

				if( strlen($_SESSION['src']['name']) ) {
					$this->db->like("name", $_SESSION['src']['name']);
				}

				if( strlen($_SESSION['src']['mob']) ) {
					$this->db->where("mobile", $_SESSION['src']['mob']);
				}


		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get('admission_query')->result_array();
		$data['pages'] = $pages;

		$data['sno'] = $start;

		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/admission/view',$data);
		$this->load->view('admin/footer');
	}


	public function add()
	{
		$post = $this->input->post('data');
		// print_r($post);
		if(!empty($post)) {
			$this->db->insert( "admission_query", $post );
			$data['alert'] = $this->db->insert_id();
		}

		$head['nav'] = 2;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/admission/add',$data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{

		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->update( "admission_query", $post, "id='".$id."'" );
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("admission_query", array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$head['nav'] = 2;

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/admission/add',$data);
		$this->load->view('admin/footer');

	}




		public function download ( $id=null ) {

			$this->load->model('custom');

			$usr = $this->db->get_where("student", array("id"=>$id))->row_array();
			$crs = $this->db->get_where("course", array("id"=> $id))->row_array();
			$join = date("Y-m-d", strtotime($usr['created']));

				if( date('d', strtotime( $join) )>28 ) {
					$join = date("Y-m-d", strtotime($usr['created']." -5 days"));
				}

			$drs = $crs['validity'];

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
				$wday = ($days-$sun);
				$abs = ($wday-$atds);
				// $prc = (($atds$wday) / $wday) * 100;
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

}
