<?php
class User_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('admin/role_model');
	}
	
	public function GetTotalRecord() {	
		$this->db->select('a.*,b.name as brand_name');
		$this->db->from("tbl_brand_admin as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');	
		
		$this->db->where('a.status !=', 5);
		$this->db->where('a.role', 2);
		
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->like('a.name', $name);
	
		$brand_id 	=  trim($this->input->post('brand_id'));
		if($brand_id)
		$this->db->where('a.brand_id', $brand_id);	

		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {            
			return $query->num_rows();
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		/*$this->db->where('status !=', 5);
		$this->db->where('role', 2);
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->like('name', $name);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_brand_admin");
		echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false; */	
		
		
		$this->db->select('a.*,b.name as brand_name');
		$this->db->from("tbl_brand_admin as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');	
		
		$this->db->where('a.status !=', 5);
		$this->db->where('a.role', 2);
		
		$name  =  trim($this->input->post('name'));
		if($name != '')
		$this->db->like('a.name', $name);
	
		$brand_id 	=  trim($this->input->post('brand_id'));
		if($brand_id)
		$this->db->where('a.brand_id', $brand_id);
	
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
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
   
   
   
   public function GetBrands($start=0, $limit="") {				
		$this->db->select('b.*');
		$this->db->from("tbl_brand_admin as a");
		$this->db->join('tbl_brand as b', 'a.brand_id = b.id', 'left');	
		
		$this->db->where('a.status !=', 5);
		$this->db->where('a.role', 2);
		if($limit)
		$this->db->limit($limit,$start);
		$this->db->order_by("b.id", "desc");
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
   
   
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_brand_admin");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByEmailId($email) {
        $this->db->where('email', $email);
		$query = $this->db->get("tbl_brand_admin");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_user_data($image=null){
		$id = $this->input->post('id');
		$brand_id = $this->input->post('brand_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$role = $this->input->post('role');
		$indate = $this->input->post('indate');
		$status = $this->input->post('status');
		$brand_user = $this->GetRecordByEmailId($email);
		
		$data = array(
					'brand_id'=>$brand_id ,
					'name'=>$name ,
					'email'=>$email,	
					'role'=>2,
					'indate'=>$indate,
					'status'=>$status
					);
		if($id)			
		{
			$data['password'] = md5($this->input->post('password'));
			$this->db->where('id', $id);
			$this->db->update('tbl_brand_admin', $data); 
		}
		else
		{
			if($brand_user->id==""){
				if($this->input->post('password') != ''){
					$data['password'] = md5($this->input->post('password'));
				}
				$data['indate']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_brand_admin',$data); 
			}else{
				return false;
			}
		}
		return true;
		
	}
	
	public function validate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_email', 'user_email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_email', 'user_email', 'trim|required|xss_clean|callback_check_database');
		
		$username = $this->security->xss_clean($this->input->post('user_email'));
		$password = $this->security->xss_clean($this->input->post('user_pass'));
		
		if($this->form_validation->run() == FALSE)
		{
			return false;
		}
		else
		{		 
				$this->db->where('email', $username);
				$this->db->where('password', md5($password));
				$this->db->where('status', 1);
				$query = $this->db->get('tbl_brand_admin');
				//echo $this->db->last_query();
				if($query->num_rows == 1)
				{
					$row = $query->row();						
						$data = array(
										'adminid' => $row->id,
										'brand_id' => $row->brand_id, 	
										'brand_name' => $row->name,
										'aemail' => $row->email,
										'validated' => true,
										'arole' => $row->role
										);
						$this->session->set_userdata($data);
						
						$data1 = array(
							'user_id'=>$seller_record->id,
							'user_type'=>4,	
							'login_date'=>date('Y-m-d H:i:s'),
							'ip_address'=>$_SERVER['REMOTE_ADDR']
							);
						$this->db->insert('tbl_login_history',$data1);
						return true;
				}
				return false;
		}
	}

}

?>
