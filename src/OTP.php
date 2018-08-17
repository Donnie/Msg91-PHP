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
		$this->url = "https://control.msg91.com/api/sendotp.php"
	}

	public function set($mobile, $email = null)
	{
		$this->params = [
			'authkey' => $this->auth,
			'sender' => $this->sender,
			'mobile' => $mobile,
			'email' => $email
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