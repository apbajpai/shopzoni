<?php
class Time_Slot_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$totime  =  trim($this->input->post('totime'));
		$fromtime  =  trim($this->input->post('fromtime'));
		if($totime != '')
		$this->db->where('totime', $totime);		
		if($fromtime != '')
		$this->db->where('fromtime', $fromtime);		
		$query = $this->db->get("tbl_time_slot");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$totime  =  trim($this->input->post('totime'));
		$fromtime  =  trim($this->input->post('fromtime'));
		if($totime != '')
		$this->db->where('totime', $totime);		
		if($fromtime != '')
		$this->db->where('fromtime', $fromtime);
		$this->db->order_by('fromtime ASC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_time_slot");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$delivery_location = $this->GetDeliveryLocationById($row->delivery_location_id);
				$row->delivery_location = $delivery_location->delivery_location;
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetRecordsControl() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_time_slot");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$delivery_location = $this->GetDeliveryLocationById($row->delivery_location_id);
				$row->delivery_location = $delivery_location->delivery_location;			
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_time_slot");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByDeliveryLocationId($delivery_location_id) {
        $this->db->where('delivery_location_id', $delivery_location_id);
		$query = $this->db->get("tbl_time_slot");
		$data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_time_slot_data($image=null) {
		$id = $this->input->post('id');
		$delivery_location_id = $this->input->post('delivery_location_id');
		$order_ending_time = $this->input->post('order_ending_time');
		$maximum_no_of_order = $this->input->post('maximum_no_of_order');
		$totime = $this->input->post('totime');
		$fromtime = $this->input->post('fromtime');
		$seller_id = $this->session->userdata('seller_id');
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		
		$data = array(
				'totime'=>$totime ,
				'fromtime'=>$fromtime,
				'delivery_location_id'=>$delivery_location_id,
				'order_ending_time'=>$order_ending_time,
				'maximum_no_of_order'=>$maximum_no_of_order,
				'seller_id'=>$seller_id,	
				'status'=>$status,
				'created_by'=>$created_by
				);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_time_slot', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_time_slot',$data); 
			$id = $this->db->insert_id();
			$this->db->where('id', $id);
			$this->db->update('tbl_time_slot', $data); 
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
		$query = $this->db->get("tbl_time_slot");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	
	public function GetDeliveryLocationById($id) {
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
}