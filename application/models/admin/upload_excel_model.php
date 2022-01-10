<?php
class Upload_Excel_model extends CI_Model {
    
	private $path = 'public/uploads/upload_excel/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}	
	
	public function save_upload_excel_data($image=null) {
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