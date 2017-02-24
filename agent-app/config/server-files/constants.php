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


define('FRONTEND_URL',              'http://ecommercedevelopment.us/beautysalon/');
define('ADMIN_URL',                 'http://ecommercedevelopment.us/beautysalon/admin/');
define('SALON_OWNER_ADMIN_URL',     'http://ecommercedevelopment.us/beautysalon/product/');
define('DOCUMENT_ROOT',             '/home/ecommez1/public_html/beautysalon/');
define('FILE_UPLOAD_ABSOLUTE_PATH', '/home/ecommez1/public_html/beautysalon/upload/');
define('FILE_UPLOAD_URL',           'http://ecommercedevelopment.us/beautysalon/upload/');
define('FRONT_JS_PATH',             'http://ecommercedevelopment.us/beautysalon/js/');
define('ADMIN_CSS_PATH',          'http://ecommercedevelopment.us/beautysalon/admin/css/');
define('ADMIN_JS_PATH',           'http://ecommercedevelopment.us/beautysalon/admin/js/');
define('ADMIN_IMAGE_PATH',        'http://ecommercedevelopment.us/beautysalon/admin/img/');

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