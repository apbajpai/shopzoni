 <?php
	if($this->agent->is_mobile())
	{
		$detect = "mobile";
	}else{
		$detect = "desktop";
	}		
  ?>  

  <div class="container-fluids banner_top_margin brand_page_top_mr" style="padding-top:10px">
      <div class="">
      <div id="owl-demo" class="owl-carousel">
		<?php foreach($brand_banner_image as $key=>$banner){
			$slider_image_path = base_url()."seller/public/uploads/slider_brand_image/".$banner->image;
			?>
			<div class="item"><img src="<?php echo $slider_image_path; ?>"></div>
       <?php } ?> 
      </div>
      </div>
    </div>

    <div class="container-fluid" style="padding-top: 30px">
            
            <div class="col-md-12" style="margin-top: 30PX">
              <div class="quote_word">
                <ul>
          <li><a href="<?php echo base_url();?>brands/0-9">0-9</a></li>
                  <li><a href="<?php echo base_url();?>brands/A">A</a></li>
                  <li><a href="<?php echo base_url();?>brands/B">B</a></li>
                  <li><a href="<?php echo base_url();?>brands/C">C</a></li>
                  <li><a href="<?php echo base_url();?>brands/D">D</a></li>
                  <li><a href="<?php echo base_url();?>brands/E">E</a></li>
                  <li><a href="<?php echo base_url();?>brands/F">F</a></li>
                  <li><a href="<?php echo base_url();?>brands/G">G</a></li>
                  <li><a href="<?php echo base_url();?>brands/H">H</a></li>
                  <li><a href="<?php echo base_url();?>brands/I">I</a></li>
                  <li><a href="<?php echo base_url();?>brands/J">J</a></li>
                  <li><a href="<?php echo base_url();?>brands/K">K</a></li>
                  <li><a href="<?php echo base_url();?>brands/L">L</a></li>
                  <li><a href="<?php echo base_url();?>brands/M">M</a></li>
                  <li><a href="<?php echo base_url();?>brands/N">N</a></li>
                  <li><a href="<?php echo base_url();?>brands/O">O</a></li>
                  <li><a href="<?php echo base_url();?>brands/P">P</a></li>
                  <li><a href="<?php echo base_url();?>brands/Q">Q</a></li>
                  <li><a href="<?php echo base_url();?>brands/R">R</a></li>
                  <li><a href="<?php echo base_url();?>brands/S">S</a></li>
                  <li><a href="<?php echo base_url();?>brands/T">T</a></li>
                  <li><a href="<?php echo base_url();?>brands/U">U</a></li>
                  <li><a href="<?php echo base_url();?>brands/V">V</a></li>
                  <li><a href="<?php echo base_url();?>brands/W">W</a></li>
                  <li><a href="<?php echo base_url();?>brands/X">X</a></li>
                  <li><a href="<?php echo base_url();?>brands/Y">Y</a></li>
                  <li><a href="<?php echo base_url();?>brands/Z">Z</a></li>
                </ul>
              </div>
        </div>  
    </div>


    <div class="container-fluid" style="padding: 30px">
      <div class="col-md-3 grid_margin">
       <div class="filter_box">
          <div class="brand_filter_head">Brand Search</div>
          <div class="col-md-12">
      <form name="search" id="search" action="<?php echo base_url(); ?>brands" method="post">
      <div class="input-group input-search brand_search_box">
        <input type="text" name="brand_name" id="brand_name" class="form_search-control" name="q" id="q" placeholder="Search...">
        <span class="input-group-btn">
        <button class="btn brand_search_btn" type="submit">Search</button>
        </span>
      </div>
      </form>
          </div>
		  
		 
		  <?php if($detect=="desktop"){ ?>
          <div class="brand_filter_head">Department</div>
			<form name="search" id="search" action="<?php echo base_url(); ?>brands" method="post">
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
			</form>
		  <?php } ?>
			
            
          <div class="clear"></div>
       </div>
      </div>
      <div class="col-md-9 grid_margin">
    <?php 
	foreach($brands_record as $key=>$brand){ 
    if($brand->image!="")
      $brand_image = "http://shopzoni.com/brand/public/uploads/brand/".$brand->image;
    else
      $brand_image = "http://shopzoni.com/brand/public/uploads/brand/no_image_brand.png";
    
    ?>
        <div class="col-md-4">
          <div class="brand_box">
          <a href="<?php echo base_url();?>brand_details/<?php echo $brand->slug; ?>">
            <img src="<?php echo $brand_image; ?>" class="product_img_size" />
            <div class="brand_name"><?php echo $brand->name; ?></div>
          </a>
          </div>
        </div>
    <?php } ?>
    
        
      </div>
    </div>  


  <div class="clear"></div> 

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="<?php echo base_url(); ?>img/add_banner.jpg" class="img-responsive"></div>
    </div>-->




   
    



