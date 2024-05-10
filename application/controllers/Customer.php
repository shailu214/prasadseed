<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(9,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
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
			$this->db->like("customer_name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['mob']) ) {
			$this->db->where("mobile", $_SESSION['src']['mob']);
		}

		$rows = $this->db->get('customer')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'customer/page/';
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
			$this->db->like("customer_name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['mob']) ) {
			$this->db->where("mobile", $_SESSION['src']['mob']);
		}
		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get("customer")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/customer/view',$data);
		$this->load->view('admin/footer');
	}


	public function add()
	{
		$post = $this->input->post('data');
		if(!empty($post)) {
			$post['code'] = $this->custom->unique_code("customer", "CST");
			$this->db->insert( "customer", $post );
			$data['alert'] = $this->db->insert_id();
		}

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/customer/add',$data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{

		$post = $this->input->post('data');
		if(!empty($post)) {

			$this->db->update( "customer", $post,  "id='".$id."'" );
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("customer", array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/customer/add',$data);
		$this->load->view('admin/footer');

	}


	public function detail ( $id=null ) {

		$data = $this->db->get_where("customer", array("id"=>$id))->row_array();

		$data['paid'] = $this->getAmtTotal(1,$id);
		$data['due'] = $this->getAmtTotal(0,$id);
		$this->db->where("customer_id", $id);

		$this->db->where("due > 0");
		$data['orders'] = $this->db->get_where('order')->result_array();

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/customer/info',$data);
		$this->load->view('admin/footer');
	}

	public function getAmtTotal($type=null, $id=null) {
		if($type == 1){
			$this->db->select_sum('paid');
			$this->db->where("customer_id", $id);
			$amt = $this->db->get('order')->row()->paid;
		} else {
			$this->db->select_sum('due');
			$this->db->where("customer_id", $id);
			$amt = $this->db->get('order')->row()->due;
		}
		return $amt;
	}

}
