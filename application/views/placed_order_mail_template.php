<?PHP

$message='<b>Congratulations, your item sold</b> <br><br>
Hi “';
$message .= $order_details[0]->seller_business_name;
$message .= '”,
<br>
<br>
You did it! Your item sold.';
$message .='<br>';
$message .='<br>';
$message .= 'Date  : ';
$message .= date("d-m-Y", strtotime($order_details[0]->date_created));
$message .='<br>';
$message .='<br>';
$message .= 'Order ID  : ';
$message .= $order_details[0]->order_id;
$message .='<br>';
$message .='<br>';
$message .= 'Buyer Name  : ';
$message .= $order_details[0]->name;
$message .='<br>';
$message .='<br>';
$message .= 'Email Id  : ';
$message .= $order_details[0]->email;
$message .='<br>';
$message .='<br>';
$message .='For more details log on to “<a href="http://seller.shopzoni.com">Seller.shopzoni.com</a>”
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
	
	
	$to=$order_details[0]->email_id;
	$subject="Congratulations, your item sold" ;
	$from='info@shopzoni.com';
	
		
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:$from\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\n";
	
	@mail($to,$subject,$message,$headers,"-f $from");
	
?>