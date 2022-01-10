<?php
class Website_User_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('admin/role_model');
	}
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');		
		$this->db->where('status !=', 5);
		$full_name  =  trim($this->input->post('full_name'));
		$email_id  =  trim($this->input->post('email_id'));
		
		if($full_name != '')
		$this->db->where('full_name', $full_name);
		if($email_id != '')
		$this->db->where('email_id', $email_id);
		
		$query = $this->db->get("tbl_user");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$full_name  =  trim($this->input->post('full_name'));
		$email_id  =  trim($this->input->post('email_id'));
		
		if($full_name != '')
		$this->db->where('full_name', $full_name);
		if($email_id != '')
		$this->db->where('email_id', $email_id);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_user");
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
				$query = $this->db->get("tbl_user");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByEmail($email_id) {
        $this->db->where('email_id', $email_id);
				$query = $this->db->get("tbl_user");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_user_data() {
		$id = $this->input->post('id');
		$full_name = $this->input->post('full_name');
		$display_name = $this->input->post('display_name');
		$email_id = $this->input->post('email_id');
		$gender = $this->input->post('gender');
		$dob = $this->input->post('dob');
		$country = $this->input->post('country');
		$city = $this->input->post('city');
		$status = $this->input->post('status');
		
		$email_exist=$this->GetRecordByEmail($email_id);
		if($email_exist==false){
			$data = array(
						'full_name'			=>		$full_name ,
						'display_name'		=>		$display_name,	
						'email_id'			=>		$email_id,
						'gender'			=>		$gender,
						'dob'				=>		$dob,
						'country'			=>		$country,
						'city'				=>		$city,
						'status'			=>		$status
						);
			if($id)			
			{
				//$data['password'] = md5($this->input->post('password'));
				$this->db->where('id', $id);
				$this->db->update('tbl_user', $data); 
			}
			else
			{
				if($this->input->post('password') != ''){
					//$data['password'] = md5($this->input->post('password'));
				}
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_user',$data); 
			}
			return true;
		}
	}
	
	public function uniqueUser($email_id) {
			$this->db->where('email_id', $email_id);		
			//$this->db->where('status !=', 5);
			$query = $this->db->get("tbl_user");
			
			if ($query->num_rows() > 0) {
					return "false";
			}
			return "true";
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
			$query = $this->db->get('tbl_user');
			if($query->num_rows == 1)
			{
					$row = $query->row();
					$data = array(
									'adminid' => $row->id,
									'aname' => $row->name,
									'aemail' => $row->email,
									'validated' => true,
									'arole' => $row->role
									);
					$this->session->set_userdata($data);
					return true;
			}
			return false;
	}
}
}

?>
