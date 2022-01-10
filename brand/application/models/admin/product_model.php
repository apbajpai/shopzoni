<?php
class Product_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecordold() {

		$this->db->select('count(*) as total');			
		$name 					= $this->input->post('name');
			
		if($name != '')
		$this->db->where('name', $name);		
				
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product"); 
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	
	public function GetTotalRecord() {
		$this->db->select('a.*,b.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');
		$brand_id = $this->session->userdata('brand_id');
		$this->db->where('a.brand_id', $brand_id);	
		$this->db->where('a.status !=', 5);	
		
		$name 	=  trim($this->input->post('name'));		
		/*$filters = array('@^[\t\s]+@', '@[\t\s]+$@', '@[\t\s]+@');
		$filtered = array('', '', '-');
		$new_name = preg_replace($filters, $filtered, $name); */
		$new_name1 = explode(' \ ',$name);
		
		if($new_name1[0])
		$this->db->like('a.name', $new_name1[0]);

		$brand_id 	=  trim($this->input->post('brand_id'));
		if($name)
		$this->db->where('a.brand_id', $brand_id);
		
		//$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {            
			return $query->num_rows();
        }        
		return 0;
    }	
	
	public function GetRecords($start=0, $limit=10) {							
		$this->db->select('a.*,b.name as brand_name,c.name as sub_category_name,d.name as category_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');	
		$this->db->join('tbl_category as c', 'a.category_id = c.id', 'left');	
		$this->db->join('tbl_category as d', 'c.parent_id = d.id', 'left');	
		$brand_id = $this->session->userdata('brand_id');
		$this->db->where('a.brand_id', $brand_id);	
		$this->db->where('a.status !=', 5);		
		
		$name 	=  trim($this->input->post('name'));		
		/*$filters = array('@^[\t\s]+@', '@[\t\s]+$@', '@[\t\s]+@');
		$filtered = array('', '', '-');
		$new_name = preg_replace($filters, $filtered, $name); */
		$new_name1 = explode(' \ ',$name);
		
		if($new_name1[0])
		$this->db->like('a.name', $new_name1[0]);	

		$brand_id 	=  trim($this->input->post('brand_id'));
		if($brand_id)
		$this->db->where('a.brand_id', $brand_id);
		
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); 
	
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$data[] = $row;
			}
			return $data;
		}
		return false;
    }
	
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
				$query = $this->db->get("tbl_product");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByModelNo($model_no) {
        $this->db->where('model_no', $model_no);
		$query = $this->db->get("tbl_product");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_product_data($image=null) {
		$id = $this->input->post('id');		
		$name = $this->input->post('name');	
		$model_no = $this->input->post('model_no');	
		$brand_id = $this->session->userdata('brand_id');
		$category_id = $this->input->post('category_id');
		$sub_category_id = $this->input->post('sub_category_id');
		$section_id = $this->input->post('section_id');
		$manufacturer = $this->input->post('manufacturer');
		$color = $this->input->post('color');
		$short_description = $this->input->post('short_description');
		$description = $this->input->post('description');
		$unit = $this->input->post('unit');
		$weight = $this->input->post('weight');
		$size = $this->input->post('size');
		$quantity = $this->input->post('quantity');
		$quantity_option = $this->input->post('quantity_option'); 
		$minimum_quantity_alert = $this->input->post('minimum_quantity_alert');
		$tax_category = $this->input->post('tax_category');
		$price = $this->input->post('price');
		$mrp = $this->input->post('mrp');
		$meta_title = $this->input->post('meta_title');
		$meta_description = $this->input->post('meta_description');
		$meta_keywords = $this->input->post('meta_keywords');
		$seo_canonical = $this->input->post('seo_canonical');
		//$discount = $this->input->post('discount');
		//$offer_code = $this->input->post('offer_code');
		$offer = $this->input->post('offer');
		$status = $this->input->post('status');



		$created_by = $this->session->userdata('adminid');
		$date_published = $this->input->post('date_published');	
		
		if($id=="" || $id==0){
			$res = $this->GetRecordByModelNo($model_no);
		}
		
		if($sub_category_id!=''){
			$category_id = $sub_category_id;
		}
		
		
		if($res->id == ""){
		$data = array(									
					'name'=>$name,
					'model_no'=>$model_no,
					'section_id'=>$section_id,
					'category_id'=>$category_id,
					'brand_id'=>$brand_id,						
					'manufacturer'=>$manufacturer,	
					'color'=>$color,	
					'short_description'=>$short_description,	
					'description'=>$description,	
					'unit'=>$unit,	
					'weight'=>$weight,	
					'size'=>$size,					
					'tax_category'=>$tax_category,					
					'mrp'=>$mrp,	
					'meta_title'=>$meta_title,
					'meta_description'=>$meta_description,
					'meta_keywords'=>$meta_keywords,
					'seo_canonical'=>$seo_canonical,
					//'discount'=>$discount,						
					'created_by'=>$created_by,					
					'status'=>$status
				);
				
			/* echo "<pre>";
			print_r($data);
			echo "</pre>"; exit; */
				
		if($id)			
		{
			/*if(!preg_match("/^[_a-z0-9-]+-[0-9]+$/", $data['slug'])) {
			  $data['slug'] = GetSlug($title, $id);
			}*/
			//$data['slug'] = GetSlugTitle($title, $id);		
					
			$data['date_modified']=date('Y-m-d H:i:s');
			$data['code'] = GetCode($name, $id);
			$this->db->where('id', $id);
			$this->db->update('tbl_product', $data); 
		}
		else
		{
			//$data['slug'] = '';
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_product',$data); 			
			$id = $this->db->insert_id();
			
			//$data['slug'] = GetSlugTitle($title, $id);
			//$data['slug'] = GetSlugnew($title, $id, 'tbl_product');
			$data['code'] = GetCode($name, $id);
			$this->db->where('id', $id);
			$this->db->update('tbl_product', $data);			
		}
			return true;
		}else{
			return false;
		}
		
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

	
	
	public function GetAutoSuggestRecords($key) {
			$this->db->where('status !=', 5);			
			$this->db->like('title',"$key");
				
		$this->db->limit(10,0);
		$this->db->order_by("id", "desc");
        $query = $this->db->get("tbl_product");	
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
	
	public function GetExcelProduct() {
	
		$this->db->select('a.*,e.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id', 'left');
		$this->db->where('a.status !=', 5);
		
		$query = $this->db->get();
		//$query = $this->db->get("tbl_product");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function updateProductPrice(){
		$price_arr = $this->input->post('price');
		foreach($price_arr as $key=>$price){		
			$data['price'] = $price;
			//$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $key);
			$this->db->update('tbl_product', $data); 
			//echo $this->db->last_query();
		}
		return true;
	}
	
	public function GetImageByProductID($product_id) {
		$this->db->where('status', 1);		
		$this->db->where('product_id', $product_id);	
        $query = $this->db->get("tbl_image");	
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
	
}