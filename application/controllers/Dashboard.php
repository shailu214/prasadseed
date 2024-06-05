<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['farmers'] = $this->db->get("farmer")->num_rows();
		$data['entry'] = $this->db->get("entry_management")->num_rows();
		$data['bardana'] = $this->db->get("bardana")->num_rows();
		$data['amount'] = $this->db->get("amount")->num_rows();
		$data['fare'] = $this->db->get("fare_gadi_bada")->num_rows();
		$head['nav'] = 1;

		$data['total_qty'] = $this->db->select_sum('qty')->get("entry_management")->row();
		$data['total_qty_sell'] = $this->db->select_sum('quantity')->get("sell")->row();
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
	}

	public function sync() {
		$date = date('Y-m-d');
		$this->db->where('lending_sync_date < DATE_SUB(NOW(), INTERVAL 30 DAY )');
		
		$this->db->select('id, lending_sync_date, credit_amount, per, cal_per, balance_amount');
		$data = $this->db->get('amount')->result_array();
		$arr = [];
		foreach($data as $obj) {
			$cal_per = ($obj['credit_amount']*$obj['per'])/100;
			$balance_amount = ($obj['cal_per']+$obj['credit_amount']);
			$arr = [
				'lending_sync_date' => $date,
				'cal_per' => $obj['cal_per']+$cal_per,
				'balance_amount' => $obj['balance_amount']+$cal_per,
			];
			$this->db->where('id', $obj['id']);
			$this->db->update('amount', $arr);
		}
		redirect('dashboard');
	}
}
