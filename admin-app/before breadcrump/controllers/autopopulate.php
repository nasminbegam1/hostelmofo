<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Autopopulate extends CI_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_misc');
	}
	
	
	
	public function get_country_currency()
	{
		$country_code = $this->input->get_post('theOption',true);
		$resultstring =$this->model_misc->getCountryCurrencycode($country_code);
		echo $resultstring; 
	}
}
	