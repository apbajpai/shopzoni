<?php $uri1 = $this->uri->segment(1); ?>
 

 
<div class="footer_bg">
      <div class="container-fluid">
      <div class="row">
      <div class="col-md-4">
        <h4 class="footer_menu_header">Shopzoni</h4>
        <div class="footer_menu">
        <ul>
		  <li><a target="_blank" href="http://mark.shopzoni.com/">About Us</a></li> 
		  <li><a target="_blank" href="<?php echo base_url();?>termsconditions">Terms & Conditions</a></li>	
		  <li><a target="_blank" href="<?php echo base_url();?>return-policy">Return Policy</a></li> 
		  <li><a target="_blank" href="<?php echo base_url();?>privacy-policy">Privacy Policy</a></li>
		  <li><a target="_blank" href="http://seller.shopzoni.com">Sell With Us</a></li>
		  <li><a target="_blank" href="http://registration.shopzoni.com">Join as Brand</a></li>
        </ul>
        </div>
      </div>
      
      <div class="col-md-4">
        <h4 class="footer_menu_header">Customer Information</h4>
        <div class="footer_menu">
        <ul>
          <li><a target="_blank" href="http://mark.shopzoni.com/contact-us-2/">Contact US</a></li>                   
          <li><a target="_blank" href="http://shopzoni.com/pdf/BuyerGuide.pdf">Buyers Guide</a></li>          
          <li><a target="_blank" href="<?php echo base_url();?>sitemap.xml">Site Map</a></li> 
		  <?php if($uri1=="brands_products" || $uri1=="product" || $uri1=="shop" ){ ?>
          <li><a target="_blank" href="<?php echo base_url();?>terms_conditions">Seller Terms & Conditions</a></li>
		  <?php } ?>		  
        </ul>
        </div>
      </div>
      
      <div class="col-md-4">
        <h4 class="footer_menu_header">Social Links</h4>
        <div>
        	<span><a target="_blank" href="https://www.facebook.com/szshopzoni/"><img src="<?php echo base_url(); ?>img/facebook-icon.jpg" /></a></span>
        	<span><a target="_blank"href="https://twitter.com/shopzoni"><img src="<?php echo base_url(); ?>img/twitter-icon.jpg" /></a></span>
        	<span><a target="_blank"href="https://www.linkedin.com/company-beta/13332363/"><img src="<?php echo base_url(); ?>img/linkedin-icon.png" /></a></span>
        	<span><a target="_blank" href="https://www.instagram.com/sz_shopzoni/"><img src="<?php echo base_url(); ?>img/instagram-icon.png" /></a></span>
        </div>
      </div>
      </div>

      <div class="footer_bottom" >
        <!--<div class="col-md-2 grid_margin footer_bottom_con">
          <span><img src="img/footer_call_icon.jpg"></span> <span class="footer_call_number">1800 2000 8000</span>
        </div>
        <div class="col-md-8 grid_margin footer_bottom_con">
          <span><img src="img/footer_call_icon.jpg"></span> <span class="footer_call_number">123 Fashion Ave. NY</span>
        </div>-->

        <!--<div class="col-md-10 footer_company" align="center">Powered By : <a target="_blank" href="http://anvitechnology.com">Anvi Technology</a></div>-->
        <div class="col-md-10 footer_company" align="center"> © <?php echo date("Y"); ?> shopzoni.com. All Rights Reserved.</div>
		
		<br>		
		<br>		
		<br>		
      </div>
	
      </div>
	  
    </div>
	
	


	
<?php 
if($uri1!='' && $url1=='dologin'){ ?>	
<script src="<?php echo base_url(); ?>qzoom/jquery-1.6.js" type="text/javascript"></script>
<?php } ?>


<script type="text/javascript" src="<?php echo base_url(); ?>js/asidebar.jquery.js"></script>
  

<script src="<?php echo base_url(); ?>qzoom/jquery.jqzoom-core.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>banner/assets/js/jquery-1.9.1.min.js"></script> 

   <!--  <script src="banner/owl-carousel/owl.carousel.js"></script> -->
      <style>
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: 257px;
    }
    
  
  #owl-demo .owl-next {
  right: 15px;
  position: absolute;
  width: 30px;
  background-image: url(banner/crousel_arrow_right.png) !important;
  height: 48px;
  top:40%;
  background-repeat: no-repeat!important;
}
#owl-demo .owl-prev {
  left: 15px;
  position: absolute;
  width: 30px;
  background-image: url(banner/crousel_arrow_left.png) !important;
  height: 48px;
  top:40%;
  background-repeat: no-repeat!important;
}

#owl-demo.owl-theme .owl-controls .owl-buttons div{ opacity:1; background:transparent;}
  
    </style>
      


<!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/npm.js"></script>

<script type="text/javascript">
 $(".owl-carousel").hover(function(){ 
  $(".owl-buttons").show();

},function(){
     $(".owl-buttons").hide(); 
});
</script>

<script type="text/javascript">
  (function($){
  $(document).ready(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault(); 
      event.stopPropagation(); 
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
    });
  });
})(jQuery);
</script>

<script type="text/javascript">
 $(document).on('click','.value-control',function(){
    var action = $(this).attr('data-action')
	//alert(action);
    var target = $(this).attr('data-target')
	//alert(target);
    var value  = parseFloat($('[id="'+target+'"]').val());
	//alert(value);
    if ( action == "plus" ) {
      value++;
    }
    if ( action == "minus" && value > 1) {
      value--;
    }
    $('[id="'+target+'"]').val(value)
})
</script>



<script>
    $(document).ready(function() {

      var owl = $("#owl-demo");
		owl.owlCarousel({
        navigation : true,
        singleItem : true,
		navigationText:false,
        //transitionStyle : "fade",
		pagination:false,    
      });

     });
    </script> 



<style type="text/css">
  .owl-buttons{
    display: block;
  }
</style>

<script src="owlcarousel/owl.carousel.js"></script>
<script src="owlcarousel/theme.js"></script>
<script src="owlcarousel/theme.init.js"></script>  

  </body>
</html>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

