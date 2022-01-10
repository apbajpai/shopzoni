<?php delete_cookie('name'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
 /* $( function() {
    $( "#datepicker" ).datepicker({ 
		dateFormat: "dd-mm-yy",
		 minDate: new Date(<?php echo date(); ?>),
		onSelect: function() {
			date = new Date();			
			$("#datepicker").datepicker('option', 'minDate', date);
		}
	});
  });  */ 
  
<?php 
	
	if($holiday->sunday==1){
		$date_content = 'dt.getDay() == 0';
	  }
	  
	  if($holiday->monday==1){
		  if($date_content!="")
				$date_content .= '|| dt.getDay() == 1';
		  else
				$date_content .= ' dt.getDay() == 1';
	  }
	  
	  if($holiday->tuesday==1){
		  if($date_content!="")
				$date_content .= '|| dt.getDay() == 2';
		  else
				$date_content .= ' dt.getDay() == 2';
	  }
	  
	  if($holiday->wednesday==1){
		  if($date_content!="")
				$date_content .= '|| dt.getDay() == 3';
		  else
				$date_content .= ' dt.getDay() == 3';
	  }
	  
	  if($holiday->thursday==1){
		  if($date_content!="")
				$date_content .= '|| dt.getDay() == 4';
		  else
				$date_content .= ' dt.getDay() == 4';
	  }
	  
	  if($holiday->friday==1){
		  if($date_content!="")
				$date_content .= '|| dt.getDay() == 5';
		  else
				$date_content .= ' dt.getDay() == 5';
	  }
	  
	  if($holiday->saturday==1){
		  if($date_content!="")
				$date_content .= '|| dt.getDay() == 6';
		  else
				$date_content .= ' dt.getDay() == 6'; 
	  }
	  
    ?>
	

  
$(function()
{  
  $('#datepicker').datepicker({ 
  dateFormat: "dd-mm-yy",
  minDate: new Date(<?php echo date(); ?>),
  <?php if($date_content!=""){ ?>
	beforeShowDay:
    function(dt)
    {
       return [<?php echo $date_content; ?> ? false : true];
    }
   <?php }else{  ?>
	function(dt) {
		return true;
	}
    <?php } ?>
  
 });
});
  
</script>












 <script>
 
 /** Days to be disabled as an array */
var disableddates = ["12-8-2017", "15-8-2017", "17-8-2017", "19-8-2017"];
 
function DisableSpecificDates(date) {
 
 var m = date.getMonth();
 var d = date.getDate();
 var y = date.getFullYear();
 
 // First convert the date in to the mm-dd-yyyy format 
 // Take note that we will increment the month count by 1 
 var currentdate = (m + 1) + '-' + d + '-' + y ;
 
  // We will now check if the date belongs to disableddates array 
 for (var i = 0; i < disableddates.length; i++) {
 
 // Now check if the current date is in disabled dates array. 
 if ($.inArray(currentdate, disableddates) != -1 ) {
 return [false];
 }
 }
 
}
 
 
 $(function() {
 $( "#datepicker11" ).datepicker({
 beforeShowDay:
    function(dt)
    {
		var disableddates = ["12-8-2017", "15-8-2017", "17-8-2017", "19-8-2017"];
	    var m = date.getMonth();
		var d = date.getDate();
		var y = date.getFullYear();
		var currentdate = (m + 1) + '-' + d + '-' + y ;
		
		for (var i = 0; i < disableddates.length; i++) { 
		 // Now check if the current date is in disabled dates array. 
		 if ($.inArray(currentdate, disableddates) != -1 ) {
			return [false];
		 }
		}
		
       return [dt.getDay() == 2 || dt.getDay() == 5 ? false : true];
    }
 });
 });
 </script>



<div role="main" class="main shop banner_top_margin" style="padding-top: 180px">
		
				<div class="container">
					<?php if($sucess_msg!=''){ ?><span style="color:green;"><?php echo $sucess_msg; ?></span><?php } ?>
					<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>
					<span style="color:red;"><?php echo validation_errors(); ?></span>
					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes">
							
							<form enctype="multipart/form-data" method="post" class="stdform" id="frm<?php echo $seller->seller_id; ?>" name="frm<?php echo $seller->seller_id; ?>" accept-charset="utf-8" action="<?php echo base_url(); ?>b2c_place_order">
								
								
								
								<!--<div class="col-md-12">
									<div class="featured-box featured-box-secundary featured-box-cart">
										<div class="box-content">
											
												<table cellspacing="0" class="shop_table cart">
													<thead>
														<tr>
															<th width="30%" class="product-thumbnail">&nbsp;</th>
															<th width="10%" class="product-name">Product Name</th>
															<th width="20%" class="product-price">Price</th>
															<th width="10%" class="product-price">Unit</th>
															<th width="10%" class="product-quantity">Quantity</th>
															<th width="10%" class="product-subtotal">Amount</th>
															<th width="10%" class="product-remove">Action</th>									
														</tr>
													</thead>
													<tbody>
													
														<?php 	
															$amount= 0;
															$total = 0;
															if(count($seller_cart_record[0])>0){
															foreach($seller_cart_record as $key=>$seller){
															if($seller_id == $seller->seller_id){
														?>
														
														<div class="row product_detail_border product_cat" style="color:black;">
														<div class="col-md-3 " 1d="nn1"><b><?php echo $seller->seller_code; ?></b></div>
														<div class="col-md-6" 1d="nn1"><b><?php echo $seller->business_name; ?></b></div>
														<input type="hidden" name="type" id="type" value="<?php echo $seller->type; ?>">
														<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->seller_id; ?>">												
														
														<?php 
															$amount= 0;
															$total = 0;
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
																
															$image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;
														?>
														
														<tr class="cart_table_item" id="cartRowDiv<?php echo $product->cart_id; ?>">
															
															<td class="product-thumbnail">
																<a href="shop-product-sidebar.html">
																	<img width="100" height="100" alt="" class="img-responsive" src="<?php echo $image_path; ?>">
																</a>
															</td>
															<td class="product-name">
																<a target="_blank" href="<? echo base_url().$product->code;?>"><?php echo $product->name; ?></a>
															</td>
															<td class="product-price">
																<?php if($product->packet_weight==''){ ?>
																<span class="amount"><?php echo $product->weight; ?> <?php echo $unit; ?> - <i class="fa fa-inr"></i> <?php echo $price; ?></span>
																<?php }else{ ?>
																<span class="amount"><?php echo $product->packet_weight; ?> <?php echo $unit; ?> - <i class="fa fa-inr"></i> <?php echo $price; ?></span>
																<?php } ?>
															</td>
															<td class="product-price">
																<span class="amount"><?php echo $unit; ?></span>
															</td>                                                            
															<td class="product-quantity">																
																<div class="quantity">
																	<input type="button" class="minus value-control" value="-" data-action="minus" data-target="quantity<?php echo $product->cart_id; ?>" onclick="calc_amount('<?php echo $product->cart_id; ?>','minus');">
																	<input type="text" class="input-text qty text" title="quantity" value="<?php echo $product->quantity; ?>" name="quantity[<?php echo $product->cart_id; ?>]" id="quantity<?php echo $product->cart_id; ?>" value="<?php echo $product->quantity; ?>" min="1" step="1">
																	<input type="hidden" name="price" id="price<?php echo $product->cart_id; ?>" value="<?php echo $price; ?>">
																	<input type="button" class="plus value-control" value="+" data-action="plus" data-target="quantity<?php echo $product->cart_id; ?>" onclick="calc_amount('<?php echo $product->cart_id; ?>','plus');">
																</div>
															</td>
															<td class="product-subtotal">
																<span class="amount" id="amount<?php echo $product->cart_id; ?>"><i class="fa fa-inr"></i> <?php echo ($price*$product->quantity); ?></span>
															</td>	
															<input type="hidden" id="amt<?php echo $product->cart_id; ?>" class="amt" name="qty[]" value="<?php echo number_format($price*$product->quantity , 2, '.', ''); ?>" />
															<td class="product-remove">
																<a title="Remove this item" class="remove" onclick="removetocart('<?php echo $product->cart_id; ?>','<?php echo $seller->seller_id; ?>')">
																	<i class="fa fa-times"></i>
																</a>
															</td>		
															<input type="hidden" name="cart_ids[]" value="<?php echo $product->cart_id; ?>">
														</tr>
														<?php } ?>
														
														</div>
															<?php } } }else if($sucess_msg==""){ ?>
														<span> There is no item in your cart. </span>
														<?php } ?>
														
													</tbody>
												</table>
											
										</div>
									</div>
								</div>--->



								<div class="">
									<div class="panel-body box_scroll">
												<table class="table table-bordered table-striped table-condensed mb-none" width="100%">
													<thead>
														<tr>															
															<th width="20%" class="text-center ">Product Name</th>
															<th width="20%" class="text-center">Price</th>
															<th width="15%" class="text-center ">Unit</th>
															<th width="20%" class="text-center">Quantity</th>
															<th width="20%" class="text-center ">Amount</th>
															<th width="20%" class="text-center">Action</th>
														</tr>
													</thead>
													
													
													<tbody>
													
													
														<?php 	
															$amount= 0;
															$total = 0;
															if(count($seller_cart_record[0])>0){
															foreach($seller_cart_record as $key=>$seller){
															if($seller_id == $seller->seller_id){
														?>
														
														<div class="row product_detail_border product_cat" style="color:black;">
														<div class="col-md-3 " 1d="nn1"><b><?php echo $seller->seller_code; ?></b></div>
														<div class="col-md-6" 1d="nn1"><b><?php echo $seller->business_name; ?></b></div>
														<input type="hidden" name="type" id="type" value="<?php echo $seller->type; ?>">
														<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->seller_id; ?>">												
														
														<?php 
															$amount= 0;
															$total = 0;
																													
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
																
															$image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;
														?>
													
													
													
														<tr id="cartRowDiv<?php echo $product->cart_id; ?>">
															
															<td width="20%" class="text-center"><a target="_blank" href="<? echo base_url().$product->code;?>"><?php echo $product->name; ?></a></td>
															<?php if($product->packet_weight==''){ ?>
															<td width="20%" class="text-center"> <?php echo $product->weight; ?> <?php echo $unit; ?> - <i class="fa fa-inr"></i> <?php echo $price; ?></td>
															<?php }else{ ?>
															<td width="20%" class="text-center"> <?php echo $product->packet_weight; ?> <?php echo $unit; ?> - <i class="fa fa-inr"></i> <?php echo $price; ?></td>
															<?php } ?>
															<td width="15%" class="text-center"><?php echo $unit; ?></td>
															<td width="20%" class="text-center">
																<div class="quantity">
																<input type="button" class="minus value-control" value="-" data-action="minus" data-target="quantity<?php echo $product->cart_id; ?>" onclick="calc_amount('<?php echo $product->cart_id; ?>','minus');">
																<input type="text" class="input-text qty text" title="quantity" value="<?php echo $product->quantity; ?>" name="quantity[<?php echo $product->cart_id; ?>]" id="quantity<?php echo $product->cart_id; ?>" value="<?php echo $product->quantity; ?>" min="1" step="1">
																<input type="hidden" name="price" id="price<?php echo $product->cart_id; ?>" value="<?php echo $price; ?>">
																<input type="button" class="plus value-control" value="+" data-action="plus" data-target="quantity<?php echo $product->cart_id; ?>" onclick="calc_amount('<?php echo $product->cart_id; ?>','plus');">
																</div>
															</td>
															<td width="20%" class="text-center" id="amount<?php echo $product->cart_id; ?>"><i class="fa fa-inr"></i> <?php echo ($price*$product->quantity); ?></td>
															<input type="hidden" id="amt<?php echo $product->cart_id; ?>" class="amt" name="qty[]" value="<?php echo number_format($price*$product->quantity , 2, '.', ''); ?>" />
																					
															<td width="20%" class="text-center">
															<a title="Remove this item" class="remove" onclick="removetocart('<?php echo $product->cart_id; ?>','<?php echo $seller->seller_id; ?>')">
																	<i class="fa fa-times"></i>
																</a>															
															</td>
															<input type="hidden" name="cart_ids[]" value="<?php echo $product->cart_id; ?>">
														</tr>
														<?php } ?>
														</div>
														<?php } } }else if($sucess_msg==""){ ?>
														<span> There is no item in your cart. </span>
														<?php } ?>
														
													</tbody>
												</table>
											</div>
								</div>
								
								
								
								
						

							<div class="row featured-boxes cart">
                          		<div class="col-md-6">
                          			<div class="col-md-12">
	                          		<div class="featured-box featured-box-secundary default">
											<div class="box-content">
												<h4>Billing Address</h4>
													
													
					
													<!--<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Courier</label>
																<input type="checkbox" name="delivery_type" id="delivery_type" value="curier" <?php if($delivery_type=="curier"){ ?> checked="checked" <?php } ?>>
															</div>
														</div>
													</div>-->

													
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Name</label>
																<input type="text"  name="billing_name" id="billing_name" value="<?php echo $user_record->name; ?>" class="form-control">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Phone/Mobile</label>
																<input type="text" name="billing_mobile" id="billing_mobile" value="<?php echo $user_record->mobile; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>E-mail Address</label>
																<input type="text" name="billing_email" id="billing_email" value="<?php echo $user_record->email; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Address</label>
																<input type="text" name="billing_address" id="billing_address" value="<?php echo $user_record->address; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Pincode</label>
																<input type="text" name="billing_pincode" id="billing_pincode" value="<?php echo $user_record->pincode; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<span class="remember-box checkbox">
																<label>
																	<input type="checkbox" name="is_different" id="is_different" value="yes" <?php if($is_different=="yes"){ ?> checked="checked" <?php } ?>>Check if Delivery Address Different from Billing Address 
																</label>
															</span>
															</div>
														</div>
													</div>
													
													
													
												<div id="delivery_address_div" style="display:none">	
												<h4>Delivery Address</h4>
																							
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Name</label>
																<input type="text"  name="delivery_name" id="delivery_name" value="<?php echo $delivery_name; ?>" class="form-control">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Phone/Mobile</label>
																<input type="text" name="delivery_mobile" id="delivery_mobile" value="<?php echo $delivery_mobile; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>E-mail Address</label>
																<input type="text" name="delivery_email" id="delivery_email" value="<?php echo $delivery_email; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Address</label>
																<input type="text" name="delivery_address" id="delivery_address" value="<?php echo $delivery_address; ?>" class="form-control">
															</div>
														</div>
													</div>
	                                                <div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Pincode</label>
																<input type="text" name="delivery_pincode" id="delivery_pincode" value="<?php echo $delivery_pincode; ?>" class="form-control">
															</div>
														</div>
													</div>
												</div>											
												
											</div>
									</div>
									</div>
                            	</div>
							
							
                            	<div class="col-md-6">
								<div class="col-md-12">
									<div class="featured-box featured-box-secundary default" id="delivery_type_div">
										<div class="box-content">
											<h4>Select Delivery Schedule</h4>
											
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Delivery Location</label>
															<select class="form-control" id="delivery_location_id" name="delivery_location_id">
																<option value="" selected="selected">Select Delivery Location</option>
																<?php						
																	foreach($delivery_location as $loc){
																		if($delivery_location_id == $loc->id) $selected='selected="selected"';
																		else $selected='';
																?>
																<option value="<?php echo $loc->id; ?>" <?php echo $selected ?>><?php echo $loc->delivery_location; ?></option>
                                                               <?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">														
															<label>Delivery date</label>
															<input class="date_icon" id="datepicker" type="text" name="delivery_date" autocomplete="off" /><i class="fa fa-calendar" aria-hidden="true" onclick="call_calender();"></i>
														</div>
														<div id="timeslotDiv">
														<div class="col-md-6" >
															<label>Time Slot</label>
															<select class="form-control" id="time_slot_id" name="time_slot_id">
																<option value="">Select time slot</option>
																<?php 						
																	foreach($time_slot as $time){
																		if($time_slot_id == $time->id) $selected='selected="selected"';
																		else $selected='';
																?>
                                                                <option value="<?php echo $time->id; ?>" <?php echo $selected ?>><?php echo date('g:i A', strtotime($time->fromtime)); ?>- <?php echo date('g:i A', strtotime($time->totime)); ?></option>
																	<?php }	?>
															</select>
														</div>
														</div>														
													</div>
												</div>											
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="featured-box featured-box-secundary default" style="margin-top:13px">
										<div class="box-content">
											<h4>Cart Totals</h4>
											<table cellspacing="0" class="cart-totals">
												<tbody>
													<tr class="cart-subtotal">
														<th>
															<strong>Cart Subtotal</strong>
														</th>
														<td>
															<strong><i class="fa fa-inr"></i> <span class="amount" id="total_span" ><?php echo number_format($total, 2, '.', ''); ?></span></strong>
															<input type="hidden" name="total" id="total" value="<?php echo number_format($total, 2, '.', ''); ?>">
															<input type="hidden" name="totals" id="totals" value="<?php echo number_format($total, 2, '.', ''); ?>">
														</td>
													</tr>
													
													<tr class="shipping">														
														<th>
															Shipping
														</th>
														<td id="shippingDiv">
															
														</td>														
													</tr>
													
													
													<tr class="total">
														<th>
															<strong>Total</strong>
														</th>
														<td>
															<strong>  <span class="amount" id="grand_total_span"><i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ''); ?></span></strong>
															<input type="hidden" name="grand_total" id="grand_total" value="<?php echo number_format($total, 2, '.', ''); ?>">
														</td>
													</tr>
													
													<?php //if($total<=$seller_cart_record[0]->minimum_order_amount && $seller_cart_record[0]->minimum_order_amount!=0){ ?>
													<tr class="total" id="minimum_orderDIV" style="display:none;">
														<th>
															<strong>Minimum Order Value</strong>
														</th>
														<td>
															<strong> <span class="amount" id="minimum_amount_span"> <i class="fa fa-inr"></i> <?php echo number_format($seller_cart_record[0]->minimum_order_amount, 2, '.', ''); ?></span></strong>																									
														</td>
													</tr>
													<?php //} ?>
													<input type="hidden" name="minimum_order_amount" id="minimum_order_amount" value="<?php echo number_format($seller_cart_record[0]->minimum_order_amount, 2, '.', ''); ?>">
												</tbody>
											</table>
										</div>
									</div>
								</div>
                                </div>
							</div>						
							
							
							
                            <?php //if($total>=$seller_cart_record[0]->minimum_order_amount || $seller_cart_record[0]->minimum_order_amount==0){ ?>
                            <div class="row featured-boxes" id="confirmDiv" style="display:none;">
								<div class="col-md-12">
									<div class="actions-continue">
										<button class="btn brand_search_btn btn_coust" type="submit">Confirm</button>										
									</div>
								</div>
							</div>
							<?php // } ?>
							</form>
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
function calc_amount(id,action){		
		var qty_id = 'quantity'+id;
		var quantity  = document.getElementById(qty_id).value;	
		//alert(shipping_charge);
		//alert(quantity);
		//alert(action);
		if(action=='plus'){
			var quantity  = ++quantity;
		}else if(action=='minus' && quantity>1){
			var quantity  = --quantity;
		}
		var price_id = 'price'+id;
		var price  = document.getElementById(price_id).value;	
		var total = quantity*price;		
		$('#amount'+id).html(total);
		$('#amt'+id).val(total);
				
		var sum = 0;
		var grand_total = 0;
		$('.amt').each(function(){
		   sum += Number($(this).val());
		});
		
		if($('#shipping_charge').val()>0){
			grand_total =sum + Number($('#shipping_charge').val());
		}else{
			grand_total =sum;
		}
		
		$('#total_span').html(sum);
		$('#grand_total_span').html(grand_total);
		$("#total").val(sum);
		$("#grand_total").val(grand_total);		
		
		var min_order_amount = <?php echo $seller_cart_record[0]->minimum_order_amount; ?>;		
		if(sum < min_order_amount)
		{
			$("#confirmDiv").hide();
			$("#minimum_orderDIV").show();				
		}else{			
			$("#confirmDiv").show();
			$("#minimum_orderDIV").hide();
		}
}

function update_shipping_charge(){	
	//alert(" update_shipping_charge function called");
	var sum = 0;
	var grand_total = 0;
	$('.amt').each(function(){
	   sum += Number($(this).val());
	});
	
	var shipping_charge  = $('#shipping_charge').val();
	
	if(shipping_charge>0){
		var grand_total = Number(sum)+Number(shipping_charge);	
	}else{
		var grand_total = sum;
	}
	//alert(sum);
	$('#total_span').html(sum);
	$('#grand_total_span').html(grand_total);
	$("#totals").val(grand_total);
	$("#grand_total").val(grand_total);
	
	var min_order_amount = <?php echo $seller_cart_record[0]->minimum_order_amount; ?>;	
	if(sum < min_order_amount)
	{
		$("#confirmDiv").hide();
		$("#minimum_orderDIV").show();				
	}else{		
		$("#confirmDiv").show();
		$("#minimum_orderDIV").hide();
	}
	
	/*var system_time  = $('#system_time').val();
	var order_ending_time  = $('#order_ending_time').val();
	
	alert(system_time);
	alert(order_ending_time);
	
	if(system_time > order_ending_time){
		$("#confirmDiv").hide();
	} */
}

</script>
	

	
	
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
		//console.log(url);
		.done (function(data) { 
			var arr = data.split('####');
			var cart_id = arr[0];
			var seller_id = arr[1];			
			$('#cartRowDiv'+cart_id).remove();	
			
			var sum = 0;
			$('.amt').each(function(){
			   sum += Number($(this).val());
			});		
			
			var grand_total = 0;
			if($('#shipping_charge').val()>0){
				var grand_total =sum + Number($('#shipping_charge').val());
			}else{
				var grand_total =sum;	
			}
			
			$('#total_span').html(sum);
			$('#grand_total_span').html(grand_total);
			$("#totals").val(sum);
			$("#grand_total").val(grand_total);
			
			var min_order_amount = <?php echo $seller_cart_record[0]->minimum_order_amount; ?>;			
			if(sum < min_order_amount)
			{				
				$("#confirmDiv").hide();
				$("#minimum_orderDIV").show();				
			}else{				
				$("#confirmDiv").show();
				$("#minimum_orderDIV").hide();
			}
			location.reload(true);
			//$('#cartDiv'+data).show();	
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}	
</script>


<script>

<?php if($is_different=="yes"){ ?>
	$("#delivery_address_div").show();
<?php } ?>


$("#is_different").click(function(){
	if(!$(this).is(":checked"))
		$("#delivery_address_div").hide();
	else
		$("#delivery_address_div").show();
});

<?php if($delivery_type=="curier"){ ?>
	$("#delivery_type_div").hide();
<?php } ?>


$("#delivery_type").click(function(){
	if(!$(this).is(":checked"))
		$("#delivery_type_div").show();
	else
		$("#delivery_type_div").hide();
});


$("#b2bbtn").click(function(){
    $("#b2cdiv").hide();
	$("#b2bdiv").show();
});

$("#b2cbtn").click(function(){
    $("#b2bdiv").hide();
	$("#b2cdiv").show();
});


$("#proceed").click(function(){
    $( "#proceedDIV" ).toggle();
});

jQuery(document).ready(function(){	
	jQuery("#frm").validate({
		rules: {
			delivery_location_id: required,			
			time_slot_id: required,			
		},
		messages: {
			delivery_location_id: {
				required: "Please Select Delivery Location",
			},	
			time_slot_id: {
				required: "Please Select Time Slot",
			},	
		}
	});
});	
</script>


<script>
jQuery('#datepicker').change(function(){
		delivery_date = jQuery(this).val();
		//alert(delivery_date);
		delivery_location_id	=	$('#delivery_location_id').find("option:selected").val();
		
		if(delivery_location_id!=""){
			url = "<?php echo base_url(); ?>timeslotDropdown/"+delivery_location_id+"/<?php echo $seller_id; ?>/"+delivery_date;
			console. log(url); 
			jQuery('#timeslotDiv').load(url);
			
			url = "<?php echo base_url(); ?>shipping/"+delivery_location_id+"/<?php echo $seller_id; ?>";			
			jQuery('#shippingDiv').load(url);			
			update_shipping_charge();
		}else{
			jQuery('#timeslotDiv').html("");
			jQuery('#shippingDiv').html("");
			update_shipping_charge();
		}
});


jQuery('#delivery_location_id').change(function(){
		delivery_location_id = jQuery(this).val();
		
		if(delivery_location_id!=""){			
			url = "<?php echo base_url(); ?>shipping/"+delivery_location_id+"/<?php echo $seller_id; ?>";			
			jQuery('#shippingDiv').load(url);
			//sleep(200);
			//alert("ok");
			//jQuery.wait(50);
			update_shipping_charge();
		}else{			
			jQuery('#shippingDiv').html("");
			update_shipping_charge();
		}
});
</script>


   


    