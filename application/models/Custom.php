<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom extends CI_Model {

		public function unique_code($tbl=null , $prf=null)
		{

			$row = $this->db->select_max('id')->get($tbl)->row()->id;

			$autoid = $row+1;

			if(strlen($autoid) == 1) {
				$oid = $prf."00000".$autoid;
			} elseif(strlen($autoid) == 2) {
				$oid = $prf."0000".$autoid;
			} elseif(strlen($autoid) == 3) {
				$oid = $prf."000".$autoid;
			} elseif(strlen($autoid) == 4) {
				$oid = $prf."00".$autoid;
			} elseif(strlen($autoid) == 5) {
				$oid = $prf."0".$autoid;
			} elseif(strlen($autoid) == 6) {
				$oid = $prf.$autoid;
			}

			return $oid;
		}

		public function getStrArray( $str=null ) {

			$str2 = nl2br(substr(trim($str), 197));
// 			echo trim($str2);
			$strData = explode("<br />", trim($str2));
			$strData = array_map('trim',$strData);
// 			print_r($strData);
			// print_r(array_filter($strData, create_function('$value', 'return $value !== "";')));
			$i=0;
			foreach ($strData as $key => $val) {
				$i++;

                // print_r(explode(" ",$val));

                if($i <= 9 ) {
					 $date = trim(substr(trim($val),24,10));
					 $code = trim(substr(trim($val),4,8));
					 $time = trim(substr(trim($val),35,9));
				} if($i > 9 && $i <= 99) {
					 $code = trim(substr(trim($val),5,8));
					 $date = trim(substr(trim($val),25,10));
					 $time = trim(substr(trim($val),36,9));
				} elseif( $i > 99 && $i <= 999 ) {
    // 			echo $i.'<br>';
    				$code = trim(substr(trim($val),6,8));
					$date = trim(substr(trim($val),26,10));
					$time = trim(substr(trim($val),37,9));
				} elseif( $i > 999 ) {
					 $date = trim(substr(trim($val),27,10));
					 $code = trim(substr(trim($val),7,8));
					 $time = trim(substr(trim($val),38,9));
				}

			  $ar['code'] = ltrim($code, '0');
			  $ar['date'] = $date;
			  $ar['time'] = $time;

			$vl_arr = explode(' ', $val);

			$ar['status'] = $vl_arr[3];
			$res[] = $ar;
		}

// 		print_r($res);
		return $res;
	}

	public function countSunday( $days=null, $m=null, $y=null ) {
		$sun = 0;
			for ($i=0; $i<=$days; $i++) {
				if(date("D", strtotime($y.'-'.$m.'-'.$i)) == 'Sun' ) {
					$sun++;
				}
			}
			return $sun;
	}


	public function getPaidReciept($tp=null, $id=null, $lim=null, $start=null) {

		$this->db->select("fe.*, st.code as scode,  cs.course");
		$this->db->from("fee_reciept fe, course cs, student st");
		$this->db->where("fe.student_id=st.id");
		$this->db->where("fe.course_id=cs.id");
		$this->db->where("fe.batch_id", $id);
		// if($_SESSION['fee']['m']) {
		// 	$this->db->where("FIND_IN_SET('".$_SESSION['fee']['m']."', fe.month)");
		// }
		if($_SESSION['fee']['m']) {
			$this->db->where("FIND_IN_SET('".$_SESSION['fee']['m'].$_SESSION['fee']['y']."', fe.f_year)");
		}
		// $this->db->where("fe.f_year", $_SESSION['fee']['y']);
		if($tp == 1) {
			$this->db->order_by("fe.id", "desc");
			$this->db->limit($lim, $start);
			$data = $this->db->get()->result_array();
		} else {
			$data = $this->db->get()->num_rows();
		}

		return $data;

	}

	public function getUnpaidReciept( $tp=null, $id=null, $lim=null, $start=null ) {

		$this->db->select("st.*,  cs.course")
		->from("course cs, student st")
		->where("st.course_id=cs.id")
		->where("st.batch", $id)
		->where("st.code NOT IN (select student_id from tbl_fee_reciept where student_id = st.code and month ='".$_SESSION['fee']['m']."' )",NULL,FALSE);
		if($tp == 1) {
			$this->db->order_by("st.id", "desc");
			$this->db->limit($lim, $start);
			$data = $this->db->get()->result_array();
		} else {
			$data = $this->db->get()->num_rows();
		}
		// $data['result'] = $this->db->get()->result_array();
		return $data;
	}



	public function getAbsentList( $id=null, $date=null) {

		($date)? $d = date('j', strtotime($date)) : $d = date('j');

		$this->db->select("st.*,  cs.course")
		->from("course cs, student st")
		->where("st.course_id=cs.id")
		->where("st.batch", $id)
		->where("st.code NOT IN (select code from tbl_leave where code=st.code and find_in_set('".$d."', lv_days) > 0 )",NULL,FALSE);

			if($date) {
				$this->db->where("st.code NOT IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d', strtotime($date))."') )",NULL,FALSE);
			} else {
				$this->db->where("st.code NOT IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d')."') )",NULL,FALSE);
			}

			$this->db->order_by("st.id", "desc");
			$data = $this->db->get()->result_array();
		// $data['result'] = $this->db->get()->result_array();
		return $data;
	}


	public function getPresentList( $id=null, $date=null) {

		$this->db->select("st.*,  cs.course")
		->from("course cs, student st")
		->where("st.course_id=cs.id")
		->where("st.batch", $id);

			if($date) {
				$this->db->where("st.code IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d', strtotime($date))."') )",NULL,FALSE);
			} else {
				$this->db->where("st.code IN (select student_id from tbl_attendance_student where student_id = st.code and DATE(at_date) = DATE('".date('Y-m-d')."') )",NULL,FALSE);
			}

			$this->db->order_by("st.id", "desc");
			$data = $this->db->get()->result_array();
		// $data['result'] = $this->db->get()->result_array();
		return $data;
	}


	public function setConfig() {

		$conf =	$this->db->get("config")->row_array();

		extract($conf);

		if($com_name) {
			define("COM_NAME", $com_name);
		}
		if($mobile) {
			define("MOBILE", $mobile);
		}
		if($email) {
			define("EMAIL", $email);
		}
		if($reg_fee) {
			define("REG_FEE", $reg_fee);
		} else {
			$this->session->set_flashdata('notify', '<div class="app-error"><i class="fe fe-alert-triangle"></i> &nbsp;Application is not configured. <a href="'.base_url().'profile.html">Click Here</a> go to setting.</div>');
		}
		if($logo) {
			define("LOGO", $logo);
		}
		if($sms_user) {
			define("SMS_USER", $sms_user);
		}
		if($sms_pass) {
			define("SMS_PASS", $sms_pass);
		}
		if($sender_id) {
			define("SENDER_ID", $sender_id);
		}
	}


	public function sendSMS($mobileno, $message) {
		$conf =	$this->db->get("config")->row_array();

		extract($conf);
        $smsMessage = "%20Dear%20Parent%20$fname%20is%20absent%20Today.NEW%20Dastak%20Classes%20Kakadeo%20Kanpur%20always%20care%20your%20Trust%20.%20SPM%20INFOTECH%20SERVICE"; 
		$ip_conn = 'http://173.45.76.227';
		$user = $sms_user;
		$pass = $sms_pass;
		$route = 'trans1';
		$senderid = $sender_id;
		$msg = urlencode($message);
		$ch = curl_init();
		$s="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=abhiaw&password=686l2u-lAoa&sender=JHINST&to=$mobileno&message=$smsMessage&reqid=1&format={json|text}&pe_id=1201161589219376932&template_id=1207163609176835382&route_id=route+id&callback=Any+Callback+URL&unique=0";			
		//$s="$ip_conn/send.aspx?username=$user&pass=$pass&route=$route&senderid=$senderid&numbers=$mobileno&message=$msg";
		curl_setopt($ch, CURLOPT_URL,$s);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		// grab URL and pass it to the browser
			$res = curl_exec($ch);
		// close cURL resource, and free up system resources
		curl_close($ch);
		//echo "<pre>"; print_r($res);
	}
	
	public function sendFeeSMS($mobileno, $message) {
		$conf =	$this->db->get("config")->row_array();

		extract($conf);
		
		$user_info = $this->get_user_detail($mobileno);
		$name  = $user_info->fname;
		$f_due = $user_info->due;

		$ip_conn = 'http://173.45.76.227';
		$user = $sms_user;
		$pass = $sms_pass;
		$route = 'trans1';
		$senderid = $sender_id;
		$msg = urlencode($message);
		$ch = curl_init();
		
		//$smsMessage = "Dear $name Your Fee $f_due is due , for continue to study please deposit your fee. SPM INFOTECH SERVICE";
		//$smsMessage = "Dear Your Fee $f_due is due , for continue to study please deposit your fee. SPM INFOTECH SERVICE";
        $url = "http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=abhiaw&password=686l2u-lAoa&sender=JAIHOO&to=$mobileno&message=Dear%20Your%20Fee%20$f_due%20is%20due%20,%20for%20continue%20to%20study%20please%20deposit%20your%20fee.SPM%20INFOTECH%20SERVICE&reqid=1&format={json|text}&pe_id=1201161589219376932&template_id=1207167558963301715&route_id=route+id&callback=Any+Callback+URL&unique=0";
	     $s=$url;
		//$s="$ip_conn/send.aspx?username=$user&pass=$pass&route=$route&senderid=$senderid&numbers=$mobileno&message=$msg";
		curl_setopt($ch, CURLOPT_URL,$s);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		// grab URL and pass it to the browser
			$res = curl_exec($ch);
		// close cURL resource, and free up system resources
		curl_close($ch);
		//echo "<pre>"; print_r($res);
	}
	
	public function get_user_detail($mobileno) {
		
		$this->db->select("fname,due");
		$this->db->from("tbl_student");
		$this->db->where("mobile",$mobileno);
		$data = $this->db->get()->row();
		return $data;
		
	}	

}
