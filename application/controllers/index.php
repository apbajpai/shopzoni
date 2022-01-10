<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		session_start();		
		ob_start();
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->library('user_agent');
		$this->load->helper('url');
		//$this->load->library('email');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('seller_registration_model');
		$this->load->model('category_model');	
		$this->load->model('section_model');	
		$this->load->model('product_model');	
		$this->load->model('registration_model');	
		$this->load->model('brand_model');
		$this->load->model('buyer_request_model');
		$this->load->model('department_model');
		$this->load->library('facebook/fb','fb');
		$this->load->model('terms_conditions_model');
		$this->load->model('slider_image_model');
		$this->load->model('holiday_model');
		$this->load->library('user_agent');
	}	
	
	public function index($page_no)
	{
		$this->page($page_no);
	}

	private function check_isvalidated(){
        if(! $this->session->userdata('user_id')){
            redirect('login');
        }
    }
		

	public function page($param)
	{	
		$this->load->view('common/header', $data);	
		$banner_image = $this->slider_image_model->GetRecords();
		$small_banner_image = $this->slider_image_model->Getsmall_banner_image(0,3);
		$data['small_banner_image'] = $small_banner_image;
		
		$section_record = $this->section_model->GetHomeRecords();		
		foreach($section_record as $section){
			$section_records[] =	$this->product_model->GetRecords($seller_id='',$section->id,$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
		}
		$data['section_records'] = $section_records;
		
		//$data['section1_products'] = $this->product_model->GetRecords($seller_id='',$section_id='13',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
		//$data['section2_products'] = $this->product_model->GetRecords($seller_id='',$section_id='4',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
		//$data['section3_products'] = $this->product_model->GetRecords($seller_id='',$section_id='1',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
		//$data['section4_products'] = $this->product_model->GetRecords($seller_id='',$section_id='1',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
		
		
		$data['banner_image'] = $banner_image;
		$this->load->view('index', $data);
		$this->load->view('common/footer');	
	}	
	
	
	
	public function brands($param){	
		$param = $this->uri->segment(2);
		$brand_banner_image = $this->slider_image_model->GetBrand_banner_image();
		$data['brand_banner_image'] = $brand_banner_image;
		/*$this->load->view('common/header', $data);		
		$data['brands_record'] = $this->brand_model->GetRecords($param);
		$this->load->view('brands', $data);
		$this->load->view('common/footer'); */
		
		//search query start//
		$search['name'] = $this->input->post('name');
		$data['search'] = $search;
		
		//serach query ends//		
		
		$department_ids = $this->input->post('department');
		
		if(is_array($department_ids)){
			$brands_record	=	$this->brand_model->GetRecordsByDepartment($department_ids);
			$data['brands_record'] = $brands_record;
			$data['department_ids'] = $department_ids;
			//$department_record	=	$this->department_model->GetRecords();
			$department_record	=	$this->department_model->GetDepartmentRecordswithBrandProducts();	
			
			$data['department_record'] = $department_record;
			
			$this->load->view('common/header', $data);			
			$this->load->view('brands', $data);
			$this->load->view('common/footer');
		}else{
			$brands_record	=	$this->brand_model->GetRecords($param);
			$data['brands_record'] = $brands_record;
			$data['department_ids'] = $department_ids;
			$department_record	=	$this->department_model->GetDepartmentRecordswithBrandProducts();
			$data['department_record'] = $department_record;
			
			$this->load->view('common/header', $data);			
			$this->load->view('brands', $data);
			$this->load->view('common/footer');
		}		
	}
	
	public function products($page_no){		
		//search query start//
		$page_no = $this->uri->segment(2); 
		$search['search_products'] = $this->input->post('search_products');
		$data['search'] = $search;
		$product_name	=	$this->input->post('search_products');
		
		$per_page=45;
		$total_record	= $this->product_model->GetTotalRecord('','','',$brand_ids,$product_name);		
		$config['base_url'] = site_url().'products';
		$config['total_rows'] = $total_record;
		$config['per_page'] = $per_page;
		$config["uri_segment"] = 2;
		
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		
		if($page_no=='')
			$limit=0;
		else
			$limit=$config["per_page"]*($page_no-1);
			
		$offset = ($limit) ? $limit : 0;
		
		
		
		$this->load->view('common/header', $data);
		
		$department_ids = $this->input->post('department');
		$brands_record	=	$this->brand_model->GetRecordsByDepartment($department_ids);
		foreach($brands_record as $key=>$brand){
			$brand_ids[] = $brand->id;
		}	
		$data['department_ids'] = $department_ids;
		$data['products'] = $this->product_model->GetRecords('','','',$brand_ids,$product_name,$offset,$per_page);
		$department_record	=	$this->department_model->GetRecords();
		$data['department_record'] = $department_record;
		$this->load->view('products', $data);
		$this->load->view('common/footer');
	}
	
	public function addtowhishlist($param)
	{
		$param = $this->uri->segment(1); 
		$this->check_isvalidated();
		echo $this->product_model->addtowhishlist($param);
	}
	
	public function product_details($param){
		//echo $param;
		$param = $this->uri->segment(1);
		//search query start//
		$search['name'] 	= $this->input->post('name');
		$search['state'] 	= $this->input->post('state');
		$search['city'] 	= $this->input->post('city');
		$search['pincode'] 	= $this->input->post('pincode');
		$search['pkt'] 		= $this->input->post('pkt');
		$data['search'] 	= $search;
		//serach query ends//
		
		$state_record	=	$this->product_model->GetStateRecord();
		$data['state_record'] = $state_record;
		
		$city_record	=	$this->product_model->GetCityRecord();
		$data['city_record'] = $city_record;
		
		$pincode_record	=	$this->product_model->GetPincodeRecord();
		$data['pincode_record'] = $pincode_record;			

		$seller_record	=	$this->product_model->getSellerByProductCode($param);
		
		$data['seller_record'] = $seller_record;
			
		//$seller_record_packet	=	$this->product_model->getSellerByProductPacketCode($param);
		//$data['seller_record_packet'] = $seller_record_packet;
				
		$product_detail = $this->product_model->GetRecords($seller_id='',$section_id='',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10,$param);
		$data['product_detail'] = $product_detail;
		
		
		
		$packet_record	=	$this->product_model->GetPacketBySellerProductID($seller_id="",$product_detail[0]->id);		
		$data['packet_record'] = $packet_record;	
				
		$brand_product = $this->product_model->getProductByBrandID($product_detail[0]->brand_id);
		$data['brand_product'] = $brand_product; 
		
		$seo_tag->meta_title = $product_detail[0]->meta_title;
		$seo_tag->meta_description = $product_detail[0]->meta_description;
		$seo_tag->meta_keywords= $product_detail[0]->meta_keywords;
		$seo_tag->seo_canonical = $product_detail[0]->seo_canonical;
		$data['seo_tag'] = $seo_tag;
		
		$og_tag->type = "Product";
		$og_tag->title = $product_detail[0]->name;
		$og_tag->description = $product_detail[0]->meta_description;
		$og_tag->url = base_url().$product_detail[0]->code;
		$og_tag->site_name = "Shopzoni";
		$og_tag->image = base_url()."brand/public/uploads/product/".$product_detail[0]->image[0]->image;	
		
		$data['og_tag'] = $og_tag;
		
		$this->load->view('common/header', $data);
		
		if($product_detail[0]->id==""){
			redirect("/404");
		}
		
		if($this->agent->is_mobile())
		{
			$this->load->view('product_detail_mobile', $data);
		}else{
			$this->load->view('product_detail', $data);
		}
		
		$this->load->view('common/footer');
	}
	
	public function viewcart(){ 
		if($this->session->userdata('user_id')==""){
			$this->load->view('common/header', $data);	
			$data['redirect_url'] = 'login';
			$this->load->view('login', $data);
			$this->load->view('common/footer'); exit;
		}else{	
		$data['seller_cart_record']	=	$this->product_model->getCartRecordSeller();	
		$data['cart_record']	=	$this->product_model->getCartRecord();	
		$this->load->view('common/header', $data);			
		$this->load->view('view-cart', $data);
		$this->load->view('common/footer');
		}
	}
	
	public function removetocart(){
		$cart_id	=	$this->input->post('cart_id');
		$seller_id	=	$this->input->post('seller_id');
		$this->product_model->removetocart();
		echo $cart_id.'####'.$seller_id;
		
		//$data['seller_cart_record']	=	$this->product_model->getCartRecordSellerB2B();	
		//$data['cart_record']	=	$this->product_model->getCartRecord();
		//return $this->load->view('product_cart', $data);
	}
	
	public function google_signin(){
		$res=$this->registration_model->google_registration();
	}
	
	public function login_via_google(){
		session_start();
		//Login For GooglePlus
		$google_client_id 		= '769663773557-f7hdnqr9kkaq5dfr2kitdlm1v3r7e37m.apps.googleusercontent.com';
		$google_client_secret 	= 'uUD02-k51Y-UalVTc2qV-6N0';
		//$google_redirect_url 	= 'http://shopzoni.com/login_via_google'; 
		$google_redirect_url 	= 'http://devendra.net.in/shopzoni/login_via_google'; 
		$google_developer_key 	= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
		
		include_once APPPATH . "libraries/google/src/Google_Client.php";
		include_once APPPATH . "libraries/google/src/contrib/Google_Oauth2Service.php";
		
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to The Shopzoni');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);

		$google_oauthV2 = new Google_Oauth2Service($gClient);
		//If user wish to log out, we just unset Session variable
		//if ($_SESSION['reset']==0)	

		if ($_SESSION['reset']==0)
		{
		  unset($_SESSION['token']);
		  $_SESSION['reset']=1;
		  $gClient->revokeToken();
		  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
		}

		if (isset($_GET['code'])){ 
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}

		if (isset($_SESSION['token'])){ 
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()){
			//For logged in user, get details from google using access token
			$user = $google_oauthV2->userinfo->get();
					
			if(isset($user['id'])){
				$user['login_via']='google';			
				//$this->process($user);
				$google_id 	= $user['id'];
				$email 		= $user['email'];
				$name  		= $user['name'];
				$gender  	= $user['gender'];
				$data_arr 	= array(
						//"google_id"	=> $google_id,
						"email" => $email,
						//"gender" => $gender,
						"name"  => $name,
						"date_created" => date("Y-m-d H:i:s"),
						"status" => 1,
						//"registered_via" => "google",
						"password"  => md5(time())
					);
				$cus_data = $this->registration_model->insertGooglePlusCustomerData($data_arr,$google_id,$email,$name);
			}
			
			//redirect("/dologin/google");
			
			
			if(base_url().'login'==$_SESSION['uri1']){
				redirect(base_url(), 'refresh');
			}else if(base_url().'dologin'==$_SESSION['uri1']){
				redirect(base_url(), 'refresh');
			}else if('activate_buyer'==$_SESSION['uri1']){
				redirect(base_url(), 'refresh');
			}else if($_SESSION['uri1']=="shop"){
				 redirect($_SESSION['google_login_url'], 'refresh');
			}else{
				redirect($this->agent->referrer(), 'refresh');
			}
			
			
			/*echo 	'<script>
							window.location.href=\''.$this->session->userdata('current_url').'\'
					</script>'; */
					
		}else{//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
			header('Location:'.$authUrl.'');
		}//Login For GooglePlus End Here
		
	}
	
	
	public function brand($page_no='')
	{
		$seller_record = $this->seller_registration_model->GetRecordsBySeller();
		$data['seller_record'] = $seller_record;
		if($seller_record[0]->id!='')
		$_SESSION['seller_id'] = $seller_record[0]->id;
		
		$brand_ids = $this->input->post('brand');
		if($page_no==""){
		$_SESSION['brand_ids'] = $brand_ids;
		$data['brand_ids'] = $_SESSION['brand_ids'];
		}else{
		$data['brand_ids'] = $_SESSION['brand_ids'];
		}
				 
		$brand_record	=	$this->brand_model->GetSellerBrand($_SESSION['seller_id']);
		$data['brand_record'] = $brand_record;		
		
		$section_record = $this->section_model->GetRecords($_SESSION['seller_id']);
		$data['section_record'] = $section_record;
		
		$category_record = $this->category_model->getCategory();
		$data['category_record'] = $category_record;
		
		$subcategory_record = $this->category_model->getSubCategory();
		$data['subcategory_record'] = $subcategory_record;
		
		
		$per_page=50;
		$product_record = $this->product_model->GetTotalRecords($_SESSION['seller_id'],$section_id,$category_ids,$_SESSION['brand_ids']);
		$total_record	= 	count($product_record);	
		$config['base_url'] = site_url().'brands';
		$config['total_rows'] = $total_record;
		$config['per_page'] = $per_page;
		$config["uri_segment"] = 2;
		
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		
		if($page_no=='')
			$limit=0;
		else
			$limit=$config["per_page"]*($page_no-1);
			
		$offset = ($limit) ? $limit : 0;
		
		//$array_records = $this->product_model->GetRecords($offset,$per_page); 
		$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,$_SESSION['brand_ids'],'',$offset,$per_page);
		$data['product_record'] = $product_record;	
			
		//$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,$brand_ids);
		$data['product_record'] = $product_record;
		
		$this->load->view('common/header', $data);	
		$data['cart_record']	=	$this->product_model->getCartRecord();
		if($this->agent->is_mobile())
		{
			$this->load->view('shop_mobile', $data);
		}else{
			$this->load->view('shop', $data);
		}
		$data['vendor'] = $_SESSION['vendor'];
		$this->load->view('common/footer');
	}
	
	
	public function product()
	{
		$seller_record = $this->seller_registration_model->GetRecordsBySeller();
		$data['seller_record'] = $seller_record;
		if($seller_record[0]->id!='')
		$_SESSION['seller_id'] = $seller_record[0]->id;
		
		$product = trim($this->input->post('product')); 
		$data['product']=$product;
		
		$brand_record	=	$this->brand_model->GetSellerBrand($_SESSION['seller_id']);
		$data['brand_record'] = $brand_record;
		
		$section_record = $this->section_model->GetRecords($_SESSION['seller_id']);
		$data['section_record'] = $section_record;
		
		$category_record = $this->category_model->getCategory();
		$data['category_record'] = $category_record;
		
		$subcategory_record = $this->category_model->getSubCategory();
		$data['subcategory_record'] = $subcategory_record;
			
		$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,'',$product);
		$data['product_record'] = $product_record;
		
		$this->load->view('common/header', $data);	
			$data['cart_record']	=	$this->product_model->getCartRecord();	
			$this->load->view('shop', $data);
		$data['vendor'] = $_SESSION['vendor'];
		$this->load->view('common/footer');
	}

	
	
	public function login()
	{
		
		//****************** facebook*****************************
		$data['user_profile'] = array();
		$data['login_url'] = $this->fb->createLoginLink(); 
		$user_profile = $this->fb->initialize();		
		//print_r($user_profile); 
		if($user_profile){
			$res=$this->registration_model->facebook_registration($user_profile); 			
			$this->load->helper('url');
			redirect("/");
		}
		//******************** End *************************************
		
		/*
		$this->load->view('common/header', $data);			
		$this->load->view('login', $data);
		$this->load->view('common/footer');
		$data['user_profile'] = array();
		$data['login_url'] = $this->fb->createLoginLink(); 
		$user_profile = $this->fb->initialize();		
		
		if($user_profile){
			$res=$this->registration_model->facebook_registration($user_profile); 			
			$this->load->helper('url');
			redirect("/home");
		} */
		
		$this->load->view('common/header', $data);			
		$this->load->view('login', $data);
		$this->load->view('common/footer');
		
	}
	
	
	
	public function dologin($param)
	{			
		$chk_login	=	$this->registration_model->check_login();		
		$this->load->view('common/header', $data);		
		if($chk_login==1){			
			$section_record = $this->section_model->GetHomeRecords();		
			foreach($section_record as $section){
				$section_records[] =	$this->product_model->GetRecords($seller_id='',$section->id,$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
			}
			$data['section_records'] = $section_records;
			
			//$data['section1_products'] = $this->product_model->GetRecords($seller_id='',$section_id='13',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
			//$data['section2_products'] = $this->product_model->GetRecords($seller_id='',$section_id='4',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10);
			$banner_image = $this->slider_image_model->GetRecords();
			$data['banner_image'] = $banner_image;
			//if($_SESSION['uri1']!=""){
			//redirect("/".$_SESSION['uri1']);	
			//}else{
			//$this->load->view('index', $data);
			//}
			//$this->load->view('index', $data);
			
			$reffrer_array = explode('/',$this->agent->referrer());
						
			$previous_url = $this->input->post('previous_url');
			
			//echo $this->agent->referrer(); exit;
			if(base_url().'login'==$this->agent->referrer()){
				redirect(base_url(), 'refresh');
			}else if(base_url().'dologin' == $this->agent->referrer()){
				redirect(base_url(), 'refresh');
			}else if(base_url().'register' == $this->agent->referrer()){
				redirect(base_url(), 'refresh');
			}else if('activate_buyer' == $reffrer_array[3]){
				redirect(base_url(), 'refresh');
			}else{
				redirect($this->agent->referrer(), 'refresh');
			}
		}else{
			$data['error_msg']	=	'Invalid Login details..!';
			$this->load->view('login', $data);
		}
		
		$this->load->view('common/footer');
	}
	
	public function signup()
	{
		$this->load->view('common/header', $data);			
		$this->load->view('login', $data);
		$this->load->view('common/footer');
	}
	
	public function register()
	{
		$data = array(
					'name' => '',
					'address' => '',
					'pincode' => '',
					'email' => '',
					'password' => '',
					'cpassword' => '',
					'mobile' => '',
					);
		$this->session->set_userdata($data); 
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean|max_length[110]');		
		//$this->form_validation->set_rules('pincode', 'pincode', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('pincode', 'pincode', 'required|xss_clean|min_length[6]|max_length[6]');		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean');
		
		
		if($this->form_validation->run() == FALSE){			
			$data = array(
							'name' => form_error('name'),
							'address' => form_error('address'),
							'pincode' => form_error('pincode'),
							'email' => form_error('email'),
							'password' => form_error('password'),
							'cpassword' => form_error('cpassword'),
							'mobile' => form_error('mobile'),
							);
			$this->session->set_userdata($data);  
			$data = array(
				'name'			=>	$this->input->post('name'),
				'business_name'	=>	$this->input->post('business_name'),
				'address'		=>	$this->input->post('address'),
				'pincode'		=>	$this->input->post('pincode'),
				'email'			=>	$this->input->post('email'),
				'password'		=>	$this->input->post('password'),
				'cpassword'		=>	$this->input->post('cpassword'),
				'mobile'		=>	$this->input->post('mobile'),
				);
			$this->load->view('common/header', $data);	
			$this->load->view('login', $data);
		}
		else{
			$this->load->view('common/header', $data);		
			$inserted_id	=	$this->registration_model->save_user_data();
			if($inserted_id){
				$this->send_email_verification_link($inserted_id);
				$data['success_msg_signup']	=	'Your account has been created. To move on to the next step, log in to your account and click on the verification link sent to your e-mail.!';
				$this->load->view('login', $data);
			}else{
				$data = array(
					'name'			=>	$this->input->post('name'),
					'business_name'	=>	$this->input->post('business_name'),
					'address'		=>	$this->input->post('address'),
					'pincode'		=>	$this->input->post('pincode'),
					'email'			=>	$this->input->post('email'),
					'password'		=>	$this->input->post('password'),
					'cpassword'		=>	$this->input->post('cpassword'),
					'mobile'		=>	$this->input->post('mobile'),
					);
				$this->load->view('login', $data);
			}				
		}
		$this->load->view('common/footer');
	}
	
	public function email_availability($email)
	{
		echo $res = $this->registration_model->checkEmailAvailability($_REQUEST['email']);
	}
	
	public function addtocart(){		
		$product_id	=	$this->input->post('product_id');
		$packet_map_id	=	$this->input->post('packet_map_id');
		$quantity	=	$this->input->post('quantity'); 
		$seller_id	=	$this->input->post('seller_id'); 
				
		$product_record = $this->product_model->getProductRecordByIdNew($product_id,$seller_id);
		$packet_record = $this->product_model->getPacketRecordByMapIdNew($packet_map_id,$seller_id);
		$qty_data = $this->product_model->getPacketQuantityCart($packet_map_id,$seller_id);
		//print_r($packet_record);
		//print_r($product_record);
		//print_r($qty_data);
		
		$qty = $qty_data->quantity;
		$quantity = $quantity+$qty;		
		
		if($packet_map_id!=""){
			if($quantity>=1){				
				if($packet_record->quantity_option==1){
					if($packet_record->quantity >= $quantity){				
						$this->product_model->addtocart();	
						$data['cart_record']	=	$this->product_model->getCartRecord();	
						return $this->load->view('cart', $data);
					}
				}else{				
					$this->product_model->addtocart();	
					$data['cart_record']	=	$this->product_model->getCartRecord();	
					return $this->load->view('cart', $data);
				}
			}
		}else if($product_id!=""){		
			if($quantity>=1){				
				if($product_record->quantity_option==1){
					if($product_record->quantity >= $quantity){
						$this->product_model->addtocart();	
						$data['cart_record']	=	$this->product_model->getCartRecord();	
						return $this->load->view('cart', $data);
					}
				}else{				
					$this->product_model->addtocart();	
					$data['cart_record']	=	$this->product_model->getCartRecord();	
					return $this->load->view('cart', $data);
				}
			}
		}
	}
	
	public function check_quantity()
	{
		$product_id	=	$this->input->post('product_id');
		$quantity	=	$this->input->post('quantity');
		$product_record = $this->product_model->getProductRecordById($product_id);
		//print_r($product_record);
		if($product_record->quantity_option==1){
			if($product_record->quantity < $quantity){
				echo $product_record->product_map_id."###".' Avl. Qty. only '.$product_record->quantity; 
			}else{
				$val=1;
				echo $product_record->product_map_id."###".$val;
			}
		}
	}
	
	
	public function check_packet_quantity()
	{
		$product_id	=	$this->input->post('product_id');
		$packet_map_id	=	$this->input->post('packet_map_id');
		$quantity	=	$this->input->post('quantity');
		$product_record = $this->product_model->getProductRecordById($product_id);
		$packet_record = $this->product_model->getPacketRecordByMapId($packet_map_id);
		//print_r($product_record);
		if($packet_record->quantity_option==1){
			if($packet_record->quantity < $quantity){
				echo $product_record->product_map_id."###".' Avl. Qty. only '.$packet_record->quantity; 
			}else{
				$val=1;
				echo $product_record->product_map_id."###".$val;
			}
		}
	}
	
	
	public function check_quantity_new()
	{
		$product_id	=	$this->input->post('product_id');
		$quantity	=	$this->input->post('quantity');
		$seller_id	=	$this->input->post('seller_id');
		$product_record = $this->product_model->getProductRecordByIdNew($product_id,$seller_id);
		$qty_data = $this->product_model->getProductQuantityCart($product_id,$seller_id);
		$qty = $qty_data->quantity;
		$quantity = $quantity+$qty;
		//print_r($product_record);
		if($product_record->quantity_option==1){
			if($product_record->quantity < $quantity){
				echo $product_record->seller_id."###".' Avl. Qty. only '.$product_record->quantity; 
			}else{
				$val=1;
				echo $product_record->seller_id."###".$val;
			}
		}
	}
	
	
	public function check_packet_quantity_new()
	{
		$quantity	=	$this->input->post('quantity');
		$product_id	=	$this->input->post('product_id');
		$seller_id	=	$this->input->post('seller_id');
		$packet_map_id	=	$this->input->post('packet_map_id');
		
		$product_record = $this->product_model->getProductRecordByIdNew($product_id,$seller_id);
		$packet_record = $this->product_model->getPacketRecordByMapIdNew($packet_map_id,$seller_id);
		$qty_data = $this->product_model->getPacketQuantityCart($packet_map_id,$seller_id);
		//print_r($packet_record);
		//print_r($product_record);
		//print_r($qty_data);
		
		$qty = $qty_data->quantity;
		$quantity = $quantity+$qty;
		if($packet_record->quantity_option==1){
			if($packet_record->quantity < $quantity){
				echo $packet_record->seller_id."###".' Avl. Qty. only '.$packet_record->quantity; 
			}else{
				$val=1;
				echo $packet_record->seller_id."###".$val;
			}
		}
	}
	
	
	public function forgot_password()
	{
		$email = $this->input->post('email');
		$res = $this->registration_model->getUserRecordByEmail($email);
		$data['email_id'] = $res->email;
		$data['id'] = $res->id;
		$data['password'] = $res->password;
		$data['success_msg']	=	'Log in to your mail account and click on the reset password link sent to your e-mail.!';
		$this->load->view('forgot_mail', $data);
		//redirect(base_url().'login');
		$this->load->view('common/header', $data);	
		$this->load->view('login', $data);
		$this->load->view('common/footer');
	}
	
	public function reset_password($user_id)
	{
		$this->load->view('common/header', $data);	
		$user_id = base64_decode($user_id);
		$data['user_id'] = $user_id;			
		$this->load->view('reset_password', $data);	
		$this->load->view('common/footer');
	}
	
	public function change_password()
	{
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean');		
		
		
		if($this->form_validation->run() == FALSE){			
			$data = array(							
							'user_id' => form_error('user_id'),
							'password' => form_error('password'),
							'cpassword' => form_error('cpassword'),							
							);
			$this->session->set_userdata($data);  
			redirect('/reset_password');
		}
		else{
			$this->load->view('common/header', $data);		
			$this->registration_model->change_password();			
			$data['success_msg']	=	'Your Password has been changed sucessfully.!';
			$this->load->view('login', $data);			
			$this->load->view('common/footer');
		}
	}
	
	
	public function myaccount()
	{	
		?>
			<script>				
				window.opener.location.reload(true);
				window.close();
			</script>
			<?php
		if($this->session->userdata('user_id')!=0)
		$_SESSION['buyer_id'] = $this->session->userdata('user_id');
		$this->load->view('common/header', $data);	
		$data['row']	=	$this->registration_model->getBuyerRecordById($_SESSION['buyer_id']);
		$this->load->view('myaccount', $data);
		$this->load->view('common/footer');
	}
	
	public function updateprofile()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');		
		//$this->form_validation->set_rules('pincode', 'pincode', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('pincode', 'pincode', 'required|xss_clean|min_length[6]|max_length[6]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|numeric|max_length[12]');
		
		
		if($this->form_validation->run() == FALSE){
						$data = array(
							'name' => form_error('name'),
							'address' => form_error('address'),
							'pincode' => form_error('pincode'),
							'email' => form_error('email'),
							'password' => form_error('password'),
							'cpassword' => form_error('cpassword'),
							'mobile' => form_error('mobile'),
							);
			//$this->session->set_userdata($data);  
			redirect('/myaccount');
		}
		else{
			$this->load->view('common/header', $data);		
			$id	=	$this->registration_model->update_user_data();
			if($id){
				$data['success_msg']	=	'Updated Successful..!';
				$data['row']	=	$this->registration_model->getBuyerRecordById($id);
				$this->load->view('myaccount', $data);
			}else{				
				$data['row']	=	$this->registration_model->getBuyerRecordById($this->session->userdata('user_id'));
				$this->load->view('myaccount', $data);
			}		
			$this->load->view('common/footer');
		}
	}
	
	
	public function buyer_request($vendor_code){
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header', $data);
			$data['vendor_code'] = $vendor_code;
			$this->load->view('buyer_request', $data);
			$this->load->view('common/footer');
		}else{
			redirect('/login');
		}
	}
	
	public function send_request(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('seller_code', 'Seller Code', 'trim|required|xss_clean');	

		if($this->form_validation->run() == FALSE){
			$this->load->view('common/header', $data);	
			$this->load->view('buyer_request', $data);
			$this->load->view('common/footer');		
		}else if($this->session->userdata('user_id')=="" || $this->session->userdata('user_id')==0){
			redirect(base_url().'login');
		}else{
			$this->load->view('common/header', $data);
			$seller_code	=	$this->input->post('seller_code');
			$seller_data	=	$this->registration_model->GetRecordsBySellerCode($seller_code);
			$seller_id		=	$seller_data[0]->id;
			if($seller_id!=""){
				$buyer_id		=	$this->session->userdata('user_id');		
				$buyer_req_data	=	$this->registration_model->getBuyerRequestByBuyerIdAndSellerId($buyer_id,$seller_id);				
				if($buyer_req_data->id==""){
					$save	=	$this->registration_model->save_send_request_data($seller_id);
					if($save){
					$data['success_msg']	=	'Request Sent Successfully..!';				
					}
				}else if($buyer_req_data->request_status==0){	
					$data['reg_error_msg']	=	'Request Already Sent..!';					
				}else if($buyer_req_data->request_status==1){	
					$data['reg_error_msg']	=	'Vendor is Already in Your vendor List..!';
				}
			}else{
				$data['reg_error_msg']	=	'Invalid Seller Code..!';
			}
			
			$this->load->view('buyer_request', $data);		
			$this->load->view('common/footer');
		}
	}
	
	
	public function send_email_verification_link($id){
		$buyer_record  =  $this->registration_model->getBuyerRecordById($id);
		$data['email_id'] = $buyer_record->email;
		$data['insertid'] = $id;
		$data['buyer_record'] = $buyer_record;
		$this->load->view('activate_buyer_mail_template', $data);
		/*$this->load->view('common/header', $data);
		$this->load->view('mail_confirmation', $data);
		$this->load->view('common/footer'); */
	}
	
	
	public function activate_buyer($id){
		$id = $this->uri->segment(2,0); 
		$id = base64_decode($id);
		$this->registration_model->activateAccount($id); 		
		//redirect('/login');
		
		//****************** facebook*****************************
		/*$data['user_profile'] = array();
		$data['login_url'] = $this->fb->createLoginLink(); 
		$user_profile = $this->fb->initialize(); 	
		
		if($user_profile){
			$res=$this->registration_model->facebook_registration($user_profile); 			
			$this->load->helper('url');
			redirect("/home");
		}
		
		
		//******************** End *************************************
		
		
		$this->load->view('common/header', $data);			
		$this->load->view('login', $data);
		$this->load->view('common/footer');//****************** facebook*****************************
		$data['user_profile'] = array();
		$data['login_url'] = $this->fb->createLoginLink(); 
		$user_profile = $this->fb->initialize();		
		
		if($user_profile){
			$res=$this->registration_model->facebook_registration($user_profile); 			
			$this->load->helper('url');
			redirect("/home");
		} */	
		
		
		//******************** End *************************************
		
		
		$this->load->view('common/header', $data);	
		
		$this->load->view('login', $data);
		$this->load->view('common/footer');
		
		
		/*$buyer_record  =  $this->registration_model->getBuyerRecordById($id);
		$data['seller_record'] = $buyer_record;
		$this->load->view('common/seller_header', $data);
		$this->load->view('registration_step3', $data);
		$this->load->view('common/footer');	 */
	}
	
	
	public function checkout(){		
		$product_id	=	$this->input->post('product_id'); 
		$quantity	=	$this->input->post('quantity'); 
		if($quantity>=1){
			$product_record = $this->product_model->getProductRecordById($product_id); 			
			if($product_record->quantity_option==1){
				if($product_record->quantity >= $quantity){
					$this->product_model->addtocart();	
					$cart_record	=	$this->product_model->getCartRecord(); 
					$data['cart_record']	=   $cart_record;
					//return $this->load->view('cart', $data);
				}
			}else{				
				$this->product_model->addtocart();	
				$cart_record	=	$this->product_model->getCartRecord(); 
				$data['cart_record']	=   $cart_record;
				//return $this->load->view('cart', $data);
			}
		}
		
		
		$user_details = $this->registration_model->getBuyerMindatoryFields();
	
		if($user_details->name !="" && $user_details->address !="" && $user_details->pincode !="" && $user_details->email !="" && $user_details->mobile !="")
		{
			$seller_id	=	$this->input->post('seller_id');
			foreach($cart_record[$seller_id] as $product){
				$cart_ids[]	=	$product->cart_id; 
			}
			$type	=	$this->input->post('type');
			
			$data['seller_id']	=	$seller_id;
			$data['delivery_location']	=	$this->product_model->GetDeliveryLocation($seller_id);
			$data['time_slot']	=	$this->product_model->GetTimeSlote($seller_id);
			$data['seller_cart_record']	=	$this->product_model->getCartRecordSeller();				
			$data['cart_record']	=	$this->product_model->getCartRecord();	
			$data['user_record']	=	$this->registration_model->getBuyerRecordById($this->session->userdata('user_id'));	
			$data['holiday']		=	$this->holiday_model->GetRecordBySellerId($seller_id);
			
			
			$this->load->view('common/header', $data);			
			$this->load->view('cart', $data);
			$this->load->view('common/footer');
			
		}else{
			redirect("/myaccount");
		}
		
	}
	
	
	public function place_order(){				
		$user_details = $this->registration_model->getBuyerMindatoryFields();
		if($user_details->name !="" && $user_details->address !="" && $user_details->pincode !="" && $user_details->email !="" && $user_details->mobile !="")
		{
			//$cart_ids	=	$this->input->post('cart_ids');	
			$buyer_id		=	$this->session->userdata('user_id');
			$seller_id	=	$this->input->post('seller_id');  
			$cart_deta = $this->product_model->getCartRecordSellerBuyer($seller_id,$buyer_id);	
		
			foreach($cart_deta as $crtkey=>$crt_record){
				$cart_ids[] = $crt_record->id;
			}
			
			$type	=	$this->input->post('type'); 
			if($type==0){
				if($cart_ids!=""){
					
					foreach($cart_ids as $cart_id){
						$this->product_model->update_product_order($cart_id);
					}
					
					$result = $this->product_model->place_order();	
					$res = explode("###",$result);	
					$order_details = $this->seller_registration_model->GetRecordsByOrderId($res[0]);
					$data['order_details'] = $order_details;
					if($res[1]==0 && $res[0] !=""){
						//SMS Gateway Integration Sucessful.
						$data['sucess_msg'] = "Order placed Successfully..!".'<br>'.'your order id:- '.$res[0];						
						$data['error_msg'] = '<br>'."Below products have insufficient quantity. ";
						
						$data['seller_info'] ='<br><br>'.' For further details or information please contact Seller';
						$data['seller_info'] .='<br>'.$order_details[0]->seller_business_name;
						$data['seller_info'] .='<br>'.$order_details[0]->seller_business_address;
						$data['seller_info'] .='<br> Contact No. '.$order_details[0]->mobile_number;
						
						$this->load->view('placed_order_mail_template', $data);
					}else if($res[1]==0){
						$data['error_msg'] = "Below products have insufficient quantity.!";
						$data['seller_info'] ='<br><br>'.' For further details or information please contact Seller';
						$data['seller_info'] .='<br>'.$order_details[0]->seller_business_name;
						$data['seller_info'] .='<br>'.$order_details[0]->seller_business_address;
						$data['seller_info'] .='<br> Contact No. '.$order_details[0]->mobile_number;
					}else{
						$data['sucess_msg'] = "Order placed Successfully..!".'<br>'.'your order id:- '.$res[0];
						$data['seller_info'] ='<br><br>'.' For further details or information please contact Seller';
						$data['seller_info'] .='<br>'.$order_details[0]->seller_business_name;
						$data['seller_info'] .='<br>'.$order_details[0]->seller_business_address;
						$data['seller_info'] .='<br> Contact No. '.$order_details[0]->mobile_number;
						$this->load->view('placed_order_mail_template', $data);
					}
				}				
				$data['seller_cart_record']	=	$this->product_model->getCartRecordSeller();	
				$data['cart_record']	=	$this->product_model->getCartRecord();	
				$this->load->view('common/header', $data);			
				$this->load->view('view-cart', $data);
				$this->load->view('common/footer');
			}else if($type==1){
				$seller_id	=	$this->input->post('seller_id');
				$data['seller_id']	=	$seller_id;
				$data['delivery_location']	=	$this->product_model->GetDeliveryLocation($seller_id);
				$data['time_slot']	=	$this->product_model->GetTimeSlote($seller_id);
				$data['seller_cart_record']	=	$this->product_model->getCartRecordSeller();				
				$data['cart_record']	=	$this->product_model->getCartRecord();	
				$data['user_record']	=	$this->registration_model->getBuyerRecordById($this->session->userdata('user_id'));	
				$data['holiday']		=	$this->holiday_model->GetRecordBySellerId($seller_id);
				
				$this->load->view('common/header', $data);			
				$this->load->view('cart', $data);
				$this->load->view('common/footer');
			}
		}else{
			redirect("/myaccount");
		}
	}
	
	
	public function timeslotDropdown($delivery_location_id,$seller_id,$delivery_date){
		$delivery_location_id = $this->uri->segment(2,0);
		$seller_id = $this->uri->segment(3,0);
		$delivery_date = $this->uri->segment(4,0);
		
		$data['time_slot'] = $this->product_model->GetTimeSloteByOrderEndingTime($seller_id,$delivery_location_id,$delivery_date);
			$data['delivery_date'] = $delivery_date;
			$this->load->view('timeslotDropdown', $data);	
	}
	
	public function shipping($delivery_location_id,$seller_id){
		if($data['delivery_location'] = $this->product_model->GetDeliveryLocationByID($delivery_location_id,$seller_id))
			$this->load->view('shipping_charge', $data);	
	}
	
	public function check_maximum_order($time_slot_id,$delivery_date){
		$data['time_slot_record'] = $this->product_model->GetTimeSloteById($time_slot_id);		
		if($data['total_delivery_date_wise_order'] = $this->product_model->GetTimeSlotAndDeliveryDateWiseOrderCounter($time_slot_id,$delivery_date))
			$this->load->view('check_maximum_order', $data);	
	}
	
	
	public function b2c_place_order(){
		$delivery_type	=	$this->input->post('delivery_type');  
		$is_different	=	$this->input->post('is_different');  		
		$this->load->library('form_validation');	
		
		if($delivery_type==""){			
			$this->form_validation->set_rules('delivery_location_id', 'Delivery Location', 'trim|required|xss_clean');
			$this->form_validation->set_rules('time_slot_id', 'Time Slot', 'trim|required|xss_clean');
			$this->form_validation->set_rules('delivery_date', 'Delivery Date', 'trim|required|xss_clean');
		}
		
		$this->form_validation->set_rules('billing_name', 'name', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('billing_mobile', 'mobile', 'trim|required|numeric|xss_clean');	
		$this->form_validation->set_rules('billing_email', 'Email', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('billing_address', 'address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('billing_pincode', 'pincode', 'trim|required|numeric|min_length[6]|max_length[6]|xss_clean');
		
		
		if($is_different=="yes"){
			$this->form_validation->set_rules('delivery_name', 'name', 'trim|required|xss_clean');	
			$this->form_validation->set_rules('delivery_mobile', 'mobile', 'trim|required|numeric|xss_clean');	
			$this->form_validation->set_rules('delivery_email', 'Email', 'required|valid_email|xss_clean');
			$this->form_validation->set_rules('delivery_address', 'address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('delivery_pincode', 'pincode', 'trim|required|numeric|min_length[6]|max_length[6]|xss_clean');
		}

		if($this->form_validation->run() == FALSE){
			$seller_id	=	$this->input->post('seller_id');
			$data['seller_id']				=	$seller_id;
			$data['delivery_location']		=	$this->product_model->GetDeliveryLocation($seller_id);
			$data['holiday']				=	$this->holiday_model->GetRecordBySellerId($seller_id);
			$data['time_slot']				=	$this->product_model->GetTimeSlote($seller_id);
			$data['seller_cart_record']		=	$this->product_model->getCartRecordSeller();	
			$data['cart_record']			=	$this->product_model->getCartRecord();	
			$data['user_record']			=	$this->registration_model->getBuyerRecordById($this->session->userdata('user_id'));	
			
			$data['delivery_type']			=	$this->input->post('delivery_type'); 
			$data['delivery_location_id']	=	$this->input->post('delivery_location_id'); 
			$data['time_slot_id']			=	$this->input->post('time_slot_id'); 
			
			$data['is_different']			=	$this->input->post('is_different');
			
			$data['billing_name']			=	$this->input->post('billing_name'); 
			$data['billing_mobile']			=	$this->input->post('billing_mobile'); 
			$data['billing_email']			=	$this->input->post('billing_email'); 
			$data['billing_address']		=	$this->input->post('billing_address'); 
			$data['billing_pincode']		=	$this->input->post('billing_pincode'); 
			
			$data['delivery_name']			=	$this->input->post('delivery_name'); 
			$data['delivery_mobile']		=	$this->input->post('delivery_mobile'); 
			$data['delivery_email']			=	$this->input->post('delivery_email'); 
			$data['delivery_address']		=	$this->input->post('delivery_address'); 
			$data['delivery_pincode']		=	$this->input->post('delivery_pincode'); 
			
			$this->load->view('common/header', $data);			
			$this->load->view('cart', $data);
			$this->load->view('common/footer');
		}else{
			$seller_id	=	$this->input->post('seller_id');
			$data['seller_id']	=	$seller_id;
			$user_details = $this->registration_model->getBuyerMindatoryFields();
			if($user_details->name !="" && $user_details->address !="" && $user_details->pincode !="" && $user_details->email !="" && $user_details->mobile !="")
			{
				//$cart_ids	=	$this->input->post('cart_ids');		
				$buyer_id		=	$this->session->userdata('user_id');
				$seller_id	=	$this->input->post('seller_id');  
				$cart_deta = $this->product_model->getCartRecordSellerBuyer($seller_id,$buyer_id);	
			
				foreach($cart_deta as $crtkey=>$crt_record){
					$cart_ids[] = $crt_record->id;
				}
				
				
				if($cart_ids!=""){
					
					foreach($cart_ids as $cart_id){
						$this->product_model->update_product_order($cart_id);
					}
					
					$result = $this->product_model->b2c_place_order();	
					$res = explode("###",$result);
					$order_details = $this->seller_registration_model->GetRecordsByOrderId($res[0]);
					$data['order_details'] = $order_details;
					
					if($res[1]==0 && $res[0] !=""){
						$data['sucess_msg'] = "Order placed Successfully..!".'<br>'.'your order id:- '.$res[0];
						$data['error_msg'] = '<br>'."Below products have insufficient quantity Contact Seller.!";						
						$this->load->view('placed_order_mail_template', $data);
					}else if($res[1]==0){
						$data['error_msg'] = "Below products have insufficient quantity Contact Seller.!";								
					}else if($res[2]!=""){
						$data['error_msg'] = $res[2];
					}else{
						$data['sucess_msg'] = "Order placed Successfully..!".'<br>'.'your order id:- '.$res[0];
						$this->load->view('placed_order_mail_template', $data);
					}
				}
				
				//$data['seller_cart_record']	=	$this->product_model->getCartRecordSellerB2C();	
				//$data['cart_record']	=	$this->product_model->getCartRecord();	
				$data['seller_cart_record']	=	$this->product_model->getCartRecordSeller();	
				$data['cart_record']	=	$this->product_model->getCartRecord();	
				
				$this->load->view('common/header', $data);			
				$this->load->view('view-cart', $data);
				$this->load->view('common/footer');
			}else{
				redirect("/myaccount");
			}
		}
	}
	
	
	
	public function vendor_list(){
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header', $data);	
			$data['vendor_record']	=	$this->seller_registration_model->vendor_list();
			$data['order_vendor_record']	=	$this->seller_registration_model->vendor_listByOrder();
			
			$this->load->view('vendor_list', $data);
			$this->load->view('common/footer');
		}else{
			redirect('/login');
		}
	}
	
	
	public function order_list(){
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header', $data);	
			$data['order_record']	=	$this->seller_registration_model->order_list();
			$this->load->view('order_list', $data);
			$this->load->view('common/footer');
		}else{
			redirect('/login');
		}
	}
	
	public function wish_list(){		
		$this->load->view('common/header', $data);	
		$data['wish_list_record']	=	$this->product_model->getWishList();
		$this->load->view('wish_list', $data);
		$this->load->view('common/footer');
	}
	
	public function deletewishlist($id){		
		$this->product_model->deletewishlist($id);
	}
	
	public function view_order($order_id){	
		$order_id = $uri1 = $this->uri->segment(2); 
		if($this->session->userdata('user_id')!=""){
			$order_record	=	$this->seller_registration_model->GetRecordsByOrderId($order_id);			
			if($order_record[0]->id!=""){
				$this->load->view('common/header', $data);			
				$data['order_record']	=   $order_record;
				$this->load->view('view_order_list', $data);
				$this->load->view('common/footer');
			}else{
				redirect('/order_list');
			}
		}else{
			redirect('/login');
		}
	}
	
	/*public function buyer_approval()
	{		
		$data["approval_error_msg"] = "Send the request to Vendor to authorise you.";
		$this->load->view('common/header', $data);		
		if($this->session->userdata('user_id')==""){
			redirect(base_url().'login');
		}else{			
			$this->load->view('index', $data);
		}		
		$this->load->view('common/footer');
	} */
	
	
	public function validateVendorCode($vendor){	
		$seller = $this->seller_registration_model->GetRecordsBySellerCode($vendor);		
		if(!isset($seller) || $seller[0]->id==""){			
			return 0;
		}else{
			return 1;
		}
	}
	
	
	public function updateCartCounter()
	{
		//echo $cart_record_count = $this->product_model->GetTotalCartRecordByBuyer();
		$cart_record = $this->product_model->getCartRecord();
		$qty = 0;
		foreach($cart_record as $key=>$cart_data){
			foreach($cart_data as $key=>$cart_item){
				$qty = $qty+$cart_item->quantity;
			}
		}
		echo $qty; 
	}
	
	public function product_inner($product_id){
		$this->load->view('common/header', $data);	
		$record = $this->product_model->getRecordById($product_id);
		$data['record'] = $record;
		$this->load->view('product_inner', $data);
	}
	
	public function terms_conditions(){
		$this->load->view('common/header', $data);	
		$seller_record = $this->seller_registration_model->GetRecordsBySeller();
		$data['seller_record'] = $seller_record;
		$array_records = $this->terms_conditions_model->GetRecordBySellerId();
		$data['record'] = $array_records; 
		$this->load->view('terms_conditions', $data);
		$this->load->view('common/footer');
	}
	
	public function termsconditions(){
		$this->load->view('common/header', $data);	
		$seller_record = $this->seller_registration_model->GetRecordsBySeller();
		$data['seller_record'] = $seller_record;
		$array_records = $this->terms_conditions_model->GetRecordBySellerId();
		$data['record'] = $array_records; 
		$this->load->view('buyer_terms_conditions', $data);
		$this->load->view('common/footer');
	}
	
	
	public function privacy_policy(){
		$this->load->view('common/header', $data);			
		$this->load->view('privacy_policy', $data);
		$this->load->view('common/footer');
	}
	
	public function return_policy(){
		$this->load->view('common/header', $data);			
		$this->load->view('return_policy', $data);
		$this->load->view('common/footer');
	}
	
	public function sitemap()
	{		
		$this->load->view('sitemap', $data);
	}
	
	public function seller_details($seller_code){
		$seller_code = $this->uri->segment(2);
		$this->load->view('common/header', $data);	
		$seller_record = $this->seller_registration_model->GetRecordsBySellerCode($seller_code);
		$data['seller_record'] = $seller_record;
		$array_records = $this->terms_conditions_model->GetRecordBySellerId1($seller_record[0]->id);
		$data['record'] = $array_records;
		$this->load->view('seller_details', $data);
		$this->load->view('common/footer');
	}
	
	public function brand_search($param)
	{		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		
		//serach query ends//		
		
		$department_ids = $this->input->post('department');
		
		if(is_array($department_ids)){
			$brand_record	=	$this->brand_model->GetRecordsByDepartment($department_ids);
			$data['brand_record'] = $brand_record;
			$data['department_ids'] = $department_ids;
			$department_record	=	$this->department_model->GetRecords();
			$data['department_record'] = $department_record;
			
			$this->load->view('common/header', $data);			
			$this->load->view('brand_search', $data);
			$this->load->view('common/footer');
		}else{
			$brand_record	=	$this->brand_model->GetRecordsControl($param);
			$data['brand_record'] = $brand_record;
			$data['department_ids'] = $department_ids;
			$department_record	=	$this->department_model->GetRecords();
			$data['department_record'] = $department_record;
			
			$this->load->view('common/header', $data);			
			$this->load->view('brand_search', $data);
			$this->load->view('common/footer');
		}
		
	}

	public function brand_details($param)
	{			
		$param = $this->uri->segment(2);
		$brand_data = $this->brand_model->GetRecordBySlug($param);
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$search['state'] 		= $this->input->post('state');
		$search['city'] 		= $this->input->post('city');
		$search['pincode'] 		= $this->input->post('pincode');
		$data['search'] = $search;
		//serach query ends//
		$slider_image_record	=	$this->brand_model->GetSliderImage($brand_data->id);
		$data['slider_image_record'] = $slider_image_record;
		
		$brand_record	=	$this->brand_model->GetRecordById($brand_data->id);
		$data['brand_record'] = $brand_record;
		
		$product_record	=	$this->product_model->GetBradWiseProduct($brand_data->id,0,8);
		$data['product_record'] = $product_record;
		
		$state_record	=	$this->product_model->GetStateRecord();
		$data['state_record'] = $state_record;
		
		$city_record	=	$this->product_model->GetCityRecord();
		$data['city_record'] = $city_record;
		
		$pincode_record	=	$this->product_model->GetPincodeRecord();
		$data['pincode_record'] = $pincode_record;
		
		
		$data['search_title'] = "Sellers";
		$seller_record	=	$this->product_model->getSellerByBrandID($brand_data->id);
		$data['seller_record'] = $seller_record;

		
		$seo_tag->meta_title = $brand_record->meta_title;
		$seo_tag->meta_description = $brand_record->meta_description;
		$seo_tag->meta_keywords= $brand_record->meta_keywords;
		$seo_tag->seo_canonical = $brand_record->seo_canonical;
		$data['seo_tag'] = $seo_tag;
		
		
		//echo "HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH"; exit;
		$this->load->view('common/header', $data);			
		$this->load->view('brands_detail', $data);
		$this->load->view('common/footer');
	}
	
	public function partner($param)
	{	
		$param = $this->uri->segment(2);
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$search['state'] 		= $this->input->post('state');
		$search['city'] 		= $this->input->post('city');
		$search['pincode'] 		= $this->input->post('pincode');
		$data['search'] = $search;
		//serach query ends//
		
		//$brand_record	=	$this->brand_model->GetRecordById($param);
		$brand_record	=	$this->brand_model->GetRecordBySlug($param);
		$data['brand_record'] = $brand_record;
		
		$product_record	=	$this->product_model->GetBradWiseProduct($brand_record->id);
		$data['product_record'] = $product_record;
		
		$state_record	=	$this->product_model->GetStateRecord();
		$data['state_record'] = $state_record;
		
		$city_record	=	$this->product_model->GetCityRecord();
		$data['city_record'] = $city_record;
		
		$pincode_record	=	$this->product_model->GetPincodeRecord();
		$data['pincode_record'] = $pincode_record;		
		
		$data['search_title'] = "Partners";
		$partner_record	=	$this->product_model->getPartnerByBrandID($brand_record->id);
		$data['partner_record'] = $partner_record;		
		
		$this->load->view('common/header', $data);			
		$this->load->view('partner', $data);
		$this->load->view('common/footer');
	}
	
	public function view_more_brand_record($param)
	{	
		$param = $this->uri->segment(2);
		$brand_record	=	$this->brand_model->GetRecordBySlug($param);
		$data['brand_record'] = $brand_record;
		$product_record	=	$this->product_model->GetBradWiseProduct($brand_record->id);
		
		$data['product_record'] = $product_record;		
		echo $this->load->view('view_more_products', $data);
		
	}
	
	public function view_less_brand_record($param)
	{	
		$param = $this->uri->segment(2);
		$brand_record	=	$this->brand_model->GetRecordBySlug($param);
		$data['brand_record'] = $brand_record;
		$product_record	=	$this->product_model->GetBradWiseProduct($brand_record->id,0,8);
		
		$data['product_record'] = $product_record;		
		echo $this->load->view('view_less_products', $data);		
	}
	
	public function view_slider($param)
	{	
		$param = $this->uri->segment(2);
		//echo "TTTTTTTTTTTTTTTTTTTTTTTTTTTttttttt";
		echo $this->load->view('view_slider', $data);
	}
	
	
	public function redirectshop($vendor)
	{				
		if($vendor!=''){
			$_SESSION['vendor']	= $vendor;
			redirect(base_url().'shop');			
		}
	}
	
	public function buyer_guide($vendor)
	{				
		$this->load->view('common/header', $data);			
		$this->load->view('buyer_guide', $data);
		$this->load->view('common/footer');
	}
	
	public function cancel_order()
	{
		$this->load->library('user_agent');
		$order_id	=	$this->product_model->cancel_order(); 		
		if($order_id)
			redirect(base_url().'view_order/'.$order_id);
		else
			redirect($this->agent->referrer());
	}
	
	public function service_center($param)
	{	
		$param = $this->uri->segment(2);
		//$brand_record	=	$this->brand_model->GetRecordById($param);
		$brand_record	=	$this->brand_model->GetRecordBySlug($param);
		$data['brand_record'] = $brand_record;
		
		$service_center_record	=	$this->brand_model->GetServiceCenterBybrandId($brand_record->id);
		$data['service_center_record'] = $service_center_record;		
		
		$this->load->view('common/header', $data);			
		$this->load->view('service_center', $data);
		$this->load->view('common/footer');
	}	
	
	
	public function get_sellerByPacket(){
		$packet_id		= trim($this->input->post('packet_id'));		
		$product_id		= trim($this->input->post('product_id'));		
		$code			= trim($this->input->post('code'));		
		$seller_record	=	$this->product_model->getSellerByProductPacketCode($code); 
		$data['seller_record'] = $seller_record;
		if($this->agent->is_mobile())
		{
			$this->load->view('packetswiseseller_mobile', $data);
		}else{
			$this->load->view('packetswiseseller', $data);
		}		
	}
	

	
	public function shop($shop_code="",$section='',$category='',$subcategory='')
	{ 		
		if(is_numeric($section))
			$section="";
		if(is_numeric($category))
			$category="";
		if(is_numeric($subcategory))
			$subcategory="";		
		
		$uri1 = $this->uri->segment(1);
		$uri2 = $this->uri->segment(2); 
		$uri3 = $this->uri->segment(3); 
		$uri4 = $this->uri->segment(4); 
		$uri5 = $this->uri->segment(5); 
		$shop_code = $uri2;
		$config['base_url'] = site_url().'shop/'.$shop_code;
		if($uri5!=""){
			if(is_numeric($uri5)){
			$page_no = $uri5;
			}
			$uri_segment = 5;
			$config['base_url'] = site_url().'shop/'.$uri2.'/'.$uri3.'/'.$uri4;
		}else if($uri4!=""){
			if(is_numeric($uri4)){
			$page_no = $uri4;
			}
			$uri_segment = 4;
			$config['base_url'] = site_url().'shop/'.$uri2.'/'.$uri3.'/'.$uri4;
		}else if($uri3!=""){
			if(is_numeric($uri3)){
			$page_no = $uri3;
			}
			$uri_segment = 3;
			$config['base_url'] = site_url().'shop/'.$uri2.'/'.$uri3;
		}else if($uri2!=""){
			if(is_numeric($uri2)){
			$page_no = $uri2;
			}
			$uri_segment = 2;
			$config['base_url'] = site_url().'shop/'.$shop_code;
		}
		
		if($this->session->userdata('user_id')==""){
			$this->load->view('common/header', $data);	
			$data['redirect_url'] = 'login';
			$this->load->view('login', $data);
			$this->load->view('common/footer'); exit;
			//redirect(base_url().'login');
		}
		//if($shop_code!='')
			$vendor  = $shop_code;
		//else
			//$vendor  =  trim($this->input->post('vendor'));
		
		if($vendor!=''){
			$_SESSION['vendor']	= $vendor;
			$seller_record = $this->seller_registration_model->GetRecordsBySellerCode($vendor);
			if($seller_record[0]->id!='')
				$this->seller_registration_model->saveShopVisitor($seller_record);			
		}else{			
			$seller_record = $this->seller_registration_model->GetRecordsBySeller();
			$vendor = $seller_record[0]->seller_code;
		} 
		
		$data['seller_record'] = $seller_record;
		if($seller_record[0]->id!='')
		$_SESSION['seller_id'] = $seller_record[0]->id;
		
		$vendor_code_validate = $this->validateVendorCode($vendor); 
		if($vendor_code_validate==0){
			$data["approval_error_msg"] = "Invalid Vendor Code."; 
			$this->load->view('common/header', $data);				
			$this->load->view('vendor_error', $data);
			$data['vendor'] = $_SESSION['vendor'];
			$this->load->view('common/footer',$data);
			exit;	
		}	
				
		if($seller_record[0]->type==0){
			$buyer_request_record = $this->buyer_request_model->CkeckBuyerApproval($seller_record[0]->id,$this->session->userdata('user_id'));  
			
			if($buyer_request_record[0]->id==""){
				$buyer_request_url=base_url()."buyer_request";
				$data["approval_error_msg"] = "<a href=".$buyer_request_url.">Send the request to Vendor to authorise you.</a>";
				$this->load->view('common/header', $data);		
				if($this->session->userdata('user_id')==""){
					//redirect(base_url().'login');
					$this->load->view('common/header', $data);	
					$data['redirect_url'] = 'login';
					$this->load->view('login', $data);
					$this->load->view('common/footer'); exit;
				}else{
					redirect(base_url().'buyer_request/'.$shop_code);
					//$this->load->view('index', $data);
				}		
				$this->load->view('common/footer'); 
				exit;	
			}else if($buyer_request_record[0]->status==0){
				$data["approval_error_msg"] = "Ask your vendor to activate you.";
				$this->load->view('common/header', $data);		
				if($this->session->userdata('user_id')==""){
					//redirect(base_url().'login');
					$this->load->view('common/header', $data);
					$data['redirect_url'] = 'login';
					$this->load->view('login', $data);
					$this->load->view('common/footer'); exit;
				}else{			
					$this->load->view('vendor_error', $data);
				}		
				$this->load->view('common/footer'); 
				exit;	
			}	
		}		
				
		
		/*if($buyer_request_record[0]==0){
			redirect(base_url().'buyer_approval');
		} */		
			
		$data['seller_cart_record']	=	$this->product_model->getCartRecordSellerB2B();			
		$data['cart_record']	=	$this->product_model->getCartRecord();	
		
		$brand_record	=	$this->brand_model->GetSellerBrand($_SESSION['seller_id']);
		$data['brand_record'] = $brand_record;
		
		if($subcategory!='')
			$category=$subcategory;
			
		$section_record		=	$this->section_model->GetRecordsByCode($section);		
		$category_record	=	$this->category_model->GetRecordsByCode($category);
		
			
		if($section_record[0]->id!=''){
			$section_id = $section_record[0]->id;
		}else{	
			$brand_record		=	$this->brand_model->GetRecordByCode($section);
			$brand_id = $brand_record->id;
		}
		
		if($category_record[0]->id!='')
		$category_id = $category_record[0]->id;
		
		if($subcategory!=''){			
			$category_ids[] = $category_record[0]->id;
		}else{
			$category_record = $this->category_model->getSubCategoryByCategory($category_record[0]->id);
			foreach($category_record as $key=>$cat){
				$category_ids[] = $cat->id;
			}
		} 		
		
		
		
				$brand_ids = $this->input->post('brand');
				$product = trim($this->input->post('product')); 
			
				if($brand_ids!=""){
					if($page_no==""){
					$_SESSION['brand_ids'] = $brand_ids;
					$data['brand_ids'] = $_SESSION['brand_ids'];
					}else{
					$data['brand_ids'] = $_SESSION['brand_ids'];
					}
							 
					$brand_record	=	$this->brand_model->GetSellerBrand($_SESSION['seller_id']);
					$data['brand_record'] = $brand_record;		
					
					$section_record = $this->section_model->GetRecords($_SESSION['seller_id']);
					$data['section_record'] = $section_record;
					
					$category_record = $this->category_model->getCategory();
					$data['category_record'] = $category_record;
					
					$subcategory_record = $this->category_model->getSubCategory();
					$data['subcategory_record'] = $subcategory_record;
					
					
					$per_page=50;
					$product_record = $this->product_model->GetTotalRecords($_SESSION['seller_id'],$section_id,$category_ids,$_SESSION['brand_ids']);
					$total_record	= 	count($product_record);	
					$config['base_url'] = site_url().'brands';
					$config['total_rows'] = $total_record;
					$config['per_page'] = $per_page;
					$config["uri_segment"] = 2;
					
					$config['cur_tag_open'] = '<li><a class="current">';
					$config['cur_tag_close'] = '</a></li>';
					
					$this->pagination->initialize($config);
					$data['pagination_links'] = $this->pagination->create_links();
					
					if($page_no=='')
						$limit=0;
					else
						$limit=$config["per_page"]*($page_no-1);
						
					$offset = ($limit) ? $limit : 0;
					
					//$array_records = $this->product_model->GetRecords($offset,$per_page); 
					$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,$_SESSION['brand_ids'],'',$offset,$per_page);
					$data['product_record'] = $product_record;	
						
					//$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,$brand_ids);
					$data['product_record'] = $product_record;
					
					$this->load->view('common/header', $data);	
						$data['cart_record']	=	$this->product_model->getCartRecord();	
						if($this->agent->is_mobile())
						{						
							$this->load->view('shop_mobile', $data);
						}else{
							$this->load->view('shop', $data);
						}
					$data['vendor'] = $_SESSION['vendor'];
					$this->load->view('common/footer');
						
				}else if($product!=""){
					$data['product']=$product;
					$brand_record	=	$this->brand_model->GetSellerBrand($_SESSION['seller_id']);
					$data['brand_record'] = $brand_record;
					
					$section_record = $this->section_model->GetRecords($_SESSION['seller_id']);
					$data['section_record'] = $section_record;
					
					$category_record = $this->category_model->getCategory();
					$data['category_record'] = $category_record;
					
					$subcategory_record = $this->category_model->getSubCategory();
					$data['subcategory_record'] = $subcategory_record;
						
					$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,'',$product);
					$data['product_record'] = $product_record;
					
					$this->load->view('common/header', $data);	
						$data['cart_record']	=	$this->product_model->getCartRecord();	
						if($this->agent->is_mobile())
						{
							$this->load->view('shop_mobile', $data);
						}else{
							$this->load->view('shop', $data);
						}
					$data['vendor'] = $_SESSION['vendor'];
					$this->load->view('common/footer');		
				}else{
		
					if(count($seller_record)>0 && !empty($seller_record)){										
						
							$section_record = $this->section_model->GetRecords($_SESSION['seller_id']);
							$data['section_record'] = $section_record;
							
							$category_record = $this->category_model->getCategory();
							$data['category_record'] = $category_record;
							
							$subcategory_record = $this->category_model->getSubCategory();
							$data['subcategory_record'] = $subcategory_record;
								
							//$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,$brand_id);
							//$data['product_record'] = $product_record;
							
									
							$per_page=500000;
							$product_record = $this->product_model->GetTotalRecords($_SESSION['seller_id'],$section_id,$category_ids,$brand_id);
							$total_record	= 	count($product_record);	
							//$config['base_url'] = site_url().'shop';
							$config['total_rows'] = $total_record;
							$config['per_page'] = $per_page;
							$config["uri_segment"] = $uri_segment;
							
							$config['cur_tag_open'] = '<li><a class="current">';
							$config['cur_tag_close'] = '</a></li>';
							
							$this->pagination->initialize($config);
							$data['pagination_links'] = $this->pagination->create_links();
							
							if($page_no=='')
								$limit=0;
							else
								$limit=$config["per_page"]*($page_no-1);
								
							$offset = ($limit) ? $limit : 0;
							
							//$array_records = $this->product_model->GetRecords($offset,$per_page); 
							$product_record = $this->product_model->GetRecords($_SESSION['seller_id'],$section_id,$category_ids,$brand_id,'',$offset,$per_page);		
							$data['product_record'] = $product_record;	
					
					
					}else{
						$_SESSION['seller_id'] = '';
					}			
					
					$vendor_code_validate = $this->validateVendorCode($vendor); 
					if($vendor_code_validate==0)
					$data["approval_error_msg"] = "Invalid Vendor Code."; 
					$this->load->view('common/header', $data);		
					if(count($seller_record)>0 && !empty($seller_record) && $vendor_code_validate == 1){
						$data['vendor_code'] = $shop_code;
						//$this->load->view('shop', $data);
						//$this->load->view('common/header', $data);	
						$data['cart_record']	=	$this->product_model->getCartRecord();
						if($this->agent->is_mobile())
						{
							$this->load->view('shop_mobile', $data);
						}else{
							$this->load->view('shop', $data);
						}						
					}else{			
						$this->load->view('index', $data);
					}
					$data['vendor'] = $_SESSION['vendor'];
					$this->load->view('common/footer',$data);
				}
	}
	
	public function error(){	
		$this->load->view('common/header',$data);
		$this->load->view('error_404', $data);
		$this->load->view('common/footer',$data);
	}
	
	public function delivery_location($seller_id){
		$seller_id = $this->uri->segment(2); 
		//$this->load->view('common/header',$data);
		$delivery_location 	=	$this->product_model->GetDeliveryLocation($seller_id);
		$data['delivery_location'] = $delivery_location;
		$this->load->view('delivery_location_popup', $data);
		//$this->load->view('common/footer',$data);
	}
	
	public function product_offer($product_map_id){	
		//$this->load->view('common/header',$data);		
		$product_offer 	=	$this->product_model->GetProductOffer($product_map_id);		
		$data['product_offer'] = $product_offer;
		$this->load->view('product_offer_popup', $data);
		//$this->load->view('common/footer',$data);
	}
	
	
	public function product_description_popup($product_map_id){	
		//$this->load->view('common/header',$data);		
		$product_details 	=	$this->product_model->GetProductOffer($product_map_id);		
		$data['product_details'] = $product_details;
		$this->load->view('product_description_popup', $data);
		//$this->load->view('common/footer',$data);
	}
	
	public function rating_review(){		
		$this->load->view('common/header', $data);	
		$this->load->view('rating_review', $data);
		$this->load->view('common/footer');
		
	}
	
}
?>