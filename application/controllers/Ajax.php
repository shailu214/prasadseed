<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('custom');

	}

	public function index()
	{
		$meta = array(
			"page" => 1,
			"limit" => 10,
			"rows" =>5
		);

		$arr = array(
						array(
							'id' => "1",
							'course' => "MA",
							'fee' => "250",
							'status' => 1,
							'date' => "11-22-1999",
						),
						array(
							'id' => "2",
							'course' => "MC",
							'fee' => "150",
							'status' => 2,
							'date' => "11-22-1999",
						)
					);

		echo json_encode(array("data" => $arr, "meta" => $meta));
	}

	public function getBatch( ) {

		$cid = $this->input->post('cid');
		$data = $this->db->select("id,batch_name")->where(array("course_id"=> $cid, 'status' => 1))->get("batch")->result_array();
		echo json_encode($data);

	}


	public function getProducts() {

		$sale = $this->input->post('sale');
		$src = $this->security->xss_clean($this->input->post('src'));

		$this->db->like('product_name', $src);
		$this->db->where("status", 1);

		if($sale) {
			$this->db->where("qty > 0");
		}
		$this->db->limit(5);
		$data = $this->db->get("product")->result_array();

		echo json_encode($data);

	}

	//===================================================================//
//===================================================================//

	public function delete() {
		$id = $this->input->post('id');
		$tbl = $this->input->post('tbl');

		$this->db->delete($tbl, "id='".$id."'");
	}


public function getCustomer() {

	$src = $_REQUEST['q'];

	$this->db->like("customer_name", $src);
	$this->db->limit(10);

	$data = $this->db->get("customer")->result_array();
	$res[] = array(
		"id" =>0,
		"text" => "All Customer"
	);
	foreach ($data as $key => $val) {

		$item['id'] = $val['id'];
		$item['text'] = $val['customer_name'].' - '.$val['mobile'];
		$res[] = $item;

		unset( $item );

	}
	echo json_encode(array("results" => $res));
}

public function customerInfo(){

		extract( $_POST );
		$data = $this->db->where( "id", $cid )->get( "customer" )->row_array();
		$due = $this->db->select_sum("due")->where("customer_id", $cid)->get("order")->row()->due;
		$data['due'] = $due;
		echo json_encode($data);
}


public function getSubCat() {
	$id = $this->input->post('id');
	$data = $this->db->get_where("sub_category", array("status"=>1, "parent"=> $id))->result_array();
	echo json_encode($data);
}


public function src_fee(){
	if($this->input->post('m')) { $_SESSION['fee']['m'] = $this->input->post('m'); }
	if($this->input->post('y')) { $_SESSION['fee']['y'] = $this->input->post('y'); }
	if($this->input->post('type')) { $_SESSION['fee']['type'] = $this->input->post('type'); }
	// $_SESSION['fee']['y'] = $this->input->post('y');
}


public function setAttd() {

	date_default_timezone_set("Asia/Kolkata");

	$uid = $this->input->post('id');

	$row = $this->db->where("staff_id", $uid)
	->where("DATE(at_date) = DATE('".date("Y-m-d")."')")
	->get("attendance_staff")
	->row_array();

	if( empty( $row ) ) {
		$post = array (
			"staff_id" => $uid,
			"at_day" => date('j'),
			"at_month" => date('n'),
			"at_year" => date('Y'),
			"at_date" => date("Y-m-d"),
			"login_time" => date('G:i:s')
		);
		$this->db->insert( "attendance_staff", $post );
	} else {
		$this->db->set(
				array(
					"logout_time"=> date('G:i:s'),
					"work_hour"=> $this->gethour($row['login_time'], date('G:i:s')),
			)
		);
		$this->db->where("staff_id", $uid);
	 	$this->db->where("DATE(at_date) = DATE('".date("Y-m-d")."')");
		$this->db->update("attendance_staff");
	}

}


public function gethour($login, $logout ) {

	$time1 = strtotime($login);
	$time2 = strtotime($logout);
	$difference = round(abs($time2 - $time1) / 3600,2);
	$hour =  floor($difference);
	return $hour;

}


public function resetsrc() {
	unset($_SESSION['src']);
}


public function set_service() {
	$act = $this->input->post('act');
	$id = $this->input->post('id');
	$sid = $this->input->post('sid');

	$srv = explode(",", $this->db->select("services")->where("id", $id)->get('student')->row()->services);
	// print_r($srv);
	if( in_array($sid, $srv)) {
		$res =array_diff($srv,[$sid]);
	} else {
		$srv[] = $sid;
		$res = $srv;
	}

echo	$data = implode(",", $res);

	$this->db->update("student", array("services" => $data), "id='".$id."'");
}


public function setBatch(){
		extract($_POST);
		$_SESSION['src_btc'] = $id;
}


public function exam_sms( ){

	$id = $this->input->post('id');
	$data = $this->db->get_where("exam", array("id"=> $id))->row_array();
	$mob = $this->db->select('mobile2')->where('code', $data['student_id'])->get('student')->row()->mobile2;
  $sts = ($data['status']==1)? "Passed" : "Failed";
 	$msg = $data['name']." Result - Exam Code: ".$data['ex_code'].",  Result: ".$sts.", Marks : ".$data['total']."/".$data['max_marks'];

	$this->custom->sendSMS($mob, $msg);
}


public function prod_price() {
	extract($_POST);
	$row = $this->db->get_where("product", array("id"=>$pid))->row_array();
	if( $act == 1 ) {
		echo $row['sell_price'];
	} elseif ( $act == 2) {
		echo $row['purchase_price'];
	}
}

public function add_product(){
	// $post = $_POST;
	if(strlen($_POST['product_name']) > 0) {
		$post['product_name'] = $_POST['product_name'];
	}
	if(strlen($_POST['sell_price']) > 0) {
		$post['sell_price'] = $_POST['sell_price'];
	}
	if(strlen($_POST['purchase_price']) > 0) {
		$post['purchase_price'] = $_POST['purchase_price'];
	}
	if(strlen($_POST['price']) > 0) {
		$post['price'] = $_POST['price'];
	}
	if(strlen($post['hsn']) > 0) {
		unset($post['hsn']);
	}
	// print_r($post);

	if(!empty($post)) {

		$this->db->insert("product", $post);
		$pid = $this->db->insert_id();
		echo json_encode( array("id"=>$pid, "text"=> $post['product_name']) );
	}

}

public function add_vendor(){
	// $post = $_POST;
	if(strlen($_POST['company_name']) > 0) {
		$post['company_name'] = $_POST['company_name'];
	}
	if(strlen($_POST['vendor_name']) > 0) {
		$post['vendor_name'] = $_POST['vendor_name'];
	}
	if(strlen($_POST['mobile']) > 0) {
		$post['mobile'] = $_POST['mobile'];
	}
	if(strlen($_POST['email']) > 0) {
		$post['email'] = $_POST['email'];
	}
	if(strlen($post['address']) > 0) {
		$post['address'] = $_POST['address'];
	}
	// print_r($post);

	if(!empty($post)) {
		$post['code'] = $this->custom->unique_code("vendor", "VND");
		$this->db->insert("vendor", $post);
		$pid = $this->db->insert_id();
		$name  = $post['company_name'] .' ('. $post['vendor_name'] .  ')';
		echo json_encode( array("id"=>$pid, "text"=> $name) );
	}

}

}
