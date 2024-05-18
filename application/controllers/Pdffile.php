<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdffile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->pageParam->nav = 'pdffile';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

    public function index( $pg=null ) {
		$id = 2;
		$this->db->where('id', $id);
		$obj = $this->db->get('challan')->row();
		if($obj) {
			$this->db->where('id', $obj->farmer_id);
			$farmer = $this->db->get('farmer')->row();
			if($farmer) {
				$obj->farmer = $farmer->name;
			}
		}
		$data['obj'] = $obj;
		//echo '<pre>'; print_r($data); die;
		
		$this->load->view('admin/head');
		$this->load->view('admin/challan/pdf',$data);
		//$this->load->view('admin/footer');
	}

    public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("fare_gadi_bada")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}

		$data = ['obj' => $obj];
		$this->load->view('admin/challan/info',$data);
		$this->load->view('admin/footer');
	}




}
