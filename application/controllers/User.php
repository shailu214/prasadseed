<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1) { redirect('dashboar.html'); }
		// $
		$_SESSION['APP_OPT_ALLOW'] = explode(',', APP_OPT_ALLOW);
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index( $pg=null ) {

		$this->db->where("role > 1");
		$rows = $this->db->get('users')->num_rows();
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

		$this->db->where("role > 1");
		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get('users')->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/user/view',$data);
		$this->load->view('admin/footer');

	}


	public function add()
	{

		$post = $this->input->post('data');
		$opt = $this->input->post('opt');
		if(!empty($post)) {
			$post['perm_opt'] = implode(",",$opt);
			$this->db->insert( "users", $post );
			$data['alert'] = $this->db->insert_id();
		}

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/user/add',$data);
		$this->load->view('admin/footer');

	}


	public function edit( $id =null)
	{

		$post = $this->input->post('data');
		$opt = $this->input->post('opt');

		if(!empty($post)) {
			$post['perm_opt'] = implode(",",$opt);
			$this->db->update( "users", $post, "id='".$id."'" );
			$alert = $this->db->affected_rows();

		}


		$data = $this->db->get_where("users", array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/user/add',$data);
		$this->load->view('admin/footer');

	}

}
