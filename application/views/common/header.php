<?php $uri1 = $this->uri->segment(1); ?>
<?php
if($this->agent->is_mobile())
{
    $detect = "mobile";
}else{
	$detect = "desktop";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title><?php echo $seo_tag->meta_title; ?></title>    
  <meta name="description" content="<?php echo $seo_tag->meta_description; ?>">
  <meta name="keywords" content="<?php echo $seo_tag->meta_keywords; ?>" />   
  <meta name="google-site-verification" content="GDVm00TetHnhOyupzDIhtGh-60495Eb5PImF7yBaZYg" />
  <meta name="document-type" content="Public" />
  <meta name="Robots" content="index, follow" />    
  <meta name="language" content="EN" />
  <link rel="canonical" href="<?php echo $seo_tag->seo_canonical; ?>"/>


  <meta property="og:locale" content="en_US" />
  <meta property="fb:app_id" content="1589864254657329" /> 
  <meta property="og:type" content="PRODUCT" />
  <meta property="og:title" content="<?php echo $seo_tag->meta_title; ?>" />
  <meta property="og:description" content="<?php echo strip_tags($seo_tag->description); ?>" />
  <meta property="og:url" content="<?php echo $seo_tag->seo_canonical; ?>" /> 
  <meta property="og:image" content="<?php echo $og_tag->image; ?>" />
  <meta property="og:site_name" content="<?php echo $seo_tag->seo_canonical; ?>" />

  
  <meta name="twitter:site" content="@<?php echo $seo_tag->seo_canonical; ?>">
  <meta name="twitter:creator" content="@<?php echo $seo_tag->seo_canonical; ?>">
  <meta name="twitter:title" content="<?php echo $seo_tag->title; ?>">
  <meta name="twitter:description" content="<?php echo $seo_tag->description; ?>">
  
  
    <link rel="icon" href="<?php echo base_url(); ?>img/favicon.png">
    

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
  <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>qzoom/jquery.jqzoom.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>qzoom/zoom.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>owlcarousel/owl.carousel.css" media="screen">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/dist.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/mob_web.css">
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



<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-100448179-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-100448179-1');
</script>

  </head>

  <body>
  
<?php if($detect=="desktop"){ ?>  
  
<div class="navbar-fixed-top">
    <header class="header_1 window_header">
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
  
  
  <div class="header_2 window_header">
      <div class="container-fluid">
    <?php if (!$this->agent->is_mobile()){ ?>
      <div class="col-md-3"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo.png" class="logo" width="100%" /></a></div>
    <?php } ?>
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
      //$cart_record_count = $this->product_model->GetTotalCartRecordByBuyer();
	  $cart_record = $this->product_model->getCartRecord();
		$qty = 0;
		foreach($cart_record as $key=>$cart_data){
			foreach($cart_data as $key=>$cart_item){
				$qty = $qty+$cart_item->quantity;
			}
		}
		$cart_record_count = $qty;
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


<?php }else if($detect=="mobile"){ ?>

<!--New Mobile Menu-->
	<div class="mob_head vander_hideweb">
	  <div class=" col-xs-4"> <a href="#" onclick="$('.aside').asidebar('open')"><img src="<?php echo base_url(); ?>img/bmenu.png" class="bmenu" width="" /></a></div>
	  <div class="col-xs-4"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo.png" class="img-responsive mob_logo" width="" /></a></div>
	  <div class="col-xs-4">
	  
	  
	  <?php if($this->session->userdata('user_id')){
		  $cart_record_count = $this->product_model->GetTotalCartRecordByBuyer();
		?>
		
		<div class="cart_align">
		  <div class="col-xs-6 cart_count"><span id="cartCounter"><?php echo $cart_record_count; ?></span> </div>
		  <div class="col-xs-6 cart_bg cart_box cart_icon"><a href="<?php echo base_url(); ?>viewcart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
		</div>
	  <?php } ?>
	  </div>

	  <div class="top_src_bg">
	  <form id="searchForm" action="<?php echo base_url(); ?>shop" method="post">
			<div class="col-xs-12">
			  <div class="input-group mb-md search_box_align">
			  <input type="text" class="form-control" name="vendor" id="vendor_mobile" placeholder="Enter Vendor Code">
			  <span class="input-group-btn">
			  <button class="btn btn-success btn-warning" onclick="return mysearchfrmMobile('<?php echo base_url(); ?>');" type="submit">Go</button>
			  </span>
		  <?php /* if($approval_error_msg!=''){ ?><span style="color:red;"><?php echo $approval_error_msg; ?></span><?php } */ ?> 
			  </div>
			</div>

			<div class="col-xs-6">
			  <a ><a href="<?php echo base_url(); ?>brands" class="btn brand_search_btnm btn_coust_home">SEARCH BY BRAND</a>
			</div>
			<div class="col-xs-6">
			  <a ><a href="<?php echo base_url(); ?>products" class="btn brand_search_btnm btn_coust_home">SEARCH BY PRODUCT</a></a>
			</div>

		</form>
	  </div>
	  <div class="clef"></div>
	</div>



	<div class="clearm"></div>


	<div class="aside">
	
	 <?php if($this->session->userdata('user_id')){          
          $array = explode(" ",$this->session->userdata('name'));
          $first_name = $array[0];
      ?>	    
      <div class="aside-header">
        <a href='<?php echo base_url();?>myaccount'>My Account</a>
        <span class="close" data-dismiss="aside" aria-hidden="true">&times;</span>
      </div>
      <div class="aside-header">
        <a href='<?php echo base_url();?>buyer_request'>Request to Vendor</a>
      </div>
      <div class="aside-header">
        <a href='<?php echo base_url();?>vendor_list'>Your Vendor List</a>
      </div>
      <div class="aside-header">
        <a href="<?php echo base_url(); ?>message_seller">Message to seller</a>
      </div>
      <div class="aside-header">
        <a href='<?php echo base_url();?>order_list'>Your Orders</a>
      </div>
      <div class="aside-header">
        <a href="<?php echo base_url(); ?>logout">Logout</a>
      </div>
	 <?php }else{ ?>
	  <div class="aside-header">
        <a href='<?php echo base_url();?>login'>Login</a>
        <span class="close" data-dismiss="aside" aria-hidden="true">&times;</span>
      </div>
	  <div class="aside-header">
        <a href='<?php echo base_url();?>register'>Register</a>
      </div>
	 <?php }?>
	  
    </div>
    <div class="aside-backdrop"></div>
	
<!--New Mobile Menu-->

<?php } ?>
    
          
          
          
          
          



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


function mysearchfrmMobile(HTTP_URL)
{
  var search = jQuery.trim(jQuery("#vendor_mobile").val()); 
  search = urlencode(search);   
  if(search==''){
    $('.btn-danger').popover({content: "Please fill out this field.",  placement: "bottom"});
    jQuery( "#vendor_mobile" ).focus();
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


<script type="text/javascript">
  $(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });
</script>
 