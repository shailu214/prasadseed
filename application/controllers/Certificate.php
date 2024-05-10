<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}


	public function index( ) {
		$this->load->view('admin/head');
		$post = $this->input->post('data');
		if(!empty( $post )) {
			$roll_no = $post['roll_no'];
			$certificate_type = $post['certificate_type'];
			$ceritficate_no = $post['ceritficate_no'];
			
			$this->db->select('tbl_student.*');
			$this->db->where("code", $roll_no);
		//	echo 1; die;
			$query = $this->db->get('tbl_student')->row();
			if($query) {
				//redirect('view-certificate');
				$data = $query;
				if($certificate_type == 'certificate') {
					$data->course_id = $this->db->select('tbl_course.*')->where("id", $data->course_id)->get('tbl_course')->row();
					$data->batch = $this->db->select('tbl_batch.*')->where("id", $data->batch)->get('tbl_batch')->row();
					
					$this->db->where('certificate_number',$ceritficate_no);
					$this->db->where('student_id',$roll_no);
					$obj=$this->db->get('tbl_exam')->row();
					$data->title = 'CERTIFICATE';
					$data->exam = $obj;
					$data->roll = $roll_no;
					if($obj == null) {
						$this->session->set_flashdata('message', 'Record not found');
						redirect("download-certificate");
					}
					
					$data->marks = $this->db->select('tbl_marks.*')->where("ex_id", $obj->id)->get('tbl_marks')->result();
					
				} else if($certificate_type == 'marksheet') {
					$data->course_id = $this->db->select('tbl_course.*')->where("id", $data->course_id)->get('tbl_course')->row();
					$data->batch = $this->db->select('tbl_batch.*')->where("id", $data->batch)->get('tbl_batch')->row();
					
					$this->db->where('marksheet_number',$ceritficate_no);
					$this->db->where('student_id',$roll_no);
					$obj=$this->db->get('tbl_exam')->row();
					if($obj == null) {
						$this->session->set_flashdata('message', 'Record not found');
						redirect("download-certificate");
					}
					$data->title = 'MARKSHEET';
					$data->exam = $obj;
					$data->roll = $roll_no;
					$data->marks = $this->db->select('tbl_marks.*')->where("ex_id", $obj->id)->get('tbl_marks')->result();
				}
				//echo '<pre>'; print_r($data); die;
				$this->load->view('view-certificate', ['data' => $data]);
			} else {
				$this->session->set_flashdata('message', 'Record not found');
				redirect("download-certificate");
			}
		} else {
			$this->load->view('download-certificate', []);
		}
	}
	
	/* public function view( ) {
		$this->load->view('view-certificate', []); 
	} */
	
	private function generatePdfData($student, $id, $type) {
		if($type == 'marksheet') {
			$this->db->select('tbl_exam.*');
			$this->db->where("marksheet_number", $id);
			$this->db->where("student_id", $student->code);
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
			$this->db->where("certificate_number", $id);
			$this->db->where("student_id", $student->code);
		//	echo 1; die;
			$query = $this->db->get('tbl_exam')->row();
			return $this->load->view('admin/certificate', ['data' => $query], true);
		}
		
	}
}
