<div role="main" class="main shop banner_top_margin" style="padding-top: 180px">

				<div class="container">
					<?php if($sucess_msg!=''){ ?><span style="color:green;"><?php echo $sucess_msg; ?></span><?php } ?>
					<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>	
					<?php if($seller_info!=''){ ?><?php echo $seller_info; ?><?php } ?>
					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Orders</h4>
						<div class="panel-body">
							
								<?php 
									$amount= 0;
									$total = 0;
									if(count($seller_cart_record[0])>0){
									foreach($seller_cart_record as $key=>$seller){ 
								?>
								<div class="row view_order_bottom">
									<div class="col-md-4 text-center"><h4><?php echo $seller->seller_code; ?></h4></div>
									<div class="col-md-4 text-center"><h4><?php echo $seller->business_name; ?></h4></div>
									<div class="col-md-4 text-center"><button class="btn brand_search_btn btn_coust_view_cart" type="button" name="answer" value="Show Div" id="your_orders<?php echo $seller->seller_id; ?>" >View Orders</button></div>
								</div>
								<script>						
										$("#your_orders<?php echo $seller->seller_id; ?>").click(function(){						  
										  $("#cartDiv<?php echo $seller->seller_id; ?>").toggle(); // toggle collapse
										});
								</script>
								
								<form name="frm<?php echo $seller->seller_id; ?>" id="frm<?php echo $seller->seller_id; ?>" action="<?php echo base_url(); ?>place_order" method="post">
								<div id="cartDiv<?php echo $seller->seller_id; ?>" style="display:none">
									<table class="table table-bordered table-striped table-condensed mb-none">
										<thead>
											<tr>
												<th width="30%" class="text-center">Product Name</th>
												<th width="10%" class="text-center">Qty</th>
												<th width="10%" class="text-center">Unit</th>
												<th width="20%" class="text-center">Price</th>
												<th width="10%" class="text-center">Amount</th>
												<th width="10%" class="text-center">Action</th>
											</tr>
										</thead>
										<tbody >
											<?php 
												$amount= 0;
												$total = 0;
												$total_qty = 0;
												foreach($cart_record[$seller->seller_id] as $product){ 
													if($product->packet_map_id!=0){
														$amount = ($product->packet_price*$product->quantity);
														$total += $amount; 
														
														$price = $product->packet_price;
														$unit = $product->packet_unit;
													}else{
														$amount = ($product->price*$product->quantity);
														$total += $amount; 
														$price = $product->price;
														$unit = $product->unit;
													}
													$total_qty = $total_qty+$product->quantity
											?>
											<tr id="cartRowDiv<?php echo $product->cart_id; ?>">
												<th class="text-center"><?php echo $product->name; ?></th>
												<th class="text-center"><?php echo $product->quantity; ?></th>
												<input type="hidden" class="quantity<?php echo $seller->seller_id; ?>" name="quantity[]" value="<?php echo $product->quantity; ?>" />
												<th class="text-center"><?php echo $unit; ?></th>
												
												
												<?php if($product->packet_weight==''){ ?>
												<th class="text-center"><?php echo $product->weight; ?> <?php echo $unit; ?> - <i class="fa fa-inr"></i> <?php echo $price; ?></th>
												<?php }else{ ?>
												<th class="text-center"><?php echo $product->packet_weight; ?> <?php echo $unit; ?> - <i class="fa fa-inr"></i> <?php echo $price; ?></th>
												<?php } ?>
												<th class="text-center"><?php echo number_format($price*$product->quantity , 2, '.', ''); ?></th>
												<input type="hidden" class="qty<?php echo $seller->seller_id; ?>" name="qty[]" value="<?php echo number_format($price*$product->quantity , 2, '.', ''); ?>" />
												<td class="product-remove text-center cross">
													<a onclick="removetocart('<?php echo $product->cart_id; ?>','<?php echo $seller->seller_id; ?>')" title="Remove this item" class="remove" >
														<i class="fa fa-times"></i>
													</a>
												</td>
												<input type="hidden" name="cart_ids[]" value="<?php echo $product->cart_id; ?>">
											</tr>
											
											<?php } ?>
											<tr>
												<td class="text-center"><b>Total</b></td>
												<td class="text-center"><span id="totalcartquantity<?php echo $seller->seller_id; ?>"><?php echo $total_qty; ?></span></td>
												<td class="text-center"></td>
												<td class="text-center"></td>
												<td class="text-center" id="total_quantity<?php echo $seller->seller_id; ?>"><i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ''); ?></td>
												<td class="text-center"><button class="btn brand_search_btn btn_coust Proceed_btn" type="submit"><?php if($seller->type=="0"){?>submit<?php }else{ ?>Proceed <?php } ?></button></td>
												<input type="hidden" name="type" id="type" value="<?php echo $seller->type; ?>">
												<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->seller_id; ?>">
											</tr>
											<tr>
												<td class="text-center" colspan="6"><button class="btn brand_search_btn btn_coust vander_hideweb" type="submit"><?php if($seller->type=="0"){?>submit<?php }else{ ?>Proceed <?php } ?></button></td>
											</tr>
										</tbody>
									</table>
								</div>
								</form>
								<?php } }else if($sucess_msg==""){ ?>
								<span> There is no item in your cart. </span>
								<?php } ?>
								
						</div>
						</div>
									</div>
								</div>
							</div>
						</div>    					
					</div>
			</div>


	<div class="clear"></div>	

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="img/add_banner.jpg" class="img-responsive"></div>
    </div>-->
	
    
	


   <script>
	function removetocart(cart_id,seller_id) {	
		$.ajax({			
			type: "POST",
			url: "<?php echo base_url(); ?>removetocart",
			data: {
				cart_id : cart_id,
				seller_id : seller_id
			}
		})
		.done (function(data) { 
		//alert(data);
		console.log(data);
			var arr = data.split('####');
			var cart_id = arr[0];
			var seller_id = arr[1];
			
			var cartDiv = '#cartRowDiv'+cart_id.trim();			
			$(cartDiv).remove();	
			
			var sum = 0;
			$('.qty'+seller_id).each(function(){
			   sum += Number($(this).val());
			});
			//alert(sum);
			
			$('#total_quantity'+seller_id).html(sum);
			
			var totalqty = 0;
			$('.quantity'+seller_id).each(function(){
			   totalqty += Number($(this).val());
			});
			$('#totalcartquantity'+seller_id).html(totalqty);
			
			//$('#cartDiv'+data).show();
			updateCartCounter(seller_id);
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
</script>


   