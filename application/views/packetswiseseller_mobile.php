
	<!--Mobile UI-->
	<h3 class="home_crow_head">Seller Details</h3>
    <div class="col-md-12 product_saller_detail padding_l_r" style="width:100%;">
		
		
			<?php 
			foreach($seller_record as $key=>$seller){
				if($seller->packet_price)
					$price = $seller->packet_price;
				else
					$price = $seller->price;
			?>
		
			<div class="col-md-12 sal_name padding_l_r">
				&nbsp;&nbsp; Name : <?php echo $seller->business_name; ?>
			</div>
			
			<div class="col-md-12 sal_des dpage_align">
				Price : <?php echo $price; ?>
			</div>
			<div class="col-md-12 sal_des dpage_align">
				Offer :<?php echo $seller->seller_map_record->offer; ?>
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
			<!--<span><button class="btn brand_search_btn btn_list" onclick="buy_packet('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>'),updateCartCounter('<?php echo $seller->id; ?>');" type="submit">Add To Cart</button></span>-->
			<span><button class="btn brand_search_btn btn_list" onclick="buy_packet('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>');" type="submit">Add To Cart</button></span>
			
			<div id="productavlDiv<?php echo $seller->id; ?>" style="color:red; font-size:12px;"></div>
			<div id="productavlDivsucess<?php echo $seller->id; ?>" style="color:green; font-size:12px;"></div>
			
			<span><button class="btn brand_search_btn btn_list" type="submit">Buy Now</button></span>
			</form>
		  <?php }else{ ?>
			
				
				<form name ="addtocartfrm" id="addtocartfrm" method="post" action="<?php echo base_url(); ?>checkout">
				<!--<span><button class="btn brand_search_btn btn_list" onclick="buy_packet('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>'),updateCartCounter('<?php echo $seller->id; ?>');" type="button">Add To Cart</button>-->
				<span><button class="btn brand_search_btn btn_list" onclick="buy_packet('<?php echo $seller->seller_map_record->id; ?>','<?php echo $seller->id; ?>','<?php echo $seller->packet_map_id; ?>');" type="button">Add To Cart</button>
				
				<div id="productavlDiv<?php echo $seller->id; ?>" style="color:red; font-size:12px;"></div>
				<div id="productavlDivsucess<?php echo $seller->id; ?>" style="color:green; font-size:12px;"></div>
				
				<span><button class="btn brand_search_btn btn_list" type="submit">Buy Now</button>
				 <input type="hidden" name="type" id="type" value="1">
				  <input type="hidden" name="product_id" id="product_id" value="<?php echo $seller->seller_map_record->id; ?>">
				  <input type="hidden" name="packet_map_id" id="packet_map_id" value="<?php echo $seller->packet_map_id; ?>">
				  <input type="hidden" name="quantity" id="quantity" value="1">
				  <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->id; ?>">
				</form>	
		  <?php } ?>	
					
				
			</div>
			<?php } ?>
			
		</div>
	<!--Mobile UI-->
	
	
	
	
	
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
			
			
			
