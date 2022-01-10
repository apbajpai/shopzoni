<?php $uri1 = $this->uri->segment(1); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="product" />
	<meta property="og:title" content="<?php echo $uri1;?>" />
	<meta property="og:description" content="<?php echo $uri1;?>" />
	<meta property="og:url" content="<?php echo base_url().$uri1;?>" />
	<meta property="og:site_name" content="Shopzoni" />
	
  
  
  
    <link rel="icon" href="<?php echo base_url(); ?>img/favicon.png">
    <title>Shopzoni <?php echo $uri1;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/bbootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/tab_login.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/theme-shop.css">
	<?php if($uri1!='' && $url1=='dologin'){ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/theme-elements.css">
	<?php } ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="<?php echo base_url(); ?>banner/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>banner/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>banner/owl-carousel/owl.transitions.css" rel="stylesheet">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>owlcarousel/owl.theme.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>owlcarousel/owl.transitions.css" media="screen">
	<script class="jsbin" src="<?php echo base_url(); ?>owlcarousel/hover_m.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/calendar.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>qzoom/jquery.jqzoom.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>qzoom/zoom.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>owlcarousel/owl.carousel.css" media="screen">
	
	<!--<style type="text/css">
		#myform {
		text-align: center;
		padding: 5px;
		border: 1px dotted #ccc;
		margin: 2%;
		}
		.qty {
			width: 140px;
			height: 125px;
			text-align: center;
		}
		input.qtyplus { width:25px; height:25px;}
		input.qtyminus { width:25px; height:25px;}
	</style>-->
	
	
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59198afdc1797300114e3faf&product=inline-share-buttons"></script>

	  <!--Start of Tawk.to Script-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/598afb1bdbb01a218b4db82a/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script-->


  </head>

  <body>
<div class="navbar-fixed-top">
    <header class="header_1">
      <div class="container-fluid">
        <div class="col-lg-10 col-xs-7 top_contact"><!--<i class="fa fa-phone" aria-hidden="true"></i> 1800-555-8989--></div>
		
		<div class="col-lg-1 col-xs-2 top_contact top_user">
              <div class="dropdown">
			  <?php if($this->session->userdata('user_id')){ 					
					$array = explode(" ",$this->session->userdata('name'));
					$first_name = $array[0];
					?>				
				<button class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i> <?php echo substr($first_name,0,20); if(strlen($first_name)>20) echo ".."; ?></button>
				 <div class="dropdown-content">				  
				   <a href='<?php echo base_url();?>myaccount'>My Account</a>
					<a href='<?php echo base_url();?>buyer_request'>Request to Vendor</a>
					<a href='<?php echo base_url();?>vendor_list'>Your Vendor List</a>
					<a href="<?php echo base_url(); ?>message_seller">Message to seller</a>
					<a href='<?php echo base_url();?>order_list'>Your Orders</a>
					<a href="<?php echo base_url(); ?>logout">Logout</a>
				  </div>
				<?php }else{ ?>
				<div class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo base_url(); ?>login">Login</a></div>				
				<?php } ?>             
              </div>
        </div>
		
		
		 <?php if(!$this->session->userdata('user_id')){ ?>
        <div class="col-lg-1 col-xs-3 top_contact top_user"><a href="<?php echo base_url(); ?>register"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></div>
		 <?php } ?>
      </div>
    </header>   
	
	
	<div class="header_2">
      <div class="container-fluid">
      <div class="col-md-3"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo.png" class="logo" width="100%" /></a></div>
      <div class="col-md-9 grid_margin">
        <div class="row">
		
		<form id="searchForm" action="<?php echo base_url(); ?>shop" method="post">
        <div class="col-lg-9 col-xs-12">
          <div class="input-group mb-md search_box_align">
          <input type="text" class="form-control" name="vendor" id="vendor" placeholder="Enter Vendor Code">
          <span class="input-group-btn">
          <button class="btn btn-success btn-warning" onclick="return mysearchfrm('<?php echo base_url(); ?>');" type="submit">Go</button>
          </span>
		  <?php /* if($approval_error_msg!=''){ ?><span style="color:red;"><?php echo $approval_error_msg; ?></span><?php } */ ?>	
          </div>
        </div>
		</form>
		
		<!--<form name="search" id="search" action="/" method="post" onsubmit="return mysearchfrm('<?php echo base_url(); ?>');">
					<span><input style="border-radius: 4px 0 0 4px" type="text" class="form-control form-control-add" id="searchField" name="textfield" value="<?php echo $search_key; ?>" placeholder="Enter your text here and Search..."></form></span>

					<span class="input-group-btn"><button class="btn btn-defaults btn_modify_header_search" type="submit" onclick="return mysearchfrm('<?php echo base_url(); ?>');">Search <i class="fa fa-search"></i></button></span>
					</form>-->
		
		
		
		<?php if($this->session->userdata('user_id')){
			$cart_record_count = $this->product_model->GetTotalCartRecordByBuyer();
		?>
        <div class="col-lg-3 col-xs-12 cart_align">
          <div class="col-lg-9 col-xs-10 cart_count"><span id="cartCounter"><?php echo $cart_record_count; ?></span> item(s)</div>
          <div class="col-lg-2 col-xs-2 cart_bg cart_box cart_icon"><a href="<?php echo base_url(); ?>viewcart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
        </div>
		<?php } ?>
        </div>

        <div class="row <?php if(!$this->session->userdata('user_id')){ ?>search_menu <?php } ?>">
          <div class="col-md-12">
          <div class="col-md-4 top_search_menu"><a href="<?php echo base_url(); ?>brands">SEARCH BY BRAND</a></div>
          <!--<div class="col-md-4 top_search_menu"><a href="#">SEARCH BY DEPARTMENT</a></div>-->
          <div class="col-md-4 top_search_menu"><a href="<?php echo base_url(); ?>products">SEARCH BY PRODUCT</a></div>
          </div>
        </div>
      </div>
      </div>
    </div>
	
</div>

<script>

function urlencode(str) {
  str = (str + '').toString();
  return encodeURIComponent(str)
	.replace(/!/g, '%21')
	.replace(/'/g, '%27')
	.replace(/\(/g, '%28')
	.
  replace(/\)/g, '%29')
	.replace(/\*/g, '%2A')
	.replace(/%20/g, '~');
}


function mysearchfrm(HTTP_URL)
{
	var search = jQuery.trim(jQuery("#vendor").val());	
	search = urlencode(search);	
	if(search==''){
		$('.btn-danger').popover({content: "Please fill out this field.",  placement: "bottom"});
		jQuery( "#vendor" ).focus();
		return false;
	}
	//jQuery("#tooltip").hide();
	
	var URL = HTTP_URL+'shop/'+search
	jQuery('#search').attr('action', URL);
	
	if(search){
		//document.getElementById('search').submit();
		window.location.href = URL;
	}
	
	return false;
}

</script>
 