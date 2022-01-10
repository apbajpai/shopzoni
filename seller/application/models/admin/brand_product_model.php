<?php
class Brand_product_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function GetTotalRecordold_21092016($brand_id="") {
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$name = trim($this->input->post('name'));
		if($name != '')
		$this->db->like('name', $name);
		$brand_id1 = $this->input->post('brand_id');
		if($brand_id1!="")
		$brand_id = $brand_id1;
		
		if($brand_id != '')
		$this->db->where('brand_id', $brand_id);
				
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
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$name = trim($this->input->post('name'));
		if($name != '')
		$this->db->like('a.name', $name);
		
		$brand_id1 = $this->input->post('brand_id');
		if($brand_id1!="")
		$brand_id = $brand_id1;		
		
		if($brand_id != '')
		$this->db->where('a.brand_id', $brand_id);
		
		$query = $this->db->get();	
			
			//echo $this->db->last_query(); 
		
			$data = array();
			if ($query->num_rows() > 0) {        
				$data = $query->result();
				return $data[0]->total=$query->num_rows();
			}        
			return 0;
    }
	
	
	public function GetRecords($brand_id="",$start=0, $limit=10) {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('a.*,b.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$name = trim($this->input->post('name'));
		if($name != '')
		$this->db->like('a.name', $name);
		
		$brand_id1 = $this->input->post('brand_id');
		if($brand_id1!="")
		$brand_id = $brand_id1;		
		
		if($brand_id != '')
		$this->db->where('a.brand_id', $brand_id);
		
		//if($brand_id=="" && $name=="")
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); 
	
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$row->seller_product_map = $this->check_sell_yours_data($row->id,$seller_id);
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
	
	public function sell_yours() {
		$product_id =$this->input->post('product_id');
		$product = $this->brand_product_model->GetRecordById($product_id);
		$category = $this->category_model->GetRecordById($product->category_id);
		
		$category_id = $category->id;
		$seller_id = $this->session->userdata('seller_id');
		
		$sell_your_data = $this->check_sell_yours_data($product_id,$seller_id);
		if($sell_your_data->id==""){
			$data = array(					
					'product_id'=>$product_id,					
					'seller_id'=>$seller_id,
					'status'=>0,
					);		
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_seller_product_map',$data);

			$sub_cat_map_data = $this->GetSubCategoryMapBySellerIDandCategoryID($seller_id,$category_id);
			if($sub_cat_map_data->id==''){
				$data1 = array(					
						'category_id'=>$category_id,					
						'seller_id'=>$seller_id,
						'status'=>1,
						);		
				$data1['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_seller_sub_category_map',$data1);
			}			
			//echo $this->db->last_query();
			return true;
		}else{
			return "false";
		}
	}
	
	
	public function check_sell_yours_data($product_id,$seller_id) {
        $this->db->where('product_id', $product_id);
		$this->db->where('seller_id', $seller_id);
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_seller_product_map");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function uniqueCategory($name, $parent_id) {			
		$this->db->where('name', $name);
		$this->db->where('parent_id', $parent_id);
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_category");
		//echo $this->db->last_query(); exit;
		if ($query->num_rows() > 0) {
				return "false";
		}
		return "true";
	}
	
	public function getCategoryByName($name, $parent_id) {			
		$this->db->where('name', $name);
		$this->db->where('parent_id', $parent_id);
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_category");
		//echo $this->db->last_query(); exit;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row;
			}
			return $data;
		}
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
	
	
	public function GetSubCategoryMapBySellerIDandCategoryID($seller_id,$category_id) {
		$this->db->where('status', 1);		
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('category_id', $category_id);
        $query = $this->db->get("tbl_seller_sub_category_map");	
		//echo $this->db->last_query(); 
        $data = array();
			if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$data = $row;
            }
            return $data;
        }
        return false;
    }
	

	
}