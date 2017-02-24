<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('FRONTEND_URL',              	'http://192.168.2.5/hostelmofo/');
define('SITENAME',                      'HostelMofo');
define('CDN_URL',                       'http://accomodation.totalwealthconce.netdna-cdn.com/');

//define('CDN_URL',                       'http://192.168.2.5/hostelmofo/');

define('CDN_PROPERTY_SMALL_IMG',        CDN_URL.'upload/property/small/');
define('CDN_PROPERTY_THUMB_IMG',        CDN_URL.'upload/property/thumb/');
define('CDN_PROPERTY_BIG_IMG',          CDN_URL.'upload/property/big/');

define('CDN_PROPERTY_BANNER_IMG',       CDN_URL.'upload/property_type/banner/');


define('CDN_PROVINCE_BIG_IMG',          CDN_URL.'upload/province/banner/');
define('CDN_PROVINCE_LIST_IMG',         CDN_URL.'upload/province/listing/');

define('CDN_CITY_THUMB_IMG',            CDN_URL.'upload/city/thumb/');
define('CDN_CITY_IMG',                  CDN_URL.'upload/city/');

define('FILE_UPLOAD_URL',               CDN_URL.'/upload/');

define('CDN_TEAM_IMG',                  FILE_UPLOAD_URL.'team/');
define('CDN_TEAM_THUMB_IMG',            FILE_UPLOAD_URL.'team/thumb/');

define('CDN_CSS_PATH',                  CDN_URL.'css/styles.css');
define('CDN_JS_PATH',                   CDN_URL.'js/custom-script.js');
define('CDN_IMAGE_PATH',                CDN_URL.'images/');

define('LOGO_IMAGE',                    CDN_URL.'logo.png');

define('ORIGINAL_SITE_URL',             'http://192.168.2.5/hostelmofo/');
define('SITE_URL',                      'http://192.168.2.5/hostelmofo/');
define('BACKEND_URL',            	'http://192.168.2.5/hostelmofo/admin/');
define('BACKEND_URL_FOR_MAIL',          'http://192.168.2.5/hostelmofo/warp/');
define('SERVER_ABSOLUTE_PATH', 		'/var/www/html/hostelmofo/upload/');
define('FILE_UPLOAD_ABSOLUTE_PATH',     '/var/www/html/hostelmofo/upload/');


define('CDN_BANNER_IMG',                FILE_UPLOAD_URL.'banner/');
define('CDN_BANNER_THUMB_IMG',          FILE_UPLOAD_URL.'banner/thumb/');
define('FRONT_CSS_PATH',          	'http://192.168.2.5/hostelmofo/css/');
define('FRONT_JS_PATH',           	'http://192.168.2.5/hostelmofo/js/');
define('FRONT_IMAGE_PATH',        	'http://192.168.2.5/hostelmofo/images/');
define('RECORD_LIMIT_SEARCH_PAGE',      20);
define('SALES_RECORD_LIMIT_SEARCH_PAGE',      20);
define('PAGE_NUMBER_SHOW',      5);
define('FAVOURITE_PER_PAGE_LIMIT',      15);

define('CURRENT_URL',                   'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
define('AJAX_CURRENT_URL' ,             strval(isset($_SERVER['HTTP_REFERER'])));

$d= date("Y-m-d");
define('DEFAULT_CHECK_IN_DATE', date("d/m/Y",strtotime(date("d-m-Y", strtotime($d)). " +1 day" )));
define('DEFAULT_CHECK_OUT_DATE', date('d/m/Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

define('HOME_DEFAULT_CHECK_IN_DATE', date("d/m/Y",strtotime(date("d-m-Y", strtotime($d)). " +1 day" )));
define('HOME_DEFAULT_CHECK_OUT_DATE', date('d/m/Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

define('DEFAULT_FORM_CHECK_IN_DATE', date("d-m-Y",strtotime(date("d-m-Y", strtotime($d)). " +1 day" )));
define('DEFAULT_FORM_CHECK_OUT_DATE', date('d-m-Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

//API key for library inInfo to track country
define('INFODB_APIKEY',                  '8ed7dffa2131e8a77996a6561c6f55bb5ab7b5708723fc63e4e644a226d7eaa9'); 

define('TABLE_PREFIX','hw_');

define('ADMINUSER', TABLE_PREFIX.'adminuser');

define('USER', TABLE_PREFIX.'social_users');
define('AVAILABILITY', TABLE_PREFIX.'availibility');
//define('FRONTUSER', TABLE_PREFIX.'frontuser');
define('CMS', TABLE_PREFIX.'cms');
define('CURRENCY_MASTER', TABLE_PREFIX.'currency_master');
define('NEWSLETTER', TABLE_PREFIX.'newsletter');
define('SITESETTINGS', TABLE_PREFIX.'sitesettings');
define('BANNER_MASTER', TABLE_PREFIX.'banner_master');
define('CLIENT', TABLE_PREFIX.'client');
define('FAQ', TABLE_PREFIX.'faq_master');
define('HOMECONTENT', TABLE_PREFIX.'homecontent');
define('TEAM', TABLE_PREFIX.'team_management');
define('EMAILTEMPLATE', TABLE_PREFIX.'email_template');

define('HEAR_ABOUT', TABLE_PREFIX.'hear_about_master');
define('PROVINCE_MASTER', TABLE_PREFIX.'province_master');
define('LANGUAGE_MASTER', TABLE_PREFIX.'property_language_master');
define('CITY', TABLE_PREFIX.'city_master');

define('PROPERTY_MASTER', TABLE_PREFIX.'property_master');
define('PROPERTY_DETAILS', TABLE_PREFIX.'property_details');
define('PROPERTY_TYPE', TABLE_PREFIX.'property_type_master');
define('PROPERTY_IMAGE', TABLE_PREFIX.'property_image');
define('PROPERTY_PRICE', TABLE_PREFIX.'property_price');
define('PROPERTY_ROOMPRICE', TABLE_PREFIX.'property_roomprice');
define('PROPERTY_FACILITIES', TABLE_PREFIX.'property_facilities');
define('PROPERTY_POLICIES', TABLE_PREFIX.'property_policies');

define('FACILITIES', TABLE_PREFIX.'facilities_master');
define('FEATURED_CATEGORY', TABLE_PREFIX.'featured_category');
define('POLICY_MASTER', TABLE_PREFIX.'property_policies_master');
define('ROOMTYPE_MASTER', TABLE_PREFIX.'roomtype_master');
define('REVIEW_MASTER', TABLE_PREFIX.'review_master');
define('CITY_MASTER', TABLE_PREFIX.'city_master');
define('ENQUIRY_MASTER', TABLE_PREFIX.'enquiry_master');
define('MEMBERS_FAVOURITE', TABLE_PREFIX.'members_favourite');
define('CONTACT', TABLE_PREFIX.'contact_us');
define('PROPERTY_APPROVAL', TABLE_PREFIX.'property_approval');

define('BOOKING_DETAILS', TABLE_PREFIX.'booking_deatils');
define('PAYMENT_INFO', TABLE_PREFIX.'payment_info');
define('DISCOUNT_CODE', TABLE_PREFIX.'discountcode_master');
define('FEEDBACK', TABLE_PREFIX.'feedback');
define('WALLET', TABLE_PREFIX.'wallet');
define('PROPERTY_MINIMUMNIGHT',TABLE_PREFIX.'property_minimumnight');
define('DEALS',TABLE_PREFIX.'deal');
define('AGENT_ROOMTYPE',TABLE_PREFIX.'agent_roomtype');
define('USER_CREDIT_CARD',TABLE_PREFIX.'user_credit_card');
define('GROUPTYPE',TABLE_PREFIX.'groupType');
define('AGEGROUP',TABLE_PREFIX.'ageGroup');
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
 
/**************************** Paypal Live Information **********************/ 
define('Paypal_Version', '93');
define('API_Button_Source', 'AngellEYE_PHPClass');
define('Path_To_Cert_Key_PEM', '/path/to/cert/pem.txt');
define('API_Mode', 'Signature'); 
/************************************************** Paypal Information Ends *****************************************/
