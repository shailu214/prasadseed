<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cmsval {

public function verify() {

	if(str_replace('/','',base_url()) == '{BS_URI}') {
		// header("location:install.html");
		echo '<script>window.location.href="install.html";</script>';
	}
}

public function verifyKey( $key , $data, $db ) {

	$CI =& get_instance();

	$res = $this->makeRequest( $data );

	if( $res->status == 1) {

		$CI->load->model("dbase");
		$CI->dbase->setConfigDB( $data, $db );
		$this->appStr( $res->app_key );

		$_SESSION['conf'] = $data;
		$_SESSION['step'] = 1;
		header("location:install/step_1.html");

	} else {
		return false;
	}

}


public function renewApp( $post ) {

	$CI =& get_instance();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'https://www.spminfosys.in/master_admin/api');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	$res = curl_exec($ch);
	curl_close();
	$res = json_decode($res);
	// var_dump($res);
	if($res->status == 1) {
		$conf = read_file('application/config/constants.php');
		$conf = str_replace(APP_VL_STR, $res->app_key, $conf);
		write_file('application/config/constants.php', $conf );
		return 1;
	} else {
		return 0;
	}

}


public function makeRequest( $post ) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'https://spminfosys.in/master_admin/api');
  // curl_setopt($ch, CURLOPT_URL,'http://localhost/mailbox/api');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
	// print_r($response);
	// echo curl_error($ch);
	curl_close();
  $result = json_decode($response);
	return $result;
}




public function appStr( $str ) {
	$conf = read_file('application/config/constants.php');
	$conf = str_replace("{VSTR}", $str , $conf);
	write_file('application/config/constants.php', $conf );
}


public function validateApp()  {
	$CI =& get_instance();
	$CI->load->model("fconst");

	if( strtotime( date("Y-m-d") ) > $CI->fconst->getED() ) {
		return 1;
	} else {
		return 0;
	}

}


public function appAlert() {
	$CI =& get_instance();
	$CI->session->set_flashdata('notify','<div class="app-error"><i class="fe fe-alert-triangle"></i> &nbsp;Your License Expired! Please get a new license. <a href="'.base_url().'renew.html">Click Here</a> to renew license</div>');
	$CI->session->set_flashdata('dact',1);
}

}
