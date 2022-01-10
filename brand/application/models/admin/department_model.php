<?php
class Department_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->like('name', $name);
		$query = $this->db->get("tbl_department");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		if($name != '')
		//$this->db->where('name', $name);
		$this->db->like('name', $name);
		$this->db->order_by('id DESC');
		//$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_department");
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
		$query = $this->db->get("tbl_department");
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
		$query = $this->db->get("tbl_department");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByName($name) {
        $this->db->where('status !=', 5);
        $this->db->where('name', $name);
				$query = $this->db->get("tbl_department");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_department_data($image=null) {
		
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$slug = GetSlug($this->input->post('name'),'');
		//$status = $this->input->post('status');				
		$status = 1;	
		
		$created_by = $this->session->userdata('adminid');
		
		if($id=="" || $id == 0){
			$res = $this->GetRecordByName($name); 
		}
		
		if($res==0){
		
		$data = array(
			'name'=>$name,
			'status'=>$status
		);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');				
			$this->db->where('id', $id);
			$this->db->update('tbl_department', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_department',$data); 
			$id = $this->db->insert_id();			
			$this->db->where('id', $id);
			$this->db->update('tbl_department', $data); 
		}
		return true;
		}else{
		return false;
		}
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
	
	/*public function GetDepartmentMapRecord($brand_id) {							
		$this->db->select('a.id,a.name,b.status');
		$this->db->from("tbl_department as a");
		$this->db->join('tbl_brand_department_map as b', 'b.department_id = a.id', 'Left');	
		
		$this->db->where('a.status !=', 5);		
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		echo $this->db->last_query(); 
	
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
    } */
	
	public function GetDepartmentMapRecord($brand_id) {							
		$this->db->where('status !=', 5);	
		$this->db->order_by("name", "asc");
		$query = $this->db->get("tbl_department");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$brand_dep_map_rec = $this->GetDepartmentMapTableRecord($row->id,$brand_id);
				$row->map_status = $brand_dep_map_rec->status;
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetDepartmentMapTableRecord($department_id,$brand_id) {							
		$this->db->where('department_id', $department_id);
		$this->db->where('brand_id', $brand_id);
		$query = $this->db->get("tbl_brand_department_map");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
}