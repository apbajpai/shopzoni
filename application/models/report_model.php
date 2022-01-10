<?php
class Report_model extends CI_Model {
    
	private $path = 'public/uploads/report/';
    
	function __construct(){
		parent::__construct();
		session_start();
		$this->load->database();
	}	
	
	public function GetTotalRecord($category_id,$title='',$type='') {
		//$title = urldecode($title);
		//str_replace("~","Peter",$title);
		
		
		$this->db->select('a.*,b.name as category_name,b.slug as subcategory_slug,c.name as parent_name,c.slug as category_slug,d.slug as section_slug,e.slug as section_slug1');
		$this->db->from("tbl_report as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');	
		$this->db->join('tbl_section as d', 'b.section_id = d.id', 'left');	
		$this->db->join('tbl_section as e', 'c.section_id = d.id', 'left');	
		
		$this->db->where('a.status', 1);		
		$this->db->where('b.status', 1);
		
		if($category_id)
		$this->db->where('a.category_id', $category_id);
		
		if($title)
		$this->db->like('a.title',"$title");
	
		if($type)
		$this->db->where('a.type', $type);
		
		if($category_ids[0]!=''){
			$this->db->where_in('a.category_id',$category_ids);
		} 
		//if($limit)
		//$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
        $data = array();
		if ($query->num_rows() > 0) {
            return $query->num_rows;
        }
        return $query->num_rows;  
    }
	
	public function GetRecords($category_id,$title='',$limit=10,$start=0,$type='') {
		//$title = urldecode($title);
		//str_replace("~","Peter",$title);
		//echo 'TTTT'.$type.'SSS'; 
		
		$this->db->select('a.*,b.name as category_name,b.slug as subcategory_slug,c.name as parent_name,c.slug as category_slug,d.slug as section_slug,e.slug as section_slug1');
		$this->db->from("tbl_report as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');	
		$this->db->join('tbl_section as d', 'b.section_id = d.id', 'left');	
		$this->db->join('tbl_section as e', 'c.section_id = d.id', 'left');	
		
		$this->db->where('a.status', 1);		
		$this->db->where('b.status', 1);
		
		if($category_id)
		$this->db->where('a.category_id', $category_id);
		
		if($title)
		$this->db->like('a.title',"$title");
	
		if($type)
		$this->db->where('a.type', $type);
		
		if($category_ids[0]!=''){
			$this->db->where_in('a.category_id',$category_ids);
		} 
		if($limit)
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		/*echo "<!---";
		echo $this->db->last_query(); 
		echo "--->"; */
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByReportID($row->id);
				$data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function getRecordById($product_id){
		$this->db->select('a.*,b.name as category_name,c.name as parent_name,b.slug as category_slug');
		$this->db->from("tbl_report as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		
		$this->db->where('a.id', $product_id);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByReportID($row->id);
				$data = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function GetRecordsBySlug($cat_slug,$slug){
		$this->db->select('a.*,b.name as category_name,c.name as parent_name,b.slug as category_slug');
		$this->db->from("tbl_report as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		
		$this->db->where('a.slug', $slug);	
		$this->db->where('b.slug', $cat_slug);	
		$query = $this->db->get();	
		//echo $this->db->last_query();	
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByReportID($row->id);
				$data = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function addtocart(){
		$user_licence = $this->input->post('user_licence');	
		$report_id = $this->input->post('report_id');	
		$buyer_id = $this->session->userdata('user_id');
		$session_id = session_id();
		switch ($user_licence) {
			case 1:
				$amount = $this->input->post('amount1');	
				break;
			case 2:
				$amount = $this->input->post('amount2');
				break;
			case 3:
				$amount = $this->input->post('amount3');
				break;
			case 4:
				$amount = $this->input->post('amount4');
				break;
		}
		
		$currency = $this->input->post('currency');	
		$title = $this->input->post('title');	
		
		$data = array(
					'report_id'=>$report_id,
					'title'=>$title,
					'buyer_id'=>$buyer_id,
					'session_id'=>$session_id,
					'user_licence'=>$user_licence,								
					'amount'=>$amount,
					'currency'=>$currency,
					'status'=>1								
				);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_cart', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_cart',$data); 
		}
		//echo $this->db->last_query();	
		return true;
	}
	
	
	public function getCartRecord() {
		$session_id = session_id();
        /*$this->db->where('status', 1);
        $this->db->where('buyer_id ', $this->session->userdata('user_id'));
		$query = $this->db->get("tbl_cart");
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){					
                $data[] = $row;
            }
            return $data;
        }
        return false; */
		
		
		$this->db->select('a.*,b.code');
		$this->db->from("tbl_cart as a");
		$this->db->join('tbl_report as b', 'a.report_id = b.id', 'left');
			
		$this->db->where('a.status', 1);
        //$this->db->where('a.buyer_id ', $this->session->userdata('user_id'));
        $this->db->where('a.session_id', $session_id);
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
	
	public function removetocart() {
        $id = $this->input->post('cart_id');	
			
		$data = array(
					'status'=>5							
				);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$this->db->update('tbl_cart', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_cart',$data); 
		}
		//echo $this->db->last_query();	
		return true;
    }
	
	public function GetImageByReportID($report_id) {
		$this->db->where('status', 1);		
		$this->db->where('report_id', $report_id);	
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