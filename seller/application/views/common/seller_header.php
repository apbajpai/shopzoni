<?php 	
	$admin_name = $this->session->userdata['name'];	
?>

<!DOCTYPE html>
<html>
<head>

<!-- Basic -->
<meta charset="utf-8">
<title>Seller Shopzoni</title>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="author" content="http://seller.shopzoni.com/">

<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/img/favicon.png" />


<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/bootstrap/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/fontawesome/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/owlcarousel/owl.carousel.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/owlcarousel/owl.theme.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/magnific-popup/magnific-popup.css" media="screen">

<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-elements.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-blog.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-shop.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-animate.css">

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/skins/default.css">

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/menustyles.css">

<!-- Head Libs -->
<script src="<?php echo base_url(); ?>vendor/modernizr/modernizr.js"></script>

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/bootstrap/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/fontawesome/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/owlcarousel/owl.carousel.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/owlcarousel/owl.theme.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/magnific-popup/magnific-popup.css" media="screen">

<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-elements.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-blog.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-shop.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/theme-animate.css">

<!-- Current Page CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/rs-plugin/css/settings.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/circle-flip-slideshow/css/component.css" media="screen">

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/skins/default.css">

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css">

<!-- Head Libs -->
<script src="<?php echo base_url(); ?>vendor/modernizr/modernizr.js"></script>

<style>
.ckl {
	clear: both;
}

.f-password111{
padding-right:6px 340px 0 0;
}
</style>

<!-- Vendor --> 
<script src="<?php echo base_url(); ?>vendor/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery.appear/jquery.appear.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jquery.easing/jquery.easing.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jquery-cookie/jquery-cookie.js"></script> 
<script src="<?php echo base_url(); ?>vendor/bootstrap/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>vendor/common/common.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jquery.validation/jquery.validation.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jquery.stellar/jquery.stellar.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jquery.gmap/jquery.gmap.js"></script> 
<script src="<?php echo base_url(); ?>vendor/isotope/jquery.isotope.js"></script> 
<script src="<?php echo base_url(); ?>vendor/owlcarousel/owl.carousel.js"></script> 
<script src="<?php echo base_url(); ?>vendor/jflickrfeed/jflickrfeed.js"></script> 
<script src="<?php echo base_url(); ?>vendor/magnific-popup/jquery.magnific-popup.js"></script> 
<script src="<?php echo base_url(); ?>vendor/vide/vide.js"></script> 

<!-- Theme Base, Components and Settings --> 
<script src="<?php echo base_url(); ?>js/theme.js"></script> 

<!-- Theme Custom --> 
<script src="<?php echo base_url(); ?>js/custom.js"></script> 

<!-- Theme Initialization Files --> 
<script src="<?php echo base_url(); ?>js/theme.init.js"></script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-100482727-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<style>
#heade-in{
	border-top:5px solid #EDEDED;
	background:#F6F6F6;
	background:-webkit-linear-gradient( #f6f6f6, white);
	background:linear-gradient( #f6f6f6, white);
	border-bottom:#dddddd 1px solid;
	padding:20px 0;
}

</style>


<body>
<div class="body">
  
  



<header id="heade-in">
  
 <div class="container">
    <div class="row">
      <div class="col-md-2 logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo.png"> </a></div>
      <div class="col-md-3 header_con">
	  
      </div>
      <div class="col-md-7 top-form">
	  <?php if($admin_name!=""){ ?>
		<form class="form-inline" method="post" name="logoutfrm" id="logoutfrm" action="<?php echo base_url()?>logout">
			<div class="form-group">
			<label for="exampleInputName2"><b><?php echo $admin_name; ?></b></label>            
			<button type="submit" class="btn btn-default">Logout</button>
		</form>
	 <?php }else{ ?>
	   <form class="form-inline" method="post" name="loginfrm" id="loginfrm" action="<?php echo base_url()?>seller_login">
        <div class="form-group">
          <label for="exampleInputName2">Email ID</label>
          <input type="text" class="form-control" name="lemail_id" id="lemail_id" placeholder="Email ID">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail2">Password</label>
          <input type="password" class="form-control" name="lpassword"  id="lpassword" placeholder="Password">
        </div>
		<button type="submit" class="btn btn-default">Login</button>
		<div style="text-align:center; color:#FF4500;"><?php echo $error_msg; ?></div>
      </form>
	 <?php } ?>
	  <?php if($this->uri->segment(1)=="mailsent"){ ?>
	  <div style="text-align:left; color:GREEN;"><b>Log in to your mail account & check your Login Id and Password.!</b></div> 
	  <?php } ?>
	  <?php if($this->uri->segment(1)=="invalid-seller"){ ?>
	  <div style="text-align:left; color:RED;"><b>This Email Id is not Registered as seller with shopzoni. !</b></div> 
	  <?php } ?>
	  <?php if($this->uri->segment(1)=="inactive-seller"){ ?>
	  <div style="text-align:left; color:RED;"><b>Your Account is inactive by shopzoni, please contact at info@shopzoni.com </b></div> 
	  <?php } ?>
      <div class="f-pass"><a data-toggle="modal" data-target="#myModal" href="#">Forgot Password ?</a></div>
      </div>
    </div>
  </div>
  </header>
  
  
  
  
<!--Pop Up-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      <div class="col-md-1"></div>
      <div class="col-md-10"><br/>
      <form name="forgot_password" id="forgot_password" action="forgot_password" method="post">
        <label>E-mail Address</label>
        <input type="email" value="" placeholder="Enter Your Email id" name="email" id="email" class="form-control input-lg"><br/>
        <input type="submit" value="Submit" class="btn btn-default">
      </form>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>
    </div>

  </div>
</div>
<!--Pop Up End-->


<script>
jQuery(document).ready(function(){	
	jQuery.validator.setDefaults({ ignore: '' });
	jQuery("#loginfrm").validate({
		rules: {		
			lemail_id: {
				required: true,
				email: true
			},
			email_check:"required",
			lpassword: {
                required: true,
                minlength: 5,
				maxlength: 20
            }
		},
		messages: {
			lemail_id:{
			    lemail_id: "Please enter Email Address..!",
				email: "Please enter a valid email address..!"
			},
			lpassword: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!",               
                maxlength: "Your password must be less than equal to 20 characters..!"               
            },
			
			email_check:"Email Address Already Registered",
			confirm_password: {
			required: "Please enter confirm password..!",
			equalTo: "Password and confirm password not matched..!" 
			}
		}
	});	
});	

</script>
  