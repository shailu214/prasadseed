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

    public function index( $id ) {
		$this->db->where('id', $id);
		$obj = $this->db->get('challan')->row();
		if($obj) {
			$this->db->where('id', $obj->farmer_id);
			$farmer = $this->db->get('farmer')->row();
			if($farmer) {
				$obj->farmer = $farmer->name;
				$this->db->where('id', $farmer->address);
				$addressobj = $this->db->get('address')->row();
				if($addressobj) {
					$obj->address = $addressobj->address;
				}
			}



			$this->db->where('id', $obj->vegetable_id);
			$vegetable = $this->db->get('vegetable')->row();
			if($vegetable) {
				$obj->vegetable = $vegetable->name;
			}
		}
		$data['obj'] = $obj;
		//echo '<pre>'; print_r($data); die;
		
		$this->load->view('admin/head');
		$this->load->view('admin/challan/pdf',$data);
		//$this->load->view('admin/footer');
	}
	
	public function delivery( $id ) {
		$this->db->where('id', $id);
		$obj = $this->db->get('challan')->row();
		if($obj) {
			$this->db->where('id', $obj->farmer_id);
			$farmer = $this->db->get('farmer')->row();
			if($farmer) {
				$obj->farmer = $farmer->name;
				$this->db->where('id', $farmer->address);
				$addressobj = $this->db->get('address')->row();
				if($addressobj) {
					$obj->address = $addressobj->address;
				}
			}



			$this->db->where('id', $obj->vegetable_id);
			$vegetable = $this->db->get('vegetable')->row();
			if($vegetable) {
				$obj->vegetable = $vegetable->name;
			}
		}
		$data['obj'] = $obj;
		//echo '<pre>'; print_r($data); die;
		
		$this->load->view('admin/head');
		$this->load->view('admin/delivery/pdf',$data);
		//$this->load->view('admin/footer');
	}


	public function rasid( $id ) {
		$this->db->where('id', $id);
		$obj = $this->db->get('rasid')->row();
		if($obj) {
			$this->db->where('id', $obj->farmer_id);
			$farmer = $this->db->get('farmer')->row();
			if($farmer) {
				$obj->farmer = $farmer->name;
				$this->db->where('id', $farmer->address);
				$addressobj = $this->db->get('address')->row();
				if($addressobj) {
					$obj->address = $addressobj->address;
				}
			}

			$this->db->where('id', $obj->farmer_lot_id);
			$farmer_lot = $this->db->get("farmer_lots")->row();
			if($farmer_lot) {
				$obj->farmer_lot_id = $farmer_lot->lots;
			}

			$this->db->where('id', $obj->vendor_id);
			$vendor = $this->db->get("vendors")->row();
			if($vendor) {
				$obj->vendor_id = $vendor->name;
			}

			$this->db->where('id', $obj->vegetable_id);
			$vegetable = $this->db->get('vegetable')->row();
			if($vegetable) {
				$obj->vegetable = $vegetable->name;
			}
		}
		$data['obj'] = $obj;
		//echo '<pre>'; print_r($data); die;
		
		$this->load->view('admin/head');
		$this->load->view('admin/rasid/pdf',$data);
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
