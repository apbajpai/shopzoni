<?php									
	if($brand_record->image!="")
		$logo = "http://shopzoni.com/brand/public/uploads/brand/".$brand_record->image;
	else
		$logo = "http://shopzoni.com/brand/public/uploads/brand/no_image_brand.png";
?>

<div role="main" class="main shop banner_top_margin" style="padding-top: 180px">
					
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="row featured-boxes login">
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4><?php echo $brand_record->name; ?></h4>
											<div class="col-sm-2"><img src="<?php echo $logo; ?>" width="110"></div>
											<div class="col-sm-10">
												<p> Email : <?php echo $brand_record->email_feedback; ?></p>
												<p>Website : <a href="<?php echo $brand_record->website; ?>" target="_blank"><?php echo $brand_record->website; ?></a></p>
												<p>Customer Care Number : <?php echo $brand_record->customer_care_number; ?></p>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
     			</div>


     			<div class="container">
					<div class="row" style="padding-top:20px;">
					<?php if($service_center_record[0]->id!=""){ ?>
					<h3 style="margin-left:28px; text-decoration:underline">Service Centre</h3>
					<?php } ?>
						<?php foreach($service_center_record as $key=>$service_center){ ?>
						<div class="col-md-6">
							<div class="row featured-boxes login">
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<div class="col-md-12">
												<h4><?php echo $service_center->name; ?></h4>
												<p>Contact Person : <?php echo $service_center->contact_person; ?></p>
												<p>Contact Number : <?php echo $service_center->phone; ?></p>
												<p>Email : <?php echo $service_center->email; ?></p>
												<p>Address : <?php echo $service_center->address; ?></p>
												<p><?php echo $service_center->state_name; ?>, <?php echo $service_center->district_name; ?>, <?php echo $service_center->pincode; ?></p>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						
						
						<!--<div class="col-md-6">
							<div class="row featured-boxes login">
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<div class="col-md-12">
												<h4>Add 1</h4>
												<p>Contact Person : SHANU KUMAR SINHA</p>
												<p>Contact Number : 9968844223</p>
												<p>Email : dev4net@gmail.com</p>
												<p>Address : W-14 greater kailash-1</p>
												<p>Delhi, New Delhi, 110001</p>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>--->
						
						
						
					</div>
     			</div>

	

	 


	<div class="clear"></div> 

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="<?php echo base_url();?>img/add_banner.jpg" class="img-responsive"></div>
    </div>-->
    



   


   