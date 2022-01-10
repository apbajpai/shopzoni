<?php
class MY_Controller extends CI_Controller {
  public function __construct(){
    parent::__construct();	
  }
  
  function action($act, $id, $act_val = ''){
		$module = $this->uri->segment(2);
		switch($module){
			case 'category':
			$tableName = 'tbl_category';
			break;
			case 'article':
			$tableName = 'tbl_article';
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
			case 'author':
			$tableName = 'tbl_author';
			break;
			case 'admin':
			$tableName = 'tbl_admin';
			break;
			case 'website_user':
			$tableName = 'tbl_user';
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