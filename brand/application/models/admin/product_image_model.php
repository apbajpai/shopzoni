<?php
class Product_Image_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord($product_id='') {
		$this->db->select('a.*,b.name as product_name');
		$this->db->from("tbl_image as a");
		$this->db->join('tbl_product as b', 'a.product_id = b.id', 'left');
		
		$this->db->where('a.product_id', $product_id);	
		$this->db->where('a.status !=', 5);
		$caption 	=  trim($this->input->post('caption'));
		if($caption)
		$this->db->like('a.caption', $caption);

		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {            
			return $query->num_rows();
        }        
		return 0;
    }	
	
	public function GetRecords($start=0, $limit=10) {							
		$this->db->select('a.*,b.name as brand_name');
		$this->db->from("tbl_image as a");
		$this->db->join('tbl_product as b', 'a.product_id = b.id', 'left');
		$this->db->where('a.product_id', $this->session->userdata('product_id'));	
		$this->db->where('a.status !=', 5);			
		$caption 	=  trim($this->input->post('caption'));
		if($caption)
		$this->db->like('a.caption', $caption);	

		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
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
		$query = $this->db->get("tbl_image");
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
		$product_id = $this->input->post('product_id');	
		$caption = $this->input->post('caption');
		$img_alt = $this->input->post('img_alt');
		$img_desc = $this->input->post('img_desc');
		$status = $this->input->post('status');
		
		$created_by = $this->session->userdata('adminid');
		$date_published = $this->input->post('date_published');			
		
		$data = array(									
					'product_id'=>$product_id,
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
			$this->db->update('tbl_image', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_image',$data); 			
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