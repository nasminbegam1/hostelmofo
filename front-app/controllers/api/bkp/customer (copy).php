<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Customer extends REST_Controller{
    function __construct(){
        parent::__construct();       
        $this->load->model('model_basic');
    }
    
    
    function get_random_password($chars_min=8, $chars_max=12, $use_upper_case=false, $include_numbers=false, $include_special_chars=false){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                

      return $password;
    }

		function signup_post()
		{
		    $data['first_name']     = addslashes(trim($this->input->get_post('first_name')));
		    $data['last_name']      = addslashes(trim($this->input->get_post('last_name')));
		    $data['email']		= addslashes(trim($this->input->get_post('email')));
		    $data['dob_dd']         = addslashes(trim($this->input->get_post('dob_dd')));
		    $data['dob_mm']         = addslashes(trim($this->input->get_post('dob_mm')));
		    $data['dob_yy']         = addslashes(trim($this->input->get_post('dob_yy')));
		    $data['gender']         = addslashes(trim($this->input->get_post('gender')));
		    $data['location']       = addslashes(trim($this->input->get_post('location')));
		    $data['nationality']    = addslashes(trim($this->input->get_post('nationality')));
		    $data['country_code']   = addslashes(trim($this->input->get_post('country_code')));
		    $data['mobile_no']      = addslashes(trim($this->input->get_post('mobile_no')));
		    $data['password']       = addslashes(trim($this->input->get_post('password')));
		
				if(!empty($data['first_name']) && !empty($data['last_name']) && !empty($data['email']) && !empty($data['dob_dd']) && !empty($data['dob_mm']) && !empty($data['dob_yy']) && !empty($data['nationality']) && !empty($data['country_code']) && !empty($data['mobile_no']) && !empty($data['password'])){
						// Check for email address exists
						$chkEmailCnt	= $this->model_basic->isRecordExist(USER, "email = '" . $data['email'] . "'");
		
						if(!$chkEmailCnt){
		
								$insertArr= array(
										'firstname'     => $data['first_name'],
										'lastname'      => $data['last_name'],
										'email'      		=> $data['email'],
										'password'      => $data['password'],
										'birthDate'     => $data['dob_dd'],
										'birthMonth'    => $data['dob_mm'],
										'birthYear'     => $data['dob_yy'],
										'gender'        => $data['gender'],
										'location'      => $data['location'],
										'nationality'		=> $data['nationality'],
										'country_code'	=> $data['country_code'],
										'mobile_no'			=> $data['mobile_no'],
										'activated'			=> '1',
										'provider'			=> 'site',
										'created'				=> date("Y-m-d H:i:s")
								);
		
								$insertedID		= $this->model_basic->insertIntoTable(USER, $insertArr);
								if($insertedID <> '')
								{
								    $userArr = $this->model_basic->getValues_conditions(USER, '',  '', 'id='.$insertedID);
								    $first_name= $userArr[0]['firstname'];
								    $last_name= $userArr[0]['lastname'];
								    $email= $userArr[0]['email'];
								    $password= $userArr[0]['password'];
								    $site_name= "HostelMofo";
								    $frontendurl= FRONTEND_URL;
								    
								    $template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=12');
    
								    $mail_config['to'] = stripslashes(trim($email));
								    $mail_config['from'] = $template[0]['responce_email'];
								    $mail_config['from_name'] = 'HostelMofo Team';
								    $mail_config['subject'] = $template[0]['email_subject'];
								    $mail_config['message'] =  $template[0]['email_content'];
								    
								    $str_find= array('{{FIRST-NAME}}','{{LAST-NAME}}','{{FRONT-URL}}','{{EMAIL}}','{{PASSWORD}}','{{SITE-NAME}}');
								    $str_replace= array($first_name,$last_name,$frontendurl,$email,$password,$site_name);
								    
								    $mail_config['message'] = str_replace($str_find,$str_replace,$mail_config['message']);
				    
								    $mailsnd_user = send_html_email($mail_config);

								    $message = array('data' => $userArr, 'status' => '1', 'message' => 'User added successfully! Mail has been sent.');
								}
								else{
										$message = array('status' => '2', 'message' => 'Unable to add user.please try again!');
								}
						}
						else{
								$message = array('status' => '3', 'message' => 'Email Address is already exists!');
						}
				}
				else{
						$message = array('message' => 'Data not found!');
				}
				$this->response($message, 200); // 200 being the HTTP response code
		}
    
    function signin_post(){
	$data['email']		        = addslashes(trim($this->input->get_post('email')));
	$data['password']               = addslashes(trim($this->input->get_post('password')));
	$data['token']               	= addslashes(trim($this->input->get_post('token')));
	
	$customerRecord			= $this->model_basic->getValues_conditions(USER, '*', '', 'email = "'.$data['email'].'"');
	if($customerRecord){
	    if($customerRecord[0]['password'] == $data['password']){
		if($customerRecord[0]['activated'] == 1){
		    $insertArr      	= array(
					    'users_id'               	=> $customerRecord[0]['id'],
					    'token_id'              	=> $data['token'],
					    'created_at'		=> date("Y-m-d H:i:s")
					    );
		    $dd		= $customerRecord[0]['birthDate'];
		    if(strlen($customerRecord[0]['birthMonth']) == 1){
			$mm	= '0' . $customerRecord[0]['birthMonth'];
		    }else{
			$mm	= $customerRecord[0]['birthMonth'];
		    }
		    $yy		= $customerRecord[0]['birthYear'];
		    $dob	= $dd . '/' . $mm . '/' . $yy;
		    $customerRecord[0]['dob']	= $dob;
		    
		    $insertedID		= $this->model_basic->insertIntoTable('hw_app_user_tokens', $insertArr);
		    $message = array('customer' => $customerRecord, 'status' => '1', 'message' => 'You have successfully logged in!');
		}else{
		    $message = array('status' => '2', 'message' => 'Account not activated!');
		}
	    }else{
		$message = array('status' => '3', 'message' => 'Invalid password provided!');
	    }
	}else{
	    $message = array('status' => '4', 'message' => 'Invalid email address provided!');
	}
	$this->response($message, 200);
    }
    
    function signout_post(){
	$data['id']               	= addslashes(trim($this->input->get_post('id')));
	$data['token']               	= addslashes(trim($this->input->get_post('token')));
	$customerRecord			= $this->model_basic->getValues_conditions('hw_app_user_tokens', '*', '', 'users_id = "'.$data['id'].'" AND token_id = "'.$data['token'].'"');
	if($customerRecord){
	    if($customerRecord[0]['token_id'] == $data['token']){
		$where_clause	= 'users_id = "' . $data['id'] . '" AND token_id = "' . $data['token'] . '"';
		$delRecord	= $this->model_basic->deleteData('hw_app_user_tokens', $where_clause);
		$message = array('status' => '1', 'message' => 'You have successfully logged out!');
	    }else{
		$message = array('status' => '2', 'message' => 'Token mismatch!');
	    }
	}else{
	    $message = array('status' => '3', 'message' => 'Invalid users id provided!');
	}
	$this->response($message, 200);
    }
    
    function forgotpassword_post(){
	$data['email']		        = addslashes(trim($this->input->get_post('email')));	
	$customerRecord			= $this->model_basic->getValues_conditions(USER, array('id'), '', 'email = "'.$data['email'].'"');
	if($customerRecord){
	    //$this->load->helper('string');
	    //$new_password	= random_string('alnum',8);
	    $uid		= $customerRecord[0]['id'];
	    $new_password	= $this->get_random_password(8, 10, true, true, true);
	    $idArr		= array('id'	=> $uid);
	    $updateArr		= array('password'	=> $new_password);
	    $updatedRecord	= $this->model_basic->updateIntoTable(USER, $idArr, $updateArr);
	    if($updatedRecord){
		$settings           			= $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'',"sitesettings_id IN (1,3)");
		$mail_config                    	= array();
		$mail_config['to'] 			= $data['email'];
		$mail_config['from'] 			= trim($settings[0]['sitesettings_value']);
		$mail_config['from_name'] 		= 'Hostelworld Team';
		$mail_config['subject']			= 'Hostelworld - Forgot Password';
		$mail_config['message']			= 'Thanks you for requesting a password.<br>Please find the new password below:<br>New Password: ' . $new_password;
		$mailsnd = send_html_email($mail_config);
		$message = array('status' => '1', 'message' => 'New password has been sent to email!');
	    }else{
		$message = array('status' => '2','message' => 'Password cannot be set. Please try again!');
	    }
	}else{
	    $message = array('status' => '3','message' => 'Invalid email address provided!');
	}
	$this->response($message, 200);
    }
    
    function getprofileinfo_get(){
	$id	= $this->uri->segment(4, 0);
	if($id){
	    $customerRecord			= $this->model_basic->getValues_conditions(USER, array('*'), '', 'id = "'.$id.'"');
	    if($customerRecord){
		$result	=$customerRecord[0];
		$message = array('result' => $result,'message' => 'Record fetched successfully!');
	    }else{
		$message = array('message' => 'Invalid customer ID provided!');
	    }
	}else{
	    $message = array('message' => 'Invalid customer ID provided!');
	}
	$this->response($message, 200);
    }
    
    function editprofile_post(){
	$data['id']                 		= addslashes(trim($this->input->get_post('id')));
	$data['first_name']                 	= addslashes(trim($this->input->get_post('first_name')));
	$data['last_name']                  	= addslashes(trim($this->input->get_post('last_name')));
	$data['dob_dd']            		= addslashes(trim($this->input->get_post('dob_dd')));
	$data['dob_mm']               		= addslashes(trim($this->input->get_post('dob_mm')));
	$data['dob_yy']                		= addslashes(trim($this->input->get_post('dob_yy')));
	$data['gender']               		= addslashes(trim($this->input->get_post('gender')));
	$data['location']                   	= addslashes(trim($this->input->get_post('location')));
	$data['nationality']                	= addslashes(trim($this->input->get_post('nationality')));
	$data['country_code']                	= addslashes(trim($this->input->get_post('country_code')));
	$data['mobile_no']                	= addslashes(trim($this->input->get_post('mobile_no')));
	$data['password']                 	= addslashes(trim($this->input->get_post('password')));
	
	if(!empty($data['id']) && !empty($data['first_name']) && !empty($data['last_name']) && !empty($data['dob_dd']) && !empty($data['dob_mm']) && !empty($data['dob_yy']) && !empty($data['nationality']) && !empty($data['country_code']) && !empty($data['mobile_no']) && !empty($data['password'])){
	    $idArr		= array('id' => $data['id']);
	    $updateArr      	= array(
				    'firstname'               	=> $data['first_name'],
				    'lastname'              	=> $data['last_name'],
				    'password'        		=> $data['password'],
				    'birthDate'           	=> $data['dob_dd'],
				    'birthMonth'            	=> $data['dob_mm'],
				    'birthYear'                	=> $data['dob_yy'],
				    'gender'              	=> $data['gender'],
				    'location'              	=> $data['location'],
				    'nationality'		=> $data['nationality'],
				    'country_code'		=> $data['country_code'],
				    'mobile_no'			=> $data['mobile_no']
				    );	    
	    
	    $insertedID		= $this->model_basic->updateIntoTable(USER, $idArr, $updateArr);
	    $customerRecord	= $this->model_basic->getValues_conditions(USER, array('*'), '', 'id = "'.$data['id'].'"');
	    if($customerRecord){
		$dd		= $customerRecord[0]['birthDate'];
		if(strlen($customerRecord[0]['birthMonth']) == 1){
		    $mm	= '0' . $customerRecord[0]['birthMonth'];
		}else{
		    $mm	= $customerRecord[0]['birthMonth'];
		}
		$yy		= $customerRecord[0]['birthYear'];
		$dob	= $dd . '/' . $mm . '/' . $yy;
		$customerRecord[0]['dob']	= $dob;
		$result	= $customerRecord[0];
		
		//'customer' => $customerRecord
		//$message = array('status' => '1', 'result' => $result,'message' => 'User updated successfully!');
		$message = array('status' => '1', 'result' => $customerRecord,'message' => 'User updated successfully!');
	    }else{
		$message = array('status' => '2', 'message' => 'Invalid customer ID provided!');
	    }	    
	}else{
	    $message = array('status' => '3', 'message' => 'Data not found!');
	}
	$this->response($message, 200);
    }
}