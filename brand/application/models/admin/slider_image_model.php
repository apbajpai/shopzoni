<?php
class Slider_Image_model extends CI_Model {
    
	private $path = 'public/uploads/slider_image/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {	
		$caption = trim($this->input->post('caption'));
		$brand_id = $this->session->userdata('brand_id');
		$this->db->select('count(*) as total');		
		$this->db->where('status !=', 5);
		$new_caption = explode(' \ ',$caption);
		
		if($new_caption[0])
		$this->db->like('caption', $new_caption[0]);
		$this->db->where('brand_id', $brand_id);
		$query = $this->db->get("tbl_slider_image");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$brand_id = $this->session->userdata('brand_id');
		$caption = trim($this->input->post('caption'));
		$this->db->where('status !=', 5);
		
		$new_caption = explode(' \ ',$caption);
		
		if($new_caption[0])
		$this->db->like('caption', $new_caption[0]);
		$this->db->where('brand_id', $brand_id);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_slider_image");
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
		$query = $this->db->get("tbl_slider_image");
		//echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function save_product_image_data($image=null) {
		$id = $this->input->post('id');		
		$caption = $this->input->post('caption');
		$status = $this->input->post('status');
		
		$created_by = $this->session->userdata('adminid');
		$brand_id = $this->session->userdata('brand_id');
		$date_published = $this->input->post('date_published');			
		
		$data = array(									
					'brand_id'=>$brand_id,	
					'caption'=>$caption,	
					'image'=>$image,
					'created_by'=>$created_by,					
					'status'=>$status
				);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');			
			$this->db->where('id', $id);
			$this->db->update('tbl_slider_image', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_slider_image',$data); 			
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