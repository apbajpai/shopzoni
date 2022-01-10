<?php

class Fb_Login extends MY_Controller  {

public $user = "";

public function __construct() {
parent::__construct();

// Load facebook library and pass associative array which contains appId and secret key
$this->load->library('facebook', array('appId' => '1589864254657329', 'secret' => 'f83372b8c00f8a8dcd066d758d872a14'));

// Get user's login information
$this->user = $this->facebook->getUser();
}

// Store user information and send to profile page
public function index() {

if ($this->user) {
$data['user_profile'] = $this->facebook->api('/me/');

// Get logout url of facebook
$data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . 'index.php/fb_login/logout'));

// Send data to profile page
$this->load->view('fb_profile', $data);
} else {

// Store users facebook login url
$data['login_url'] = $this->facebook->getLoginUrl();
$this->load->view('fb_login', $data);
}
}

// Logout from facebook
public function logout() {

// Destroy session
session_destroy();

// Redirect to baseurl
redirect(base_url());
}

}

?>