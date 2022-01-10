<style>
.product_img_size{
	width: 269px;
	height: 190px
}
</style>	

<div class="container-fluid page_header_height">
    	<div class="col-md-3 grid_margin">
       <div class="filter_box">
          <div class="brand_filter_head">Product Search</div>
          <div class="col-md-12">
			<form name="search" id="search" action="<?php echo base_url(); ?>products" method="post">
			<div class="input-group input-search brand_search_box">
			  <input type="text" name="search_products" id="search_products" class="form_search-control"  placeholder="Search..." value="<?php echo $search['search_products']; ?>">
			  <span class="input-group-btn">
				<!--<button class="btn brand_search_btn" type="submit">Search</button>-->
				<input class="btn brand_search_btn" type="submit" name="search" id="search" value="Search">
			  </span>
			</div>
			</form>
          </div>
		  
		  
          <!--<div class="brand_filter_head">Department</div>
		   <form name="search" id="search" action="<?php echo base_url(); ?>products" method="post">
            <div class="col-md-12">
			 <?php foreach($department_record as $key=>$department){ 
						
						if (in_array($department->id, $department_ids))
							$selected = 'checked="checked"';
						else
							$selected = '';
				?>
              <div class="checkbox-custom checkbox-default check_box_brand">
                  <input type="checkbox" name="department[]" id="department<?php echo $department->id; ?>" <?php echo $selected; ?> value="<?php echo $department->id; ?>"> 
                    <label for="checkboxExample1"><?php echo $department->name; ?></label>
              </div>
              <?php } ?>
              <div><button class="btn brand_search_btn btn_coust" type="submit">GO</button></div>
            </div>
			</form>--->
			
			
			
          <div class="clear"></div>
       </div>
      </div>
      <div class="col-md-9 grid_margin">
	  
		<?php 
		foreach($products as $key=>$product){ 
		$image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;
		$packet = $product->packet;			
		?>	
        <div class="col-md-4">
          <div class="product_box">
			<form name="product" id="product" action="<?php echo base_url().$product->code; ?>" method="post">
            <!--<a href="<?php echo base_url().$product->code; ?>">-->
              <img class="product_img_size" src="<?php echo $image_path; ?>" />
              <div class="product_price">MRP: <i class="fa fa-inr"></i> <?php echo $product->mrp; ?></div>
			  <div class="product_name"><?php echo $product->brand_name; ?></div>
              <div class="product_name"><?php  echo substr($product->name, 0,24); if(strlen($product->name)>24) echo " ..."; ?></div>
              <div class="product_dis"><a href="#" title="<?php echo strip_tags($product->short_description); ?>" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><?php echo substr(strip_tags($product->short_description), 0,30); if(strlen(strip_tags($product->short_description))>30) echo " ..."; ?></a></div>
              <div>
              <span><button class="btn brand_search_btn btn_coust" type="submit">DETAILS</button></span>
              <!--<span><a href=""><img src="img/wisslist.jpg" /></a></span>-->
              </div>
            <!--</a>-->
			</form>
          </div>
        </div>
		<?php } ?>  			
      </div>
	  <div class="col-md-9 grid_margin">	  
			<ul class="pagination" style="float:right; margin:20px 0px 20px 0px;">
				<?php echo $pagination_links; ?>
			</ul>	
	  </div>
	  
	 
	  
	 </div>
	

	


	<div class="clear"></div>	

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="img/add_banner.jpg" class="img-responsive"></div>
    </div>-->

    

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/npm.js"></script>

   

<script src="owlcarousel/owl.carousel.js"></script>
<script src="owlcarousel/theme.js"></script>
<script src="owlcarousel/theme.init.js"></script>  

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>



  </body>
</html>
