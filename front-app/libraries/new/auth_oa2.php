<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_oa2 extends CI_Controller
{
    public function session($provider_name)
    {
	$this->load->library('session');
        $this->load->helper('url_helper');
	$this->load->helper('cookie');

        $this->load->library('oauth2/OAuth2');
	$this->load->library('tank_auth');
	$this->load->model('tank_auth/users');
	$this->load->model('model_basic');
	$this->load->config('oauth2', TRUE);

        $provider = $this->oauth2->provider($provider_name, array(
            'id' => $this->config->item($provider_name.'_id', 'oauth2'),
            'secret' => $this->config->item($provider_name.'_secret', 'oauth2'),
        ));
	
	
	$provider_name = $provider->name;
	

	if ( ! $this->input->get('code'))
        {
	    $options['redirect_uri'] = SITE_URL.'auth_oa2/session/google';
            // By sending no options it'll come back here
            $provider->authorize();
        }
        else
        {
            // Howzit?
            try
            {
                //$token = $provider->access($_GET['code']);
                $token = $provider->access($this->input->get('code'));
                $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                //echo "<pre>Tokens: ";
                //var_dump($token);


		/*** Set social user values into session start */
		$arr_social_user = array(
					    'user_id'		=> $user['uid'],
					    'username'		=> $user['name'],
					    'first_name'	=> $user['first_name'],
					    'last_name'		=> $user['last_name'],
					    'email'		=> $user['email'],
					    'image'		=> $user['image'],
					    'provider_name'	=> $provider_name
					);
		
		/*** Set social user values into session end */
		$ip_address		= $_SERVER['REMOTE_ADDR'];
		
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');
			
		}
		//elseif( !is_null($this->users->get_user_by_email($provider_name.'|'.$user['email']))) { //already registered
		elseif( !is_null($this->users->get_user_by_email($user['email']))) { //already registered
			echo 'already';
			
			if ($this->tank_auth->login_oa2( $provider_name.'|'.$user['email'], $user['image'] ) ) {								// success
			   echo "success";
				//redirect('/');

			} else {
				$errors = $this->tank_auth->get_error_message();
				if (isset($errors['banned'])) {								// banned user
					$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

				} elseif (isset($errors['not_activated'])) {				// not activated user
					redirect('/auth/send_again/');

				} else {													// fail
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
								
								
		} else {
								
				if (!is_null($data = $this->tank_auth->create_user_oa2($user['email'],$provider_name,$user['first_name'],$user['last_name']))) {
				// success
				$data['site_name'] = $this->config->item('website_name', 'tank_auth');
	    
				if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email
				    $this->_send_email('welcome', $data['email'], $data);
				}
				
				/*** Check user is exist or not ***/
				
				$arr_user = $this->model_basic->getValues_conditions(SITEUSER, "", "", "email_id = '".$user['email']."' AND status = 'Active'");
				
				if(is_array($arr_user) && count($arr_user) > 0)
				{
				    //echo "hi";exit;
				    $this->session->set_userdata('USER_PHONE', $arr_user[0]['user_phone_no']);
				    $this->session->set_userdata('USER_NAME',$arr_user[0]['first_name']." ".$arr_user[0]['last_name']);
				    $this->session->set_userdata('USER_ID',$arr_user[0]['user_id']);
				    $this->session->set_userdata('LOGIN_METHOD', $arr_user[0]['login_method']);
				    
				    /*** Set Cookies ***/
				    
				    $cookie = array( 'name'   => "action", 'value'  => "keep" , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    $this->input->set_cookie($cookie);
				    
				    $cookie = array( 'name'   => "user", 'value'  => $arr_user[0]['user_id'] , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    $this->input->set_cookie($cookie);
				    
				    $cookie = array( 'name'   => "user_name", 'value'  => $arr_user[0]['first_name']." ".$arr_user[0]['last_name'] , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    $this->input->set_cookie($cookie);
				    
				    $cookie = array( 'name'   => "phone_no", 'value'  => $arr_user[0]['user_phone_no'] , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    
				    $this->input->set_cookie($cookie);
				}
				else
				{
				    /*** insert into social property start ***/
				    $insertArr = array(
						       'login_method'	=> $provider_name,
						       'first_name'	=> $user['first_name'],
						       'last_name'	=> $user['last_name'],
						       'email_id'	=> $user['email'],
						       'image'		=> $user['image'],
						       'credits'	=> 5,
						       'status'		=> "active",
						       'added_on'	=> date("Y-m-d H:i:s")
						       );
				    
				    $user = $this->model_basic->insertIntoTable(SITEUSER, $insertArr);
				    
				    $this->session->set_userdata('USER_PHONE','');
				    $this->session->set_userdata('USER_NAME',$insertArr['first_name']." ".$insertArr['last_name']);
				    $this->session->set_userdata('USER_ID',$user);
				    $this->session->set_userdata('LOGIN_METHOD', $provider_name);
				    
				    /*** Set Cookies ***/
				    
				    $cookie = array( 'name'   => "action", 'value'  => "keep" , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    $this->input->set_cookie($cookie);
				    
				    $cookie = array( 'name'   => "user", 'value'  => $user , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    $this->input->set_cookie($cookie);
				    
				    $cookie = array( 'name'   => "user_name", 'value'  => $insertArr['first_name']." ".$insertArr['last_name'] , 'expire' => '15000000','prefix' => 'laetly_','secure' => false);
				    $this->input->set_cookie($cookie);
				
				    //redirect('/auth/dashboard/');
				}
				
				redirect('/auth/dashboard/');
	
			} else {
			    $errors = $this->tank_auth->get_error_message();
			    foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}

		}


            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }


	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

}

/* End of file auth_oa2.php */
/* Location: ./application/controllers/auth_oa2.php */