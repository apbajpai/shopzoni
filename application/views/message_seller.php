<div role="main" class="main shop banner_top_margin account_page_header_height mobile_header_top_margin">

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Message To Seller</h4>											
											<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; $error_msg=''; ?></span><?php } ?>
											<?php if($success_msg!=''){ ?><span style="color:green;"><?php echo $success_msg; $success_msg='';?></span><?php } ?>
											<?php if($seller_info!=''){ ?><?php echo $seller_info; $seller_info='';?></span><?php } ?>
											
											<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															&nbsp;
														</div>
													</div>
												</div>
											
											<?php if($success!=1){ ?>
											<form action="<?php base_url(); ?>savemessage_seller " id="message_seller" name="message_seller" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Vendor Code</label>
															<input type="text" name="seller_code" id="seller_code" value="<?php echo $seller_code; ?>" class="form-control input-lg">
															<label class="error" for="name"><p><font color="red"><?php echo $error_seller_code; ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>message</label>
															<textarea name="message" class="form-control" rows="2"  maxlength="5000"><?php echo $message; ?></textarea>
															<label class="error" for="name"><p><font color="red"><?php echo $error_message; ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="Send" class="btn brand_search_btn btn_coust pull-right push-bottom" data-loading-text="Loading...">
													</div>
												</div>
											</form>
											<?php } ?>
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
    



   


  