<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']                    = "home";
$route['404_override']                          = 'error404';

$route['page-not-found']                        = 'home/get404';
$route['about-us']                              = 'cms_page/index';
$route['contact-us']                            = 'cms_page/index';
$route['press']                                 = 'cms_page/index';
$route['agents-and-affiliates']                 = 'cms_page/index';
$route['terms-and-conditions']                  = 'cms_page/index';
$route['privacy-policy']                        = 'cms_page/index';
$route['management']                            = 'cms_page/index';
$route['groups']                                = 'cms_page/index';
$route['guides-and-info']                       = 'cms_page/index';

$route['property-rent/(:any)']                  = 'property/details/$1';

$route['listing/hostels']           = 'listing/index/hostels';
$route['listing/working-hostels']   = 'listing/index/working-hostels';
$route['listing/hotels']            = 'listing/index/hotels';
$route['listing/camping']           = 'listing/index/camping';


/* End of file routes.php */
/* Location: ./application/config/routes.php */