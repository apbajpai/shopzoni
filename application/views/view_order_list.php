<div role="main" class="main shop banner_top_margin mobile_header_top_margin order_list_top view_order_list_top_margin" >

				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<h4>Order List</h4><h4>Order ID - <?php echo $order_record[0]->order_id; ?> [<?php echo $order_record[0]->seller_business_name; ?>]</h4>
							<div class="row featured-boxes login">
								
								<div class="box_scroll">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											
							
						<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>
						<div class="panel-body vander_hidemobiles ">
							<table class="table table-bordered table-striped table-condensed mb-none">
								<thead>
									<tr>
										<th class="text-center">Date</th>
										<th class="text-center">Product Name</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Unit</th>
										<th class="text-center">Price</th>
										<th class="text-center">Amount</th>
										<th class="text-center">Status</th>
										<th class="text-center">Select</th>
									</tr>
								</thead>
								<tbody>
									<form name="frm<?php echo $seller->seller_id; ?>" id="frm" action="<?php echo base_url(); ?>cancel_order" method="post">
									<?php 	
									/*echo "<pre>";
									print_r($order_record);
									echo "</pre>";  */
									$grand_total = 0;
									$i=1; foreach($order_record as $key=>$order){
									switch ($order->order_status) {
										case 1:
											$order_status_view = "Added to Cart";
											break;
										case 3:
											$order_status_view = "Order Placed";
											break;
										case 4:
											$order_status_view = "Order Approved";
											break;
										case 5:
											$order_status_view = "Order Cancel";
											break;
									}
									
									?>
									<tr>
										<td class="text-center"><?php echo date("d-m-Y", strtotime($order->date_created)); ?></td>
										<td class="text-center"><?php echo $order->product_name; ?></td>
										<td class="text-center"><?php echo $order->total_quantity; ?></td>
										
										
										<?php if($order->packet[0]->id!=""){ 
										foreach($order->packet as $row){	
										$amount = ($order->product_price*$order->total_quantity);
										?>						
										<td><?php echo $order->product_unit; ?></td>
										<td><?php echo $order->product_weight; ?> <?php echo $order->product_unit; ?> - <i class="fa fa-inr"></i> <?php echo $order->product_price; ?></td>					
										<td><i class="fa fa-inr"></i> <?php echo $amount; ?></td>	
										<?php } }else{ 
										$amount = ($order->product_price*$order->total_quantity);
										?>
										<td><?php echo $order->product_unit; ?></td>
										<td><?php echo $order->product_weight; ?> <?php echo $order->product_unit; ?> - <i class="fa fa-inr"></i> <?php echo $order->product_price; ?></td>					
										<td><i class="fa fa-inr"></i> <?php echo $amount; ?></td>	
										<?php } ?>
										
										
										<th class="text-center"><?php echo $order_status_view; ?></th>										
										<th class="text-center">
										<?php if($order->order_status!=5){ ?>
										<input type="checkbox" name="order_ids[]" id="order_ids<?php echo $order->id; ?>" value="<?php echo $order->id; ?>">
										<?php } ?>
										</th>
									</tr>
									<?php 
									if($order->order_status!=5){
									$grand_total = $grand_total+$amount;	
									$i++; } }?>
									
									<tr>
										<td class="text-center" colspan="5">Total</td>
										<th class="text-left"><i class="fa fa-inr"></i> <?php echo $grand_total; ?></th>
									</tr>
									
									<tr>
										<td class="text-center" colspan="7"></td>
										<th class="text-center"><button class="btn brand_search_btn btn_coust" name="submit" id="submit" type="submit">Cancel</button></th>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						
						
					<!--Mobile UI-->
					
					<form name="frm<?php echo $seller->seller_id; ?>" id="frm" action="<?php echo base_url(); ?>cancel_order" method="post">
					<?php 	
					/*echo "<pre>";
					print_r($order_record);
					echo "</pre>";  */
					$grand_total = 0;
					$i=1; foreach($order_record as $key=>$order){
					switch ($order->order_status) {
						case 1:
							$order_status_view = "Added to Cart";
							break;
						case 3:
							$order_status_view = "Order Placed";
							break;
						case 4:
							$order_status_view = "Order Approved";
							break;
						case 5:
							$order_status_view = "Order Cancel";
							break;
					}
					
					?>
									
					<!--<div class="col-md-12 order_list_details_box  padding_l_r product_saller_detail">
	                  	<div class="col-md-12 sal_name padding_l_r">
	                  		<?php echo date("d-m-Y", strtotime($order->date_created)); ?>
	                  	</div>
	                  	<div class="col-md-12 sal_des padding_l_r">
	                  		<?php echo $order->product_name; ?>
	                  	</div>
	                  	<div class="col-md-12 sal_des">
	                  		<?php echo $order->total_quantity; ?>
	                  	</div>
						
						<?php if($order->packet[0]->id!=""){ 
							foreach($order->packet as $row){	
							$amount = ($order->product_price*$order->total_quantity);
						?>	                  	
						<div class="col-md-12 sal_des">
	                  		<?php echo $order->product_unit; ?>
	                  	</div>
						<div class="col-md-12 sal_des">
	                  		<?php echo $order->product_weight; ?> <?php echo $order->product_unit; ?> - <i class="fa fa-inr"></i> <?php echo $order->product_price; ?>
	                  	</div>	
						<div class="col-md-12 sal_des">
	                  		<i class="fa fa-inr"></i> <?php echo $amount; ?>
	                  	</div>
						<?php } }else{ 
							$amount = ($order->product_price*$order->total_quantity);
						?>
						<div class="col-md-12 sal_des">
	                  		<?php echo $order->product_unit; ?>
	                  	</div>
						<div class="col-md-12 sal_des">
	                  		<?php echo $order->product_weight; ?> <?php echo $order->product_unit; ?> - <i class="fa fa-inr"></i> <?php echo $order->product_price; ?>
	                  	</div>
						<div class="col-md-12 sal_des">
	                  		<i class="fa fa-inr"></i> <?php echo $amount; ?>
	                  	</div>				
						<?php } ?>
						
	                  	<div class="col-md-12 sal_btn_box">
	                  		<a href="<?php echo base_url() ?>view_order/<?php echo $order->order_id; ?>" class="btn brand_search_btn btn_coust" type="submit">View</a>
	                  	</div>
                  	</div>
					
					<?php 
					$grand_total = $grand_total+$amount;	
					$i++; } ?>
					
					<div class="col-md-12 order_list_details_box  padding_l_r">
						<div class="col-md-12 sal_btn_box">
							<b>Grand Total :</b> <?php echo $grand_total; ?>
						</div>
					</div>-->
					<!--Mobile UI-->	
						
						
						
						
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
    <div><img src="<?php echo base_url(); ?>img/add_banner.jpg" class="img-responsive"></div>
    </div>-->
    


   


   