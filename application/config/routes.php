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

//error_reporting(E_ALL); 

$route['default_controller'] = "index";
$route['404'] = "index/error/";
$route['404_override'] = 'error';

$route['seller-details/(:any)'] = "index/seller_details/$1";
$route['redirectshop/(:any)'] = "index/redirectshop/$1";
$route['logout'] = "logout";
$route['error'] = "index/error/";
$route['brands'] = "index/brands/";
$route['return-policy'] = "index/return_policy/";
$route['privacy-policy'] = "index/privacy_policy/";
$route['sitemap.xml'] = "index/sitemap";

$route['get_sellerByPacket'] = "index/get_sellerByPacket/";
$route['checkout'] = "index/checkout/";
$route['brands/(:any)'] = "index/brands/$1";
$route['brands_products'] = "index/brand";
$route['brands_products/(:any)'] = "index/brand/$1";
$route['timeslotDropdown/(:any)/(:any)/(:any)'] = "index/timeslotDropdown/$1/$2/$3";
$route['shipping/(:any)/(:any)'] = "index/shipping/$1/$2";
$route['check-maximum-order/(:any)/(:any)'] = "index/check_maximum_order/$1/$2";

$route['products'] = "index/products/";
$route['products/([0-9]+)'] = "index/products/$1";


$route['viewcart'] = "index/viewcart/";
$route['login'] = "index/login/";
$route['dologin'] = "index/dologin/";

$route['signup'] = "index/signup/";
$route['forgot_password'] = "index/forgot_password/";
$route['change_password'] = "index/change_password/";
$route['reset_password/(:any)'] = "index/reset_password/$1";
$route['register'] = "index/register/";
$route['brand_details'] = "index/brand_details/";
$route['brand_details/(:any)'] = "index/brand_details/$1";
$route['view_more_brand_record/(:any)'] = "index/view_more_brand_record/$1";
$route['view_less_brand_record/(:any)'] = "index/view_less_brand_record/$1";
$route['partner'] = "index/partner/";
$route['partner/(:any)'] = "index/partner/$1";
$route['service_center'] = "index/service_center/";
$route['service_center/(:any)'] = "index/service_center/$1";

$route['shop'] = "index/shop/";
$route['shop/(:any)'] = "index/shop/$1";
$route['shop/(:any)/(:any)'] = "index/shop/$1/$2";
$route['shop/(:any)/(:any)/(:any)'] = "index/shop/$1/$2/$3";
$route['shop/(:any)/(:any)/(:any)/(:any)'] = "index/shop/$1/$2/$3/$4";


$route['updateCartCounter'] = "index/updateCartCounter/";
$route['addtocart'] = "index/addtocart/";
$route['check_quantity'] = "index/check_quantity/";
$route['check_quantity_new'] = "index/check_quantity_new/";
$route['check_packet_quantity'] = "index/check_packet_quantity/";
$route['check_packet_quantity_new'] = "index/check_packet_quantity_new/";
$route['removetocart'] = "index/removetocart/";
$route['place_order'] = "index/place_order/";
$route['b2c_place_order'] = "index/b2c_place_order/";
$route['sucess/([0-9]+)'] = "index/sucess/$1";
$route['activate_buyer/(:any)'] = "index/activate_buyer/$1";
$route['activate_account/([0-9]+)'] = "index/activate_account/$1";
$route['send_email_verification_link/([0-9]+)'] = "index/send_email_verification_link/$1";
$route['save'] = "index/save/";
$route['email_availability'] = "index/email_availability/";
$route['register'] = "index/register/";
$route['seller_login'] = "index/seller_login/";
$route['view_slider/(:any)'] = "index/view_slider/$1";
$route['delivery-location/(:any)'] = "index/delivery_location/$1";
$route['product-offer/(:any)'] = "index/product_offer/$1";
$route['product-description-popup/(:any)'] = "index/product_description_popup/$1";
$route['product'] = "index/product";
$route['myaccount'] = "index/myaccount/";
$route['buyer_request'] = "index/buyer_request/";
$route['buyer_request/(:any)'] = "index/buyer_request/$1";
$route['vendor_list'] = "index/vendor_list/";
$route['order_list'] = "index/order_list/";
$route['logout'] = "logout";
$route['updateprofile'] = "index/updateprofile/";
$route['send_request'] = "index/send_request/";
$route['vendor_list'] = "index/vendor_list/";
$route['message_seller'] = "help/message_seller/";
$route['savemessage_seller'] = "help/savemessage_seller/";
$route['view_order/(:any)'] = "index/view_order/$1";
$route['cancel_order'] = "index/cancel_order/";
$route['google_signin'] = "index/google_signin/";
$route['login_via_google'] = "index/login_via_google/";
$route['login_via_google#'] = "index/login_via_google/";
$route['(:any)'] = "index/product_details/$1";
$route['terms_conditions'] = "index/terms_conditions/";
$route['termsconditions'] = "index/termsconditions/";





	
/* End of file routes.php */
/* Location: ./application/config/routes.php */