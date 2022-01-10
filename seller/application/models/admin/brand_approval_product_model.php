<?php
class Brand_Approval_Product_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {
		$this->db->select('count(*) as total');	
		$this->db->where('status', 2);
		$name = $this->input->post('name');
		if($name != '')
		$this->db->like('product_name', $name);
		$brand_id = $this->input->post('brand_id');
		if($brand_id != '')
		$this->db->where('brand_id', $brand_id);
				
        $query = $this->db->get("tbl_brand_product");	
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total=$query->num_rows();
        }        
		return 0;
    }
	
	
	public function GetRecords($start=0,$limit=10) {		
		$this->db->select('a.*,b.name as brand_name');
		$this->db->from("tbl_brand_product as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');
		
		$this->db->where('a.status', 2);
		$name = $this->input->post('name');
		if($name != '')
		$this->db->like('a.product_name', $name);
		
		$brand_id = $this->input->post('brand_id');
		if($brand_id != '')
		$this->db->where('brand_id', $brand_id);
		
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
			$query = $this->db->get("tbl_brand_product");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }	
	
	public function save_brand_product_data($image=null) {
		$id = $this->input->post('id');
		$seller_product_id = $this->input->post('seller_product_id');
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
		$quantity_option = $this->input->post('quantity_option'); 
		$minimum_quantity_alert = $this->input->post('minimum_quantity_alert');
		$tax_category = $this->input->post('tax_category');
		$price = $this->input->post('price');
		$mrp = $this->input->post('mrp');
		//$discount = $this->input->post('discount');
		//$offer_code = $this->input->post('offer_code');
		$offer = $this->input->post('offer');
		$status = $this->input->post('status');



		$created_by = $this->session->userdata('adminid');
		//$seller_id = $this->session->userdata('seller_id');
		$date_published = $this->input->post('date_published');		
		
		if($sub_category_id!=''){
			$category_id = $sub_category_id;
		}
		
		$data = array(									
					'product_name'=>$product_name,	
					'image'=>$image,	
					'category_id'=>$category_id,	
					'section_id'=>$section_id,	
					//'brand_id'=>$brand_id,	
					'manufacturer'=>$manufacturer,	
					'color'=>$color,	
					'short_description'=>$short_description,	
					'description'=>$description,	
					'unit'=>$unit,	
					'weight'=>$weight,	
					'size'=>$size,	
					'quantity'=>$quantity,	
					'quantity_option'=>$quantity_option,	
					'minimum_quantity_alert'=>$minimum_quantity_alert,	
					'tax_category'=>$tax_category,	
					'price'=>$price,	
					'mrp'=>$mrp,	
					//'discount'=>$discount,	
					//'offer_code'=>$offer_code,
					'offer'=>$offer,					
					'created_by'=>$created_by,					
					'status'=>1
				);
				
			$data2 = $data;
				
		    /*echo "<pre>";
			print_r($data);
			echo "</pre>"; exit; */
				
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$data['code'] = GetCode($product_name, $id);
			//$data['seller_id'] = $seller_id;
			$data['sell_yours'] = 0;
			$this->db->where('id', $seller_product_id);
			$this->db->update('tbl_product', $data); 
			
			//echo $this->db->last_query(); exit;
			
			$data2['date_modified']=date('Y-m-d H:i:s');
			$data2['code'] = GetCode($product_name, $id);
			$data2['status'] = 1;
			$this->db->where('id', $id);
			$this->db->update('tbl_brand_product', $data2);
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_product',$data); 
			$id = $this->db->insert_id();
			
			$data['code'] = GetCode($product_name, $id);
			//$data['seller_id'] = $seller_id;
			$data['sell_yours'] = 0;
			$this->db->where('id', $id);
			$this->db->update('tbl_product', $data);
			
			$data2['seller_product_id'] = $id;
			$this->db->insert('tbl_brand_product',$data2); 
			$id = $this->db->insert_id();
			
			$data2['code'] = GetCode($product_name, $id);
			$data2['status'] = 2;
			$this->db->where('id', $id);
			$this->db->update('tbl_brand_product', $data2);
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