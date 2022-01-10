<?php
class Webpage_model extends CI_Model {
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function GetRecords() {
		$this->db->where('status !=', 5);
	    $query = $this->db->get("tbl_webpage");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordById($webpage_id) {
        $this->db->where('webpage_id', $webpage_id);
		$query = $this->db->get("tbl_webpage");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function getExtension($str){
		$i=strrpos($str,".");
		if(!$i)
		{
			return"";
		}
		$l=strlen($str)-$i;
		$ext=substr($str,$i+1,$l);
		return $ext;
	}
	
	public function upload_image()
	{		
		if($_FILES['image']['name'])
		{
			$file_extention = $this->getExtension($_FILES['image']['name']);			
			if($file_extention=='gif' || $file_extention=='jpg' || $file_extention=='jpeg' || $file_extention=='png')
			{
				$image_name = time().'.'.$file_extention;
				$tmp_name = $_FILES['image']['tmp_name'];
				$upload_file = str_replace(' ','_',$image_name);
				$path_file = $_SERVER['DOCUMENT_ROOT']."/public/uploads/staticpage/";
				@mkdir($path_file, 0777);
				$file_target = $path_file . $upload_file ;
				@move_uploaded_file($tmp_name, $file_target);
				$image = $image_name;			
				//DELETE FILE
				if($this->input->post('image_old'))
				{
					unlink($path_file.'/'.$this->input->post('image_old'));
				}			
			}else{
				$image = $this->input->post('image_old');
			}			
		}
		else
		{
			$image = $this->input->post('image_old');
		}
		return $image;	
	}	
	
	public function addEditRecords()
	{		
		$image = $this->upload_image();
		$image_alt_text = $this->input->post('image_alt_text');
		$webpage_id = $this->input->post('webpage_id');
		$title = $this->input->post('title');
		$slug = $this->input->post('slug');
		$status = ($this->input->post('status'))?1:0;
		$short_description = $this->input->post('short_description');
		$description = $this->input->post('description');
		$meta_title = $this->input->post('meta_title');		
		$meta_description = $this->input->post('meta_description');		
		$meta_keywords = $this->input->post('meta_keywords');$added_date = date('Y-m-d H:i:s');		
		$modified_date = date('Y-m-d H:i:s');
		if($webpage_id)			
		{
			$data = array('title'=>$title ,
				'slug'=>$slug ,
				'short_description'=>$short_description ,
				'description'=>$description ,
				'image'=>$image ,
				'image_alt_text'=>$image_alt_text ,
				'status'=>$status ,
				'meta_title'=>$meta_title,	
				'meta_description'=>$meta_description,	
				'meta_keywords'=>$meta_keywords,
				'modified_date'=>$modified_date,
				);
			
			$data['slug'] = GetSlugTitle($title, $webpage_id);
			$this->db->where('webpage_id', $webpage_id);
			$this->db->update('tbl_webpage', $data); 
		}
		else
		{
			$data = array('title'=>$title ,
						'slug'=>$slug ,
						'short_description'=>$short_description ,
						'description'=>$description ,
						'image'=>$image ,
						'image_alt_text'=>$image_alt_text ,
						'status'=>$status ,
						'meta_title'=>$meta_title,	
						'meta_description'=>$meta_description,	
						'meta_keywords'=>$meta_keywords,
						'added_date'=>$added_date,
						);
			$this->db->insert('tbl_webpage',$data); 
		}
		return true;
	}

	public function deleteRecord($id){
		$data = array('status'=>5);
		$this->db->where('webpage_id', $id);
		$this->db->update('tbl_webpage', $data); 
		//echo $this->db->last_query();die;
		return true;
	}	
}