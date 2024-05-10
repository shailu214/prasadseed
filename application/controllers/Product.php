<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(8,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();

		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();

	}

	public function index( $pg=null )
	{

		$post = $this->input->post('src');

		if(!empty( $post )) {
			$this->session->src = $post;
		}

		if( strlen($_SESSION['src']['name']) ) {
			$this->db->like("product_name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['sts']) ) {
			$this->db->where("status", $_SESSION['src']['sts']);
		}

		$rows = $this->db->get('product')->num_rows();
		$lim = 10;

		$this->load->library('pagination');

		$config['base_url'] = base_url().'product/page/';
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
			$this->db->like("product_name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['sts']) ) {
			$this->db->where("status", $_SESSION['src']['sts']);
		}
		$this->db->order_by("id", "desc");
		$this->db->limit($lim, $start);
		$data['result'] = $this->db->get("product")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/product/view', $data);
		$this->load->view('admin/footer');

	}


	public function add()
	{
		$post = $this->input->post('data');

			if(!empty($post)) {
				// $post['gst_amt'] = ($post['sell_price']/100)*$post['gst'];
				$this->db->insert("product", $post);
				$data['alert'] = $this->db->insert_id();
			}

			$data['taxes'] = $this->db->get_where( "tax", array( "status" => 1 ) )->result_array();

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/product/add', $data);
		$this->load->view('admin/footer');
	}


	public function edit( $id=null )
	{
		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->update("product", $post, "id='".$id."'");
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("product", array("id" => $id))->row_array();
		$data['taxes'] = $this->db->get_where( "tax", array( "status" => 1 ) )->result_array();

		$data['alert'] = $alert;

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/product/add', $data);
		$this->load->view('admin/footer');
	}

}
