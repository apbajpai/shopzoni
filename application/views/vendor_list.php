<div role="main" class="main shop banner_top_margin account_page_header_height mobile_header_top_margin">

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Vendor List</h4>											
											<div class="panel-body vander_hidemobile">
												<table class="table table-bordered table-striped table-condensed mb-none">
													<thead>
														<tr>
															<!--<th class="text-center">Date</th>-->
															<th class="text-center ">Vendor Code</th>
															<th class="text-center">Vendor Name</th>
														</tr>
													</thead>
													<tbody>
														<?php 	$i=1; foreach($order_vendor_record as $key=>$vendor){ if($vendor->seller_code!=""){ ?>
														<tr>
															<!--<td class="text-center"><?php echo date("d-m-Y", strtotime($vendor->date_modified)); ?></td>-->
															<td class="text-center"><a href="<?php echo base_url();?>shop/<?php echo $vendor->seller_code; ?>"><?php echo $vendor->seller_code; ?></a></td>
															<td class="text-center"><?php echo $vendor->business_name; ?></td>
														</tr>
														<?php $i++; } } ?>
													</tbody>
												</table>
											</div>
											

											<!--Mobile Vendor List-->
											<div class="panel-body vander_hideweb padding_l_r">
												<table class="table table-bordered table-striped table-condensed mb-none">
													<thead>
														<tr>
															<!--<th class="text-center">Date</th>-->
															<th class="text-center">Vendor Name / Vendor Code</th>
														</tr>
													</thead>
													<tbody>
														<?php 	$i=1; foreach($order_vendor_record as $key=>$vendor){ if($vendor->seller_code!=""){ ?>
														<tr>
															<!--<td class="text-center"><?php echo date("d-m-Y", strtotime($vendor->date_modified)); ?></td>-->
															<td class="text-center">
																<?php echo $vendor->business_name; ?> /
																<a href="<?php echo base_url();?>shop/<?php echo $vendor->seller_code; ?>"><?php echo $vendor->seller_code; ?></a>
															</td>
														</tr>
														<?php $i++; } } ?>
													</tbody>
												</table>
											</div>



											<!--Mobile Vendor List-->






											<h4>Approved Vendors (B2B)</h4>
											<div class="padding_l_r panel-body vander_hidemobile">
												<table class="table table-bordered table-striped table-condensed mb-none">
													<thead>
														<tr>
															<!--<th class="text-center">Date</th>-->
															<th class=" text-center">Vendor Code</th>
															<th class="text-center">Vendor Name</th>
														</tr>
													</thead>
													<tbody>
														<?php 	$i=1; foreach($vendor_record as $key=>$vendor){ if($vendor->seller_code!=""){ ?>
														<tr>
															<!--<td class="text-center"><?php echo date("d-m-Y", strtotime($vendor->date_modified)); ?></td>-->
															<td class=" text-center"><a href="<?php echo base_url();?>shop/<?php echo $vendor->seller_code; ?>"><?php echo $vendor->seller_code; ?></a></td>
															<td class="text-center"><?php echo $vendor->business_name; ?></td>
														</tr>
														<?php $i++; } } ?>
													</tbody>
												</table>
											</div>



											<div class="panel-body vander_hideweb padding_l_r">
												<table class="table table-bordered table-striped table-condensed mb-none">
													<thead>
														<tr>
															<!--<th class="text-center">Date</th>-->
															<th class="text-center">Vendor Name / Vendor Code</th>
														</tr>
													</thead>
													<tbody>
														<?php 	$i=1; foreach($vendor_record as $key=>$vendor){ if($vendor->seller_code!=""){ ?>
														<tr>
															<!--<td class="text-center"><?php echo date("d-m-Y", strtotime($vendor->date_modified)); ?></td>-->
															<td class="text-center"><?php echo $vendor->business_name; ?> / 
																<a href="<?php echo base_url();?>shop/<?php echo $vendor->seller_code; ?>"><?php echo $vendor->seller_code; ?></a>
															</td>
														</tr>
														<?php $i++; } } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
    					
					</div>

			</div>

     

	

	 


	<div class="clear"></div>	

    <!---<div class="container">
    <div class="col-md-2"></div>
    <div><img src="img/add_banner.jpg" class="img-responsive"></div>
    </div>-->
    



   


