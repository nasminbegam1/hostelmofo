<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_wallet extends CI_Model
{
	
    public function __construct(){
	    // Call the Model constructor
	    parent::__construct();
    }
    
    public function getWalletBalance(){
        $sql = "select SUM(amount) as creditAmount from ".WALLET." where user_id=".$_SESSION['USER_ID']." and debit_credit='cr'";
        $query = $this->db->query($sql);
        $rec = $query->row_array();
        $sql2 = "select SUM(amount) as debitAmount from ".WALLET." where user_id=".$_SESSION['USER_ID']." and debit_credit='dr'";
        $query2 = $this->db->query($sql2);
        $rec2 = $query2->row_array();
        $creditAmount = $rec['creditAmount'];
        $debitAmount  = $rec2['debitAmount'];
        $siteCurrency	= $this->nsession->userdata('currencyCode');
        $currencyRate =    $this->nsession->userdata('currencyRate');
        $currencySymbol   = $this->nsession->userdata('currencySymbol');
        if($creditAmount > $debitAmount){
				$walletBalance = $creditAmount-$debitAmount;
				$formated = round(currentPrice1(stripslashes($walletBalance),$currencySymbol,$currencyRate));
				return $formated;
		  }
		  else{
				return 0;
		  }
		  
    }
	
}
   
?>