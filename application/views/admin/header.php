<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin :: <?php echo isset($heading)?$heading:"Dashboard"; ?></title>
<?php $this->load->helper('url');?>
<?php define('VIEWBASE',site_url().'application/views/admin/'); ?>
<link rel="stylesheet" href="<?php echo VIEWBASE; ?>css/style.default.css" type="text/css" />
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/general.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/excanvas.min.js"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="<?php echo VIEWBASE; ?>css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="<?php echo VIEWBASE; ?>css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
</head>
<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo">Shopping<span></span></h1>
            <span class="slogan">Admin Panel</span>            
            <br clear="all" />            
        </div><!--left-->        
        <div class="right">
            <div class="userinfo">
            	<img src="<?php echo VIEWBASE; ?>images/thumbs/avatar.png" alt="" />
                <span><?php echo $this->session->userdata('name'); ?></span>
            </div><!--userinfo-->            
            <div class="userinfodrop">
            	<div class="avatar">
                	<a href=""><img src="<?php echo VIEWBASE; ?>images/thumbs/avatarbig.png" alt="" /></a>
                </div><!--avatar-->
                <div class="userdata">
                	<h4>Welcome</h4>
                   <!-- <span class="email">youremail@yourdomain.com</span>-->
                    <ul>
                    	<!--<li><a href="editprofile.html">Edit Profile</a></li>-->
                        <li><a href="<?php echo base_url().'admin/logout'?>">Sign Out</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
    <div class="header">
    	<ul class="headermenu">
        	<li <?php if($this->uri->segment(2)!='report'){?>class="current"<?php }?>><a href="<?php echo base_url()?>admin/home"><span class="icon icon-flatscreen"></span>Dashboard</a></li>
            <!--<li><a href="#"><span class="icon icon-pencil"></span>Manage Blog</a></li>
            <li><a href="#"><span class="icon icon-message"></span>Messages</a></li>-->
            <!--<li <?php if($this->uri->segment(2)=='report'){?>class="current"<?php }?>><a href="<?php echo base_url()?>admin/report"><span class="icon icon-chart"></span>Reports</a></li>-->
        </ul>
    </div><!--header--> 