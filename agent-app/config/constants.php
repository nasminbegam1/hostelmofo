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

define('FRONTEND_URL',              'http://192.168.2.5/hostelmofo/');
define('AGENT_URL',                 'http://192.168.2.5/hostelmofo/agent/');
define('DOCUMENT_ROOT',             '/var/www/html/hostelmofo/');
define('FILE_UPLOAD_ABSOLUTE_PATH', '/var/www/html/hostelmofo/upload/');
define('FRONT_JS_PATH',             'http://192.168.2.5/hostelmofo/js/');
define('AGENT_CSS_PATH',            'http://192.168.2.5/hostelmofo/agent/css/');
define('AGENT_JS_PATH',             'http://192.168.2.5/hostelmofo/agent/js/');
define('AGENT_IMAGE_PATH',          'http://192.168.2.5/hostelmofo/agent/img/');
define('RSS_XML',                   'http://www.hostelmofo.com/blog/feed/');
define('FILE_UPLOAD_URL',           CDN_URL.'/upload/');
//define('DOMAIN_NAME', 		        'www.beautysalon.com');


define('TABLE_PREFIX','hw_');
define('AGENT', TABLE_PREFIX.'agent');
define('AGENT_ROOMTYPE', TABLE_PREFIX.'agent_roomtype');

define('SITESETTINGS', TABLE_PREFIX.'sitesettings');
define('FRONTUSER', TABLE_PREFIX.'frontuser');
define('EMAILTEMPLATE', TABLE_PREFIX.'email_template');
define('PROPERTY_MASTER', TABLE_PREFIX.'property_master');
define('PROPERTY_DETAILS', TABLE_PREFIX.'property_details');
define('PROPERTY_TYPE', TABLE_PREFIX.'property_type_master');
define('PROPERTY_IMAGE', TABLE_PREFIX.'property_image');
define('ROOMTYPE_MASTER', TABLE_PREFIX.'roomtype_master');
define('PROPERTY_APPROVAL', TABLE_PREFIX.'property_approval');
define('LANGUAGE_MASTER', TABLE_PREFIX.'property_language_master');
define('PROVINCE_MASTER', TABLE_PREFIX.'province_master');
define('CITY', TABLE_PREFIX.'city_master');
define('HEAR_ABOUT', TABLE_PREFIX.'hear_about_master');
define('FACILITIES', TABLE_PREFIX.'facilities_master');
define('PROPERTY_FACILITIES', TABLE_PREFIX.'property_facilities');
define('POLICY_MASTER', TABLE_PREFIX.'property_policies_master');
define('PROPERTY_POLICIES', TABLE_PREFIX.'property_policies');
define('FEATURED_CATEGORY', TABLE_PREFIX.'featured_category');
define('ENQUIRY_MASTER', TABLE_PREFIX.'enquiry_master');
define('CONTACT', TABLE_PREFIX.'contact_us');
define('PROPERTY_PRICE', TABLE_PREFIX.'property_roomprice');
define('PAYMENT_INFO',TABLE_PREFIX.'payment_info');
define('BOOKING',TABLE_PREFIX.'booking_deatils');
define('CMS',TABLE_PREFIX.'cms');
define('FEEDBACK',TABLE_PREFIX.'feedback');
define('PROPERTY_MINIMUMNIGHT',TABLE_PREFIX.'property_minimumnight');
define('DEALS',TABLE_PREFIX.'deal');
define('AVAILABILITY',TABLE_PREFIX.'availibility');
define('AGEGROUP',TABLE_PREFIX.'ageGroup');
define('GROUPTYPE',TABLE_PREFIX.'groupType');



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

define('BACKEND_URL','http://192.168.2.5/hostelmofo/agent/');

/* End of file constants.php */
/* Location: ./application/config/constants.php */