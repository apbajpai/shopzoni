<?php
class Product_Category_model extends CI_Model {
    
	private $path = 'public/uploads/product_category/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetSubTotalRecord() {		
		$seller_id = $this->session->userdata('seller_id');
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		$name  =  trim($this->input->post('name'));
		
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		if($user_record->role == 2)
		$this->db->where('seller_id', $seller_id);
		if($name != '')
		$this->db->like('name',$name);
		$this->db->where('parent_id >', 0);		
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);		
		if($name != '')
		$this->db->like('name',$name);
		$this->db->where('parent_id', 0);
		$query = $this->db->get("tbl_product_category");		
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords() {
        $this->db->where('parent_id', 0);
		//Remove deleted category from list
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);				
		if($name != '')
		$this->db->like('name',$name);
		$this->db->order_by('id DESC');
		$query = $this->db->get("tbl_product_category");
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
			    $row->parent_name = '';
				$data[] = $row;
				$child_array = $this->GetChildRecords($row->id);
				if(sizeof($child_array) > 0){
					foreach ($child_array as $child) {
						$child->parent_name = $row->name;
						$data[] = $child;
					}	
				}
            }
            return $data;
        }
        return false;
    }
	
	public function GetSubRecords($start=0, $limit=0) {
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		$seller_id = $this->session->userdata('seller_id');
		
		$name  =  trim($this->input->post('name'));
		$this->db->select('a.*, b.name as parent_name,c.name as sectin_name');
		$this->db->from("tbl_product_category as a");
		$this->db->join('tbl_product_category as b', 'a.parent_id = b.id', 'left');		
		$this->db->join('tbl_section as c', 'c.id = b.section_id', 'left');		
		$this->db->where('a.parent_id !=', 0);		
		$this->db->where('a.status !=', 5);		
		if($user_record->role == 2)
		$this->db->where('a.seller_id', $seller_id);
		if($name != '')
		$this->db->like('a.name',$name);
		$this->db->order_by('a.parent_id');
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get(); 
		//echo $this->db->last_query(); 
		       
		
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }				
            return $data;
        }        
		return false;
    }
	
	public function GetParentRecords($start=0, $limit=10) {
        $name  =  trim($this->input->post('name'));		
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
	
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);
		if($name != '')
		$this->db->like('name',$name);
		
		$this->db->where('parent_id', 0);
		$this->db->where('status !=', 5);
		
		$this->db->order_by('id DESC');
		//$this->db->limit($limit,$start);		
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetParentRecordsControl() {
        $this->db->where('parent_id', 0);
		$this->db->where('status', 1);
		$this->db->order_by('name ASC');		
		$query = $this->db->get("tbl_product_category");
		
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetChildRecords($parent_id) {
		
		$this->db->where('parent_id', $parent_id);
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->where('name', $name);
		$query = $this->db->get("tbl_product_category");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetSectionCategory($section_id) {
		$this->db->where('parent_id', 0);
		$this->db->where('section_id', $section_id);
		$this->db->where('status', 1);		
		$query = $this->db->get("tbl_product_category");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetChildRecordsControl($parent_id) {
        $this->db->where('parent_id', $parent_id);
		$this->db->where('seller_id', $this->session->userdata('seller_id'));
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetChildRecordsControlNew() {
        $this->db->where('parent_id !=', 0);		
		$this->db->where('seller_id', $this->session->userdata('seller_id'));
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetChildRecordsControl1($parent_id,$seller_id) {
        $this->db->where('parent_id', $parent_id);
		$this->db->where('seller_id', $seller_id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetChildRecordsControlNew1($seller_id) {
        $this->db->where('parent_id !=', 0);		
		$this->db->where('seller_id', $seller_id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function uniqueCategory($name, $parent_id, $id) {
			$this->db->where('id !=', $id);
			$this->db->where('name', $name);
			$this->db->where('parent_id', $parent_id);
			$this->db->where('seller_id', $this->session->userdata('seller_id'));
			$this->db->where('status !=', 5);
			$query = $this->db->get("tbl_product_category");
			//echo $this->db->last_query(); exit;
			if ($query->num_rows() > 0) {
					return "false";
			}
			return "true";
	}
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_product_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_product_category_data($image=null) {
		$id = $this->input->post('id');
		$parent_id = $this->input->post('category_id');
		$section_id = $this->input->post('section_id');
		$name = $this->input->post('name');
		
		$date_created = $this->input->post('date_created');
		$date_modified = $this->input->post('date_modified');
		$created_by = $this->input->post('created_by');
		$status = $this->input->post('status');	
		$created_by = $this->session->userdata('adminid');
		$seller_id = $this->session->userdata('seller_id');
		
		$unique_status = $this->product_category_model->uniqueCategory($name, $parent_id, $id);
		if($unique_status=="true"){
		$data = array('parent_id'=>$parent_id ,
					'name'=>$name ,
					'section_id'=>$section_id ,
					//'code'=>$code ,
					'seller_id'=>$seller_id,	
					'date_created'=>$date_created ,
					'date_modified'=>$date_modified ,				
					'status'=>$status ,
					'created_by'=>$created_by
					);
		if($id)			
		{
			if(empty($slug))$slug=$name;
			$data['slug'] = url_title($slug, '-', TRUE);
			//$data['slug'] = GetSlugTitle($slug, $id);
			$data['code'] = GetCode($name, $id);
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_product_category', $data); 
		}
		else
		{
			$data['slug'] = '';
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_product_category',$data); 
			$id = $this->db->insert_id();
			if(empty($slug))$slug=$name;
			$data['slug'] = url_title($slug, '-', TRUE);
			$data['slug'] = GetSlugTitle($slug, $id);
			$data['code'] = GetCode($name, $id);
			$this->db->where('id', $id);
			$this->db->update('tbl_product_category', $data);
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
		
	function create_nested_category($parent_id = 0) {
        $items = array();
        $this->db->where('parent_id', $parent_id);
        $query = $this->db->get('tbl_product_category');
        $results = $query->result();
    	foreach($results as $result) {
			$child_array = $this->create_nested_category($result->id);
			if(sizeof($child_array) == 0){
                array_push($items, $result);
            }else{
                array_push($items, array($result, $child_array));
            }
        }        
        return $items;
    }
	
	public function GetOtherCategory() {
       	$this->db->where('status', 1);		
		$query = $this->db->get("tbl_product_category");
				
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

	public function uniqueSlug($slug, $id) {
		$this->db->where('id !=', $id);
		$this->db->where('slug', $slug);
		$query = $this->db->get("tbl_product_category");
		if ($query->num_rows() > 0) {
				return "false";
		}
		return "true";
	}
}