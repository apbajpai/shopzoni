<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buyer_Request extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/buyer_request_model');
	  $this->check_isvalidated();
	}	
	
	public function index($page_no)
	{
		$this->page($page_no);
	}	
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('admin/login');
        }
    }	
		
	public function page($page_no)
	{
		$data['heading']='Buyer Request'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		//$search['name'] 		= $this->input->post('name');
		//$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->buyer_request_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/buyer_request/index';
		$config['total_rows'] = $total_record;
		$config['per_page'] = $per_page;
		$config["uri_segment"] = 4;
		
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		
		if($page_no=='')
			$limit=0;
		else
			$limit=$config["per_page"]*($page_no-1);
			
		$offset = ($limit) ? $limit : 0;
		
		$array_records = $this->buyer_request_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/buyer_request', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function approveRequest(){
		$this->buyer_request_model->approveRequest();
		
		$id  =  trim($this->input->post('id'));
		$buyer_record = $this->buyer_request_model->getRecordByID($id);
		
		$to=$buyer_record->email;
		$subject = "Vendor Request Approve";
				
		$message  = "Dear Sir";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "Congratulations…. Your request to ";
		$message  .= "<a href='";
		$message  .= 'https://shopzoni.com/';
		$message  .="shop/";
		$message  .=$buyer_record->seller_code;
		$message  .="'>";
		$message  .=$buyer_record->seller_code;
		$message  .= "</a>";
		$message  .= "” has been approved.";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "Welcome to ";
		$message  .= $buyer_record->seller_business_name;
		$message  .= " as Vendor code – ";
		$message  .= $buyer_record->seller_code;
		$message  .= ".  Thanks for associate with us on ";		
		$message  .= "https://shopzoni.com . Now you can check the prices of products on our shop 24x7 and you can order also ";			
		$message  .= "the same.";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "We are gratefully thanking you to join with us on https://shopzoni.com  ";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "Thanks & Regards";
		$message  .= "<br>";
		$message  .= $buyer_record->seller_code;
		$message  .= "<br>";
		$message  .= $buyer_record->seller_business_name;
		$message  .= "<br>";
		$message  .= $buyer_record->business_address;
		$message  .= "<br>";
		$message  .= $buyer_record->mobile_number;
		
		$from=$buyer_record->email_id;
		//$from = 'info@shopzoni.com';
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From:$from\r\n";
		$headers .= "X-Mailer: PHP v".phpversion()."\n";

		@mail($to,$subject,$message,$headers,"-f $from");
				
		echo $id  =  trim($this->input->post('id'));		
		//echo "<input type="button" onclick="changeOrderStatus(' echo $data->cart_id; ')" name="order_status" id="order_status" value="Approve">";
		
	}
	
	public function rejectRequest(){
		$id  =  trim($this->input->post('id'));
		$this->buyer_request_model->rejectRequest();
		
		
		$buyer_record = $this->buyer_request_model->getRecordByID($id);
		
		$to=$buyer_record->email;
		$subject = "Vendor Request Denied";
		
		/*$message  = "Your Request to ";
		$message .= $buyer_record->seller_code;
		$message .= " has been denied by the vendor ";
		$message .= $buyer_record->seller_business_name;
		$message .= " [ vendor code - ";
		$message .= $buyer_record->seller_code;
		$message .= " ]";
		$message .= "Please call the vendor ";
		$message .= $buyer_record->mobile_number;
		$message .= " to know the reason of deny your request."; */
		
		$message  = "Dear Buyer";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "As your email ID is not recognized by me, Therefore I am unable to accept your request kindly contact me";
		$message  .= "<br>";
		$message  .= "on my number ";
		$message  .= $buyer_record->mobile_number;
		$message  .= " or send me an email with your details.";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "I can accept your request send by you ";		
		$message  .= "again and do further business on http://shopzoni.com";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= "Regards";
		$message  .= "<br>";
		$message  .= "<br>";
		$message  .= $buyer_record->seller_name;
		$message  .= "<br>";
		$message  .= $buyer_record->seller_business_name;
		$message  .= "<br>";
		$message  .= $buyer_record->business_address;
		
		$from=$buyer_record->email_id;
		//$from = 'info@shopzoni.com';
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From:$from\r\n";
		$headers .= "X-Mailer: PHP v".phpversion()."\n";

		@mail($to,$subject,$message,$headers,"-f $from");


		
		echo $id  =  trim($this->input->post('id'));		
		//echo "<input type="button" onclick="changeOrderStatus(' echo $data->cart_id; ')" name="order_status" id="order_status" value="Approve">";
	}
	
	
	
}
?>