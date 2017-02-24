<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twiliosms extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->library('twilio');

		$from = '+16366424850';
		$to = '+918116401487';
		$message = 'Happy Birthday Tonmay Nandy.';

		$response = $this->twilio->sms($from, $to, $message);
		//echo "<pre>";print_r($response);echo "</pre>";

		if($response->IsError)
			echo 'Error: ' . $response->ErrorMessage;
		else
			echo 'Sent message to ' . $to;
			//echo 'Sent message';
	}

}

/* End of file twilio_demo.php */