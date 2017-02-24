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


define('DOMAIN',		    'http://192.168.2.5/');
define('CDN_URL',                   'http://accomodation.totalwealthconce.netdna-cdn.com');
define('CDN_PROPERTY_SMALL_IMG',    'http://accomodation.totalwealthconce.netdna-cdn.com/upload/property/small/');
define('CDN_PROPERTY_THUMB_IMG',    'http://accomodation.totalwealthconce.netdna-cdn.com/upload/property/thumb/');
define('CDN_PROPERTY_BIG_IMG',      'http://accomodation.totalwealthconce.netdna-cdn.com/upload/property/big/');
define('CDN_PROPERTY_BANNER_IMG',   'http://accomodation.totalwealthconce.netdna-cdn.com/upload/property_type/banner/');
define('CDN_PROPERTY_LIST_IMG',     'http://accomodation.totalwealthconce.netdna-cdn.com/upload/property_type/listing/');

define('CDN_CITY_THUMB_IMG',        'http://accomodation.totalwealthconce.netdna-cdn.com/upload/city/thumb/');
define('CDN_CITY_BIG_IMG',          'http://accomodation.totalwealthconce.netdna-cdn.com/upload/city/big/');
define('CDN_CITY_BANNER_IMG',       'http://accomodation.totalwealthconce.netdna-cdn.com/upload/city/banner/');

define('CDN_PROVINCE_BIG_IMG',      'http://accomodation.totalwealthconce.netdna-cdn.com/upload/province/banner/');
define('CDN_PROVINCE_LIST_IMG',     'http://accomodation.totalwealthconce.netdna-cdn.com/upload/province/listing/');

define('SITE_NAME',                 'hostelmofo');
define('FRONTEND_URL',              DOMAIN.SITE_NAME.'/');
define('AGENT_URL',                 DOMAIN.SITE_NAME.'/agent/');
define('BACKEND_URL',               DOMAIN.SITE_NAME.'/admin/');
define('DOCUMENT_ROOT',             '/var/www/html/'.SITE_NAME.'/');
define("SERVER_ABSOLUTE_PATH",      '/var/www/html/'.SITE_NAME.'/');
define('FILE_UPLOAD_ABSOLUTE_PATH', '/var/www/html/'.SITE_NAME.'/upload/');
define('FILE_UPLOAD_URL',           CDN_URL.'/upload/');

define('CDN_BANNER_IMG',            FILE_UPLOAD_URL.'banner/');
define('CDN_BANNER_THUMB_IMG',      FILE_UPLOAD_URL.'banner/thumb/');

define('CDN_TEAM_IMG',            FILE_UPLOAD_URL.'team/');
define('CDN_TEAM_THUMB_IMG',      FILE_UPLOAD_URL.'team/thumb/');

define('IMAGE_UPLOAD_URL',          DOMAIN.SITE_NAME.'/upload/');

define('FRONT_JS_PATH',             DOMAIN.SITE_NAME.'/js/');
define('BACKEND_CSS_PATH',          DOMAIN.SITE_NAME.'/admin/css/');
define('BACKEND_JS_PATH',           DOMAIN.SITE_NAME.'/admin/js/');
define('BACKEND_IMAGE_PATH',        DOMAIN.SITE_NAME.'/admin/images/');
define('FRONT_IMAGE_PATH',          DOMAIN.SITE_NAME.'/images/');

define('DEFAULT_CURRENCY','AUD');


// TABLE NAME

define('TABLE_PREFIX','hw_');
define('ADMINUSER', TABLE_PREFIX.'adminuser');
define('FRONTUSER', TABLE_PREFIX.'frontuser');
define('CMS', TABLE_PREFIX.'cms');
define('CURRENCY_MASTER', TABLE_PREFIX.'currency_master');
define('COUNTRIES', TABLE_PREFIX.'countries');
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
//define('PROPERTY_PRICE', TABLE_PREFIX.'property_price');
define('PROPERTY_PRICE', TABLE_PREFIX.'property_roomprice');

define('PAYMENT_INFO',TABLE_PREFIX.'payment_info');
define('BOOKING',TABLE_PREFIX.'booking_deatils');

define('PROPERTY_DETAILS', TABLE_PREFIX.'property_details');
define('PROPERTY_TYPE', TABLE_PREFIX.'property_type_master');
define('PROPERTY_IMAGE', TABLE_PREFIX.'property_image');
define('FACILITIES', TABLE_PREFIX.'facilities_master');
define('PROPERTY_FACILITIES', TABLE_PREFIX.'property_facilities');
define('PROPERTY_POLICIES', TABLE_PREFIX.'property_policies');
define('FEATURED_CATEGORY', TABLE_PREFIX.'featured_category');
define('POLICY_MASTER', TABLE_PREFIX.'property_policies_master');
define('ROOMTYPE_MASTER', TABLE_PREFIX.'roomtype_master');
define('REVIEW_MASTER', TABLE_PREFIX.'review_master');
define('FAV_LOCATION', TABLE_PREFIX.'favourite_location');
define('ENQUIRY_MASTER', TABLE_PREFIX.'enquiry_master');
define('CONTACT', TABLE_PREFIX.'contact_us');
define('PROPERTY_APPROVAL', TABLE_PREFIX.'property_approval');
define('DISCOUNTCODE_MASTER', TABLE_PREFIX.'discountcode_master');
define('FEEDBACK',TABLE_PREFIX.'feedback');
define('AGENT_ROOMTYPE',TABLE_PREFIX.'agent_roomtype');
define('AGENT',TABLE_PREFIX.'agent');

define('AGEGROUP',TABLE_PREFIX.'ageGroup');
define('GROUPTYPE',TABLE_PREFIX.'groupType');



// PROJECT NAME : 'Api project' IN https://console.developers.google.com
//define("CLIENT_ID",                 "246791962838-o8ljfqkbm1rot3moltdsknr1cf6ml5f9.apps.googleusercontent.com");
//define("EMAIL",                     "246791962838-o8ljfqkbm1rot3moltdsknr1cf6ml5f9@developer.gserviceaccount.com");
//define("ACCOUNT_ID"          ,       "ga:99029709");
//define("P12_FILE_PATH"      ,        SERVER_ABSOLUTE_PATH."admin/API Project-e6c74b6168d0.p12");

define("CLIENT_ID",                 "137459539500-mga9doqf1t7eadblt0j0i5tgv3d7aog4.apps.googleusercontent.com");
define("EMAIL",                     "137459539500-mga9doqf1t7eadblt0j0i5tgv3d7aog4@developer.gserviceaccount.com");
define("ACCOUNT_ID"          ,       "ga:99029709");
define("P12_FILE_PATH"      ,        SERVER_ABSOLUTE_PATH."admin/analytics-af4681e94483.p12");

// ******************** ANALYTICS DATA ***********



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


/* End of file constants.php */
/* Location: ./application/config/constants.php */
