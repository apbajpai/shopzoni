<?PHP

$message='<b>Activate your Shopzoni Account</b> <br><br>
Hi "';
$message .= $buyer_record->name;
$message .= '",
<br>
<br>
Click on below link to activate your account';
$message .='<br>';
$message .='<br> <a href="';
$message .= base_url();
$message .='activate_buyer/';
$message .= base64_encode($insertid);
$message .='" target="_blank">';

$message .= base_url();
$message .='activate_buyer/';
$message .= base64_encode($insertid);
$message .='</a>';
$message .='<br>';
$message .='<br>';
$message .='For any query feel free to contact us."
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
+91 – 96542-26087';
	
	//echo $message;
	
	
	$to=$buyer_record->email;
	$subject="Activate your Shopzoni Account" ;
	$from='info@shopzoni.com';
	
		
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:$from\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\n";
	
	@mail($to,$subject,$message,$headers,"-f $from");
	
?>