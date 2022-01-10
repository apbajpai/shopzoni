<?php
class Admin_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('admin/role_model');
	}
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');		
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_admin");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_admin");
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
		$query = $this->db->get("tbl_admin");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_admin_data($image=null) {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$role = $this->input->post('role');
		$indate = $this->input->post('indate');
		$status = $this->input->post('status');
		$data = array(
					'name'=>$name ,
					'email'=>$email,	
					'role'=>$role,
					'indate'=>$indate,
					'status'=>$status
					);
		if($id)			
		{
			$data['password'] = md5($this->input->post('password'));
			$this->db->where('id', $id);
			$this->db->update('tbl_admin', $data); 
		}
		else
		{
			if($this->input->post('password') != ''){
				$data['password'] = md5($this->input->post('password'));
			}
			$data['indate']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_admin',$data); 
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
			$query = $this->db->get('tbl_admin');
			//echo $this->db->last_query();
			if($query->num_rows == 1)
			{
					$row = $query->row();
					$data = array(
									'adminid' => $row->id,
									'name' => $row->name,
									'aemail' => $row->email,
									'seller_id' => $row->seller_id,
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
