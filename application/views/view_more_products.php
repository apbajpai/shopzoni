<?php $uri2 = $this->uri->segment(2);  ?>
				
<div   id="view_more">
		
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
          <a href="<?php echo base_url().$product->code; ?>">
            <img src="<?php echo $image_path; ?>" class="product_img_size" />
            <div class="brand_name"><?php  echo substr($product->name, 0,30); if(strlen($product->name)>30) echo " ..."; ?></div>
          </a>
          </div>
        </div>
		<?php } ?>		
     

      <div class="clear"></div>
      <div style="margin-top: 20px; text-align:center">
        <div class="col-md-4"><a target="_blank" href="<?php echo base_url(); ?>partner/<?php echo $uri2; ?>" class="btn brand_search_btn btn_coust">View Partner</a></div> 
        <div class="col-md-4"><a target="_blank" href="<?php echo base_url(); ?>service_center/<?php echo $uri2; ?>" class="btn brand_search_btn btn_coust">Brand Details</a></div>
        <div class="col-md-4"><a onclick="view_less('<?php echo $uri2; ?>');" class="btn brand_search_btn btn_coust">View Less</a></div> 
      </div>
	  
	   </div>
	  </div>					

	  
	  
	  
	  
					
					
<script>
	function view_less(brand_id){		
		url = "<?php echo base_url(); ?>view_less_brand_record/"+brand_id;
		//console.log(url);
		jQuery('#view_more').load(url);
	}
</script>