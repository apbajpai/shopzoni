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

$route['default_controller'] = "index";
$route['404_override'] = 'error';
$route['admin'] = 'admin/home';
$route['admin/(:any)'] = "admin/$1";


$route['error'] = "index/error";
$route['poll/(:any)'] = "admin/$1";
$route['search/(:any)'] = "search/index/$1";

$route['registration/forgot_password_do-(:any)'] = "registration/forgot_password_do/$1";
$route['registration/(:any)'] = "registration/$1";

$route['archive'] = "archive";
$route['archive/(:any)'] = "archive/index/$1";
$route['archive/(:any)/([0-9])'] = "archive/page/$1/$2";

$route['pages'] = "pages";
$route['pages/(:any)'] = "pages/index/$1";

$route['sitemap'] = "sitemap";
$route['RSSfeed'] = "RSSfeed";
$route['RSSfeed/detail'] = "RSSfeed/detail";
$route['RSSfeed/detail/(:any)'] = "RSSfeed/detail/$1";
$route['article/bolti_tasvir'] = "article/bolti_tasvir";
$route['article/bolti_tasvir_ajax/(:any)/(:any)'] = "article/bolti_tasvir_ajax/$1/$2";
$route['author/(:any)'] = "author/index/$1";
$route['ads_refresh/(:any)'] = "ads_refresh/index/$1";
$route['(:any)/([0-9])'] = "category/index/$1/$2";
$route['(:any)/(:any)'] = "article/index/$2";
$route['(:any)'] = "category/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */