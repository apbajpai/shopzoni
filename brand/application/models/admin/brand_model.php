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
		$this->db->like('name', $name);
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
		//$this->db->where('name', $name);
		$this->db->like('name', $name);
		$this->db->order_by('id DESC');
		//$this->db->limit($limit,$start);
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
	
	public function GetRecordsControl() {
		$this->db->where('status', 1);		
		$this->db->order_by('name ASC');
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
	
	public function GetRecordByName($name) {
        $this->db->where('name', $name);
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
		$owner = $this->input->post('owner');
		$contact_person = $this->input->post('contact_person');
		$phone = $this->input->post('phone');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$website = $this->input->post('website');
		$communication_address = $this->input->post('communication_address');
		$registered_office = $this->input->post('registered_office');
		$customer_care_number = $this->input->post('customer_care_number');
		$email_feedback = $this->input->post('email_feedback');
		$chk = $this->input->post('chk');		
		$meta_title = $this->input->post('meta_title');
		$meta_description = $this->input->post('meta_description');
		$meta_keywords = $this->input->post('meta_keywords');
		$seo_canonical = $this->input->post('seo_canonical');
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		
		if($id=="" || $id==0){
			$res = $this->GetRecordByName($name);
		}
		
		if($res==0){
		
		$data = array(
					'name'=>$name,
					'owner'=>$owner,
					'contact_person'=>$contact_person,
					'phone'=>$phone,
					'mobile'=>$mobile,
					'email'=>$email,
					'website'=>$website,
					'communication_address'=>$communication_address,
					'registered_office'=>$registered_office,
					'customer_care_number'=>$customer_care_number,
					'email_feedback'=>$email_feedback,
					'image'=>$image,
					//'slug'=>$slug,
					'meta_title'=>$meta_title,
					'meta_description'=>$meta_description,
					'meta_keywords'=>$meta_keywords,
					'seo_canonical'=>$seo_canonical,
					'status'=>$status,
					'association_status'=>1,
					'created_by'=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');		
			$data['code'] = GetCode($name, $id);			
			$data['slug'] = GetSlugnew($name, $id, 'tbl_brand');	
			$this->db->where('id', $id);
			$this->db->update('tbl_brand', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_brand',$data); 
			$id = $this->db->insert_id();
			$data['code'] = GetCode($name, $id);	
			$data['slug'] = GetSlugnew($name, $id, 'tbl_brand');
			$this->db->where('id', $id);
			$this->db->update('tbl_brand', $data); 
		}
		
		$this->db->where('brand_id', $id);
		$data1['date_modified']=date('Y-m-d H:i:s');
		$data1['status']=0;
		$this->db->update('tbl_brand_department_map', $data1);
		
		foreach($chk as $department_id){
			$record = $this->GetMappedDepartmentByDepartmentIDandBrandId($department_id,$id);
			if($record->id==""){
				$data2 = array(
						'department_id'=>$department_id,
						'brand_id'=>$id,
						'status'=>1
						);
				$data2['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_brand_department_map',$data2);
			}else{
				$this->db->where('brand_id', $id);
				$this->db->where('department_id', $department_id);
				$data3['date_modified']=date('Y-m-d H:i:s');
				$data3['status']=1;
				$this->db->update('tbl_brand_department_map', $data3);
			}
		}
		
		return true;
		}else{
		return false;
		}
	}
	
	public function GetMappedDepartmentByDepartmentIDandBrandId($department_id,$brand_id) {
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