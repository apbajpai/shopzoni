<?php
class Slider_Image_model extends CI_Model {
    
	private $path = 'public/uploads/home_slider_image/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord($caption='') {	
		$this->db->select('count(*) as total');	
		$this->db->like('caption', $caption);
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_home_slider_image");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($caption='',$start=0, $limit=10) {
		$this->db->like('caption', $caption);
		$this->db->where('status !=', 5);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_home_slider_image");
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
		$query = $this->db->get("tbl_home_slider_image");
		//echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function save_slider_image_data($image=null) {
		$id = $this->input->post('id');		
		$title = $this->input->post('title');
		$short_desc = $this->input->post('short_desc');
		$redirect_url = $this->input->post('redirect_url');
		$caption = $this->input->post('caption');
		$img_alt = $this->input->post('img_alt');
		$img_desc = $this->input->post('img_desc');
		$status = $this->input->post('status');
		
		$created_by = $this->session->userdata('adminid');
		$date_published = $this->input->post('date_published');			
		
		$data = array(									
					'title'=>$title,
					'short_desc'=>$short_desc,
					'redirect_url'=>$redirect_url,
					'caption'=>$caption,
					'img_alt'=>$img_alt,
					'img_desc'=>$img_desc,
					'image'=>$image,
					'created_by'=>$created_by,					
					'status'=>$status
				);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');			
			$this->db->where('id', $id);
			$this->db->update('tbl_home_slider_image', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_home_slider_image',$data); 			
			$id = $this->db->insert_id();
		}
		return true;
		
	}
	
	function upload1($fieldname,$type='')
	{
		$config['upload_path'] = $this->path;
		if (!is_dir($this->path))
		{
			mkdir($this->path, 0777);
		}
		$config['allowed_types'] = $type;
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