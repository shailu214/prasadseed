<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fconst extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
	}

	public function setUri( $uri ) {

		$conf = read_file('application/config/config.php');
		$conf = str_replace("{BS_URI}", $uri , $conf);
		write_file('application/config/config.php', $conf );

	}

	public function setSql() {

 		$sql = read_file('system/conf/db.sql');
		$sql = explode("#", $sql);

		foreach ($sql as $key => $val) {
			$this->db->query($val);
		}

		$this->setAuth();
		redirect("install/finish");

	}

	public function setAuth() {

		$post['fname'] = $_SESSION['conf']['name'];
		$post['username'] = $_SESSION['conf']['username'];
		$post['password'] = $_SESSION['conf']['password'];
		$post['role'] = 1;

 		$this->db->insert( "users", $post );

	}


	public function getED() {
		$app = explode("|", base64_decode( APP_VL_STR ) );
		return strtotime( $app[1] );
	}

	public function getKey() {
		$app = explode("|", base64_decode( APP_VL_STR ) );
		return $app[0];
	}

}
