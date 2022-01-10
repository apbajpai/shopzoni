<?php
class Section_model extends CI_Model {
    
	private $path = 'public/uploads/section/';
    
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
		$query = $this->db->get("tbl_section");
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
		$this->db->like('name', $name);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_section");
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
	
	public function uniqueSection($name, $id) {
			$this->db->where('id !=', $id);
			$this->db->where('name', $name);
			$this->db->where('status !=', 5);
			$query = $this->db->get("tbl_section");
			//echo $this->db->last_query(); exit;
			if ($query->num_rows() > 0) {
					return "false";
			}
			return "true";
	}
	
	public function GetRecordsControl() {
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_section");
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
				$query = $this->db->get("tbl_section");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_section_data() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		//$slug = GetSlug($this->input->post('name'));
		$status = $this->input->post('status');				
		$home_status = $this->input->post('home_status');				
		$created_by = $this->session->userdata('adminid');

		$data = array(
					'name'=>$name,					
					'status'=>$status,
					'home_status'=>$home_status,
					'created_by'=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$data['code'] = GetCode($name, $id);			
			$this->db->where('id', $id);
			$this->db->update('tbl_section', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_section',$data); 
			$id = $this->db->insert_id();
			$data['code'] = GetCode($name, $id);			
			$this->db->where('id', $id);
			$this->db->update('tbl_section', $data); 
		}
		//echo $this->db->last_query(); exit;
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
}