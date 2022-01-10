<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/order_model');
		$this->load->model('admin/address_book_model');
		$this->load->model('admin/Delivery_Location_model');
		$this->load->model('admin/Time_Slot_model');
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
		$data['heading']='View Order'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['order_id']	= $this->input->post('order_id');
		$search['email']	= $this->input->post('email');
		$search['delivery_location_id']	= $this->input->post('delivery_location_id');
		$search['delivery_date']	= $this->input->post('delivery_date');
		$search['time_slot_id']	= $this->input->post('time_slot_id');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->order_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/order/index';
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
		
		$array_records = $this->order_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		
		$data['delivery_location'] = $this->Delivery_Location_model->GetRecordsControl();
		$data['time_slot'] = $this->Time_Slot_model->GetRecordsControl();
		
		$this->load->view('admin/order', $data);
		$this->load->view('admin/footer');
	}
	
	public function approveOrderStatus(){
		$this->order_model->approveOrderStatus();
		echo $product_id  =  trim($this->input->post('product_id'));		
		//echo $order_id  =  trim($this->input->post('order_id'));		
		//echo "<input type="button" onclick="changeOrderStatus(' echo $data->cart_id; ')" name="order_status" id="order_status" value="Approve">";
		
	}
	
	public function sendMailToBuyer(){
		$order_id  =  trim($this->input->post('order_id'));	
		$this->order_model->sendMailToBuyer();		
		$array_records = $this->order_model->GetRecordsByOrderId($order_id);
		$data['order_id'] = $order_id; 
		$data['records'] = $array_records; 
		$this->load->view('admin/order_mail_template', $data);
		echo $order_id;		
		//echo "<input type="button" onclick="changeOrderStatus(' echo $data->cart_id; ')" name="order_status" id="order_status" value="Approve">";
	}
	
	
	public function rejectOrderStatus(){
		$this->order_model->rejectOrderStatus();
		echo $cart_id  =  trim($this->input->post('cart_id'));		
		//echo "<input type="button" onclick="changeOrderStatus(' echo $data->cart_id; ')" name="order_status" id="order_status" value="Approve">";
	}
	
	public function view($order_id){
		$order_id = $this->uri->segment(4); 
		$this->order_model->changeViewStatus($order_id);
		$data['heading']='View Order'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		$array_records = $this->order_model->GetRecordsByOrderId($order_id);
		$data['records'] = $array_records; 
		$this->load->view('admin/view_order', $data);
		$this->load->view('admin/footer');
	}
	
	function timeslotDropdown($delivery_location_id)
	{
		if($data['time_slot'] = $this->Time_Slot_model->GetRecordByDeliveryLocationId($delivery_location_id))
		$this->load->view('admin/timeslotDropdown', $data);
	}
	
}
?>