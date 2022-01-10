<?php
class Partner_model extends CI_Model {
    
	private $path = 'public/uploads/partner/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('a.*,b.state_name,c.district_name,d.pincode');
		$this->db->from("tbl_partner as a");
		$this->db->join('tbl_state_master as b', 'a.state_id = b.id', 'left');
		$this->db->join('tbl_district_master as c', 'a.city_id = c.id', 'left');
		$this->db->join('tbl_pincode_master as d', 'a.pincode_id = d.id', 'left');
	
		$this->db->where('a.status !=', 5);
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->like('a.name', $name);
		$city  =  trim($this->input->post('city'));
		if($city != '')
		$this->db->like('c.district_name', $city);
		$brand_id = $this->session->userdata('brand_id');
		if($brand_id != '')
		$this->db->where('a.brand_id', $brand_id);		
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
          return $query->num_rows();
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->select('a.*,b.state_name,c.district_name,d.pincode');
		$this->db->from("tbl_partner as a");
		$this->db->join('tbl_state_master as b', 'a.state_id = b.id', 'left');
		$this->db->join('tbl_district_master as c', 'a.city_id = c.id', 'left');
		$this->db->join('tbl_pincode_master as d', 'a.pincode_id = d.id', 'left');
	
		$this->db->where('a.status !=', 5);
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->like('a.name', $name);
		$city  =  trim($this->input->post('city'));
		if($city != '')
		$this->db->like('c.district_name', $city);
		$brand_id = $this->session->userdata('brand_id');
		if($brand_id != '')
		$this->db->where('a.brand_id', $brand_id);		
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get();	
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetRecordsControl() {
		$this->db->where('status', 1);
		$this->db->order_by('name ASC');
		$query = $this->db->get("tbl_partner");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_partner");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByName($name) {
        $this->db->where('name', $name);
				$query = $this->db->get("tbl_partner");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_partner_data($image=null) {
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$address = $this->input->post('address');			
		$state_id = $this->input->post('state_id');
		$city_id = $this->input->post('city_id'); 
		$pincode_id = $this->input->post('pincode_id');
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		$brand_id = $this->session->userdata('brand_id');
				
		$data = array(
					'brand_id'=>$brand_id,
					'type'=>$type,
					'name'=>$name,
					'email'=>$email,
					'address'=>$address,
					'state_id'=>$state_id,
					'city_id'=>$city_id,
					'pincode_id'=>$pincode_id,
					'status'=>$status,					
					'created_by'=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_partner', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_partner',$data); 
			$id = $this->db->insert_id();
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
	
	function GetStateRecord()
	{
		$this->db->order_by('state_name ASC');		
		$query = $this->db->get("tbl_state_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function GetCityRecord()
	{
		$this->db->order_by('district_name ASC');		
		$query = $this->db->get("tbl_district_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	function GetPincodeRecord()
	{
		$this->db->order_by('id ASC');		
		$query = $this->db->get("tbl_pincode_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetStateCity($state_id) {
		//$state_record = $this->getStateID($state);
		//$state_id = $state_record->id;
		$this->db->where('state_id', $state_id);
		$query = $this->db->get("tbl_district_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetPincodeByCity($city_id) {
		$this->db->where('district_id', $city_id);
		$query = $this->db->get("tbl_pincode_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function getStateID($state) {
		$this->db->where('state_name', $state);
		$query = $this->db->get("tbl_state_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
}