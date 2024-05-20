<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$this->pageParam->nav = 'sell';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

	
	public function index( $pg=null ) {
		$post = $this->input->get('data');
		$request = http_build_query($_GET);
		//echo '<pre>'; print_r($request); die;
		$search = null;
		if(!empty( $post )) {
			if($post['fdate'] != '' && $post['tdate'] != '') {
				//$start_date = $post['fdate'];
				//$end_date = $post['tdate'];
				//$this->db->where('due_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
				//$this->db->join('sell_deposit', 'sell.id = sell_deposit.sell_id');
			}
			
			if($post['vendor_id'] != '') {
				$this->db->where('vendor_id', $post['vendor_id']);
			}
			
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$rows = $this->db->get('sell')->num_rows();
		$lim = 10;
		
		$search = null;
		if(!empty( $post )) {
			if($post['vendor_id'] != '') {
				$this->db->where('vendor_id', $post['vendor_id']);
			}
			
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
	
		$this->load->library('pagination');
		$config['suffix'] = '?'.$request;
		$config['base_url'] = base_url().'sell/index/';
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
		if($search != null) {
			$this->db->where('year(year)', $search);
		}
		$this->db->select("sell.*");
		if(!empty( $post )) {
			/* if($post['fdate'] != '' && $post['tdate'] != '') {
				$start_date = $post['fdate'];
				$end_date = $post['tdate'];
				
				$this->db->where('sell_deposit.due_date >=', $start_date);
				$this->db->where('sell_deposit.due_date <=', $end_date);
				$this->db->join('sell_deposit', 'sell.id = sell_deposit.sell_id');
			} */
			
			if($post['due_date'] != '') {
				$due_date = $post['due_date'];
				
				$this->db->where('sell_deposit.due_date =', $due_date);
				$this->db->join('sell_deposit', 'sell.id = sell_deposit.sell_id');
			}
			
			if($post['fdate'] != '' && $post['tdate'] != '') {
				$start_date = $post['fdate'];
				$end_date = $post['tdate'];
				$this->db->where('sell.year BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
				//$this->db->where('sell.created BETWEEN "'. date('Y-m-d H:i:s', strtotime($start_date.' 00:00:00')). '" and "'. date('Y-m-d H:i:s', strtotime($end_date.' 23:59:59')).'"');
			}
		}

		$this->db->order_by("sell.id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get("sell")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/sell/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("sell")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}
		$this->db->where('id', $obj->vendor_id);
		$vendors = $this->db->get("vendors")->row();
		if($vendors) {
			$obj->vendor_id = $vendors->name;
		}

			$this->db->select_sum('amount');
			$this->db->where('sell_id', $obj->id);
			$objcount = $this->db->get('sell_deposit')->result_array();
		//echo '<pre>'; print_r($objcount); die;

		//$this->db->where('amount_id', $id);
		//$amount_deposit = $this->db->get("amount_deposit")->result_array();

		$this->db->where('sell_id', $id);
		$amount_deposit = $this->db->get("sell_deposit")->result_array();
		
		
		$this->db->where('sell_id', $id);
		$loadqty = $this->db->get("sell_load")->result_array();
		
		//echo '<pre>'; print_r($loadqty); die;

		$data = ['obj' => $obj, 'amount_deposit' => $amount_deposit, 'loadqty' => $loadqty, 'totalamt' => $objcount[0]['amount']];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/sell/info',$data);
		$this->load->view('admin/footer');
	}


	public function add($id=null)
	{
		$post = $this->input->post('data');
		if(!empty($post)) {
			if($this->pageParam->role != 1) {
				redirect("sell");
			}
			$errors = [];
			if(empty($post['year'])) {
				$errors[] = 'Year is required';
			}
			if(empty($post['farmer_id'])) {
				$errors[] = 'Farmer Name is required';
			}
			if(empty($post['farmer_lot_id'])) {
				$errors[] = 'Farmer Lot is required';
			}
			if($post['self'] == 0) {
				if(empty($post['vendor_id'])) {
					$errors[] = 'Vendor is required';
				}
			}
			
			$lotid = $post['farmer_lot_id'];
			$this->db->where('id', $lotid);
			$farmerlot = $this->db->get('farmer_lots')->row();
			if($farmerlot == null) {
				$errors[] = 'Lot Not Found ';
				$this->session->set_flashdata('errors', $errors);
				redirect("sell/add");
			}
			
			$this->db->select_sum('quantity');
			$this->db->where('farmer_lot_id', $farmerlot->id);
			$objcount = $this->db->get('tbl_sell')->result_array();
			$objcount[0]['quantity'];
			
			$this->db->where('id', $farmerlot->entry_management_id);
			$entryCheck = $this->db->get('entry_management')->row();
			
			if(($entryCheck->qty - $objcount[0]['quantity']) < $post['quantity']) {
				$errors[] = 'Qty should be '.($entryCheck->qty - $objcount[0]['quantity']);
			}
			
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("sell/add");
			}
			
			$pkid = $this->input->post('pkid');
			$this->db->where('id', $pkid);
			$obj = $this->db->get('sell')->row();
			//echo '<pre>'; print_r($_POST); die;
			if($post['self'] == 1) {
				$post['price'] = 0;
			}
			$post['total_amount'] = $post['price'];
			$post['qty2'] = $post['qty2'];
			if($obj) {
				
				$this->session->set_flashdata('success_entry', 'success update');
				$this->db->where('id', $pkid);
				$this->db->update('sell', $post);
				redirect("sell/add/".$pkid);
			} else {
				$this->session->set_flashdata('success_entry', 'success');
				//$post['created'] = date('Y-m-d');
				$this->db->insert("sell", $post );
				$insert_id = $this->db->insert_id();
				//$this->db->where('bardana_id', $insert_id);
				foreach($this->input->post('bardanacomment') as $k => $bardanacmt) {//echo 1111; print_r($bardanacmt);
					$this->db->insert("bardana_comment", ['sell_id'=>$insert_id,'bardana_id'=>$k,'comment'=>$bardanacmt]);
				}
				//echo '<pre>'; print_r($_POST); print_r($this->input->post('bardanacomment')); die;
				
				//die;
				redirect("sell/add");
			}
		}
		//echo 123; die;
		$result = ['obj' => null, 'lots' => [], 'bardana' => []];
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get('sell')->row();
			if($obj) {
				$result['obj'] = $obj;
				
				//$this->db->where('farmer_id', $entry_management->farmer_id);
				//$result['bardana'] = $this->db->get('bardana')->result_array();
				
				$lots = [];
				$this->db->where('farmer_id', $obj->farmer_id);
				$data = $this->db->get('farmer_lots');
				foreach($data->result_array() as $obj) {
					$lots[] = $obj;
				}
				
				$result['lots'] = $lots;
		
			} else {
				redirect("sell/add");
			}
			
		}
		//echo '<pre>'; print_r($result['obj']);  die;
		$result['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/sell/add',$result);
		$this->load->view('admin/footer');
	}

	public function farmerajax()
	{
		$term = $this->input->post('searchTerm');
		$this->db->select('farmer.*, address.address as addr');
		$this->db->like('farmer.name', $term);
		$this->db->or_like('address.address', $term);
		$this->db->or_like('farmer.mobile', $term);
		$this->db->or_like('farmer.father_name', $term);
		$this->db->or_like('farmer.reference_name', $term);
		$this->db->limit(5);
		$this->db->join('address', 'address.id = farmer.address');
		$data = $this->db->get('farmer');
		$result = [];
		foreach($data->result_array() as $val) {
			$string = $val['name'].', '.$val['mobile'];
			if($val['father_name'] != null) {
				$string .= ', '.$val['father_name'];
			}
			if($val['reference_name'] != null) {
				$string .= ', '.$val['reference_name'];
			}
			$string .= ', '.$val['addr'];
			$lots = [];
			$this->db->where('farmer_id', $val['id']);
			$data = $this->db->get('farmer_lots');
			foreach($data->result_array() as $obj) {
			
				$lots[] = ['id' => $obj['id'], 'lots' => $obj['lots']];
			}
			$result[] = ['id' => $val['id'], 'search' => $string, 'lots' => $lots];
		}
		echo json_encode($result);
	}
	
	public function deposit($id) {
		
		$post = $this->input->post('data');
		$search = null;
		if(!empty( $post )) {
			$pkid = $this->input->post('pkid');
			$errors = [];
			if(empty($post['date'])) {
				$errors[] = 'Date is required';
			}
			if(empty($post['amount'])) {
				$errors[] = 'Amount is required';
			}
			
			if($post['amount'] > 0 && $pkid > 0) {
				$this->db->where('id', $pkid);
				$row = $this->db->get("sell")->row();
				
				$this->db->where('sell_id', $pkid);
				$this->db->select_sum('amount');

				$totalPreAmount = $this->db->get("sell_deposit")->row();
				//echo $post['amount']; die;
				if(($totalPreAmount->amount+$post['amount']) > ($row->quantity*$row->price)) {
					$errors[] = 'Amount should not be more then balance amount';
				}
				
			}
			
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("sell/deposit/".$pkid);
			}
			
			if($post['amount'] > 0) {
				$post['sell_id'] = $pkid;
				$this->db->insert("sell_deposit", $post );
				//$lastid = $this->db->insert_id();
				
				/* $this->db->where('id', $pkid);
				$row = $this->db->get("amount")->row();
				$deposit = $row->deposit_amount + $post['amount'];
				$balance_amount = $row->balance_amount - $post['amount'];
				$this->db->where('id', $pkid);
				$this->db->update('amount', ['deposit_amount' => $deposit, 'balance_amount' => $balance_amount]); */
				redirect("sell");
			} else {
				$errors[] = 'Enter Valid Amount';
				if(count($errors) > 0) {
					$this->session->set_flashdata('errors', $errors);
					redirect("sell/deposit/".$pkid);
				}
			}
		}
		$this->db->where('id', $id);
		$obj = $this->db->get("sell")->row();
		if($obj == null) {
			redirect("sell");
		}
		
		$this->db->where('sell_id', $id);
		$list = $this->db->get("sell_deposit")->result_array();
		
		$data = ['obj' => $obj, 'list' => $list];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/sell/deposit',$data);
		
	}
	
	
	public function deposit_x($id) {
		
		$post = $this->input->post('data');
		$search = null;
		if(!empty( $post )) {
			$pkid = $this->input->post('pkid');
			$errors = [];
			if(empty($post['date'])) {
				$errors[] = 'Date is required';
			}
			if(empty($post['amount'])) {
				$errors[] = 'Amount is required';
			}
			if(empty($post['due_date'])) {
				$errors[] = 'Due Date is required';
			}
			
			if($post['amount'] > 0 && $pkid > 0) {
				$this->db->where('id', $pkid);
				$row = $this->db->get("amount")->row();
				
				$this->db->where('amount_id', $pkid);
				$this->db->select_sum('amount');

				$totalPreAmount = $this->db->get("amount_deposit")->row();
				
				if(($totalPreAmount->amount+$post['amount']) > $row->balance_amount) {
					$errors[] = 'Amount should not be more then balance amount';
				}
				
			}
			
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("sell/deposit/".$pkid);
			}
			
			if($post['amount'] > 0) {
				$post['amount_id'] = $pkid;
				$this->db->insert("amount_deposit", $post );
				//$lastid = $this->db->insert_id();
				
				$this->db->where('id', $pkid);
				$row = $this->db->get("amount")->row();
				$deposit = $row->deposit_amount + $post['amount'];
				$balance_amount = $row->balance_amount - $post['amount'];
				$this->db->where('id', $pkid);
				$this->db->update('amount', ['deposit_amount' => $deposit, 'balance_amount' => $balance_amount]);
				redirect("sell");
			} else {
				$errors[] = 'Enter Valid Amount';
				if(count($errors) > 0) {
					$this->session->set_flashdata('errors', $errors);
					redirect("sell/deposit/".$pkid);
				}
			}
		}
		$this->db->where('id', $id);
		$obj = $this->db->get("sell")->row();
		if($obj == null) {
			redirect("sell");
		}

		$data = ['obj' => $obj];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/sell/deposit',$data);
		
	}

	
	public function load($id)
	{
		$this->db->where('id', $id);
		$obj = $this->db->get('sell')->row();
		if($obj == null) {
			redirect("sell");
		}
			
		$post = $this->input->post('data');
		if(!empty($post)) {
			echo $pkid = $this->input->post('pkid');
			if($this->pageParam->role != 1) {
				redirect("sell");
			}
			
			$errors = [];
			if(empty($post['date'])) {
				$errors[] = 'date is required';
			}
			if(empty($post['qty'])) {
				$errors[] = 'Qunatity is required';
			}
			
			//echo '<pre>'; print_r($post); die;
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("sell/load/".$id);
			}
			
			$post['sell_id'] = $pkid;
			
			$this->session->set_flashdata('success_entry', 'success create');
			$this->db->insert("sell_load", $post );
			
			redirect("sell/load/".$id);
			
		}
		
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/sell/load',['id' => $id]);
		$this->load->view('admin/footer');
	}


	
	public function delete($amountid) {
		if($this->pageParam->role == 1) {
			$this->db->where('id', $amountid);
			$amt = $this->db->get('sell')->row();
			if($amt) {
				$this->db->where('sell_id', $amt->id);
				$this->db->delete('sell_deposit');
				
				$this->db->where('id', $amt->id);
				$this->db->delete('sell');
			}
		}
		
		redirect("sell");
	}
	
	public function vendorsearchajax()
	{
		$term = $this->input->post('searchTerm');
		$this->db->select('vendors.*');
		$this->db->like('vendors.name', $term);
		$this->db->or_like('vendors.address', $term);
		$this->db->or_like('vendors.mobile', $term);
		$this->db->limit(5);
		$data = $this->db->get('vendors');
		$result = [];
		foreach($data->result_array() as $val) {
			$string = $val['name'].', '.$val['mobile'].', '.$val['address'];
			$result[] = ['id' => $val['id'], 'search' => $string, 'lots' => $lots];
		}
		echo json_encode($result);
	}
	
	public function export() {
		$post = $this->input->get('data');
		//echo '<pre>'; print_r($post); die;
		$csvData[] =array("Farmer", "Lot No","Year","Vendor", "Qty","Price","Total Price");
		$this->db->limit(50);
		$data = $this->db->get("sell")->result_array();
		foreach($data as $cnt){
			$vendorname = 'self';
			$farmerName = $lot = '';
			
			if($cnt['self'] == 0 && $cnt['vendor_id'] > 0) {
				$this->db->where('id', $cnt['vendor_id']);
				$vendor = $this->db->get('vendors')->row();
				if($vendor) {
					$vendorname = $vendor->name;
				}
			}
			
			$this->db->where('id', $cnt['farmer_id']);
			$obj = $this->db->get('farmer')->row();
			if($obj) {
				$farmerName = $obj->name;
			}
			
			$this->db->where('id', $cnt['farmer_lot_id']);
			$obj = $this->db->get('farmer_lots')->row();
			if($obj) {
				$lot = $obj->lots;
			}
			$csvData[]=array(
			  $farmerName ,$lot, $cnt['year'], $vendorname, $cnt['quantity'], $cnt['price'], $cnt['quantity']*$cnt['price']
			);
		}

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=Report_".time().".csv");
		header("Content-Transfer-Encoding: binary");
		$df = fopen("php://output", 'w');
		array_walk($csvData, function($row) use ($df) {
		  fputcsv($df, $row);
		});
		fclose($df);
	}
}
