<?PHP

$content="Your Order Id:- '".$order_id;
	
	$message='<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	</head>

	<body style="background:#eee; margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px;"><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	  <tr>
		<td align="left" valign="top">
		</td>
	  </tr>
		<tr>
		<td align="left" valign="top" bgcolor="0068b7" height="5"></td>
	  </tr>
	   <tr>
		<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; border-left:10px solid #fff; border-right:10px solid #fff; border-bottom:10px solid #fff; border-top:10px solid #fff;">';
		$message.=$content;
		$message.='</td>
	  </tr>
	  <tr>
		<td align="left" valign="top"><table width="660" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="left" valign="top" width="100%" colspan="3">Order Details are:</td>			
		  </tr>';
		  
		  $i=1;
		  foreach($records as $data){
		  if($data->order_status==4){ $order_status = "Approved"; }else{ $order_status = "Pending"; }
		  $message.='<tr>
			
			<td width="5%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color:#333;">';
			$message.= $i;			
			$message.='</td>
			
			<td width="80%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color:#333;">';
			$message.= $data->product_name;			
			$message.='</td>
			
			<td width="15%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color:#333;">';
			$message.= $order_status;			
			$message.='</td>
			
		  </tr>';
		  
		  $i++;
		  }
		  
		  $message.='<tr>
			 <td colspan="2" align="left" valign="top" height="10"></td>
			</tr>
		</table>
		</td>
	  </tr>
	  <tr>
		<td align="center" valign="middle" bgcolor="0068b7" height="30" style="color:#fff; font-size:15px;">© ';
		$message.= date('Y');
		$message.='by Shopzoni</td>
	</td>
	  </tr>
	</table>
	</body>
	</html>';
	//echo $message;
	
	$to=$records[0]->buyer_email;
	$subject=$order_id." of ".$records[0]->seller_code."[".$records[0]->seller_business_name."]";
	$from=$records[0]->seller_email;
	
	$save_mail = $this->address_book_model->save_email_data($to,$from,$subject,$message);
	
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:$from\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\n";

	@mail($to,$subject,$message,$headers,"-f $from");
	
?>