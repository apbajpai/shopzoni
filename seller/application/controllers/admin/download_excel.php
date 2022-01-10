<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_Excel extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/product_category_model');
		$this->load->model('admin/brand_model');
		$this->load->model('admin/section_model');
		$this->load->model('admin/product_model');
		$this->check_isvalidated();
	}	
	
	public function index($page_no)
	{
		$this->page($page_no);
	}	
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('admin/login');
        }
    }	
		
	public function page($page_no)
	{
		$data['heading']='Download Excel'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');	
						
		$category = $this->product_category_model->GetParentRecordsControl();		
		$data['category'] = $category;
		
		//category parent id
		$parent_id = $this->db->query("select parent_id from tbl_product_category where id = '".$array_records->category_id."'")->row()->parent_id;
		$data['parent_id'] = $parent_id;
		if($parent_id != 0){
			$sub_category = $this->product_category_model->GetChildRecordsControl($parent_id);
			$data['sub_category'] = $sub_category;
		}
		
		$brands = $this->brand_model->GetRecordsControl();
		$data['brands'] = $brands;
				
		$sections = $this->section_model->GetRecordsControl();
		$data['sections'] = $sections;
				
			
		$this->load->view('admin/download_excel', $data);
		$this->load->view('admin/footer');
	}	

	public function download()
	{	
		$product_record = $this->product_model->GetExcelProduct();
		$data['product_record'] = $product_record;
		
		/*echo "<pre>";
		print_r($product_record);
		echo "</pre>"; exit;  */
		
		
		//$data['heading']='Download Excel'; 
		//$this->load->view('admin/header', $data);		
		//$this->load->view('admin/sidebar');	
		$this->load->view('admin/product_excel', $data);
		//$this->load->view('admin/footer');
	}
}
?>