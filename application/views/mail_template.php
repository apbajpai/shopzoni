<?PHP

$content="Thank you for joining Shopzoni.'";
	
	$message='<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	</head>

	<body style="background:#eee; margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px;"><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	  <tr>
		<td align="left" valign="top">    </td>
	  </tr>
		<tr>
		  <td align="left" valign="top" bgcolor="0068b7" height="5"></td>
	  </tr>
	   
	  <tr>
		<td align="left" valign="top"><table width="660" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td align="left" valign="top" width="35%">Click Here to activate your Account</td>
			  <a href="';
			  $message .= base_url();
			  $message .='activate_buyer/';
			  $message .= base64_encode($insertid);
			  $message .='" target="_blank">';
			  
			  $message .= base_url();
			  $message .='activate_buyer/';
			  $message .= base64_encode($insertid);
			  $message .='</a>
			  <td width="65%" height="70%" align="left" valign="top">&nbsp;</td>
			</tr>			
		</table></td>
	  </tr>
	  <tr>
		<td align="center" valign="middle" bgcolor="0068b7" height="30" style="color:#fff; font-size:15px;">© 2016 by Shopzoni</td>
	  </tr>
	  </table>
	</body>
	</html>';
	//echo $message;
	
	$to=$email_id;
	$subject="Activate your Account" ;
	$from="info@shopzoni.com";
	
		
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:$from\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\n";
	
	@mail($to,$subject,$message,$headers,"-f $from");
	
?>