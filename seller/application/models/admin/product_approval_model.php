<?php
class Product_Approval_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		
				$category_id 			= ($this->input->post('sub_category_id'))? 
										  $this->input->post('sub_category_id'):
										  $this->input->post('category_id');
				$name 				= $this->input->post('name');
				$user_id = $this->session->userdata('adminid');
				$seller_id = $this->session->userdata('seller_id');
				$user_record = $this->admin_model->GetRecordById($user_id);
				
				if($user_record->role == 2)
				$this->db->where('seller_id', $seller_id);
				if($category_id!="")
				$this->db->where("(category_id = $category_id or category_id in (select id from tbl_product_category where parent_id = $category_id and status = 1))");
				if($name != '')
				$this->db->like('product_name', $name);		
				
        $query = $this->db->get("tbl_product");	
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total=$query->num_rows();
        }        
		return 0;
    }
	
	
	public function GetRecords($start=0, $limit=10) {
		
		$this->db->where('status !=', 5);
		
				$category_id 			= ($this->input->post('sub_category_id'))? 
										  $this->input->post('sub_category_id'):
										  $this->input->post('category_id');
				$name 				= $this->input->post('name');
				$user_id = $this->session->userdata('adminid');
				$seller_id = $this->session->userdata('seller_id');
				$user_record = $this->admin_model->GetRecordById($user_id);
				
				if($user_record->role == 2)
				$this->db->where('seller_id', $seller_id);
				if($category_id!="")
				$this->db->where("(category_id = $category_id or category_id in (select id from tbl_product_category where parent_id = $category_id and status = 1))");
				if($name != '')
				$this->db->like('product_name', $name);		
									
				
		$this->db->limit($limit,$start);
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
	
	public function save_product_data($image=null) {
		$id = $this->input->post('id');
		$seller_id = $this->input->post('seller_id');
		$product_name = $this->input->post('product_name');
		$category_id = $this->input->post('category_id');
		$sub_category_id = $this->input->post('sub_category_id');
		$section_id = $this->input->post('section_id');
		$brand_id = $this->input->post('brand_id');
		$manufacturer = $this->input->post('manufacturer');
		$color = $this->input->post('color');
		$short_description = $this->input->post('short_description');
		$description = $this->input->post('description');
		$unit = $this->input->post('unit');
		$weight = $this->input->post('weight');
		$size = $this->input->post('size');
		$quantity = $this->input->post('quantity');
		$minimum_quantity_alert = $this->input->post('minimum_quantity_alert');
		$tax_category = $this->input->post('tax_category');
		$price = $this->input->post('price');
		$mrp = $this->input->post('mrp');
		$discount = $this->input->post('discount');
		$offer_code = $this->input->post('offer_code');
		$status = $this->input->post('status');



		$created_by = $this->session->userdata('adminid');
		$date_published = $this->input->post('date_published');		
		
		if($sub_category_id){
			$category_id = $sub_category_id;
		}
		
		$data = array(
					'seller_id'=>$seller_id,					
					'product_name'=>$product_name,	
					'image'=>$image,	
					'category_id'=>$category_id,	
					'section_id'=>$section_id,	
					'brand_id'=>$brand_id,	
					'manufacturer'=>$manufacturer,	
					'color'=>$color,	
					'short_description'=>$short_description,	
					'description'=>$description,	
					'unit'=>$unit,	
					'weight'=>$weight,	
					'size'=>$size,	
					'quantity'=>$quantity,	
					'minimum_quantity_alert'=>$minimum_quantity_alert,	
					'tax_category'=>$tax_category,	
					'price'=>$price,	
					'mrp'=>$mrp,	
					'discount'=>$discount,	
					'offer_code'=>$offer_code,	
					'created_by'=>$created_by,					
					'status'=>$status
				);
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
	}
		
}