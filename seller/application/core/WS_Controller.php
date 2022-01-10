<?php
class WS_Controller extends CI_Controller {
  public function __construct(){
    parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('category_model');
		$this->load->model('article_model');
		$this->load->model('author_model');
		$this->load->model('ads_model');
		$this->load->model('admin/job_of_the_week_model');
		$this->load->model('admin/poll_model');		
		$this->load->model('pages_model');
  }
   
  function latest_story(){
		$data['latest_article'] = $this->article_model->GetCategoryArticle('1','','3',0);
		$this->load->view('index/latest-story', $data);	
  }
  
  function website_header($seo_data=''){		
		$data['breaking_news'] = $this->article_model->GetHomeBreaking_news();
		$data['category'] = $this->category_model->GetMenuRecords();
		$data['page_title'] = 'Home';
		$data['ads_top'] = 	$this->ads_model->loadAds('top');
		$data['seo_data'] = $seo_data;		
		$data["page"] = $this->pages_model->GetPageRecordById(1);
		
		$this->load->view('common/header', $data);	
  }
  
  function website_right($additional_content = ''){		
		
		//MEDIA WATCH BRIEFS
		$widget1['media_watch_briefs'] = $this->article_model->GetHomePageArticle($type = 'home_page', $category_id = '36', $limit=3, $start=0);
		$widget.= $this->load->view('right/media-watch-briefs', $widget1, TRUE);
		
		//ads		
		$widget.= $this->load->view('right/ads1', $widget1, TRUE);
		
		//WHAT THEY ARE SAYING		
		$widget1['what_they_are_saying'] = $this->article_model->GetHomePageArticle($type = 'home_page', $category_id = '35', $limit=3, $start=0);
		$widget.= $this->load->view('right/what-they-are-saying', $widget1, TRUE);
		
		//POLL	
		$widget1['poll'] = $this->poll_model->GetRecordsFront(0,1);
		$id=$widget1['poll'][0]->id;
		$widget1['poll_option'] = $this->poll_model->GetPollOptionRecords($id);
		$widget1['total_poll'] = $this->poll_model->GetTotalPoll($id);
		$widget.= $this->load->view('right/poll', $widget1, TRUE);
		
		//ads		
		$widget.= $this->load->view('right/ads2', $widget1, TRUE);
		
		//JOB OF THE WEEK	
		$widget1['job_of_the_week'] = $this->job_of_the_week_model->GetRecordsHome(0,2);
		$widget.= $this->load->view('right/job-of-the-week', $widget1, TRUE);
		
		//THE HOOT BLOG	
		$widget1['the_hoot_blog'] = $this->article_model->GetHomePageArticle($type = 'home_page', $category_id = '38', $limit=2, $start=0);
		$widget.= $this->load->view('right/the-hoot-blog', $widget1, TRUE);		
		
		$data['widget']=$widget;
		$this->load->view('right/right', $data);
  }
  
  function website_footer(){		
		$category = $this->category_model->GetRecords();
		foreach($category as $category_data){
			$footer_category[$category_data->id] = $this->category_model->GetChildRecords($category_data->id);
		}		
		$data["page"] = $this->pages_model->GetRecords();
		
		//$data['footer_category']=$footer_category;
		//$footer_magazine = $this->footer_magazine_model->GetRecords();
		//$data['footer_magazine'] = $footer_magazine;
		$this->load->view('common/footer', $data);
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
			case 'article_image':
			$tableName = 'tbl_article_images';
			break;
			case 'author':
			$tableName = 'tbl_author';
			break;
			case 'admin':
			$tableName = 'tbl_admin';
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
			
		}
	}
	
}
?>