<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_punch_data extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		
	}

	public function index( )
	{
		header('Content-Type: application/json');
		$input_json = file_get_contents('php://input');

        //$input_array = json_decode($input_json, true);
		
		echo '<pre>'
		print_r($input_json);
		exit;
		

		//echo json_encode($return_data);
	

		
	}

    public function transection( )
	{
		header('Content-Type: application/json');
		$input_json = file_get_contents('php://input');

        //$input_array = json_decode($input_json, true);
		
		echo '<pre>'
		print_r($input_json);
		exit;
		

		//echo json_encode($return_data);
	

		
	}
	

}
