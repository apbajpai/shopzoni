<div role="main" class="main shop banner_top_margin mobile_header_top_margin order_list_top">

				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<h4>Order List</h4>
							<div class="row ">
								
								<div class=" box_scroll top_gap_desk">
									<div class="featured-box featured-box-secundary default info-content ">
										<div class="box-content">
											
											<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>
											
											
						<?php	if($order_record[0]->product_id!=""){ ?>					
						<div class="panel-body vander_hidemobiles">
							<table class="table table-bordered table-striped table-condensed mb-none">
								<thead>
									<tr>
										<th class="text-center">Date</th>
										<th class="text-center">Order Id</th>
										<th class="text-center">Vendor Code</th>
										<th class="text-center">Vendor Name</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									
									<?php 	$i=1; foreach($order_record as $key=>$order){ ?>
									<tr>
										<td class="text-center order_cunt"><?php echo date("d-m-Y", strtotime($order->date_created)); ?></td>
										<td class="text-center order_cunt"><?php echo $order->order_id; ?></td>
										<td class="text-center order_cunt"><?php echo $order->seller_code; ?></td>
										<th class="text-center order_cunt"><?php echo $order->seller_business_name; ?></th>
										<th class="text-center"><a href="<?php echo base_url() ?>view_order/<?php echo $order->order_id; ?>" class="btn brand_search_btn btn_coust" type="submit">View</a></th>
									</tr>
									<?php $i++; } ?>
								</tbody>
							</table>
						</div>
						<?php }else{ ?>
						<div class="panel-body">
						You have not placed any orders
						</div>
						<?php } ?>
						
						
						</div>
									</div>
								</div>
							</div>




					<!--<?php if($order_record[0]->product_id!=""){ ?>
					<!--Mobile UI-->
					<!--<?php 	$i=1; foreach($order_record as $key=>$order){ ?>
					<div class="col-md-12 order_list_details_box  padding_l_r" style="border:solid 1px #ddd">
	                  	<div class="col-md-12 sal_name padding_l_r">
	                  		<?php echo date("d-m-Y", strtotime($order->date_created)); ?>
	                  	</div>
	                  	<div class="col-md-12 sal_des padding_l_r">
	                  		<?php echo $order->order_id; ?>
	                  	</div>
	                  	<div class="col-md-12 sal_des">
	                  		<?php echo $order->seller_code; ?>
	                  	</div>
	                  	<div class="col-md-12 sal_des">
	                  		<?php echo $order->seller_business_name; ?>
	                  	</div>
	                  	<div class="col-md-12 sal_btn_box">
	                  		<a href="<?php echo base_url() ?>view_order/<?php echo $order->order_id; ?>" class="btn brand_search_btn btn_coust" type="submit">View</a>
	                  	</div>
                  	</div>
					<?php $i++; } ?>
					<?php }else{ ?>
						<div class="panel-body">
						You have not placed any orders
						</div>
					<?php } ?>-->
					
					<!--Mobile UI-->
					
					
					

						</div>
    					





					</div>

			</div>

     

	

	 


	<div class="clear"></div>	

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="img/add_banner.jpg" class="img-responsive"></div>
    </div>--->
    



   


