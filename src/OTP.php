<?php

namespace Donnie\Msg91;

/**
* Author: Donnie Ashok
* Email: hello@donnieashok.in
* Date: 17-08-2018
* Description: Msg91 API for sending OTP
*/

class OTP
{

	private $auth;
	private $sender;
	
	function __construct($auth = null, $sender = "OTPSMS")
	{
		$this->auth = $auth;
		$this->sender = $sender;
	}

	public function set($mobile, $email = null)
	{
		$this->url = "https://control.msg91.com/api/sendotp.php";
		$this->params = [
			'authkey' => $this->auth,
			'sender' => $this->sender,
			'mobile' => $mobile,
			'email' => $email
		];

		return $this;
	}

	public function get($mobile, $otp)
	{
		$this->url = "http://api.msg91.com/api/verifyRequestOTP.php";
		$this->params = [
			'authkey' => $this->auth,
			'mobile' => $mobile,
			'otp' => $otp
		];

		return $this;
	}

	public function send()
	{
		$query = http_build_query($this->params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, count($this->params));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// execute post
		$result = curl_exec($ch);
		// close connection
		curl_close($ch);
		return json_decode($result);
	}



}