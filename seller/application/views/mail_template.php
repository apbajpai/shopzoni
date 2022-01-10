<?PHP

$message='<b>Activate your Shopzoni Seller Account</b> <br><br>
Hi ';
$message .= $seller_record->name;
$message .= ',
<br>
<br>
Click on below link to activate your account';
$message .='<br>';
$message .='<br> <a href="';
$message .= base_url();
$message .='activate_account/';
$message .= $insertid;
$message .='" target="_blank">';
$message .='Click Here to activate your Account';
$message .='</a>';
$message .='<br>';
$message .='<br>';
$message .='For any query feel free to contact us.
<br>
<br>
Regards,
<br>
<br>
<u><b>Shopzoni.com</b></u> 
<br>
<br>
<br>
 <img src="http://shopzoni.com/img/logo.png" class="logo" width="50%">
 <br>
 info@shopzoni.com
 <br>
+91 9654226087';
	
	//echo $message;
	
	
	$to=$email_id;
	$subject="Activate your Shopzoni Seller Account" ;
	$from='info@shopzoni.com';
	
		
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:$from\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\n";
	
	@mail($to,$subject,$message,$headers,"-f $from");
	
?>