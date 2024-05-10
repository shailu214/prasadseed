<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('custom');

	}

	public function singleFeeSMS()
	{

		$mobileno =	$this->security->xss_clean( $this->input->post('mobileno') );
		$message = $this->db->select("sms_fee_txt")->get('config')->row()->sms_fee_txt;
		$this->custom->sendFeeSMS($mobileno, $message);
	}


	public function singleAbsSMS()
	{

		$mobileno =	$this->security->xss_clean( $this->input->post('mobileno') );
		$message = $this->db->select("sms_abs_txt")->get('config')->row()->sms_abs_txt;
		$this->custom->sendSMS($mobileno, $message);

	}


	public function allFeeSMS()
	{

		$m = date("n");
		$y = date("Y");

		$this->db->select("st.mobile")
		->from("student st")
		->where("st.id NOT IN (select student_id from tbl_fee where student_id = st.id and month ='".$m."' and year ='".$y."' )",NULL,FALSE);
		$data = $this->db->get()->result_array();
		$mobile = array_column($data, 'mobile');

		$mobileno = implode(',', $mobile);

		$message = $this->db->select("sms_fee_txt")->get('config')->row()->sms_fee_txt;
		$this->custom->sendFeeSMS($mobileno, $message);


	}



	public function allAbsSMS()
	{

		$m = date("n");
		$y = date("Y");

		$this->db->select("st.mobile")
		->from("student st")
		->where("st.id NOT IN (select student_id from tbl_fee where student_id = st.id and month ='".$m."' and year ='".$y."' )",NULL,FALSE);
		$data = $this->db->get()->result_array();
		$mobile = array_column($data, 'mobile');

		$mobileno = implode(',', $mobile);
		$message = $this->db->select("sms_abs_txt")->get('config')->row()->sms_abs_txt;
		$this->custom->sendSMS($mobileno, $message);

	}


//========================================================================================================//
//-------------------------------------------------------------------------------------------------------//
//======================================================================================================//


	public function singleFeeMail()
	{

		$to =	$this->security->xss_clean( $this->input->post('mail') );
		// $to =	$this->security->xss_clean( $this->input->post('sub') );

		$conf = $this->db->get('config')->row();


			$curl_post_data=array(

					'api_user'  => 'naveeneyeweb',
		 			'api_key'   => 'admin@123',
					'to'      => $to,
			    'from'    => $conf->email,
					'fromname' => $conf->com_name,
			    'subject' => 'FEE ALERT',
			    'html'    => $conf->mail_fee_txt,
					// 'files['.$filename.']' => $file
			);

		$service_url = 'https://api.sendgrid.com/api/mail.send.json';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$curl_response = curl_exec($curl);
		$response = json_decode($curl_response);
		curl_close($curl);

	}


	public function singleAbsMail()
	{

		$to =	$this->security->xss_clean( $this->input->post('mail') );
		// $to =	$this->security->xss_clean( $this->input->post('sub') );

		$conf = $this->db->get('config')->row();


			$curl_post_data=array(

					'api_user'  => 'naveeneyeweb',
		 			'api_key'   => 'admin@123',
					'to'      => $to,
			    'from'    => $conf->email,
					'fromname' => $conf->com_name,
			    'subject' => 'STUDENT ABSENT',
			    'html'    => $conf->mail_abs_txt,
					// 'files['.$filename.']' => $file
			);

		$service_url = 'https://api.sendgrid.com/api/mail.send.json';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$curl_response = curl_exec($curl);
		$response = json_decode($curl_response);
		curl_close($curl);

	}


	public function allFeeMail()
	{

		$m = date("n");
		$y = date("Y");

		$this->db->select("st.email")
		->from("student st")
		->where("st.id NOT IN (select student_id from tbl_fee where student_id = st.id and month ='".$m."' and year ='".$y."' )",NULL,FALSE);
		$data = $this->db->get()->result_array();
		$to = array_column($data, 'email');
		// print_r($data);
		$json_string = array(
		  'to' =>$to,
		  // 'category' => 'test_category'
		);

		$conf = $this->db->get('config')->row();

			$curl_post_data=array(

					'api_user'  => 'naveeneyeweb',
					'api_key'   => 'admin@123',
					'to'      => $to,
					'from'    => $conf->email,
					'fromname' => $conf->com_name,
					'subject' => 'FEE ALERT',
					'html'    => $conf->mail_fee_txt,
					'x-smtpapi' => json_encode($json_string),
					// 'files['.$filename.']' => $file
			);

		$service_url = 'https://api.sendgrid.com/api/mail.send.json';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$curl_response = curl_exec($curl);
		// $response = json_decode($curl_response);
		curl_close($curl);
		// var_dump($curl_response);
	}




		public function allAbsMail()
		{

			$m = date("n");
			$y = date("Y");

			$this->db->select("st.email")
			->from("student st")
			->where("st.id NOT IN (select student_id from tbl_fee where student_id = st.id and month ='".$m."' and year ='".$y."' )",NULL,FALSE);
			$data = $this->db->get()->result_array();
			$to = array_column($data, 'email');
			// print_r($data);
			$json_string = array(
			  'to' =>$to,
			  // 'category' => 'test_category'
			);

			$conf = $this->db->get('config')->row();

				$curl_post_data=array(

						'api_user'  => 'naveeneyeweb',
						'api_key'   => 'admin@123',
						'to'      => $to,
						'from'    => $conf->email,
						'fromname' => $conf->com_name,
						'subject' => 'STUDENT ABSENT',
						'html'    => $conf->mail_abs_txt,
						'x-smtpapi' => json_encode($json_string),
						// 'files['.$filename.']' => $file
				);

			$service_url = 'https://api.sendgrid.com/api/mail.send.json';
			$curl = curl_init($service_url);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);

			curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$curl_response = curl_exec($curl);
			// $response = json_decode($curl_response);
			curl_close($curl);
			// var_dump($curl_response);
		}


		public function dueSMS() {
			$code = $this->input->post('code');
			if(strlen($code)>0) {
				$ord = $this->db->get_where("order",array("code"=> $code))->row_array();
				if(!empty($ord)) {
					$msg = "Dear ".$ord['customer_name'].", please pay your due amount Rs. ".	$ord['amount'].". Invoice No. - ".$ord['code'];
					$this->db->sendSMS($mob, $msg);
				}
			}

		}


}
