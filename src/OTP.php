<?php

namespace Donnie\Msg91;

/**
* Author: Donnie Ashok
* Email: hello@donnieashok.in
* Date: 17-08-2018
* Description: Msg91 API for OTP
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

	public function set($mobile, $email = null, $template = null)
	{
		$this->url = "https://control.msg91.com/api/sendotp.php";
		$this->params = [
			'authkey' => $this->auth,
			'sender' => $this->sender,
			'mobile' => $this->formatPhone($mobile),
			'email' => $email,
			'template' => $template
		];

		return $this;
	}

	public function resend($mobile, $retrytype = 'voice')
	{
		$this->url = "https://control.msg91.com/api/retryotp.php";
		$this->params = [
			'authkey' => $this->auth,
			'mobile' => $this->formatPhone($mobile),
			'retrytype' => $retrytype
		];

		return $this;
	}

	public function get($mobile, $otp)
	{
		$this->url = "https://control.msg91.com/api/verifyRequestOTP.php";
		$this->params = [
			'authkey' => $this->auth,
			'mobile' => $this->formatPhone($mobile),
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

	private function formatPhone($mobile)
	{
		if (strlen($mobile) === 10) {
			$mobile = "91".$mobile
		}
		if (strlen($mobile) === 11 && substr($mobile, 0, 1) === "0") {
			// replace 0 from the beginning of otherwise Indian number
			$mobile = "91".substr($mobile, 1);
		}

		return $mobile;
	}
}
