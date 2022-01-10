<?php
class Brand_model extends CI_Model {
    
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
		$this->db->where('name', $name);		
		$query = $this->db->get("tbl_brand");
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
		$this->db->where('name', $name);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_brand");
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
	
	public function GetRecordsFront($seller_id,$start=0, $limit=10){
		$this->db->select('b.id as product_id,c.id as product_map_id,a.*');
		$this->db->from("tbl_brand as a");
		$this->db->join('tbl_product as b', 'a.id = b.brand_id','left');
		$this->db->join('tbl_seller_product_map as c', 'b.id = c.product_id', 'left');
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$this->db->where('c.seller_id', $seller_id);
		$this->db->group_by('name'); 
		
		$query = $this->db->get();
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
	
	public function GetRecordsControl($brand_name="") {
		$this->db->where('status', 1);
		$name  =  trim($this->input->post('name'));
		$brand  =  trim($this->input->post('brand'));
		if($brand != '')
		$this->db->like('name', $brand);
		if($name != '')
		$this->db->like('name', $name);
		if($brand_name != '')
		$this->db->like('name', $brand_name, 'after');
		$query = $this->db->get("tbl_brand");
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
		$this->db->where('status', 1);
        $this->db->where('id', $id);
				$query = $this->db->get("tbl_brand");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByCode($code) {
        $this->db->where('code', $code);
				$query = $this->db->get("tbl_brand");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_brand_data($image=null) {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$slug = GetSlug($this->input->post('name'));
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		
		$data = array(
					'name'=>$name ,
					'slug'=>$slug,	
					'status'=>$status,
					'created_by'=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$data['code'] = GetCode($name, $id);			
			$this->db->where('id', $id);
			$this->db->update('tbl_brand', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_brand',$data); 
			$id = $this->db->insert_id();
			$data['code'] = GetCode($name, $id);			
			$this->db->where('id', $id);
			$this->db->update('tbl_brand', $data); 
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

	public function GetSellerBrand($seller_id) { 	
		$this->db->select('distinct(f.name),f.*');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');
		
		$this->db->where('a.status', 1);	
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status',1);
		$this->db->where('f.status', 1);
	
		$this->db->where('e.seller_id', $seller_id);
		$this->db->order_by("f.name", "ASC");
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
	
	public function GetRecordsByDepartment($department_ids) {							
		$this->db->select('distinct(a.id),a.name,a.image,b.status');
		$this->db->from("tbl_brand as a");
		$this->db->join('tbl_brand_department_map as b', 'b.brand_id  = a.id', 'left');	
		
		$this->db->where_in('b.department_id', $department_ids);
		$this->db->where('a.status', 5);	
		$this->db->where('b.status', 1);	
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
	
	public function GetSliderImage($brand_id) {
		$this->db->where('status', 1);
        $this->db->where('brand_id', $brand_id);
			$query = $this->db->get("tbl_slider_image");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}