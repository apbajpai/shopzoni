<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invite_Buyer extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/address_book_model');
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
		
		$data['heading']='Invite Buyer'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');	
		
		$array_records = $this->address_book_model->GetRecordsCompose();
		$data['records'] = $array_records; 
	
		$this->load->view('admin/invite_buyer', $data);
		
		$this->load->view('admin/footer');
	}
	
	
	public function invite()
	{
		$to=$this->input->post('to');
		$chk = $this->input->post('chk');
		
		if($to!="" || $chk!=""){
			$this->load->library('form_validation');
			if($chk!='')
			$this->form_validation->set_rules('chk[]', 'chk[]', 'trim|required|xss_clean');		
			if($to!="")
			$this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE){
				redirect('admin/invite_buyer/');
			}
			else{
				
				foreach($chk as $val){
					if($to=="")
						$to.=$val;
					else
						$to.=','.$val;
				}
				
				$subject=$this->input->post('subject');
				$from=$this->session->userdata('aemail');
				$message=$this->input->post('description');
				
				$message.="<br>";
				$message.="Please visit us on SHOPZONI.COM. Our vendor code is <b>";
				$message.= $this->session->userdata('seller_code');

				$message.=" </b><br><br> This email is sent by your vendor <b>";
				$message.= $this->session->userdata('business_name');
				$message.=" </b> not by ShopZoni.com. If you have any complaint regarding this email please contact or message to your vendor. SHOPZONI.COM is not responsible for the any type of content of this email.

				<br><br><br>join shopzoni on ";
				$message.='<a target="_blank" href="https://plus.google.com/109728453974504833493"><img src="http://seller.shopzoni.com/icon/google_plus.png"></a> 
				  <a target="_blank" href="https://www.facebook.com/Shopzoni-1107747985966519"><img src="http://seller.shopzoni.com/icon/fb.png"></a>
				  <a target="_blank" href="https://twitter.com/shopzoni"><img src="http://seller.shopzoni.com/icon/twitter.png"></a>';

				$save_mail = $this->address_book_model->save_email_data($to,$from,$subject,$message,'Invite Buyer');	
				
				
				$headers  = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "From:$from\r\n";
				$headers .= "X-Mailer: PHP v".phpversion()."\n";			
				$headers .= "Bcc: $to\r\n";
				//$val = @mail('Me', $subject, $message, $headers);

				$val = @mail($to,$subject,$message,$headers,"-f $from");
				$data['mail_val'] = $val;
				
				$data['heading']='Invite Buyer'; 
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');	
				
				$array_records = $this->address_book_model->GetRecordsCompose();
				$data['records'] = $array_records; 
				$this->load->view('admin/invite_buyer', $data);
				$this->load->view('admin/footer');		
			}
		}
	}	
}
?>