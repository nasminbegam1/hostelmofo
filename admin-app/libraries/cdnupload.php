<?php

define('CDN_FTP','ftp.accomodation.totalwealthconce.netdna-cdn.com');
define('CDN_USERNAME','accomodation.totalwealthconce');
define('CDN_PASSWPORD','accomodation123');
define('CDN_PORT','22');

class Cdnupload{
    var $obj;
    function __construct(){
        $CI = & get_instance();
        $this->obj = $CI;
       // $this->obj->load->config('cdn_config',true);
    }
    
    
    function getFileNewName($file_name){
        $new_file_name = '';
        if($file_name){
            $file_info = pathinfo($file_name);
            if(is_array($file_info)){
                $rand_text = rand(0,999999);
                $file_info['filename'] = str_replace(' ','_',$file_info['filename']);
                $new_file_name = $file_info['filename'].'_'.$rand_text.'.'.$file_info['extension'];
            }
        }
        return $new_file_name;
    }
    
    function upload($file='',$path='',$new_name=''){
      
       $server     = CDN_FTP;
       $port       = CDN_PORT;
       $username   = CDN_USERNAME;
       $passwd     = CDN_PASSWPORD;
                       
       $connection = ssh2_connect($server, $port);

       if (ssh2_auth_password($connection, $username, $passwd))
       {
           $sftp = ssh2_sftp($connection);
           //echo "Connection status: OK. Uploaded file!";
           
           $contents = file_get_contents($file);
           file_put_contents("ssh2.sftp://{$sftp}/public_html/upload/{$path}/{$new_name}", $contents);
       }
       else
       {
           echo "Nope! Can not connect to server!";
       }
    }
    
    
}