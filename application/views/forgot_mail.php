<?PHP
$reset_url = base_url().'reset_password/'.base64_encode($id);


$content="Reset Your Password.";
	
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
			<td align="left" valign="top" width="30%">Hello</td>
			<td align="left" valign="top" height="70%">&nbsp;</td>
		  </tr>		  
		  <tr>
			<td align="left" valign="top" width="30%">
			<a href="';
			$message.=$reset_url;
			$message.='">Click Here</a> to reset your Password.</td>
			<td align="left" valign="top" height="70%">&nbsp;</td>
		  </tr>		  
		  <tr>
			<td align="left" valign="top" width="30%"> Still have an issue email to us on <a href="mailto:info@shopzoni.com">Info@shopzoni.com</a></td>
			<td align="left" valign="top" height="70%">&nbsp;</td>
		  </tr>		 
		</table>
		</td>
	  </tr>
	  <tr>
		<td align="center" valign="middle" bgcolor="0068b7" height="30" style="color:#fff; font-size:15px;">© 2016 by Shopzoni</td>
	</td>
	  </tr>
	</table>
	</body>
	</html>';
	//echo $message;
	
	$to=$email_id;
	$subject="Reset Password.";
	$from="info@shopzoni.com";
	
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:$from\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\n";

	@mail($to,$subject,$message,$headers,"-f $from"); 
	
?>