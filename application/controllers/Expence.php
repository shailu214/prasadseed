<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expence extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(6,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	private function sum_amt($type) {
		$this->db->select_sum('amount');
			$this->db->where('type', $type);
		return  $this->db->get('expences')->row();
	}

	public function index($pg=null)
	{
		$post = $this->input->post('src');

		if(!empty( $post )) {
			//echo '<pre>'; print_r($post); die;
			//$this->session->src = $post;
		

			if( $post['cat'] > 0 ) {
				$this->db->where("cat", $post['cat']);
			}

			if(  $post['sbcat'] > 0 ) {
				$this->db->where("sbcat", $post['sbcat']);
			}

			if( strlen($post['sdate']) ) {
				$this->db->where("DATE(created) >= DATE('".date("Y-m-d", strtotime($post['sdate']))."')");
			}
			if( strlen($post['edate']) ) {
				$this->db->where("DATE(created) <= DATE('".date("Y-m-d", strtotime($post['edate']))."')");
			}
		}
		$rows = $this->db->get('expences')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'expence/index/';
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

		$this->db->select("cat.category as pcat, scat.category, ex.*");
		$this->db->from("expences ex, category cat, sub_category scat");

		if( $post['cat'] > 0 ) {
			$this->db->where("ex.cat", $post['cat']);
		}

		if(  $post['sbcat'] > 0 ) {
			$this->db->where("ex.sbcat", $post['sbcat']);
		}

		if( strlen($pos['sdate']) ) {
			$this->db->where("DATE(ex.created) >= DATE('".date("Y-m-d", strtotime($post['sdate']))."')");
		}
		if( strlen($post['edate']) ) {
			$this->db->where("DATE(ex.created) <= DATE('".date("Y-m-d", strtotime($post['edate']))."')");
		}
		if(!empty( $post )) {
			if(!empty($post['search_year'])) {
				$this->db->where("year(ex.created)", $post['search_year']);
				//echo '<pre>'; print_r($post); die;
			}
			
			//$this->session->src = $post;
		}
		$this->db->where("ex.cat=cat.id");
		$this->db->where("ex.sbcat=scat.id");
		$this->db->order_by("ex.id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get()->result_array();
	//	echo '<pre>'; print_r($data); die;
		$data['pages'] = $pages;
		$data['sno'] = $start;

		$data['cats'] = $this->db->get_where("category", array("status"=>1))->result_array();
		if($post['cat']>0) {
			$data['scats'] = $this->db->get_where("sub_category", array("status"=>1, "parent"=>$post['cat']))->result_array();
		}
		$data['deposit_sum'] = $this->sum_amt(1)->amount;
		//print_r($data['deposit']); die;
		$data['expense_sum'] = $this->sum_amt(2)->amount;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/expences/view', $data);
		$this->load->view('admin/footer');

	}


	public function add() {

		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->insert("expences", $post);
			$data['alert'] = $this->db->insert_id();
		}

		$data['cats'] = $this->db->get_where("category", array("status"=>1))->result_array();

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/expences/add', $data);
		$this->load->view('admin/footer');
	}


		public function edit( $id =null) {

			$post = $this->input->post('data');

			if(!empty($post)) {
				$this->db->update("expences", $post, "id='".$id."'");
				$alert = $this->db->affected_rows();
			}

			$data = $this->db->get_where("expences", array("id" => $id))->row_array();

			$data['alert'] = $alert;
			$data['edit'] = 1;

			$this->load->view('admin/head');
			$this->load->view('admin/header');
			$this->load->view('admin/expences/add', $data);
			$this->load->view('admin/footer');
		}


		public function download() {

			$this->db->select("cat.category as pcat, scat.category, ex.*");
			$this->db->from("expences ex, category cat, sub_category scat");

			if( $_SESSION['src']['cat'] > 0 ) {
				$this->db->where("ex.cat", $_SESSION['src']['cat']);
			}

			if(  $_SESSION['src']['sbcat'] > 0 ) {
				$this->db->where("ex.sbcat", $_SESSION['src']['sbcat']);
			}

			if( strlen($_SESSION['src']['sdate']) ) {
				$this->db->where("DATE(ex.created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
			}
			if( strlen($_SESSION['src']['edate']) ) {
				$this->db->where("DATE(ex.created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
			}

			$this->db->where("ex.cat=cat.id");
			$this->db->where("ex.sbcat=scat.id");
			$this->db->order_by("ex.id","desc");
			$this->db->limit($lim,$start);

			$data['result'] = $this->db->get()->result_array();
			$data['deposit_sum'] = $this->sum_amt(1)->amount;
			//print_r($data['deposit']); die;
			$data['expense_sum'] = $this->sum_amt(2)->amount;
			//echo '<PRE>'; print_r($data['result']); die;
			$this->load->view("admin/expences/excel", $data);

		}

}
