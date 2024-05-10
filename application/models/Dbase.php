<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbase extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
		$this->load->model('fconst');
	}

	public function create_db( $data ) {

		$db_name = "alpha_".rand(1111,9999);
		if ( $this->dbforge->create_database($db_name)) {


			}

	}

	public function setConfigDB( $post, $data ) {

		$conf = read_file('application/config/database.php');
		foreach ($data as $key => $val) {
			$conf = str_replace("{".$key."}", $val , $conf);
		}
			write_file('application/config/database.php', $conf );
			$this->fconst->setUri($post['uri']);
	}



}
