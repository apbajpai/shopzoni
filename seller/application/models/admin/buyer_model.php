<?php
class Buyer_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('admin/role_model');
	}
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');		
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		$email  =  trim($this->input->post('email'));
		
		if($name != '')
		$this->db->like('name', $name);
		if($email != '')
		$this->db->like('email', $email);
		
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
		$name  =  trim($this->input->post('name'));
		$email  =  trim($this->input->post('email'));
		
		if($name != '')
		$this->db->like('name', $name);
		if($email != '')
		$this->db->like('email', $email);
		
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
	
	
	public function GetTotalSubscribeRecord() {	
		$this->db->select('count(*) as total');		
		$this->db->where('status !=', 5);
		$this->db->where('subscribe', 1);
		$name  =  trim($this->input->post('name'));
		$email  =  trim($this->input->post('email'));
		
		if($name != '')
		$this->db->where('name', $name);
		if($email != '')
		$this->db->where('email', $email);
		
		$query = $this->db->get("tbl_user");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetSubscribeRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$this->db->where('subscribe', 1);
		$name  =  trim($this->input->post('name'));
		$email  =  trim($this->input->post('email'));
		
		if($name != '')
		$this->db->where('name', $name);
		if($email != '')
		$this->db->where('email', $email);
		
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
	
	public function GetRecordByEmail($email) {
        $this->db->where('email', $email);
				$query = $this->db->get("tbl_user");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	
	
}

?>
