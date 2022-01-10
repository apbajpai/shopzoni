<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login Page</title>
<?php $this->load->helper('url');?>
<?php define('VIEWBASE',site_url().'application/views/admin/'); ?>
<link rel="stylesheet" href="<?php echo VIEWBASE; ?>css/style.default.css" type="text/css" />
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/general.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/index.js"></script>
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="<?php echo VIEWBASE; ?>css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="<?php echo VIEWBASE; ?>css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="loginpage">

	<div class="loginbox">
    	<div class="loginboxinner">
        	
            <div class="logo">
            	<h1><span>Login</span></h1>
                <p>Login<br><?php if($msg){?><div class="loginmsg"><?php echo $msg;?></div><?php }?></p>
            </div><!--logo-->
            
            <br clear="all" /><br />
            
            <div class="nousername">
				<div class="loginmsg">The password you entered is incorrect.</div>
            </div><!--nousername-->
            
            <div class="nopassword">
				<div class="loginmsg">The password you entered is incorrect.</div>
                <div class="loginf">
                    <div class="thumb"><img alt="" src="<?php echo VIEWBASE; ?>images/thumbs/avatar1.png" /></div>
                    <div class="userlogged">
                        <h4></h4>
                        <a href="index.html">Not <span></span>?</a> 
                    </div>
                </div><!--loginf-->
            </div><!--nopassword-->
           
			<form id="login" action="<?php echo base_url();?>admin/login/process" method="POST" name="process">
            	
                <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="user_email" id="username" />
                    </div>
                </div>
                
                <div class="password">
                	<div class="passwordinner">
                    	<input type="password" name="user_pass" id="password" />
                    </div>
                </div>
                
                <button onclick="document.process.submit()">Sign In</button>
                
                <div class="keep"><input type="checkbox" /> Keep me logged in</div>
            
            </form>
            
        </div><!--loginboxinner-->
    </div><!--loginbox-->


</body>
</html>
