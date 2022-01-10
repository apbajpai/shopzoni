
	<div class="container-fluid " id="show_seller">
      <div class="col-md-12 grid_margin">
            <div class="panel-body mob__saller_box_hide">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed mb-none">
                  <thead>
                    <tr>
                      <th width="93" class="text-center table_box_head">Seller Name</th>
                      <th width="78" class="text-center table_box_head">Seller Info</th>
                      <th width="40" class="text-center table_box_head">Price</th>
					  <th width="40" class="text-center table_box_head">Offer</th>
					  <th width="106" class="text-center table_box_head">Delivery Location</th>
					  <th width="125" class="text-center table_box_head">Go To Store</th>
					  <th width="125" class="text-center table_box_head">Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  
				  <?php 					
						foreach($seller_record as $key=>$seller){
						if($seller->packet_price)
							$price = $seller->packet_price;
						else
							$price = $seller->price;	
						
				  ?>
				   <tr>
                    <th class="text-center"><?php echo $seller->business_name; ?></th>
                      <th class="text-center"><?php echo $seller->business_address; ?></th>
                      <th class="text-center"><?php echo $price; ?></th>
					  <th class="text-center"><?php echo $seller->seller_map_record->offer; ?></th>
					  <th class="text-center">					 
							<?php /*$sl = 1;  foreach($seller->delivery_locations as $key=>$location){ ?>
								<span><?php echo $sl.".  ".$location->delivery_location; ?></span>
								<br>
							<?php $sl++; } */ ?>	
							<a onclick="popup('<?php echo $seller->id; ?>');" data-placement="bottom"  class="shop_cunt">
							<span style="color:#E57911;font-weight:bold; font-size:18px; text-decoration:underline;"><button class="btn brand_search_btn btn_list" type="submit">View</button></span></a>
					  </th>
					  <th class="text-center"><a href="<?php echo base_url().'shop/'.$seller->seller_code; ?>">
						<button class="btn brand_search_btn btn_list" type="submit">Go To Store</button></a></th>
					  <th class="text-center">
					  <?php if($this->session->userdata('user_id')==""){ 
					  $uri1 = $this->uri->segment(1);
					  $_SESSION['uri1']=$uri1;					  
					  ?>
						<form name ="addtocartfrm" id="addtocartfrm" method="post" action="<?php echo base_url(); ?>login">
                      	<!--<div><button class="btn brand_search_btn btn_list" onclick="buy_packet('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>'),updateCartCounter('<?php echo $seller->id; ?>');" type="submit">Add To Cart</button></div>-->
                      	<div><button class="btn brand_search_btn btn_list" onclick="check_packet_quantity('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>');" type="submit">Add To Cart</button></div>
                        
						<div id="productavlDiv<?php echo $seller->id; ?>" style="color:red; font-size:12px;"></div>
						<div id="productavlDivsucess<?php echo $seller->id; ?>" style="color:green; font-size:12px;"></div>
						
						<div><button class="btn brand_search_btn btn_list" type="submit">Buy Now</button>
						</form>
					  <?php }else{ ?>
					   
                      	<!--<div><button class="btn brand_search_btn btn_list" onclick="buy_packet('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>'),updateCartCounter('<?php echo $seller->id; ?>');" type="submit">Add To Cart</button></div>-->
                      	<div><button class="btn brand_search_btn btn_list" onclick="check_packet_quantity('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>');" type="submit">Add To Cart</button></div>
						
						<div id="productavlDiv<?php echo $seller->id; ?>" style="color:red; font-size:12px;"></div>
						<div id="productavlDivsucess<?php echo $seller->id; ?>" style="color:green; font-size:12px;"></div>
						
						<form name ="addtocartfrm" id="addtocartfrm" method="post" action="<?php echo base_url(); ?>checkout">
                        <div><button class="btn brand_search_btn btn_list" type="submit">Buy Now</button></div>
						  <input type="hidden" name="type" id="type" value="1">
						  <input type="hidden" name="product_id" id="product_id" value="<?php echo $seller->seller_map_record->id; ?>">
						  <input type="hidden" name="packet_map_id" id="packet_map_id" value="<?php echo $seller->packet_map_id; ?>">
						  <input type="hidden" name="quantity" id="quantity" value="1">
						  <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->id; ?>">
						</div>
						</form>					  
					  <?php } ?>
                      </th>
                    </tr>
					
                  <?php } ?>  
                  </tbody>
                </table>
				
              </div>
            </div>
          </div> 
    </div>
	
	
	
	
<script>
  function buy_packet(id,seller_id,packet_map_id){      
    var quantity  = 1; 	
    var packet_map_id  = packet_map_id;		
	  
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>addtocart",
      data: {
        quantity : quantity,
        product_id : id,
        packet_map_id : packet_map_id,
        seller_id : seller_id,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#cartDiv').html(data); 
	  updateCartCounter();
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });	
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
  
  function get_seller(packet_id,product_id,code,product_map_id){
	  //alert(code);
	  $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>get_sellerByPacket",
      data: {
        packet_id : packet_id,  
        product_id : product_id,  
        product_map_id : product_map_id,  
        code : code,  
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#show_seller').html(data); 
    })
    .fail(function(){ 
      alert("Error")   ; 
    });
  }
  
  
  function check_packet_quantity(id,seller_id,packet_map_id){
    
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>check_packet_quantity_new",
      data: {
        quantity : 1,
        product_id : id,
        seller_id : seller_id,
        packet_map_id : packet_map_id,
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
	  //console.log(data);	
	  //alert(data);
      var val = data.split("###"); 
		//alert(val[1]);
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
	buy_packet(id,seller_id,packet_map_id);
  }
    
</script>  


<script>
function popup(str){	
    var myWindow = window.open("<?php echo base_url().'delivery-location/'; ?>"+str, "", "width=500,height=500");
}
</script>
			
			
			
