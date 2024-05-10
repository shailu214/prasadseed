<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();

	}


	public function index( $pg=null ) {

		$rows = $this->db->get('category')->num_rows();
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


		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get("category")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/category/view',$data);
		$this->load->view('admin/footer');
	}


	public function add()
	{

		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->insert("category", $post );
			$data['alert'] = $this->db->insert_id();
		}

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/category/add',$data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{

		$post = $this->input->post('data');
		if(!empty($post)) {

			$this->db->update( "category", $post,  "id='".$id."'" );
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("category", array("id"=>$id))->row_array();
		$data['alert'] = $alert;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/category/add',$data);
		$this->load->view('admin/footer');

	}



		public function sbcat( $pg=null ) {

			$rows = $this->db->get('sub_category')->num_rows();
			$lim = 10;

			$this->load->library('pagination');
			$config['base_url'] = base_url().'subcategory/page/';
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

			$this->db->select("cat.category as pcat, scat.*");
			$this->db->from("category cat, sub_category scat");
			$this->db->where("cat.id=scat.parent");
			$this->db->order_by("scat.id","desc");
			$this->db->limit($lim,$start);

			$data['result'] = $this->db->get()->result_array();
			$data['pages'] = $pages;

			$this->load->view('admin/head');
			$this->load->view('admin/header');
			$this->load->view('admin/sbcat/view',$data);
			$this->load->view('admin/footer');
		}


		public function sbcat_add()
		{

			$post = $this->input->post('data');

			if(!empty($post)) {
				$this->db->insert("sub_category", $post );
				$data['alert'] = $this->db->insert_id();
			}

			$data['categories'] = $this->db->get_where("category", array("status"=> 1))->result_array();

			$this->load->view('admin/head');
			$this->load->view('admin/header');
			$this->load->view('admin/sbcat/add',$data);
			$this->load->view('admin/footer');

		}



			public function sbcat_edit( $id=null )
			{

				$post = $this->input->post('data');

				if(!empty($post)) {
					$this->db->update( "sub_category", $post,  "id='".$id."'" );
					$alert = $this->db->affected_rows();
				}

				$data = $this->db->get_where("sub_category", array("id"=>$id))->row_array();
				$data['categories'] = $this->db->get_where("category", array("status"=> 1))->result_array();
				$data['alert'] = $alert;

				$this->load->view('admin/head');
				$this->load->view('admin/header');
				$this->load->view('admin/sbcat/add',$data);
				$this->load->view('admin/footer');

			}

}
