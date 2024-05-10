<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	

public function sendsms()
{
					$ch = curl_init();
					$s="http://www.smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=abhiaw&password=686l2u-lAoa&sender=AETLMS&to=8826262032,9988589951&message=Dear%20Your%20OTP%20is%2087954%20ALL%20EXAM%20TRICKS&reqid=1&format={json|text}&pe_id=1201162296745418069&template_id=1207162703351650824z";
					
					//$s="$ip_conn/send.aspx?username=$user&pass=$pass&route=$route&senderid=$senderid&numbers=$mobileno&message=$msg";
					curl_setopt($ch, CURLOPT_URL,$s);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					$res = curl_exec($ch);
					curl_close($ch);
					echo "<pre>"; print_r($res);

	
}
	




}
