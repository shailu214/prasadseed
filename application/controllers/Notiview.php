<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notiview extends CI_Controller {

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


		public function dues( $date=null ) {

			if( $_SESSION[ADMIN]['role'] != 1 && !in_array(20,$_SESSION[ADMIN]['prms']) ) { redirect('dashboard'); }

			$btn = $this->input->post('btn');
			
			$chk = $this->input->post('chk');
			$msg = $this->input->post('bmsg');
			// print_r($chk);

			if(!empty($chk)) {

				$conf = $this->db->get('config')->row();

				$this->db->select("email, mobile,fname,due");
				$this->db->where_in("code", $chk);
				$data = $this->db->get('student')->result_array();
                 
				if($btn == 'sms') {

					$mobile = array_column($data, 'mobile');
				    $mobileno = implode(',', $mobile);
					
					$fname = array_column($data, 'fname');
				    $fname = implode(',', $fname);
					
					$f_due = array_column($data, 'due');
				    $f_due = implode(',', $f_due);
					

					$message = $conf->sms_fee_txt;
					
					
					//$smsMessage = "Dear Your Fee $f_due is due , for continue to study please deposit your fee.SPM INFOTECH SERVICE";
					// $message = $this->db->select("sms_fee_txt")->get('config')->row()->sms_fee_txt;
                    $url = "http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=abhiaw&password=686l2u-lAoa&sender=JAIHOO&to=$mobileno&message=Dear%20Your%20Fee%20$f_due%20is%20due%20,%20for%20continue%20to%20study%20please%20deposit%20your%20fee.SPM%20INFOTECH%20SERVICE&reqid=1&format={json|text}&pe_id=1201161589219376932&template_id=1207167558963301715&route_id=route+id&callback=Any+Callback+URL&unique=0";
					$ip_conn = 'http://173.45.76.227';
					//$sms_url=http://www.smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=abhiaw&password=686l2u-lAoa&sender=AETLMS&to=8826262032,9988589951&message=Dear%20Your%20OTP%20is%2087954%20ALL%20EXAM%20TRICKS&reqid=1&format={json|text}&pe_id=1201162296745418069&template_id=1207162703351650824z"";
					$user = SMS_USER;
					$pass = SMS_PASS;
					$route = 'trans1';
					$senderid = SENDER_ID;
					$msg = urlencode($message);
					$ch = curl_init();
					$s=$url;
					
					//$s="$ip_conn/send.aspx?username=$user&pass=$pass&route=$route&senderid=$senderid&numbers=$mobileno&message=$msg";
					curl_setopt($ch, CURLOPT_URL,$s);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					$res = curl_exec($ch);
					curl_close($ch);
					$data['alert'] = 1;

				} elseif( $btn == 'mail') {
					$to = array_column($data, 'email');

					$json_string = array( 'to' =>$to );

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
					curl_close($curl);

					$data['alert'] = 2;

				} elseif( $btn == 'block') {

				 foreach ($chk as $kc => $cd) {
					 $this->db->update("student", array("status"=>0), "code='".$cd."'");
				 }
				 $log['codes'] = implode(",", $chk);
				 if(strlen($msg)) { $log['msg'] = $msg; }
				 // print_r($log);
				 $this->db->insert("block_log", $log);
				 $data['alert'] = 3;
			 }

			}
			 $fdate = '';
			 $batch_id = '';
             $fdate = $this->uri->segment(2);
			 $batch_id = $this->uri->segment(3);
			if($fdate!='')
			{
			  $data['fdate'] = $fdate;	
			}
            if($batch_id!='')
			{
			  $data['batch_id'] = $batch_id;	
			}			
			 
			$data['batch'] = $this->db->get_where("batch", array("status"=>1))->result_array();
			//if(strlen($date)==0) { $date = date("d-m-Y"); }
			$data['result'] = $this->notify->getFeeInfo(1, $date,$batch_id);
			$data['dts'] = $date;

			$this->load->view('admin/head');
			$this->load->view('admin/header');
			$this->load->view('admin/notiv/dview', $data);
			$this->load->view('admin/footer');
		}



//-------------------------------------------------------------------------------------------------//
//================================================================================================//
//-----------------------------------------------------------------------------------------------//


			public function absent() {

				if( $_SESSION[ADMIN]['role'] != 1 && !in_array(20,$_SESSION[ADMIN]['prms']) ) { redirect('dashboard'); }

				$btn = $this->input->post('btn');
				$chk = $this->input->post('chk');

				if(!empty($chk)) {

					$conf = $this->db->get('config')->row();

					$this->db->select("email, mobile2,fname");
					$this->db->where_in("id", $chk);
					$data = $this->db->get('student')->result_array();
					//echo "<pre>"; print_r($data);
					//var_dump($chk);
					//die;
					if($btn == 'sms') {

						$mobile = array_column($data, 'mobile2');
						$mobileno = implode(',', $mobile);
						
						$fname = array_column($data, 'fname');
				        $fname = implode(',', $fname);

						$message = $conf->sms_abs_txt;
						// $message = $this->db->select("sms_fee_txt")->get('config')->row()->sms_fee_txt;
                        //$smsMessage = "%20Dear%20Parent%20$fname%20is%20absent%20Today.$coaching_name%20%20always%20care%20your%20Trust%20.%20SPM%20INFOTECH%20SERVICE";
                        $url="https://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=abhiaw&password=686l2u-lAoa&sender=OTPSPM&to=$mobileno&message=%20Dear%20Parent%20$fname%20is%20absent%20Today.NEW%20Dastak%20Classes%20Vikash%20Pathak%20Sir%20always%20care%20your%20Trust%20.%20SPM%20INFOTECH%20SERVICE&reqid=1&format={json|text}&pe_id=1201161589219376932&template_id=1207167856175139959&route_id=route+id&callback=Any+Callback+URL&unique=0";
						$ip_conn = 'http://173.45.76.227';
						$user = SMS_USER;
						$pass = SMS_PASS;
						$route = 'trans1';
						$senderid = SENDER_ID;
						$msg = urlencode($message);
						$ch = curl_init();
						$s=$url;
						//$s="$ip_conn/send.aspx?username=$user&pass=$pass&route=$route&senderid=$senderid&numbers=$mobileno&message=$msg";
						curl_setopt($ch, CURLOPT_URL,$s);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
						$res = curl_exec($ch);
						curl_close($ch);

						// print_r( $res );
						$data['alert'] = 1;

					} elseif( $btn == 'mail') {
						$to = array_column($data, 'email');

						$json_string = array( 'to' =>$to );

							$curl_post_data=array(

									'api_user'  => 'naveeneyeweb',
									'api_key'   => 'admin@123',
									'to'      => $to,
									'from'    => $conf->email,
									'fromname' => $conf->com_name,
									'subject' => 'ABSENT ALERT',
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
						curl_close($curl);

						$data['alert'] = 2;

					}

					//redirect('absent');
				}

				
				
				$data['batch'] = $this->db->get_where("batch", array("status"=>1))->result_array();
			    //$data['result'] = $this->notify->getStdInfo(1);
				
				$data['result'] = array();
				$data['batch_id'] ='';
				if($_POST)
				{	
					$batch_id = $this->input->post('batch');
					
					if($batch_id!='')
					{	
					  $data['result'] = $this->notify->getStdInfo_BY_filter(1,$batch_id);
					  $data['batch_id'] = $batch_id;
					}
                } 					

					// print_r($data);
				$this->load->view('admin/head');
				$this->load->view('admin/header');
				$this->load->view('admin/notiv/abview', $data);
				$this->load->view('admin/footer');
			}


			public function log( $pg =null) {

				if($this->input->post('code')) {
					$_SESSION['lg_code'] = $this->input->post('code');
				}
				if($_SESSION['lg_code']) {
					$this->db->where("FIND_IN_SET('".$_SESSION['lg_code']."', codes)");
				}
				$rows = $this->db->get('block_log')->num_rows();
				$lim = 10;

				$this->load->library('pagination');
				$config['base_url'] = base_url().'log/';
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

				if($_SESSION['lg_code']) {
					$this->db->where("FIND_IN_SET('".$_SESSION['lg_code']."', codes)");
				}
				$this->db->order_by("id","desc");
				$this->db->limit($lim, $start);
				$data['result'] = $this->db->get("block_log")->result_array();
				$data['pages'] = $pages;
				$data['sno'] = $start;
				$head['nav'] = 3;

				$this->load->view('admin/head');
				$this->load->view('admin/header');
				$this->load->view('admin/notiv/log', $data);
				$this->load->view('admin/footer');
			}


		public function dprint() {
				$data['result'] = $this->notify->getFeeInfo(1, $date);
				$data['batch'] = $this->db->select("batch_name")->where("id", $_SESSION['src_btc'])->get("batch")->row()->batch_name;
				$this->load->view("admin/notiv/dexl", $data);
		}

}
