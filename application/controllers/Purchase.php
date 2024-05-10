<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		$this->load->model('custom');
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		$this->load->model('custom');
		$this->custom->setConfig();
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index( $pg=null )
	{
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(12,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

		$post = $this->input->post('src');

		if(!empty( $post )) {
			$this->session->src = $post;
		}

		if( strlen($_SESSION['src']['oid']) ) {
			$this->db->where("code", $_SESSION['src']['oid']);
		}

		if( $_SESSION['src']['vid'] ) {
			$this->db->where("vendor_id", $_SESSION['src']['vid']);
		}

		if( strlen($_SESSION['src']['sdate']) ) {
			$this->db->where("DATE(purchase_date) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
		}
		if( strlen($_SESSION['src']['edate']) ) {
			$this->db->where("DATE(purchase_date) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
		}

		$rows = $this->db->get('purchase')->num_rows();
		$lim = 10;

		$this->load->library('pagination');
		$config['base_url'] = base_url().'batch/page/';
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

		$this->db->select("pch.*, vnd.company_name,vnd.mobile as vmobile");
		$this->db->from("purchase pch, vendor vnd");
		$this->db->where("pch.vendor_id=vnd.id");

		if( strlen($_SESSION['src']['oid']) ) {
			$this->db->where("pch.code", $_SESSION['src']['oid']);
		}

		if( $_SESSION['src']['vid'] ) {
			$this->db->where("pch.vendor_id", $_SESSION['src']['vid']);
		}

		if( strlen($_SESSION['src']['sdate']) ) {
			$this->db->where("DATE(pch.purchase_date) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
		}
		if( strlen($_SESSION['src']['edate']) ) {
			$this->db->where("DATE(pch.purchase_date) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
		}

		$this->db->order_by("pch.id", "desc");
		$this->db->limit($lim, $start);

		$data['result'] = $this->db->get()->result_array();
		$data['pages'] = $pages;
		$data['sn'] = $start;

		$data['vendors'] = $this->db->get("vendor")->result_array();

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/purchase/view', $data);
		$this->load->view('admin/footer');

	}


	public function add()
	{
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(12,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

		if(!empty($_POST)) {

			$code = $this->custom->unique_code("purchase", "PCS");
			$pid = $this->input->post('pid');
			$qty = $this->input->post('qty');
			$date = $this->input->post('date');
			$cust = $this->input->post('vendor');
			$prods = $this->input->post('prod');

			$co = count($pid);

			if( $co>0 ) {

			 $ord = array(
				 "code" => $code,
				 "vendor_id" => $cust,
				 "purchase_date" => date("Y-m-d", strtotime($date)),
			 );
			 // print_r($ord);
			 $this->db->insert("purchase", $ord);
			 $oid = $this->db->insert_id();

			$co--;
			for($i=0; $i<=$co; $i++) {

				$prd = $this->db->where("id", $pid[$i])->get('product')->row_array();

				$prc = ceil($prd['purchase_price']*$qty[$i]);
				// $gst = ceil(($prc/100)*$prd['gst']);

				$item = array(
					"order_id" => $oid,
					"prod_id" => $pid[$i],
					"product_name" => $prd['product_name'],
					"price" => $prc,
					"qty" => $qty[$i],
					"gst" => $prd['gst'],
					// "gst_amt" => $gst,
					"total" => $prc
				);

				$this->db->insert("purchase_item", $item);
				$this->db->set('qty', 'qty+'.$qty[$i], FALSE);
				$this->db->set('pqty', 'pqty+'.$qty[$i], FALSE);
				$this->db->where('id', $pid[$i]);
				$this->db->update("product");

				$gsum[]= $gst;
				$tsum[]= $prc;
			}

			$tot = array_sum($tsum);
			// $gtot = array_sum($gsum);

			$arr = array(
				"amount" => $tot,
				"due" => $tot,
				"total" => $tot
			);
			$this->db->update("purchase", $arr, "id='".$oid."'");
			$data['alert'] = $oid;

			$this->db->insert("payment",
					array(
						"uid" => $cust,
						"type" => 2,
						"trx_type" => 2,
						"ord_id" => $oid,
						"amount" => $arr['total'],
						"desc" => "Amount credited on order - <a href='".base_url()."purchase/detail/".$oid."'>#".$code."</a>"
				));

				redirect('purchase/detail/'.$oid);
			}


			if(!empty($prods)) {
					$this->db->insert("product", $prods);
					$data['alert'] = $this->db->insert_id();
			}

		}

		$data['products'] = $this->db->where("status",1)->order_by("product_name","asc")->get("product")->result_array();

		$data['vendors'] = $this->db->get("vendor")->result_array();

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/purchase/add', $data);
		$this->load->view('admin/footer');

	}

//
// 	public function edit( $id )
// 	{
//
// 		$post = $this->input->post('data');
//
// 		if(!empty($post)) {
// 			$this->db->update("batch", $post, "id='".$id."'");
// 			$alert = $this->db->affected_rows();
// 		}
//
// 		$data = $this->db->get_where("batch", array("id" => $id))->row_array();
// 		$data['course'] = $this->db->get_where("course", array("status" => 1))->result_array();
//
// 		$data['alert'] = $alert;
//
// 		$this->load->view('admin/head');
// 		$this->load->view('admin/header');
// 		$this->load->view('admin/batch/add', $data);
// 		$this->load->view('admin/footer');
// 	}
//
// 	public function unique_code() {
// 		$id =  $this->db->select('id')->order_by('id','desc')->get('purchase')->row()->id;
// 		$id++;
// 		if(strlen($id) == 1 ) {
// 			$oid = "PRC00000".$id;
// 		} elseif( strlen($id) == 2) {
// 			$oid = "PRC0000".$id;
// 		} elseif( strlen($id) == 3) {
// 			$oid = "PRC000".$id;
// 		} elseif( strlen($id) == 4) {
// 			$oid = "PRC00".$id;
// 		} elseif( strlen($id) == 5) {
// 			$oid = "PRC0".$id;
// 		} else {
// 			$oid = "PRC".$id;
// 		}
// 	return $oid;
// }


public function detail( $id =null) {
	if($_SESSION[ADMIN]['role'] != 1 && !in_array(12,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

	$data = $this->db->get_where("purchase", array("id" => $id))->row_array();
	$post = $this->input->post('data');

	if(!empty($post)) {

		$post['type'] = 2;
		$post['trx_type'] = 1;
		$post['ord_id'] = $id;
		$post['uid'] = $data['vendor_id'];
		$post['desc'] = "Paid to vendor on order - <a href='".base_url()."purchase/detail/".$id."'>#".$data['code']."</a>";

		if(strlen($post['remark']) == 0) {
			unset($post['remark']);
		}

		if($post['amount'] <= $data['due']) {

			$this->db->insert("payment", $post);

			$this->db->set('due', 'due-'.$post['amount'], FALSE);
			$this->db->where('id', $id);
			$this->db->update("purchase");

			$this->db->set('paid', 'paid+'.$post['amount'], FALSE);
			$this->db->where('id', $id);
			$this->db->update("purchase");



			$alert = 1;

		} else {
			$alert = 2;
		}

	}

		$this->db->select("pch.*, vnd.company_name,vnd.vendor_name,vnd.address, vnd.email, vnd.mobile as vmobile");
		$this->db->from("purchase pch, vendor vnd");
		$this->db->where("pch.vendor_id=vnd.id");
		$this->db->where("pch.id", $id);

		$data = $this->db->get()->row_array();

		$data['items'] = $this->db->get_where("purchase_item", array("order_id" => $id))->result_array();
		$data['payments'] = $this->db->get_where("payment", array("ord_id" => $id, 'type'=>2, "trx_type"=>1))->result_array();

		$data['alert'] = $alert;

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/purchase/inv', $data);
		$this->load->view('admin/footer');
}


public function invprint( $id =null) {
	$data = $this->db->get_where("purchase", array("id"=> $id))->row_array();
	$data['items'] = $this->db->get_where("purchase_item", array("order_id" => $id))->result_array();
	$data['payments'] = $this->db->get_where("payment", array("ord_id" => $id, "type"=>2, "trx_type"=>1))->result_array();
	$data['vnd'] = $this->db->where("id", $data['vendor_id'])->get("vendor")->row_array();

	$this->load->view('admin/purchase/print', $data);
}


public function note( $pg=null ) {
	if($_SESSION[ADMIN]['role'] != 1 && !in_array(14,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

	$post = $this->input->post('src');

	if(!empty( $post )) {
		$this->session->src = $post;
	}
	if( strlen($_SESSION['src']['sdate']) ) {
		$this->db->where("DATE(created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
	}
	if( $_SESSION['src']['vnd'] > 0 ) {
		$this->db->where("uid", $_SESSION['src']['vnd']);
	}
	if( strlen($_SESSION['src']['edate']) ) {
		$this->db->where("DATE(created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
	}

	$rows = $this->db->get_where('payment', array("type"=>2))->num_rows();
	$lim = 10;

	$this->load->library('pagination');
	$config['base_url'] = base_url().'purchase/note/';
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

	$this->db->select("pay.*, vn.company_name, vn.vendor_name, pr.id as pid, pr.code, pr.total, pr.due, pr.paid");
	$this->db->from("payment pay, vendor vn, purchase pr");

	if( $_SESSION['src']['vnd'] > 0 ) {
		$this->db->where("pay.uid", $_SESSION['src']['vnd']);
	}
	if( strlen($_SESSION['src']['sdate']) ) {
		$this->db->where("DATE(pay.created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
	}
	if( strlen($_SESSION['src']['edate']) ) {
		$this->db->where("DATE(pay.created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
	}
	$this->db->where("pay.type",2);
	$this->db->where("pay.uid=vn.id");
	$this->db->where("pay.ord_id=pr.id");
	$this->db->group_by("pay.ord_id");
	$this->db->order_by("pay.id", "desc");
	$this->db->limit($lim, $start);
	$data['payment'] = $this->db->get()->result_array();

	$data['vendors'] = $this->db->select("id, vendor_name, company_name")->get("vendor")->result_array();

	$due = $this->getAmtTotal(2);
	$data['total'] = $due;
	$data['paid'] = $this->getAmtTotal(1);
	$data['due'] = $due-$data['paid'];
	$data['pages'] = $pages;
	$data['sn'] = $start;

	$head['nav'] = 5;
	$this->load->view('admin/head');
	$this->load->view('admin/header', $head);
	$this->load->view('admin/purchase/note', $data);
	$this->load->view('admin/footer');

}

public function getAmtTotal($type=null) {

	$this->db->select_sum('amount');
	$this->db->where("type", 2);
	$this->db->where("trx_type", $type);

	if( strlen($_SESSION['src']['sdate']) ) {
		$this->db->where("DATE(created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
	}
	if( $_SESSION['src']['vnd'] > 0 ) {
		$this->db->where("uid", $_SESSION['src']['vnd']);
	}
	if( strlen($_SESSION['src']['edate']) ) {
		$this->db->where("DATE(created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
	}

	$amt = $this->db->get('payment')->row()->amount;

	return $amt;
}


}
