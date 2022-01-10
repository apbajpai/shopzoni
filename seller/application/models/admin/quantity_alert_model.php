<?php
class Quantity_Alert_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('admin/admin_model');
	}

	public function GetTotalRecord() {
			
			$sub_category_id 	= 	$this->input->post('sub_category_id');									  
			$category_id	 	=	$this->input->post('category_id');
			$brand_id		 	=	$this->input->post('brand_id');
			$name 			 	=  trim($this->input->post('name'));			
			$user_id 		 	= $this->session->userdata('adminid');
			$seller_id 		 	= $this->session->userdata('seller_id');
			$user_record 	 	= $this->admin_model->GetRecordById($user_id);
			
			$this->db->select('distinct(a.id),a.*,b.name as category_name,c.name as parent_name,d.name as sectin_name,f.name as brand_name,e.price,e.id as seller_map_id,e.status as seller_map_status');
			$this->db->from("tbl_product as a");
			$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
			$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
			$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');
			$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
			//$this->db->join('tbl_seller_product_map as g', 'e.quantity < g.minimum_quantity_alert', 'left');
			$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');
			
			$this->db->where('a.status', 1);	
			$this->db->where('b.status', 1);
			$this->db->where('c.status', 1);
			$this->db->where('d.status', 1);
			$this->db->where('e.quantity_option', '1');
			$this->db->where('e.status !=', 5);
			$this->db->where('f.status', 1);
			$this->db->where('e.quantity_alert', 1);
			//$where = "e.quantity < e.minimum_quantity_alert";
			//$this->db->where($where);
			
			if($user_record->role == 2)
			$this->db->where('e.seller_id', $seller_id);
			if($sub_category_id!="")
			$this->db->where('a.category_id',$sub_category_id);	
			
			if($category_id!="")
			$this->db->where('c.id',$category_id);	
		
			if($brand_id!="")
			$this->db->where('a.brand_id',$brand_id);
			
			//$this->db->where("(category_id = $category_id or category_id in (select id from tbl_category where parent_id = $category_id and status = 1))");
			if($name != '')
			$this->db->like('a.name', $name);		
			
			$this->db->order_by("a.id", "desc");
			$query = $this->db->get();	
			
			//echo $this->db->last_query(); 
		
			$data = array();
			if ($query->num_rows() > 0) {        
				$data = $query->result();
				return $data[0]->total=$query->num_rows();
			}        
			return 0;
    }
	
	
	
	public function GetRecords($start=0, $limit=10) {		
				
			$sub_category_id 	= 	$this->input->post('sub_category_id');									  
			$category_id		=	$this->input->post('category_id');
			$brand_id			=	$this->input->post('brand_id');
			$name 				=  trim($this->input->post('name'));			
			$user_id 			= $this->session->userdata('adminid');
			$seller_id 			= $this->session->userdata('seller_id');
			$user_record 		= $this->admin_model->GetRecordById($user_id);
			
			$this->db->select('distinct(a.id),a.*,b.name as category_name,c.name as parent_name,d.name as sectin_name,f.name as brand_name,e.price,e.id as seller_map_id,e.status as seller_map_status');
			$this->db->from("tbl_product as a");
			$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
			$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
			$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');
			$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
			//$this->db->join('tbl_seller_product_map as g', 'e.quantity < e.minimum_quantity_alert', 'left');
			$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');
			
			$this->db->where('a.status', 1);	
			$this->db->where('b.status', 1);
			$this->db->where('c.status', 1);
			$this->db->where('d.status', 1);
			$this->db->where('e.status !=', 5);
			$this->db->where('e.quantity_option', '1');
			$this->db->where('f.status', 1);
			$this->db->where('e.quantity_alert', 1);
			//$where = "e.quantity < e.minimum_quantity_alert";
			//$this->db->where($where);
			
			if($user_record->role == 2)
			$this->db->where('e.seller_id', $seller_id);
			if($sub_category_id!="")
			$this->db->where('a.category_id',$sub_category_id);	
			
			if($category_id!="")
			$this->db->where('c.id',$category_id);	
		
			if($brand_id!="")
			$this->db->where('a.brand_id',$brand_id);
			
			//$this->db->where("(category_id = $category_id or category_id in (select id from tbl_category where parent_id = $category_id and status = 1))");
			if($name != '')
			$this->db->like('a.name', $name);
			
			$this->db->limit($limit,$start);
			$this->db->order_by("a.id", "desc");
			$query = $this->db->get();	
			
			//echo $this->db->last_query(); 
		
			$data = array();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$row->image = $this->GetImageByProductID($row->id);
					$row->packet = $this->GetSellerPacketByProductID($seller_id,$row->id);
					$data[] = $row;
				}
				return $data;
			}
			return false;
    }
	
	
	public function GetRecordById($id) { 		
		$this->db->select('a.id as product_id,a.name,a.model_no,b.*,c.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'a.id = b.product_id', 'left');
		$this->db->join('tbl_brand as c', 'c.id = a.brand_id', 'left');
		$this->db->where('b.id', $id);
		$query = $this->db->get();	
		//echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->product_id);
				$row->packet = $this->GetPacketByProductID($row->product_id);
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function save_product_data($image=null) {
		$id = $this->input->post('id');
		$seller_id = $this->input->post('seller_id');
		$name = $this->input->post('name');
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
		//$mrp = $this->input->post('mrp');
		//$discount = $this->input->post('discount');
		//$offer_code = $this->input->post('offer_code');
		$offer = $this->input->post('offer');
		$status = $this->input->post('status');



		$created_by = $this->session->userdata('adminid');
		$seller_id = $this->session->userdata('seller_id');
		$date_published = $this->input->post('date_published');		
		
		if($sub_category_id!=''){
			$category_id = $sub_category_id;
		}
		
		$data = array(
					'seller_id'=>$seller_id,					
					'name'=>$name,	
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
					'quantity_option'=>$quantity_option,	
					'minimum_quantity_alert'=>$minimum_quantity_alert,	
					'tax_category'=>$tax_category,	
					'price'=>$price,	
					//'mrp'=>$mrp,	
					//'discount'=>$discount,	
					//'offer_code'=>$offer_code,
					'offer'=>$offer,
					'seller_id'=>$seller_id,
					'created_by'=>$created_by,
					'added_by'=>2,
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
	}
	
	public function save_product_data1() {
		$product_id = $this->input->post('product_id');	
		$id = $this->input->post('id');	
		$quantity = $this->input->post('quantity');
		$quantity_option = $this->input->post('quantity_option'); 
		$minimum_quantity_alert = $this->input->post('minimum_quantity_alert');
		$price = $this->input->post('price');		
		$offer = $this->input->post('offer');
		$status = $this->input->post('status');
		
		$seller_id = $this->session->userdata('seller_id');
		$date_published = $this->input->post('date_published');		
		if($quantity_option==1 && $quantity==0){
			$status = 0;
		}
		
		$packet_id = $this->input->post('packet_id');		
		$packet_ids = $this->input->post('packet_ids');
		
		$pkt_quantity_option = $this->input->post('pkt_quantity_option');	
		$pkt_quantity = $this->input->post('pkt_quantity');	
		$pkt_minimum_quantity_alert = $this->input->post('pkt_minimum_quantity_alert');	
		$pkt_price = $this->input->post('pkt_price');	
		
		$data_pkt['status'] = 0;				
		$this->db->where('seller_id', $seller_id);
		$this->db->where('product_id', $product_id);				
		$this->db->update('tbl_seller_packet_map', $data_pkt);
		
		foreach($packet_ids as $key=>$pkt_id){	
			if($pkt_quantity_option[$key]==NULL || $pkt_quantity_option[$key]==""){
					$pkt_quantity_option[$key]=0;
			}
			$data_pkt['seller_id'] = $seller_id;
			$data_pkt['product_id'] = $product_id;
			$data_pkt['packet_id'] = $pkt_id;
			$data_pkt['quantity_option'] = $pkt_quantity_option[$key];
			$data_pkt['quantity'] = $pkt_quantity[$key];
			$data_pkt['minimum_quantity_alert'] = $pkt_minimum_quantity_alert[$key];
			$data_pkt['price'] = $pkt_price[$key];

			if($pkt_quantity_option[$key] ==1){
				if($pkt_quantity[$key]>$pkt_minimum_quantity_alert[$key]){
					if($data['quantity_alert']!=1)
					$data['quantity_alert'] = '0';
				}else{				
					$data['quantity_alert'] = '1';
				}
			}
				
			if(in_array($pkt_id,$packet_id)){
				$data_pkt['status'] = 1;
			}else{
				$data_pkt['status'] = 0;
			}			
			if($seller_id!=""){
				$packet_availability = $this->checkPacketExist($seller_id,$product_id,$pkt_id); 		
				if($packet_availability>0){
					//$data_pkt['status'] = 1;
					$data_pkt['date_modified']=date('Y-m-d H:i:s');
					$this->db->where('seller_id', $seller_id);
					$this->db->where('product_id', $product_id);
					$this->db->where('packet_id', $pkt_id);
					$this->db->update('tbl_seller_packet_map', $data_pkt);				
					//echo $this->db->last_query(); 				
				}else{
					//$data_pkt['status'] = 1;
					$data_pkt['date_created'] = date('Y-m-d H:i:s');
					$this->db->insert('tbl_seller_packet_map',$data_pkt);
					//echo $this->db->last_query();
					//$id = $this->db->insert_id();
				} 
			}
		} 
		
		$data = array(
					'quantity'=>$quantity,	
					'quantity_option'=>$quantity_option,	
					'minimum_quantity_alert'=>$minimum_quantity_alert,	
					'price'=>$price,					
					'offer'=>$offer,
					'quantity'=>$quantity,
					'seller_id'=>$seller_id,
					'status'=>$status
				);
		
		if($quantity_option==1){
			if($quantity>$minimum_quantity_alert){
				$data['quantity_alert'] = '0';
			}else{
				$data['quantity_alert'] = '1';
			}
		}
		
		if($id)			
		{			
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_product_map', $data); 
		}		
		//echo $this->db->last_query(); exit;
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
	
		$this->db->select('a.*,d.name as category_name,b.name as sub_category_name,c.id as section_id,c.name as section_name,e.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'b.id = a.category_id', 'left');
		$this->db->join('tbl_category as d', 'd.id = b.parent_id', 'left');
		$this->db->join('tbl_section as c', 'c.id = b.section_id', 'left');
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id', 'left');
		
		$seller_id = $this->session->userdata('seller_id');
		//$section_id = $this->input->post('section_id');
		//$category_id = $this->input->post('category_id');
	
        //$this->db->where('a.section_id', $section_id);
		//$this->db->where('a.category_id', $sub_category_id);
		$this->db->where('a.seller_id', $seller_id);
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
		$seller_id = $this->session->userdata('seller_id');
		foreach($price_arr as $key=>$price){		
			$data['price'] = $price;
			//$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $key);
			$this->db->where('seller_id', $seller_id);
			$this->db->update('tbl_seller_product_map', $data); 
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
	
	public function GetSellerBrand111() { 	
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('distinct(a.name),a.*');
		$this->db->from("tbl_brand as a");
		$this->db->join('tbl_product as b', 'b.brand_id = a.id', 'left');
		$this->db->join('tbl_seller_product_map as c', 'b.id = c.product_id', 'left');		
		
		if($user_record->role == 2)
		$this->db->where('c.seller_id', $seller_id);
		$this->db->where('a.status', 1);
		
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
	
	public function GetSellerBrand() { 	
				
		$user_id = $this->session->userdata('adminid');
		$seller_id = $this->session->userdata('seller_id');
		$user_record = $this->admin_model->GetRecordById($user_id);
		
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
		$this->db->where('e.status !=', 5);
		$this->db->where('f.status', 1);
		
		if($user_record->role == 2)
		$this->db->where('e.seller_id', $seller_id);
		$this->db->order_by("f.name", "asc");
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
	
	public function GetSellerPacketByProductID($seller_id,$product_id) {

		$this->db->select('a.*,b.weight,b.unit,b.mrp,b.id as pocket_id');
		$this->db->from("tbl_seller_packet_map as a");
		$this->db->join('tbl_packet as b', 'b.id = a.packet_id', 'left');
		
		$this->db->where('a.status', 1);		
		$this->db->where('a.product_id', $product_id);	
		if($seller_id)
		$this->db->where('a.seller_id', $seller_id);	
		
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
	
	public function GetPacketByProductID($product_id) {
		$this->db->where('status', 1);		
		$this->db->where('product_id', $product_id);	
        $query = $this->db->get("tbl_packet");	
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
	
	public function checkPacketExist($seller_id,$product_id,$packet_id) {
		//$this->db->where('status', 1);		
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('product_id', $product_id);	
		$this->db->where('packet_id', $packet_id);	
        $query = $this->db->get("tbl_seller_packet_map");	
		//echo $this->db->last_query(); 
        return $query->num_rows();
    }
	
	public function totalUnreadQuantityAlert() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$this->db->where('quantity_alert', 1);
		$query = $this->db->get("tbl_seller_product_map");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
	
}