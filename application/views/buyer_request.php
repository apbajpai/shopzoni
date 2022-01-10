    

<div role="main" class="main shop account_page_header_height mobile_header_top_margin">

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Send Request</h4>
											<?php if($success_msg!=''){ ?><span style="color:green;"><?php echo $success_msg; $success_msg='';?></span><?php } ?>
											<?php if($reg_error_msg!=''){ ?><span style="color:red;"><?php echo $reg_error_msg; $reg_error_msg=''; ?></span><?php } ?>
											<form action="<?php echo base_url(); ?>send_request " id="register" name="register" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Seller Code</label>
															<input type="text" name="seller_code" id="seller_code" value="<?php echo $vendor_code; ?>" class="form-control input-lg">
															<p>After vendor approved your request you will able to view its shop, also vendor code and name will appear in your vendor list.</p>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="Send" class="btn brand_search_btn btn_coust pull-right push-bottom" data-loading-text="Loading...">
													</div>
												</div>
											</form>
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
    </div>--->
    



   


   
