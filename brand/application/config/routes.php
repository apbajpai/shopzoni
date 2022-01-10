<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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


$route['default_controller'] = "index";
$route['404_override'] = 'error';


$route['logout'] = "logout";
$route['error'] = "index/error/";
$route['sucess/([0-9]+)'] = "index/sucess/$1";
$route['forgot_password'] = "index/forgot_password";
$route['activate_account/([0-9]+)'] = "index/activate_account/$1";
$route['send_email_verification_link/([0-9]+)'] = "index/send_email_verification_link/$1";
$route['save'] = "index/save/";
$route['email_availability'] = "index/email_availability/";
$route['register'] = "index/register/";
$route['seller_login'] = "index/seller_login/";




$route['index/load_more'] = "index/load_more/$1";
//$route['registration/do_subscribe'] = "registration/do_subscribe/$1";
$route['job/(:any)'] = "job/index/$1";
$route['job'] = "job/index/";
$route['page/(:any)'] = "page/index/$1";
$route['search/(:any)'] = "search/index/$1";
$route['poll'] = "poll/index/$1";
$route['poll/(:any)'] = "poll/index/$1";
$route['poll/vote'] = "poll/vote/$1";
$route['author/(:any)'] = "author/index/$1";
$route['admin'] = 'admin/home';
$route['admin/(:any)'] = "admin/$1";
$route['admin/(:any)/(:any)'] = "admin/$1/$2";



$route['registration/forgot_password_do-(:any)'] = "registration/forgot_password_do/$1";
$route['registration/(:any)'] = "registration/$1";

$route['(:any)/(:any)/(:any)-([0-9]+)'] = "article/index/$3-$4";
$route['(:any)/(:any)-([0-9]+)'] = "article/index/$2-$3";

$route['(:any)/(:any)/([0-9]+)'] = "category/index/$1/$2/$3";
$route['(:any)/(:any)'] = "category/index/$1/$2";
$route['(:any)'] = "category/index/$1/0";

	
/* End of file routes.php */
/* Location: ./application/config/routes.php */