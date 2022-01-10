<div role="main" class="main shop" style="padding-top: 100px">
	<div class="container">					
		<div class="row">
			<div class="col-md-12">
				<div class="row featured-boxes login" style="margin-top: 48px;">					
					<div class="col-md-12" id="login">
						<div class="featured-box featured-box-secundary default">
							<div class="box-content">								
								<div class="col-md-12" style="top:30px; right:5px" align="right"><a href="<?php echo base_url(); ?>shop/<?php echo $seller_record[0]->seller_code; ?>"><b>Back</b></a></div>
								<h3><?php echo $seller_record[0]->business_name;?></h3>
								
									<hr>
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">															
												<div class="container-fluid">		
												<div id="sellercartDiv">			
													<div class="col-md-10">
														<div align="center" style="text-decoration: underline;"> <h4>Bank Details</h4> </div>
														<div><h5>Bank Name - <?php echo $seller_record[0]->bank_name; ?> </h5></div>											
														<div><h5>Account Number - <?php echo $seller_record[0]->account_number; ?> </h5></div>											
														<div><h5>Bank Address - <?php echo $seller_record[0]->bank_address; ?> </h5></div>
														<div><h5>IFSC Code - <?php echo $seller_record[0]->ifsc_code; ?> </h5></div> 
														<div><h5>Bank Phone Number - <?php echo $seller_record[0]->bank_phone_number; ?> </h5></div>
													</div>			
												</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">															
												<div class="container-fluid">		
												<div id="sellercartDiv">			
													<div class="col-md-10">
														<div align="center" style="text-decoration: underline;"> <h4>Terms & Conditions</h4> </div>
														<div class="broduct_box_devise">
														<?php echo $record[0]->description; ?> 											
														</div>
													</div>			
												</div>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>							
				</div>
			</div>
		</div>
	</div>
</div>
		
		
	
