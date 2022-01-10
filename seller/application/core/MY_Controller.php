<?php
class MY_Controller extends CI_Controller {
  public function __construct(){
    parent::__construct();	
  }
  
  function action($act, $id, $act_val = ''){
		$module = $this->uri->segment(2);
		switch($module){
			case 'product':
			$tableName = 'tbl_seller_product_map';
			break;
			case 'product_category':
			$tableName = 'tbl_category';
			break;			
			case 'seller_registration':
			$tableName = 'tbl_seller_registration';
			break;
			case 'brand':
			$tableName = 'tbl_brand';
			break;
			case 'section':
			$tableName = 'tbl_section';
			break;
			case 'offer':
			$tableName = 'tbl_offer';
			break;
			case 'minimum_order':
			$tableName = 'tbl_minimum_order';
			break;
			case 'address_book':
			$tableName = 'buyer_request';
			break;
			case 'admin':
			$tableName = 'tbl_admin';
			break;
			case 'website_user':
			$tableName = 'tbl_user';
			break;	
			case 'buyer_request':
			$tableName = 'buyer_request';
			break;	
			case 'slider_image':
			$tableName = 'tbl_home_slider_image';
			break;
			default:
			$tableName = 'tbl_'.$module;
			break;
		}
		
		switch($act){
			case 'delete':
			$data = array('status'=>5);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
			break;
			
			case 'status':
			$data = array('status'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);			
			break;
			
			case 'menu_item':
			$data = array('menu_item'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);			
			break;
			
			case 'home_page':
			$data = array('home_page'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
			break;
			
			case 'show_home':
			$data = array('show_home'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
			break;
			
			case 'carousel':
			$data = array('carousel'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
			break;
			
			case 'thumbnail':
			$data = array('thumbnail'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
			break;
			
			case 'priority':
			$data = array('priority'=>$act_val);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
			break;
			
		}
	}	
}
?>