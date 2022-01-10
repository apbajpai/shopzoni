<?php
class Role_model extends CI_Model {
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function GetRecords() {
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_role");
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
				$query = $this->db->get("tbl_role");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_author_data($image=null) {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$slug = GetSlug($this->input->post('name'));
		$status = $this->input->post('status');				
		$created_by = $this->input->post('created_by');	
		
		$data = array(
					'name'=>$name ,
					'image'=>$image,	
					'slug'=>$slug,	
					'status'=>$status,
					'created_by'=>$created_by
					);
		if($id)			
		{
			$this->db->where('id', $id);
			$this->db->update('tbl_author', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_author',$data); 
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
}