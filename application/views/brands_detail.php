<?php $uri2 = $this->uri->segment(2); ?>    

    <div class=" banner_top_margin mobile_header_top_margin" style="padding-top: 10px;">
      <div class="">
      <div id="owl-demo" class="owl-carousel">
		 <?php 				
			if($slider_image_record[0]->id!=""){
			foreach($slider_image_record as $slider_image){ 
			$image = base_url()."brand/public/uploads/slider_image/".$slider_image->image;
		 ?>
		 <div class="item"><img src="<?php echo $image;?>"></div>
		 <?php } }else{ ?>
        <div class="item"><img src="<?php echo base_url(); ?>img/banner2.jpg"></div>
        <div class="item"><img src="<?php echo base_url(); ?>img/banner4.jpg"></div>
        <div class="item"><img src="<?php echo base_url(); ?>img/banner3.jpg"></div>
        <div class="item"><img src="<?php echo base_url(); ?>img/banner1.jpg"></div>
        <div class="item"><img src="<?php echo base_url(); ?>img/banner5.jpg"></div>
		<?php } ?>
      </div>
      </div>
    </div>




    


    <div class="container-fluid" style="padding: 30px" id="view_more"> 
    	<h4>
		Brand Name : <?php echo $brand_record->name; ?></h4>
      <div class="col-md-12 grid_margin">
		
		<?php
			$i=0;
			$product_count = count($product_record);
			foreach($product_record as $key=>$product){
			
				if($product->image!="")
					$image_path = "http://shopzoni.com/brand/public/uploads/product/".$product->image[0]->image;
				else
					$image_path = "http://shopzoni.com/brand/public/uploads/brand/no_image_brand.png";
		
				//$product_array[$i][$j]->name  = $product->name;
				//$product_array[$i][$j]->id  = $product->id;
				//$product_array[$i][$j]->seller_code  = $product->seller_code;
				//$j++;
			
		?>
        <div class="col-md-3">
          <div class="brand_box">
          <a href="<?php echo base_url().$product->code;?>">
            <img src="<?php echo $image_path; ?>" class="product_img_size" />
            <div class="brand_name"><?php  echo substr($product->name, 0,30); if(strlen($product->name)>30) echo " ..."; ?></div>
          </a>
          </div>
        </div>
		<?php } ?>		
      </div>

      <div class="clear"></div>
      <div style="margin-top: 20px; text-align:center">
        <div class="col-md-4"><a target="_blank" href="<?php echo base_url(); ?>partner/<?php echo $uri2; ?>" class="btn brand_search_btn btn_coust">View Partner</a></div> 
        <div class="col-md-4"><a target="_blank" href="<?php echo base_url(); ?>service_center/<?php echo $uri2; ?>" class="btn brand_search_btn btn_coust">Brand Details</a></div>
        <div class="col-md-4"><a onclick="view_more('<?php echo $uri2; ?>');" class="btn brand_search_btn btn_coust">View More</a></div> 
      </div>
	  </div>

	

	 <div class="container-fluid">

      <h3 class="home_crow_head">Sellers</h3>
          <div class="col-md-3 grid_margin">
           <div class="filter_box">
              <div class="brand_filter_head">SEARCH</div>
              <div class="col-md-12">
				<form name="brandfrm" id="brandfrm" action="<?php echo base_url().'brand_details/'.$uri2; ?>" method = "post">
					<div class="brand_detail_head">STATE</div>
					
					<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
					  <link rel="stylesheet" href="/resources/demos/style.css">
					  <script src="<?php echo base_url();?>carausel/js/jquery-1.9.1.min.js"></script>
					  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
					  
					  <?php						
						foreach($state_record as $key=>$state){
							if($key==0)
								$state_records = '"'.$state->state_name.'"';
							else
								$state_records .= ','.'"'.$state->state_name.'"';
						}
					  ?>			  
					  
					  <script>					  
					  jQuery( function() {
						var availableTags = [ <?php echo $state_records; ?>
						];
						jQuery( "#state" ).autocomplete({
						  source: availableTags
						});
					  } );
					  </script>
					  
					<div class="input-search brand_filter_location_box">
					  <input type="text" class="form_search-control" id="state" name="state" value="<?php echo $search['state']; ?>" placeholder="STATE...">
					</div>
					 <div class="brand_detail_head">DISTRICT/CITY</div>
					 <?php
						foreach($city_record as $key=>$city){
							if($key==0)
								$city_records = '"'.$city->district_name.'"';
							else
								$city_records .= ','.'"'.$city->district_name.'"';
						}
					?>			  
					  
					  <script>
					 
					  $( function() {
						var availableTags = [ <?php echo $city_records; ?>
						];
						$( "#city" ).autocomplete({
						  source: availableTags
						});
					  } );
					  </script>
					 
					<div class="input-search brand_filter_location_box">
					  <input type="text" class="form_search-control" id="city" name="city" value="<?php echo $search['city']; ?>" placeholder="DISTRICT...">
					</div>
					 <div class="brand_detail_head">PINCODE</div>
					 
					 <?php						
						/*foreach($pincode_record as $key=>$pincode){
							if($key==0)
								$pincode_records = '"'.$pincode->pincode.'"';
							else
								$pincode_records .= ','.'"'.$pincode->pincode.'"';
						} */
					  ?>			  
					  
					  <script>
					  $( function() {
						var availableTags = [ <?php echo $pincode_records; ?>
						];
						$( "#pincode" ).autocomplete({
						  source: availableTags
						});
					  } );
					  </script>
					  
					<div class="input-search brand_filter_location_box">
					  <input type="text" class="form_search-control" id="pincode" name="pincode" value="<?php echo $search['pincode']; ?>" placeholder="PINCODE...">
					</div>
					<div><button class="btn brand_search_btn btn_coust" type="submit">GO</button></div>
					</form>
              </div>
              
               

                 
              <div class="clear"></div>
           </div>
          </div>
          <div class="col-md-9 grid_margin">
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed mb-none">
                  <thead>
                    <tr>
                      <th class="text-center mob_text_left">Business Name</th>
                      <th class="text-center mob_text_left">Address</th>
                      <th class="text-center mob_text_left">Contact Details</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php 
						if($search_title=="Sellers"){
						foreach($seller_record as $key=>$seller){ ?>
                    <tr>
                      <td class="text-center mob_text_left"><?php echo $seller->business_name; ?> <br> 
					  <a href="<?php echo base_url().'shop/'.$seller->seller_code; ?>"><?php echo $seller->seller_code; ?></a>
					  </td>
                      <td class="text-center mob_text_left"><?php echo $seller->business_address; ?></td>
                      <td class="text-center mob_text_left"><?php echo $seller->name; ?> <br> <?php echo $seller->phone_number; ?><br><?php echo $seller->mobile_number; ?> <br><?php echo $seller->email_id; ?></td>
                    </tr>
						<?php } } ?>
                  </tbody>

                  
                </table>
              </div>
            </div>
          </div>    
    </div>


	<div class="clear"></div>	

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="<?php echo base_url(); ?>img/add_banner.jpg" class="img-responsive"></div>
    </div>-->
    


	
	
	
	
	
	
	
<script src="<?php echo base_url(); ?>banner/assets/js/jquery-1.9.1.min.js"></script> 
<script src="<?php echo base_url(); ?>banner/owl-carousel/owl.carousel.js"></script> 
      <style>
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
  
  #owl-demo .owl-next {
  right: 15px;
  position: absolute;
  width: 30px;
  background-image: url(<?php echo base_url(); ?>banner/crousel_arrow_right.png) !important;
  height: 48px;
  top:40%;
  background-repeat: no-repeat!important;
}
#owl-demo1 .owl-prev {
  left: 15px;
  position: absolute;
  width: 30px;
  background-image: url(<?php echo base_url(); ?>banner/crousel_arrow_left.png) !important;
  height: 48px;
  top:40%;
  background-repeat: no-repeat!important;
}

#owl-demo1.owl-theme .owl-controls .owl-buttons div{ opacity:1; background:transparent}
  
    </style>
<script>
    $(document).ready(function() {

      var owl = $("#owl-demo1");
      owl.owlCarousel({
        navigation : true,
        singleItem : true,
    navigationText:false,
        //transitionStyle : "fade",
    pagination:false,
    
      });

     });
</script> 
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->


    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>bootstrap/js/npm.js"></script>

<script type="text/javascript">
 $(".owl-carousel").hover(function(){ 
  $(".owl-buttons").show();

},function(){
     $(".owl-buttons").hide(); 
});
</script>

<style type="text/css">
  .owl-buttons{
    display: none;
  }
</style>
	
<script>
	function view_more(brand_id){
		url = "<?php echo base_url(); ?>view_more_brand_record/"+brand_id;
		jQuery('#view_more').load(url);
	}
</script>	

<style>
.home_crow_head{
	text-align:center!important;
}
</style>
	
	
	
	
	
   


   