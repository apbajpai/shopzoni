<?php 	
	$admin_name = $this->session->userdata['name'];	
?>

<!DOCTYPE html>
<html>
<head>

<!-- Basic -->
<meta charset="utf-8">
<title>Brand Shopzoni</title>
<meta name="keywords" content="Brand Shopzoni" />
<meta name="description" content="Brand Shopzoni">
<meta name="author" content="http://brand.shopzoni.com">


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
 
  ga('create', 'UA-79982963-1', 'auto');
  ga('send', 'pageview');
 
</script>

</head>




<body>
<div class="body">
  <header id="header">
    
	<div class="container">
	  <div class="logo"> <a href="#"> <img src="<?php echo base_url(); ?>img/logo.png"> </a> </div>
      <!--<div class="search"> <a href="" target="_blank" class="btn btn-default" >Forgot Password ?</a> </div>-->
      <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse"> <i class="fa fa-bars"></i> </button>
    </div>
	
    <div class="navbar-collapse nav-main-collapse collapse">
      <div class="container login_form_box">
        
          
		  <?php if($admin_name!=""){ ?>
				<form class="form-inline" method="post" name="logoutfrm" id="logoutfrm" action="<?php echo base_url()?>logout">
				<div class="form-group">
				<label for="exampleInputName2"><b><?php echo $admin_name; ?></b></label>            
				<button type="submit" class="btn btn-default">Logout</button>
				</form>
		  <?php }else{ ?>
			  <form class="form-inline" method="post" name="loginfrm" id="loginfrm" action="<?php echo base_url()?>seller_login">
              <?php if($error_msg!=''){ ?>
				<div style="text-align:right; color:#FF4500;"><?php echo $error_msg; ?></div>
			  <?php } $error_msg='';?>
			  <div>
			  <div class="form-group">
				<label for="exampleInputName2" style="color:#0088cc"><b>Seller Login</b></label>
				<input type="text" class="form-control" name="lemail_id" id="lemail_id" placeholder="User Name">
			  </div>
			  <div class="form-group">
				<input type="password" class="form-control" name="lpassword"  id="lpassword" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-default btn-primary">Login</button>
              </div>
              <div class="f-pass"><a data-toggle="modal" data-target="#myModal" href="#">Forgot Password ?</a></div>
			  </form>
		  <?php } ?>
		  	
        
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--Pop Up End-->
  