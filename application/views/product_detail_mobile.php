<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
vertical-align:middle;
font-weight:400;
font-size:17px;
font-family: serif;
}

.table_box_head{
font-family: Arial, "Helvetica Neue", Helvetica, sans-serif!important;
font-weight:600!important;
}

.check_box_top{
	padding-top:10px;
	padding-left:27px;
}
p{
margin: 0 0 0 0!important;
}
.short_d{
text-decoration:underline;
margin:10px 0;
}

.see_more{
margin: 10px 0;
}


.breadcrumb > li + li:before {
   color: #CCCCCC;
   content: "/ ";
   padding: 0 5px;
}
</style>

<script type="text/javascript">

$(document).ready(function() {
  $('.jqzoom').jqzoom({
            zoomType: 'reverse',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
  //$('.jqzoom').jqzoom();
});

</script>

    <div class="container-fluid banner_top_margin mobile_header_top_margin" >
    	
      <div class="col-md-12 grid_margin">
	  
	  
		
		 <!-- <a href="<?php echo base_url().$product_detail[0]->code; ?>">
		  <?php echo $product_detail[0]->sectin_name; ?> >> <?php echo $product_detail[0]->parent_name; ?> >><?php echo $product_detail[0]->category_name;?>>><?php echo $product_detail[0]->name; ?>
		  </a>-->
        
	  
	  
        <div class="col-md-4">
              <div class="clearfix" id="content">
              <div class="display_inline">
              <ul id="thumblist" class="clearfix" >
			  
			  <?php			
			  foreach($product_detail[0]->image as $key=>$img){ 
			  $image_path = base_url()."brand/public/uploads/product/".$img->image;			 
			  ?>
			  
              <li><a <?php if($key==0){ ?> class="zoomThumbActive" <?php } ?> href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $image_path; ?>',largeimage: '<?php echo $image_path; ?>'}"><img src='<?php echo $image_path; ?>' width="48px" height="48px"></a></li>
              
			  <?php } ?>
			 
              </ul>
              </div>
              <div class="display_inline"> <!--<a href="<?php echo $image_path; ?>" class="jqzoom" rel='gal1'>--> <img width="250px" height="250px" src="<?php echo $image_path; ?>" > <!--</a>--> </div>
              <br/>

              </div>
        </div>
		

        <div class="col-md-5">
          <h1><?php echo $product_detail[0]->name; ?></h1>
          <h5><?php echo $product_detail[0]->model_no; ?></h5>
          <h5>By <a href="<?php echo base_url();?>brand_details/<?php echo $product_detail[0]->brand_slug; ?>"><?php echo $product_detail[0]->brand_name; ?></a></h5>
          <div class="price_tag"><span>MRP:</span> <span> <i class="fa fa-inr"></i> <?php echo $product_detail[0]->mrp; ?> / <?php echo $product_detail[0]->weight; ?> <?php echo $product_detail[0]->unit; ?></span></div>
          <!--<div>
              <fieldset class="rating">
              <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
              <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
              <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
              <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
              <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
              <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
              <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
              <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
              <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
              <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
              </fieldset>
          </div>-->
		  
		  
		  <div class="product_short_dis"> GST : <?php echo $product_detail[0]->tax_category; ?>%</div>
          <div class="clear"></div>
           <!--<div>1 Year Manufacturer Warranty</div>-->
           <!--<div><?php echo $product_detail[0]->offer; ?></div>-->
           <div class="price_tag short_d">Short Description: </div>
           <div class="product_short_dis">
		   <?php echo $product_detail[0]->short_description; ?>
                <div class="see_more"><a href="#pliip"> See more product details</a></div>
          </div>
        </div>
		
		
		 <?php $uri1 = $this->uri->segment(1); ?>
		<form name="brandfrm" id="brandfrm" action="<?php echo base_url().$uri1; ?>" method = "post">	

        <div class="col-md-3 grid_margin">
          <div class="text_center"><span class="share_text">Share</span> 
          <span>
		  <!--<div class="fb-share-button" data-href="<?php echo base_url().$product_detail[0]->code;?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>-->
		  <div class="sharethis-inline-share-buttons"></div>
		  
		  <!--<div class="fb-share-button" data-href="<?php echo base_url().$product_detail[0]->code;?>"  data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().$product_detail[0]->code;?>.&amp;src=sdkpreparse">Share</a></div>
		  
		  <a data-action="share/whatsapp/share" href="whatsapp://send?text=<?php echo base_url().$product_detail[0]->code;?>">
		  <img src="<?php echo $image_path; ?>" />Share via Whatsapp</a>
		 
		 
		 <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo base_url().$product_detail[0]->code;?>&layout=button&size=large&mobile_iframe=true&width=75&height=30&appId" width="75" height="41" style="border:none;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
         <iframe src="https://platform.twitter.com/widgets/tweet_button.html?size=l&url=<?php echo base_url().$product_detail[0]->code;?>&via=Shopzoni&related=twitterapi%2Ctwitter&text=<?php echo $product_detail[0]->code;?>" width="140" height="41" title="Twitter Tweet Button" style="border: 0;" class="none"></iframe>-->

		    
		  
		  
		  
		  <!--<a href="#" class="product_socian_icon"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></span>  
          <span><a href="#" class="product_socian_icon"><i class="fa fa-twitter-square " aria-hidden="true"></i></a></span>
          <span><a href="#" class="product_socian_icon"><i class="fa fa-envelope" aria-hidden="true"></i></a></span>
          <span><a href="#" class="product_socian_icon"><i class="fa fa-instagram" aria-hidden="true"></i></a></span></div>-->		
          <div class="buy_btn_align">
          <!--<div><button class="btn brand_search_btn btn_list" type="submit">Add to Wish list</button></div>-->
          <!--<div><button class="btn brand_search_btn btn_list" type="submit">Add to Cart</button></div>-->
          <!--<div><button class="btn brand_search_btn btn_list" type="submit">Buy Now</button></div>-->
          </div>
		  
          <div class="search_Your_nearest">Search Your nearest seller</div>

          <div class="text_center">
          <!--<div><button class="btn brand_search_btn detect_location" type="submit">Detect Current Location</button></div>-->
		  
		 		  
		  			 
					  
					  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
					  <link rel="stylesheet" href="/resources/demos/style.css">
					  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
					  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
					  
					  <?php	
						foreach($state_record as $key=>$state){
							if($key==0)
								$state_records = '"'.$state->state_name.'"';
							else
								$state_records .= ','.'"'.$state->state_name.'"';
						}
						//echo $state_records;
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
		  
				<div class="col-md-12"><input type="text" class="form_search-control location_form" id="state" name="state" value="<?php echo $search['state']; ?>" placeholder="STATE..."></div>
		  
		  
		  
					<?php					
						foreach($city_record as $key=>$city){
							if($key==0)
								$city_records = '"'.$city->district_name.'"';
							else
								$city_records .= ','.'"'.$city->district_name.'"';
						}
						//echo $city_records;
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
          <div class="col-md-12"><input type="text" class="form_search-control location_form" id="city" name="city" value="<?php echo $search['city']; ?>" placeholder="DISTRICT..."></div>
		  
		  
		  
		  <?php						
						foreach($pincode_record as $key=>$pincode){
							if($key==0)
								$pincode_records = '"'.$pincode->pincode.'"';
							else
								$pincode_records .= ','.'"'.$pincode->pincode.'"';
						}
					  ?>			  
					  
					  <script>
					  /*$( function() {
						var availableTags = [ <?php echo $pincode_records; ?>
						];
						$( "#pincode" ).autocomplete({
						  source: availableTags
						});
					  } ); */
					  </script>
          <div class="col-md-12"><input type="text" class="form_search-control location_form" id="pincode" name="pincode" value="<?php echo $search['pincode']; ?>" placeholder="PINCODE..."></div>
          <div><button class="btn brand_search_btn detect_location" type="submit">Go</button></div>
		  
          </div>

        </div>
      </div>

      <div class="clear"></div>
     
	  </div>

	    
	       
      <div class="container-fluid">
      	<div class="">
      		<div class="col-md-12">
			<?php 
			/*echo "<pre>";
			print_r($packet_record);
			echo "</pre>"; */
			
			if($packet_record[0]->id!=""){ ?>
            <h3 class="home_crow_head">Available in Packets</h3>
            <?php } ?>
			<?php foreach($packet_record as $key=>$pkt){ ?>	
			<label class="checkbox-inline-block check_box_top">	
				<?php if($search['pkt']!=""){ ?>
				<input type="radio" <?php if($pkt->pocket_id==$search['pkt']){ ?> checked="checked" <?php } ?> name="pkt" id="pkt<?php echo $pkt->pocket_id; ?>" value="<?php echo $pkt->pocket_id; ?>" onclick="get_seller('<?php echo $pkt->pocket_id; ?>','<?php echo $product_detail[0]->id; ?>','<?php echo $product_detail[0]->code; ?>');"><?php echo $pkt->weight; ?> <?php echo $pkt->unit; ?>
				<?php }else{ ?>
				<input type="radio" <?php if($key==0){ ?> checked="checked" <?php } ?> name="pkt" id="pkt<?php echo $pkt->pocket_id; ?>" value="<?php echo $pkt->pocket_id; ?>" onclick="get_seller('<?php echo $pkt->pocket_id; ?>','<?php echo $product_detail[0]->id; ?>','<?php echo $product_detail[0]->code; ?>');"><?php echo $pkt->weight; ?> <?php echo $pkt->unit; ?>
				<?php } ?>
            </label>
            <?php } ?>
        </div>
        </div>
      </div>	  
	  </form>	  
	
    <div class="container-fluid grid_margin" id="show_seller" style="margin-bottom:-150px;">
      <div class="col-md-12 grid_margin ">
            <div class="panel-body">
              <!--Mobile UI-->
              <h3 class="home_crow_head">Seller Details</h3>
               <div class="col-md-12 product_saller_detail padding_l_r" style="">
               	  	
					
						<?php 
						foreach($seller_record as $key=>$seller){
							if($seller->packet_price)
								$price = $seller->packet_price;
							else
								$price = $seller->price;
						?>
					
	                  	<div class="col-md-12 sal_name padding_l_r dpage_align" style="background-color: #fff; margin-top:0px;">
	                  		&nbsp;&nbsp;&nbsp; Name : <?php echo $seller->business_name; ?>
	                  	</div>
	                  
	                  	<div class="col-md-12 sal_des dpage_align">
	                  		Price : <?php echo $price; ?>
	                  	</div>
	                  	<div class="col-md-12 sal_des dpage_align">
	                  		Offer : <?php echo $seller->offer; ?>
	                  	</div>
	                  	<div class="col-md-12 sal_btn_box">
	                  		<a onclick="popup('<?php echo $seller->id; ?>');" data-placement="bottom"  class="shop_cunt">
								<span style="color:#E57911;font-weight:bold; font-size:18px; text-decoration:underline;"><button class="btn brand_search_btn btn_list" type="submit">View Delivery Location</button></span></a>

								<span><a href="<?php echo base_url().'shop/'.$seller->seller_code; ?>">
							<button class="btn brand_search_btn btn_list" type="submit">Go To Store</button></a></span>
	                  	</div>
						
						
                  	
	                  	<div class="col-md-12 sal_btn_box">
						
						<?php if($this->session->userdata('user_id')==""){ 
						  $uri1 = $this->uri->segment(1);
						  $_SESSION['uri1']=$uri1;					  
						  ?>
						
						
						  <form name ="addtocartfrm" id="addtocartfrm" method="post" action="<?php echo base_url(); ?>login">
						  <!--<span><button class="btn brand_search_btn btn_list" onclick="buy('<?php echo $seller->product_map_id; ?>','<?php echo $seller->id; ?>'),updateCartCounter('<?php echo $seller->id; ?>');" type="submit">Add To Cart</button></span>-->
						  <span><button class="btn brand_search_btn btn_list" onclick="check_quantity('<?php echo $seller->product_map_id; ?>','<?php echo $seller->id; ?>');" type="submit">Add To Cart</button></span>
						
							<div id="productavlDiv<?php echo $seller->id; ?>" style="color:red; font-size:12px;"></div>
							<div id="productavlDivsucess<?php echo $seller->id; ?>" style="color:green; font-size:12px;"></div>
							
							<span class="padding_l_r">
							
							  <button class="btn brand_search_btn btn_list" type="submit">Buy Now</button>
							  <input type="hidden" name="type" id="type" value="1">
							  <input type="hidden" name="product_id" id="product_id" value="<?php echo $seller->product_map_id; ?>">
							  <input type="hidden" name="quantity" id="quantity" value="1">
							  <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->id; ?>">
							
							</span>
						</form>	
						<?php }else{ ?>
						
	                  		
	                       
							
							<form name ="addtocartfrm" id="addtocartfrm" method="post" action="<?php echo base_url(); ?>checkout">
							<!--<span class=" padding_l_r"><button class="btn brand_search_btn btn_list" onclick="buy('<?php echo $seller->product_map_id; ?>','<?php echo $seller->id; ?>'),updateCartCounter('<?php echo $seller->id; ?>');" type="button">Add To Cart</button></span>-->
							<span class=" padding_l_r"><button class="btn brand_search_btn btn_list" onclick="check_quantity('<?php echo $seller->product_map_id; ?>','<?php echo $seller->id; ?>');" type="button">Add To Cart</button></span>
							
							<div id="productavlDiv<?php echo $seller->id; ?>" style="color:red; font-size:12px;"></div>
							<div id="productavlDivsucess<?php echo $seller->id; ?>" style="color:green; font-size:12px;"></div>
							
							<span class="padding_l_r">
							  <button class="btn brand_search_btn btn_list" type="submit">Buy Now</button>
							  <input type="hidden" name="type" id="type" value="1">
							  <input type="hidden" name="product_id" id="product_id" value="<?php echo $seller->product_map_id; ?>">
							  <input type="hidden" name="quantity" id="quantity" value="1">
							  <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->id; ?>">
							</form>	
							</span>
						<?php } ?>
						</div>
						<?php } ?>
						
                  	</div>
				<!--Mobile UI-->	
					
            </div>			
          </div> 		  
    </div>	
	
	
	
	<div id="pliip" style="margin-bottom:141px;"></div>  
	
	
    <div class="container-fluid grid_margin">	
	
	<div class="price_tag " style="padding-left: 17px; margin-top:20px;"> Description/Specification </div>

	<div class="col-md-12">
	<?php echo $product_detail[0]->description; ?>
	</div>
	
      <!--<div><img src="images/review.png" /></div>-->
      <div class="clearfix"></div>
	  <?php if($brand_product[0]->id!=""){ ?>
      <h3 class="home_crow_head">Others products of this brand</h3>
	  <?php } ?>
      <div class="owl-carousel " data-plugin-options='{"items": 4, "singleItem": false, "navigation": true, "pagination": false, "autoPlay": false}'>  

			<?php 		
			foreach($brand_product as $key=>$product){ ?>			
            <div class="crowsel_gap itemsContainer"> 
			 <?php  $image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;	?>
              <a href="<?php echo base_url().$product->product_code; ?>"><img class="img-responsive crowsel_img_width" src="<?php echo $image_path; ?>">
				<!--<div class="play"><img src="img/quick-view.png" style="border:none;" /> </div>-->
              </a>
			  <span><a href="<?php echo base_url().$product->product_code; ?>"><?php echo $product->product_name; ?></a></span>
            </div>			
			<?php } ?>           
      </div>
    </div>
	


	<div class="clear"></div>	

    
    
	</div>
	</div>

<!--<script src="<?php echo base_url(); ?>qzoom/jquery-1.6.js" type="text/javascript"></script>-->
<script>
$(document).ready(function() { 	
   <?php if($packet_record[0]->pocket_id!=""){ ?>
   get_seller('<?php echo $packet_record[0]->pocket_id; ?>','<?php echo $product_detail[0]->id; ?>','<?php echo $product_detail[0]->code; ?>'); 
   <?php } ?>
});
</script>

<script>
  function buy(id,seller_id){ 
		    
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>addtocart",
      data: {
        quantity : 1,
        product_id : id,
        seller_id : seller_id,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
	
    .done (function(data) { 
      //alert(data);	  
      $('#cartDiv').html(data); 
    })
    .fail(function(){ 
      //alert("Error"); 
    });
	updateCartCounter();
  }


 function updateCartCounter(seller_id)
  {   
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>updateCartCounter",
      data: {
        seller_id : seller_id,  
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#cartCounter').html(data); 
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  }  
  
  function get_seller(packet_idsss,product_id,code){
			//alert(code);
	  var packet_id = $("input[name='pkt']:checked").val();
	  var state  = jQuery('#state').val(); 
	  var city  = jQuery('#city').val(); 
	  var pincode  = jQuery('#pincode').val(); 
	
	  
	  $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>get_sellerByPacket",
      data: {
        packet_id : packet_id,  
        product_id : product_id,         
        code : code,  
        state : state,  
        city : city,  
        pincode : pincode,  
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#show_seller').html(data); 
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  }
  
  
  function check_quantity(id,seller_id){
	
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>check_quantity_new",
      data: {
        quantity : 1,
        product_id : id,
        seller_id : seller_id,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
	  //console.log(data);	
	  //alert(data);
      var val = data.split("###");      
      if(val[1]==1)
      {
		$('#productavlDiv'+val[0]).html('');        
      }else if(val[1]!=''){
		$('#productavlDiv'+val[0]).html(val[1]);
      }
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
	buy(id,seller_id);        
  } 
    
</script>  


<!--Button scroll-->   
    <script type="text/javascript">
$(".jumper").on("click", function( e ) {
    
    e.preventDefault();

    $("body, html").animate({ 
        scrollTop: $( $(this).attr('href') ).offset().top 
    }, 600);
    
});
</script>
 <!--Button scroll End-->


<script>
function popup(str){	
    var myWindow = window.open("<?php echo base_url().'delivery-location/'; ?>"+str, "", "width=500,height=500");
}
</script>


    