<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallet extends MY_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model(array('model_basic','model_wallet'));
    }
    
    public function index(){
        $this->chk_login();
        $this->data = "";
        $cms_slug		=	$this->uri->segment(1);
        $this->data['wallet_balance'] = $this->model_wallet->getWalletBalance();
	$title = "My Wallet";
        $this->templatelayout->make_seo();
		  //$this->templatelayout->get_header();
		  //$this->templatelayout->get_cms_header($cms_slug);
		  //$this->templatelayout->get_banner('','','hostel');
		  $this->templatelayout->get_banner_inner('',$title);
		  //$this->templatelayout->get_footer();
		  $this->templatelayout->get_inner_footer();
        $this->elements['middle']	= 'wallet/showWallet';			
        $this->elements_data['middle'] 	= $this->data;			    
        $this->layout->setLayout('details_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
}