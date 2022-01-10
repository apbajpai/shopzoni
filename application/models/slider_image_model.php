<?php
class Slider_Image_model extends CI_Model {
    
	private $path = 'public/uploads/home_slider_image/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status', 1);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_home_slider_image");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function Getsmall_banner_image($start=0, $limit=10) {
		$this->db->where('status', 1);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_slider_product_image");
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
	
	public function GetBrand_banner_image($start=0, $limit=10) {
		$this->db->where('status', 1);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_slider_brand_image");
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