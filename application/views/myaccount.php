<?php 
if(isset($row)){
	$id = $row->id; 
    $name = $row->name;
    $business_name = $row->business_name;
    $address = $row->address;
    $pincode = $row->pincode;
    $email = $row->email;
    $password = $row->password;
    $mobile = $row->mobile;
    $subscribe = $row->subscribe;
    $date_created = $row->date_created;
    $date_modified = $row->date_modified;
    $status = $row->status;
}
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>


<div role="main" class="main shop banner_top_margin account_page_header_height mobile_header_top_margin">

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											
											<h3><b>My Account</b></h3>
											<h4><b> Note: </b>Please keep updated your contact information. This information is shown to seller for correct billing. </h4>
											<br>											
											<?php if($success_msg!=''){ ?><span style="color:green;"><?php echo $success_msg; $success_msg='';?></span><?php } ?>
											<?php if($reg_error_msg!=''){ ?><span style="color:red;"><?php echo $reg_error_msg; $reg_error_msg=''; ?></span><?php } ?>
											<form action="<?php base_url(); ?>updateprofile" id="register" name="register" method="post">
												<input type="hidden" name="id" id="id" value="<?php echo $id; ?> ">	
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Name <font color='red'>*</font></label>
															<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php //echo $this->session->userdata('name'); ?></font></p></label>
														</div>
														<div class="col-md-6">
															<label>Business Name</label>
															<input type="text" name="business_name" id="business_name" value="<?php echo $business_name; ?>" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Address <font color='red'>*</font></label>
															<input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('address'); ?></font></p></label>
														</div>
														<div class="col-md-6">
															<label>Pincode <font color='red'>*</font></label>
															<input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('pincode'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>E-mail Address <font color='red'>*</font></label>
															<input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-control input-lg">
														</div>
														<div class="col-md-6">
															<label>Phone/Mobile <font color='red'>*</font></label>
															<input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('mobile'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Password <font color='red'>*</font></label>
															<input type="password" name="password" id="password" value="<?php echo $password; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('password'); ?></font></p></label>
														</div>
														<div class="col-md-6">
															<label>Confirm Password <font color='red'>*</font></label>
															<input type="password" name="cpassword" id="cpassword" value="<?php echo $password; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('cpassword'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													
													<div class="col-md-6">
													<p>We would like to be in touch, and update you of our ongoing developments, including new product launches, promotions, offers and services.</p>
														<span class="remember-box checkbox">
															<label for="rememberme">
																<input type="checkbox" id="subscribe" name="subscribe" <?php if($subscribe==1){ ?> checked="checked" <?php } ?> value="1">I want to be updated about new events, offers and services
															</label>
														</span>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="Update" class="btn brand_search_btn btn_coust pull-right push-bottom" data-loading-text="Loading...">
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
    </div>-->
 
 
 
<script>
jQuery(document).ready(function(){	
	jQuery.validator.setDefaults({ ignore: '' });
	jQuery("#register").validate({
		rules: {		
			name: "required",			
			address: "required",
			pincode: {
				required: true,
				number: true,
				minlength: 6,
				maxlength: 6
			}, 
			email: {
				required: true,
				email: true
			},
			mobile: {
				required: true,
				number: true
			},
			password: {
                required: true,
                minlength: 5,
				//maxlength: 20
            },			
			cpassword: {
			required: true,
			equalTo: "#password"
			}						
		},
		messages: {
			email:{
			    //email: "Please enter Email Address..!",
				email: "Please enter a valid email address..!"
			},
			password: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!",               
                //maxlength: "Your password must be less than equal to 20 characters..!"               
            },			
			cpassword: {
			required: "Please enter confirm password..!",
			equalTo: "Password and confirm password not matched..!" 
			}
		}
	});	
});	





</script>