<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

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

	public function index()
	{

		$post = $this->input->post('src');
				$this->db->group_by("student_id");
				$rows = $this->db->get('exam')->num_rows();
				$lim = 10;

				$this->load->library('pagination');
				$config['base_url'] = base_url().'exam/page/';
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


				$this->db->select("ex.student_id, ex.name, ex.total, ex.ex_code, ex.status, ex.created, cs.course, bt.batch_name");
				$this->db->from("exam ex, course cs, batch bt");

				if(!empty( $post )) {
					$this->session->src = $post;
				}

				if( strlen($_SESSION['src']['code']) ) {
					$this->db->where("ex.ex_code", $_SESSION['src']['code']);
				}

				if( strlen($_SESSION['src']['name']) ) {
					$this->db->like("ex.name", $_SESSION['src']['name']);
				}

				if( $_SESSION['src']['course_id'] ) {
					$this->db->where("ex.course_id", $_SESSION['src']['course_id']);
				}

				if( $_SESSION['src']['batch_id'] ) {
					$this->db->where("ex.batch_id", $_SESSION['src']['batch_id']);
				}

				if( $_SESSION['src']['status'] ) {
					$this->db->where("ex.status", $_SESSION['src']['status']);
				}

		$this->db->where("ex.course_id = cs.id");
		$this->db->where("ex.batch_id = bt.id");
		$this->db->group_by("student_id");

		$this->db->order_by("ex.id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get()->result_array();
		$data['pages'] = $pages;

		$data['course'] = $this->db->get_where("course", array("status"=>1))->result_array();

		if( $_SESSION['src']['course_id'] ) {
			$data['batch'] = $this->db->get_where("batch", array("status"=>1,"course_id"=>$_SESSION['src']['course_id']))->result_array();
		}

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/exam/view',$data);
		$this->load->view('admin/footer');
	}


	public function add()
	{

		$sid = $this->input->post('sid');
		$sub = $this->input->post('sub');
		$mrk = $this->input->post('mrk');

		$post = $this->input->post('data');
		
		if( !empty( $post) ) {

			$co = count( $sid );
			$co--;

			$code = $this->custom->unique_code("exam", "EXM");

			$usr = $this->db->get_where("student", array("code" => $post['student_id']))->row_array();

			if( !empty( $usr )) {

				$post['name'] = $usr['fname'] . ' ' . $usr['lname'];
				$post['ex_code'] = $code;
				//  print_r($post);

				$this->db->insert("exam", $post);

				$eid = $this->db->insert_id();

				if( $eid ) {

					for( $i=0; $i<=$co; $i++) {
						$sub_mrk = $this->db->select("marks")->where("id", $sid[$i])->get("subject")->row()->marks;
						$arr = array(
							"ex_id" => $eid,
							"sub_id" => $sid[$i],
							"sub_name" => $sub[$i],
							"marks" => $mrk[$i],
							"max_marks" => $sub_mrk
						);

						$this->db->insert("marks", $arr);
						$sum[] = $mrk[$i];
						$sb_sum[] = $sub_mrk;
						unset($arr);
					}

					$this->db->update("exam", array("total" => array_sum( $sum ), "max_marks" => array_sum( $sb_sum )), "id='$eid'");
				}

				$data['alert'] = 1;
			}

		}

		// if( !empty( $post ) ) {
		// 	$this->db->insert('subject', $post);
		// 	$data['alert'] = $this->db->insert_id();
		// }

		$data['subjects'] = $this->db->get_where("subject", array("status" => 1))->result_array();
		$data['course'] = $this->db->get_where("course", array("status" => 1))->result_array();
		//$data['batches'] = $this->db->get_where("tbl_batch", array("status"=>1))->result_array();

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/exam/add',$data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{

		$post = $this->input->post('data');

		if( !empty( $post ) ) {
			$this->db->update('subject', $post, "id='".$id."'");
			$alert = $this->db->insert_id();
		}

		$data = $this->db->get_where('subject', array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/subject/add',$data);
		$this->load->view('admin/footer');
	}

	public function detail( $code=null ) {

		$this->db->select("ex.*, cs.course, bt.batch_name");
		$this->db->from("exam ex, course cs, batch bt");
		$this->db->where("ex.course_id = cs.id");
		$this->db->where("ex.batch_id = bt.id");
		$this->db->where("ex.ex_code", $code);

		$data = $this->db->get( )->row_array();


		$this->db->select("mk.marks, sb.subject, sb.marks as mx_marks");
		$this->db->from("marks mk, subject sb");
		$this->db->where("mk.sub_id=sb.id");
		$this->db->where("mk.ex_id", $data['id']);

		$data['marks'] = $this->db->get()->result_array();

		// print_r( $data );
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/exam/detail',$data);
		$this->load->view('admin/footer');
	}

	public function eprint( $code=null ) {


		$this->db->select("ex.*, cs.course, bt.batch_name");
		$this->db->from("exam ex, course cs, batch bt");
		$this->db->where("ex.course_id = cs.id");
		$this->db->where("ex.batch_id = bt.id");
		$this->db->where("ex.ex_code", $code);
		$data = $this->db->get( )->row_array();


		$this->db->select("mk.marks, sb.subject, sb.marks as mx_marks");
		$this->db->from("marks mk, subject sb");
		$this->db->where("mk.sub_id=sb.id");
		$this->db->where("mk.ex_id", $data['id']);

		$data['marks'] = $this->db->get()->result_array();
		if($data['id'] > 0 ) {
			$this->load->view("admin/exam/print", $data);
		} else {
			echo "No Result Found...";
		}

	}


	public function info ( $code =null) {

				$this->db->select("st.*, cs.course, bt.batch_name");
				$this->db->from("student st, course cs, batch bt");
				$this->db->where("st.course_id = cs.id");
				$this->db->where("st.batch = bt.id");
				$this->db->where("st.code", $code);
				$data = $this->db->get( )->row_array();

				$exam = $this->db->where("student_id", $code)->get('exam')->result_array();

				foreach ($exam as $key => $val) {
					$this->db->select("mk.marks, sb.subject, sb.marks as mx_marks");
					$this->db->from("marks mk, subject sb");
					$this->db->where("mk.sub_id=sb.id");
					$this->db->where("mk.ex_id", $val['id']);
					$val['marks'] = $this->db->get()->result_array();

					$res[] = $val;
 				}

				$data['exdata'] = $res;
				//echo '<pre>'; print_r($data); die;
				$this->load->view('admin/head');
				$this->load->view('admin/header');
				$this->load->view('admin/exam/info',$data);
				$this->load->view('admin/footer');

	}

}
