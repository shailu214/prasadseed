<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}

		$this->load->model('custom');
		$this->custom->setConfig();

		if(empty($_SESSION[ADMIN])) { redirect(''); }
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}

	public function index( $pg=null )
	{

		if($_SESSION[ADMIN]['role'] != 1 && !in_array(11,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		$post = $this->input->post('src');

		if(!empty( $post )) {
			$this->session->src = $post;
		}

		if( strlen($_SESSION['src']['oid']) ) {
			$this->db->where("code", $_SESSION['src']['oid']);
		}

		if( strlen($_SESSION['src']['name']) ) {
			$this->db->like("customer_name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['mob']) ) {
			$this->db->where("mobile", $_SESSION['src']['mob']);
		}

		if( strlen($_SESSION['src']['sdate']) ) {
			$this->db->where("DATE(created) >= DATE('".$_SESSION['src']['sdate']."')");
		}
		if( strlen($_SESSION['src']['edate']) ) {
			$this->db->where("DATE(created) <= DATE('".$_SESSION['src']['edate']."')");
		}

		$rows = $this->db->get('order')->num_rows();
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


		if( strlen($_SESSION['src']['oid']) ) {
			$this->db->where("code", $_SESSION['src']['oid']);
		}

		if( strlen($_SESSION['src']['name']) ) {
			$this->db->like("customer_name", $_SESSION['src']['name']);
		}

		if( strlen($_SESSION['src']['mob']) ) {
			$this->db->like("mobile", $_SESSION['src']['mob']);
		}

		if( strlen($_SESSION['src']['sdate']) ) {
			$this->db->where("DATE(created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
		}
		if( strlen($_SESSION['src']['edate']) ) {
			$this->db->where("DATE(created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
		}

		$this->db->order_by("id", "desc");
		$this->db->limit($lim, $start);
		$data['result'] = $this->db->get("order")->result_array();
		$data['pages'] = $pages;
		$data['sn'] = $start;
		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/sales/view', $data);
		$this->load->view('admin/footer');

	}


	public function add()
	{
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(11,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

		if(!empty($_POST)) {
			// print_r($_POST);
			$code = $this->custom->unique_code("order", "ORD");
			$pid = $this->input->post('pid');
			$qty = $this->input->post('qty');
			$disc = $this->input->post('disc');
			$cust_id = $this->input->post('customer_id');
			$cust = $this->input->post('customer');
			$mob = $this->input->post('mobile');

			$co = count($pid);

			if($co > 0) {

			 $ord = array(
				 "code" => $code,
				 "customer_id" => $cust_id,
				 "customer_name" => $cust,
				 "mobile" => $mob,
				 "discount" => $disc,
			 );

			 $this->db->insert("order", $ord);
			 $oid = $this->db->insert_id();

		if( $co>0 ) {
			$co--;
			for($i=0; $i<=$co; $i++) {

				$prd = $this->db->where("id", $pid[$i])->get('product')->row_array();

				$prc = ceil($prd['sell_price']*$qty[$i]);
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

				$this->db->insert("order_item", $item);
				$this->db->set('qty', 'qty-'.$qty[$i], FALSE);
				$this->db->where('id', $pid[$i]);
				$this->db->update("product");

				$gsum[]= $gst;
				$tsum[]= $prc;
			}

		}
			$tot = array_sum($tsum);
			$gtot = array_sum($gsum);

			$arr = array(
				"amount" => $tot,
				"due" => ($tot-$disc),
				"total" => ($tot-$disc)
			);
			$this->db->update("order", $arr, "id='".$oid."'");
			$data['alert'] = 1;

			$this->db->insert("payment",
			array(
				"uid" => $cust_id,
				"type" => 1,
				"trx_type" => 1,
				"ord_id" => $oid,
				"amount" => $arr['total'],
				"desc" => "Amount credited on order - <a href='".base_url()."sales/invoice/".$oid."'>#".$code.'</a>'
			));

			redirect("sales/invoice/".$oid);
		}

			// header("location:".base_url().'')
		}

		$cus = $this->input->post('cus');
		if(!empty($cus)) {
			$cus['code'] = $this->custom->unique_code("customer", "CST");
			$this->db->insert("customer", $cus);
			$data['alert'] = 2;
		}

		$data['products'] = $this->db->where("status=1 and qty > 0")->order_by("product_name","asc")->get("product")->result_array();
		$head['nav'] = 5;

		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/sales/add', $data);
		$this->load->view('admin/footer');

	}


	public function edit( $id =null)
	{
		if($_SESSION[ADMIN]['role'] != 1 && !in_array(11,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

		$post = $this->input->post('data');

		if(!empty($post)) {
			$this->db->update("batch", $post, "id='".$id."'");
			$alert = $this->db->affected_rows();
		}

		$data = $this->db->get_where("batch", array("id" => $id))->row_array();
		$data['course'] = $this->db->get_where("course", array("status" => 1))->result_array();

		$data['alert'] = $alert;

		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/batch/add', $data);
		$this->load->view('admin/footer');
	}

	public function unique_code() {

		$id =  $this->db->select('id')->order_by('id','desc')->get('order')->row()->id;
		$id++;

		if(strlen($id) == 1 ) {
			$oid = "ORD00000".$id;
		} elseif( strlen($id) == 2) {
			$oid = "ORD0000".$id;
		} elseif( strlen($id) == 3) {
			$oid = "ORD000".$id;
		} elseif( strlen($id) == 4) {
			$oid = "ORD00".$id;
		} elseif( strlen($id) == 5) {
			$oid = "ORD0".$id;
		} else {
			$oid = "ORD".$id;
		}

		return $oid;

}


public function invoice( $id =null) {

		$data = $this->db->get_where("order", array("id"=> $id))->row_array();
		$post = $this->input->post('data');

		if(!empty($post)) {

			$post['type'] = 1;
			$post['trx_type'] = 2;
			$post['desc'] = "Amount recived from customer on Order - <a href='".base_url()."sales/invoice/".$id."'>#".$data['code'].'</a>';
			$post['ord_id'] = $id;
			$post['uid'] = $data['customer_id'];

			if(strlen($post['remark']) == 0) {
				unset($post['remark']);
			}

			if($post['amount'] <= $data['due']) {

				$this->db->insert("payment", $post);

				$this->db->set('due', 'due-'.$post['amount'], FALSE);
				$this->db->where('id', $id);
				$this->db->update("order");

				$this->db->set('paid', 'paid+'.$post['amount'], FALSE);
				$this->db->where('id', $id);
				$this->db->update("order");

				$alert = 1;

			} else {
				$alert = 2;
			}

		}

		$data = $this->db->get_where("order", array("id"=> $id))->row_array();
		$data['items'] = $this->db->get_where("order_item", array("order_id" => $id))->result_array();
		$data['payments'] = $this->db->get_where("payment", array("ord_id" => $id, "type"=>1, "trx_type"=>2))->result_array();
		$data['alert'] = $alert;
		$data['address'] = $this->db->select("address")->where("id", $data['customer_id'])->get("customer")->row()->address;
		$head['nav'] = 5;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $head);
		$this->load->view('admin/sales/inv', $data);
		$this->load->view('admin/footer');
}


public function invprint( $id=null ) {
	$data = $this->db->get_where("order", array("id"=> $id))->row_array();
	$data['items'] = $this->db->get_where("order_item", array("order_id" => $id))->result_array();
	$data['payments'] = $this->db->get_where("payment", array("ord_id" => $id, "type"=>1, "trx_type"=>2))->result_array();
	// print_r($data['payments']);
	$data['address'] = $this->db->select("address")->where("id", $data['customer_id'])->get("customer")->row()->address;

	$this->load->view('admin/sales/print', $data);

}


public function note( $pg=null ) {
	if($_SESSION[ADMIN]['role'] != 1 && !in_array(13,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }

	$post = $this->input->post('src');
	$chk = $this->input->post('chk');


	if(!empty($chk)) {
		foreach ($chk as $ok => $ord) {
			$ord = $this->db->get_where("order", array("code" => $ord) )->row_array();
			$msg = "Dear ".$ord['customer_name'].", please pay your due amount Rs. ".	$ord['amount'].". Invoice No. - ".$ord['code'];
			$this->custom->sendSMS($ord['mobile'], $msg);
			$data['sms_alt'] = 1;
		}
	}


	if(!empty( $post )) {
		$post['cname'] =  $this->db->select("CONCAT(customer_name, '-', mobile) as cname")->where("id", $post['cust'])->get("customer")->row()->cname;
		// print_r($usr);

		$this->session->src = $post;
		// $this->session->src['cname'] = $uname;
	}

	$this->db->select("pay.*,ord.id as oid, ord.code, ord.paid, ord.due, ord.total, cus.customer_name");
	$this->db->from("payment pay, customer cus, order ord");
	$this->db->where("cus.id=pay.uid");
	$this->db->where("ord.id=pay.ord_id");

	if( strlen($_SESSION['src']['sdate']) ) {
		$this->db->where("DATE(pay.created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
	}
	if( strlen($_SESSION['src']['edate']) ) {
		$this->db->where("DATE(pay.created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
	}
	if( $_SESSION['src']['cust'] > 0 ) {
		$this->db->where("pay.uid", $_SESSION['src']['cust'] );
	}
	if( $_SESSION['src']['stats'] > 0 ) {
		if($_SESSION['src']['stats'] == 1) {
			$this->db->where("ord.due > 0");
		} else {
			$this->db->where("ord.due", 0);
		}
	}
	$this->db->where("pay.type",1);
	$this->db->group_by("pay.ord_id");

	$rows = $this->db->get()->num_rows();
	$lim = 100;

	$this->load->library('pagination');
	$config['base_url'] = base_url().'sales/note/';
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

	$this->db->select("pay.*,ord.id as oid, ord.code, ord.paid, ord.due, ord.total, cus.customer_name, cus.mobile");
	$this->db->from("payment pay, customer cus, order ord");
	$this->db->where("cus.id=pay.uid");
	$this->db->where("ord.id=pay.ord_id");

	if( strlen($_SESSION['src']['sdate']) ) {
		$this->db->where("DATE(pay.created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
	}
	if( strlen($_SESSION['src']['edate']) ) {
		$this->db->where("DATE(pay.created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
	}
	if( $_SESSION['src']['cust'] > 0 ) {
		$this->db->where("pay.uid", $_SESSION['src']['cust'] );
	}
	if( $_SESSION['src']['stats'] > 0 ) {
		if($_SESSION['src']['stats'] == 1) {
			$this->db->where("ord.due", 0);
		} else {
			$this->db->where("ord.due > 0");
		}
	}
	$this->db->where("pay.type",1);
	$this->db->group_by("pay.ord_id");
	$this->db->order_by("id", "desc");
	$this->db->limit($lim, $start);
	$data['payment'] = $this->db->get()->result_array();

	// $due = $this->getAmtTotal(1);
	$data['total'] = $this->getAmtTotal(0);
	$data['due'] = $this->getAmtTotal(1);
	$data['paid'] = $this->getAmtTotal(2);
	$data['pages'] = $pages;
	$data['sn'] = $start;

	$head['nav'] = 5;
	$this->load->view('admin/head');
	$this->load->view('admin/header', $head);
	$this->load->view('admin/sales/note', $data);
	$this->load->view('admin/footer');

}

public function getAmtTotal($type=null) {
		if($type == 1) { $amt = 'due'; } elseif($type==2) { $amt = 'paid'; } else { $amt = 'total'; }
		$this->db->select_sum($amt);
		// $this->db->where("type", 1);
		// $this->db->where("trx_type", $type);

		if( strlen($_SESSION['src']['sdate']) ) {
			$this->db->where("DATE(created) >= DATE('".date("Y-m-d", strtotime($_SESSION['src']['sdate']))."')");
		}
		if( $_SESSION['src']['cust'] > 0 ) {
			$this->db->where("customer_id", $_SESSION['src']['cust']);
		}
		if( strlen($_SESSION['src']['edate']) ) {
			$this->db->where("DATE(created) <= DATE('".date("Y-m-d", strtotime($_SESSION['src']['edate']))."')");
		}
		if( $_SESSION['src']['stats'] > 0 ) {
			if($_SESSION['src']['stats'] == 1) {
				$this->db->where("due", 0);
			} else {
				$this->db->where("due > 0");
			}
		}
		$amts = $this->db->get('order')->row()->$amt;

		return $amts;
}

}
