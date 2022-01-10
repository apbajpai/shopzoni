<?php
class Help_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
		
	
	public function save_contact_us_data() {
		$name		=	$this->input->post('name');
		$email		=	$this->input->post('email');
		$phone		=	$this->input->post('phone');
		$message	=	$this->input->post('message');
		
		$data = array(					
					'name'=>$name,
					'user_id'=>$this->session->userdata('user_id'),
					'email'=>$email,					
					'phone'=>$phone,		
					'message'=>$message
				);		
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_contact_us',$data); 
			//echo $this->db->last_query();
			$id = $this->db->insert_id();
			return $id;
		return true;		
	}
	
	public function save_message_seller_data() {
		$seller_code		=	$this->input->post('seller_code');		
		$message	=	$this->input->post('message');
		$seller_record = $this->seller_registration_model->GetRecordsBySellerCode($seller_code);
		if($seller_record[0]->id!=""){
			$data = array(					
						'seller_code'=>$seller_code,
						'user_id'=>$this->session->userdata('user_id'),
						'message'=>$message
					);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_message_seller',$data); 
				//echo $this->db->last_query();
				$id = $this->db->insert_id();
				return $id;
			return true;		
		}else{
			return false;
		}
	}
	
	
	public function save_feedback_data() {
		$seller_code		=	$this->input->post('seller_code');
		$rating		=	$this->input->post('rating');		
		$message	=	$this->input->post('message');		
		$seller_record = $this->seller_registration_model->GetRecordsBySellerCode($seller_code);
		if($seller_record[0]->id!=""){
			$data = array(	
						'seller_code'=>$seller_code,
						'user_id'=>$this->session->userdata('user_id'),
						'rating'=>$rating,					
						'message'=>$message
					);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_seller_feedback',$data); 
				//echo $this->db->last_query();
				$id = $this->db->insert_id();
				return $id;
			return true;	
		}else{
			return false;
		}
	}
	
	public function save_send_query_data() {		
		$message	=	$this->input->post('message');
		
		$data = array(					
					'user_id'=>$this->session->userdata('user_id'),					
					'message'=>$message
				);		
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_query',$data); 
			//echo $this->db->last_query();
			$id = $this->db->insert_id();
			return $id;
		return true;		
	}
	
}