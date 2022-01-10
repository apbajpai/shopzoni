<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_Excel extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
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
		$data['heading']='Upload Excel'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		
		/*$this->excel_reader->read('public/uploads/upload_excel/product_excel.xls');
		$worksheet = $this->excel_reader->worksheets[0];
		$worksheet = $this->excel_reader->sheets[0];

		echo "TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT";
		echo "<pre>";
		print_r($worksheet);
		echo "</pre>";
		exit; */ 
		
		//$this->load->view('admin/product', $data);
		$this->load->view('admin/excel_reader/example', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{
		echo "HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHhhh";
		if(is_numeric($param)){
			$data['heading']='Edit product'; 
			$article_id = $param;
		}else{
			$data['heading']='Add product'; 
		}
		
		if($article_id){
			$array_records = $this->product_model->GetRecordById($article_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		
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
		
		$offers = $this->offer_model->GetRecordsControl();
		$data['offers'] = $offers;
		
		$sellers = $this->seller_Registration_model->GetRecordsControl();
		$data['sellers'] = $sellers;
		
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-product', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'product_name', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
			redirect('admin/product/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->product_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->product_model->save_product_data($image);
			
			if($save){
				redirect('admin/product');
			}else{
				
			}
		}	
	}
	
}
?>