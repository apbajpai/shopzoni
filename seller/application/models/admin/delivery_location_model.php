<?php
class Delivery_Location_model extends CI_Model {
    
	private $path = 'public/uploads/delivery_location/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$delivery_location  =  trim($this->input->post('delivery_location'));
		if($delivery_location != '')
		$this->db->where('delivery_location', $delivery_location);		
		$this->db->where('seller_id', $seller_id);		
		$query = $this->db->get("tbl_delivery_location");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit="") {
		$this->db->where('status !=', 5);
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$delivery_location  =  trim($this->input->post('delivery_location'));		
		if($delivery_location != '')
		$this->db->where('delivery_location', $delivery_location);					
		$this->db->order_by('id DESC');
		if($limit)
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_delivery_location");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {				
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function GetRecordsControl() {
		$this->db->where('status !=', 5);
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);								
		$this->db->order_by('id DESC');		
		$query = $this->db->get("tbl_delivery_location");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {				
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function GetRecordsControlold() {
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_delivery_location");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_delivery_location");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_delivery_location_data($image=null) {
		$id = $this->input->post('id');
		$delivery_location 	= $this->input->post('delivery_location');			
		$shipping_charge 		= $this->input->post('shipping_charge');
		$seller_id = $this->session->userdata('seller_id');
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		
		$data = array(
					'delivery_location'=>$delivery_location,
					'shipping_charge'=>$shipping_charge,
					//'state_id'		=>	$state_id,
					//'city_id'		=>	$city_id,					
					//'pincode_id'	=>	$pincode_id,
					'seller_id'		=>$seller_id,	
					'status'		=>$status,
					'created_by'	=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_delivery_location', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_delivery_location',$data); 
			$id = $this->db->insert_id();
			$this->db->where('id', $id);
			$this->db->update('tbl_delivery_location', $data); 
		}
		return true;
	}

	function upload1($fieldname)
	{
		$config['upload_path'] = $this->path;
		if (!is_dir($this->path))
		{
			mkdir($this->path, 0777);
		}
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2000';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);            
		
		if (!$this->upload->do_upload($fieldname)){
			$error = array('error' => $this->upload->display_errors());
		}else{
			$upload_data = $this->upload->data();
			return $upload_data['file_name'];		
		}							
	}	
	
	public function GetTotalRecordSellerWise() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_delivery_location");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
}