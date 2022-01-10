    <div id="owl-demo" class="owl-carousel banner_top_margin online_use_phonee" style="padding-top: 10px">
	<?php foreach($banner_image as $key=>$banner){
	$slider_image_path = base_url()."seller/public/uploads/home_slider_image/".$banner->image;
	?>
      <div class="item"><a target="_blank" <?php if($banner->redirect_url!=""){ ?> href="<?php echo $banner->redirect_url; ?>" <?php } ?> > <img src="<?php echo $slider_image_path; ?>" alt="<?php echo $banner->img_alt; ?>" ></a></div>
    <?php } ?> 
    </div>


	
	<?php if(!$this->agent->is_mobile()){ ?>
	
    <div class="container-fluid" style="padding-top: 30px; margin-bottom: 20px">
	<?php $i=1;
	foreach($small_banner_image as $small_banner){
	$small_banner_image_path = base_url()."seller/public/uploads/slider_product_image/".$small_banner->image;
	?>
    <div class="col-md-4 banner_add_margin">
      <div class="col-lg-6 col-xs-8  banner_add<?php echo $i; ?>">
        <h4 class="add_header"><?php echo $small_banner->title; ?></h4>
        <p><?php echo $small_banner->short_desc; ?></p>
        <div><a <?php if($small_banner->redirect_url!=""){ ?> href="<?php echo $small_banner->redirect_url; ?>" <?php } ?> target="_blank" class="banner_shop_btn">Shop Now</a></div>
      </div>
      <div class="col-lg-6 col-xs-4 banner_add<?php echo $i; ?>"> <img src="<?php echo $small_banner_image_path; ?>" alt="<?php echo $small_banner->img_alt; ?>" class="add_banner_img img-responsive" ></div>
    </div>
	<?php $i++; } ?>   
    </div>
	
	
	<?php }else{ ?>
	
	 
	<div class="container-fluid" style="padding-top: 30px; margin-bottom: 20px">    
    	<div class="owl-carousel " data-plugin-options='{"items": 4, "singleItem": false, "navigation": true, "pagination": false, "autoPlay": false}'>            
				<?php $i=1;
				foreach($small_banner_image as $small_banner){
				$small_banner_image_path = base_url()."seller/public/uploads/slider_product_image/".$small_banner->image;
				?>
				<div class="crowsel_gap itemsContainer"> 
					<div class="col-md-4 banner_add_margin">
					  <div class="col-lg-6 col-xs-6  banner_add<?php echo $i; ?>">
						<h4 class="add_header"><?php echo $small_banner->title; ?></h4>
						<p><?php echo $small_banner->short_desc; ?></p>
						<div><a <?php if($small_banner->redirect_url!=""){ ?> href="<?php echo $small_banner->redirect_url; ?>" <?php } ?> target="_blank" class="banner_shop_btn">Shop Now</a></div>
					  </div>
					  <div class="col-lg-6 col-xs-6 banner_add<?php echo $i; ?>"><img src="<?php echo $small_banner_image_path; ?>" alt="<?php echo $small_banner->img_alt; ?> class="add_banner_img img-responsive" ></div>
					</div>
				</div>
			 <?php $i++; } ?>
        </div>
	</div>

	<?php } ?>

	
	
	<?php 	
	foreach($section_records as $section){ ?>
	<div class="container-fluid">
    <h3 class="home_crow_head"><?php echo $section[0]->sectin_name; ?></h3>
    	<div class="owl-carousel " data-plugin-options='{"items": 4, "singleItem": false, "navigation": true, "pagination": false, "autoPlay": false}'>
            
			<?php
			foreach($section as $key=>$product){ 
			$image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;
			?>
            <div class="crowsel_gap itemsContainer"> 
	            <a href="<?php echo base_url().$product->code; ?>"> <img class="img-responsive crowsel_img_width product_img_size" alt="<?php echo $product->image[0]->img_alt; ?>" src="<?php echo $image_path; ?>">
					<!--<div class="play"><img src="img/quick-view.png" style="border:none; display:none" /> </div>-->
	            </a>
			</div>
			 <?php } ?>
        </div>
	</div>
	<?php } ?>

	<div class="clear"></div>	

  
    

	
	
	
	
	
	
	
	
	
	


  


    
