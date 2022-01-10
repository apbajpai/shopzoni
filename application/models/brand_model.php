<?php
class Brand_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	
	public function GetRecords_22_08_2017($brand_name='',$start=0, $limit=10) {
		$this->db->where('status', 1);
		$name	=	$this->input->post('brand_name');
		if($name != '')
		$this->db->like('name', $name,'after');
		
		if($brand_name=='0-9'){
			$this->db->like('name', '0','after');
			$this->db->or_like('name', '1','after');
			$this->db->or_like('name', '2','after');
			$this->db->or_like('name', '3','after');
			$this->db->or_like('name', '4','after');
			$this->db->or_like('name', '5','after');
			$this->db->or_like('name', '6','after');
			$this->db->or_like('name', '7','after');
			$this->db->or_like('name', '8','after');
			$this->db->or_like('name', '9','after');
		}else{		
			if($brand_name != '')
			$this->db->like('name', $brand_name,'after');
		}
		$this->db->order_by('id DESC');
		//$this->db->limit($limit,$start);
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
	
	
	public function GetRecords($brand_name='',$start=0, $limit=10) {		
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
		
		$name	=	$this->input->post('brand_name');
		if($name != '')
		$this->db->like('f.name', $name,'after');
		
		if($brand_name=='0-9'){
			$this->db->like('f.name', '0','after');
			$this->db->or_like('f.name', '1','after');
			$this->db->or_like('f.name', '2','after');
			$this->db->or_like('f.name', '3','after');
			$this->db->or_like('f.name', '4','after');
			$this->db->or_like('f.name', '5','after');
			$this->db->or_like('f.name', '6','after');
			$this->db->or_like('f.name', '7','after');
			$this->db->or_like('f.name', '8','after');
			$this->db->or_like('f.name', '9','after');
		}else{		
			if($brand_name != '')
			$this->db->like('f.name', $brand_name,'after');
		}
		$this->db->order_by('f.id DESC');		
		
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
	
	
	public function GetRecordBySlug($slug) {
        $this->db->where('slug', $slug);
		$query = $this->db->get("tbl_brand");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetServiceCenterBybrandId($brand_id) {		
		$this->db->select('a.*,b.state_name,c.district_name,d.pincode');
		$this->db->from("tbl_service_center as a");
		$this->db->join('tbl_state_master as b', 'a.state_id = b.id', 'left');
		$this->db->join('tbl_district_master as c', 'a.city_id = c.id', 'left');
		$this->db->join('tbl_pincode_master as d', 'a.pincode_id = d.id', 'left');
	
		$this->db->where('a.status', 1);		
		$this->db->where('a.brand_id', $brand_id);		
		$this->db->order_by('a.id DESC');		
		$query = $this->db->get();	
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
	
	public function GetRecordsByDepartment_24_10_2020($department_ids){							
		$this->db->select('distinct(a.id),a.name,a.image,b.status,a.slug');
		$this->db->from("tbl_brand as a");
		$this->db->join('tbl_brand_department_map as b', 'b.brand_id  = a.id', 'left');	
		$this->db->join('tbl_product as c', 'c.brand_id = a.id','right');
		
		$this->db->where_in('b.department_id', $department_ids);
		$this->db->where('a.status', 1);	
		$this->db->where('b.status', 1);	
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); exit;
	
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
    }
	
	public function GetRecordsByDepartment($department_ids){
		$this->db->select('distinct(f.name),f.*');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');
		$this->db->join('tbl_brand_department_map as g', 'g.brand_id  = f.id', 'left');	
		$this->db->where_in('g.department_id', $department_ids);
		
		$this->db->where('a.status', 1);	
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status',1);
		$this->db->where('f.status', 1);
			
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); exit;
	
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