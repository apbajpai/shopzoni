<!DOCTYPE html>
<html lang="en">
<head>

	<script src="other_lib.js"></script>
	<script src="jquery.js"></script>
	<script>
	$.noConflict();
	// Code that uses other library's $ can follow here.
	</script
	
	
	<meta charset="utf-8" />
	<title>Shanmukha</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>css/images/favicon.ico" />
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo base_url();?>css/flexslider.css" type="text/css" media="all" />
	
	<script src="<?php echo base_url();?>js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
		<script src="js/modernizr.custom.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/functions.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.cookie.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/general.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/custom/forms.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/tinymce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.tagsinput.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/plugins/jquery.tagsinput.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/check_email_availability.js"></script>
	
	
</head>
<body>
	<!-- wrapper -->
	<div  id="wrapper">
		<!-- header -->
		<header>
			<div class="shell">
				<h1 id="logo"><a href="index.html">Core</a></h1>
				<div class="contact">
					<p class="ico phone-ico"><span></span>+91 11 26219366</p>
					<p class="ico mail-ico"><span></span><a href="mailto:info@shanmukhaventure.com">info@shanmukhaventure.com</a></p>
				</div>
			</div>	
		</header>
		<!-- end of header -->
		<!-- navigation -->
		<nav id="navigation">
			<div class="shell">
				<ul>
					<li><a href="index.html"><span></span>HOME</a></li>
					<li><a href="about.html"><span class="bottom-arr"></span>ABOUT US</a></li>
					<li><a href="products.html"><span class="bottom-arr"></span>PRODUCTS</a></li>
					<li><a href="distribution.html"><span class="bottom-arr"></span>Distribution</a></li>
					<li class="active"><a href="contact.html"><span class="bottom-arr"></span>CONTACT US</a></li>
				</ul>
			</div>	
		</nav>
		<!-- end of navigation -->
        <!-- main -->
		<div class="main">
			<div class="shell">
				<section>
					<!-- content -->
					<div class="content">
						<h2>Contact Us </h2>
						<?php if($msg!=""){ ?>
						<h2><?php echo $msg; ?></h2>
						<?php } ?>
						<div class="about_wrapper">
                            <div class="clr"></div>
                            <!--contact_wrapper start-->
                                <div class="contact_wrapper">
                                    <!--contact_left start-->
                                    <div class="contact_left">
                                       									
										<form enctype="multipart/form-data" method="post" class="stdform" id="seller" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>seller_registration/save">	
										

										<div class="contact_form">
											<div class="contact_form_left">Display Name</div>
											<div class="contact_form_right">
												<input type="text" name="display_name" id="display_name" class="longinput" value="<?php echo $display_name?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Owner Name:</div>
											<div class="contact_form_right">
												<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">Attach ID Proof:</div>
											<div class="contact_form_right">
											<input type="file" name="identity_proof">(jpg | png | jpeg | gif )
											<input type="hidden" name="identity_proof_old" id="identity_proof_old" value="<?php echo $identity_proof; ?>">
											<?php if($identity_proof){?><span id="identity_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $identity_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#identity_proof_old').val('');jQuery('#identity_proof_old_data').hide()">remove</a></span><?php }?>	
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Business Name:</div>
											<div class="contact_form_right">
											<input type="text" name="business_name" id="business_name" class="longinput" value="<?php echo $business_name?>" />
											</div>											
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Business Address:</div>
											<div class="contact_form_right">
											<input type="text" name="business_address" id="business_address" class="longinput" value="<?php echo $business_address?>" />
											</div>
											<div class="clr"></div>
										</div>
				
				
										<div class="contact_form">
											<div class="contact_form_left">Address Proof:</div>
											<div class="contact_form_right">
											<input type="file" name="address_proof">(jpg | png | jpeg | gif )
											<input type="hidden" name="address_proof_old" id="address_proof_old" value="<?php echo $address_proof; ?>">
											<?php if($address_proof){?><span id="address_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $address_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#address_proof_old').val('');jQuery('#address_proof_old_data').hide()">remove</a></span><?php }?>	
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">Mobile Number:</div>
											<div class="contact_form_right">
											<input type="text" name="mobile_number" id="mobile_number" class="longinput" value="<?php echo $mobile_number?>" />
											</div>
											<div class="clr"></div>
										</div>
				
										
										<div class="contact_form">
											<div class="contact_form_left">Phone Number:</div>
											<div class="contact_form_right">
											<input type="text" name="phone_number" id="phone_number" class="longinput" value="<?php echo $phone_number?>" />
											</div>
											<div class="clr"></div>
										</div>
				
				
										<div class="contact_form">
											<div class="contact_form_left">Email ID:</div>
											<div class="contact_form_right">
											<input type="text" name="email_id" id="email_id" class="longinput" value="<?php echo $email_id?>" onblur="check_email_availability(this.value);"/>
											<input type="hidden"  name="email_check" id="email_check" value="0" >
											</div>
											<div class="clr"></div>
										</div>
				
				
										<div class="contact_form">
											<div class="contact_form_left">Password:</div>
											<div class="contact_form_right">
											<input type="password" name="password" id="password" class="longinput" value="<?php echo $password?>" />
											</div>
											<div class="clr"></div>
										</div>
				
										
										<div class="contact_form">
											<div class="contact_form_left">Confirm Password:</div>
											<div class="contact_form_right">
											<input type="password" name="confirm_password" id="confirm_password" class="longinput" value="<?php echo $password?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">VAT/GST:</div>
											<div class="contact_form_right">
											<input type="text" name="gst" id="gst" class="longinput" value="<?php echo $gst?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">Attached Proof:</div>
											<div class="contact_form_right">
											<input type="file" name="gst_proof">(jpg | png | jpeg | gif )
											<input type="hidden" name="gst_proof_old" id="gst_proof_old" value="<?php echo $gst_proof; ?>">
											<?php if($gst_proof){?><span id="gst_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $gst_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#gst_proof_old').val('');jQuery('#gst_proof_old_data').hide()">remove</a></span><?php }?>	
											</div>
											<div class="clr"></div>
										</div>
										
										
										
										<div class="contact_form">
											<div class="contact_form_left">City:</div>
											<div class="contact_form_right">
											<input type="text" name="city" id="city" class="longinput" value="<?php echo $city?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">State:</div>
											<div class="contact_form_right">
											<input type="text" name="state" id="state" class="longinput" value="<?php echo $state?>" />
											</div>
											<div class="clr"></div>
										</div>
					
				
										<div class="contact_form">
											<div class="contact_form_left">Pin Code:</div>
											<div class="contact_form_right">
											<input type="text" name="pin_code" id="pin_code" class="longinput" value="<?php echo $pin_code?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<!--<div class="contact_form">
											<div class="contact_form_left">Delivery Location (Maximum 20):</div>
											<div class="contact_form_right">
											<input type="text" name="delivery_location" id="delivery_location" class="longinput" value="<?php echo $delivery_location?>" />
											</div>
											<div class="clr"></div>
										</div>-->
				
				
										<div class="contact_form">
											<div class="contact_form_left">Account Number:</div>
											<div class="contact_form_right">
											<input type="text" name="account_number" id="account_number" class="longinput" value="<?php echo $account_number?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Bank Name:</div>
											<div class="contact_form_right">
											<input type="text" name="bank_name" id="bank_name" class="longinput" value="<?php echo $bank_name?>" />	
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Bank Address:</div>
											<div class="contact_form_right">
											<textarea name="bank_address" id="bank_address" rows="5" cols="60" ><?php echo $bank_address?></textarea>
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Bank Phone Number:</div>
											<div class="contact_form_right">
											<input type="text" name="bank_phone_number" id="bank_phone_number" class="longinput" value="<?php echo $bank_phone_number?>" />						
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">IFSC Code:</div>
											<div class="contact_form_right">
											<input type="text" name="ifsc_code" id="ifsc_code" class="longinput" value="<?php echo $ifsc_code?>" />						
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Attached Cancelled Cheque:</div>
											<div class="contact_form_right">
											<input type="file" name="cancelled_cheque">(jpg | png | jpeg | gif )
											<input type="hidden" name="cancelled_cheque_old" id="cancelled_cheque_old" value="<?php echo $cancelled_cheque; ?>">
											<?php if($cancelled_cheque){?><span id="cancelled_cheque_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $cancelled_cheque;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#cancelled_cheque_old').val('');jQuery('#cancelled_cheque_old_data').hide()">remove</a></span><?php }?>	
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Time Slot:</div>
											<div class="contact_form_right">
											<input type="text" name="time_slot" id="time_slot" class="longinput" value="<?php echo $time_slot?>" />						
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Status:</div>
											<div class="contact_form_right">
											<select name="status">
												<option value="0" <?php if($status==0)echo 'selected';?>>No</option>
												<option value="1" <?php if($status==1)echo 'selected';?>>Yes</option>						
											</select>
											</div>
											<div class="clr"></div>
										</div>
				
						
										<div class="contact_form">
											
											<div class="contact_form_right">
											<input type="submit"  name="submit" value="Submit">
											<input type="hidden" name="id" id="id" value="<?php echo $id?>">
											</div>
											<div class="clr"></div>
										</div>
									</form>
										
										
										
										
										
										
										
										
										
										
										
										
                                        <div class="clr"></div>
                                    </div>
                                    <!--contact_left end-->
                                        <div class="contact_right">
                                            <div class="contact_address_right">
                                                <h6>Shanmukha Venture Services pvt. Ltd.</h6>
                                                <p>205 Vishal Bhawan 95 </p>
                                              <p>Nehru Place New Delhi – 110019</p>
                                                <p><span class="contact_address_right_bold">Phone No :</span> +91 11 26219366</p>
                                                <p><span class="contact_address_right_bold">Email Id :</span> <a href="mailto:Info@shanmukhaventure.com">Info@shanmukhaventure.com</a></p>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="clr"></div>
                                    <div class="map">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3504.7148642785974!2d77.252203!3d28.548288999999997!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3c56271865b%3A0x895a336bae841ab!2sVishal+Bhawan!5e0!3m2!1sen!2sin!4v1412015154017" width="890" height="300" frameborder="0" style="border:0"></iframe>
                                    </div>
                                    <div class="clr"></div>
                                </div>
					</div>
					<!-- end of content -->
					<div class="cl">&nbsp;</div>
				</section>
			</div>
		</div>
		<!-- end of main -->
		<!-- services -->
		<!-- end of services -->
		<div id="footer-push"></div>
	</div>
	<!-- end of wrapper -->
	<div id="footer">
		<div class="shell">
			<nav class="footer-nav">
				<a href="index.html">HOME</a>
				<a href="about.html">ABOUT US</a>
				<a href="products.html">PRODUCTS</a>
				<a href="distribution.html">Distribution</a>
				<a href="contact.html" class="active">CONTACT US</a>
			</nav>
			<p class="copy">Copyright &copy; 2012 Shanmukha  </p>
			<div class="cl">&nbsp;</div>
		</div>
	</div>
</body>
</html>


<script>
jQuery(document).ready(function(){	
	jQuery('#delivery_location').tagsInput();	
	jQuery('#time_slot').tagsInput();
	jQuery.validator.setDefaults({ ignore: '' });
	jQuery("#seller").validate({
		rules: {
			display_name: "required",
			name: "required",
			business_name: "required",
			business_address: "required",
			mobile_number: {
				required: true,
				number: true
			},
			/*phone_number: {
				required: true,
				number: true
			}, */
			email_id: {
				required: true,
				email: true
			},
			email_check:"required",
			password: {
                required: true,
                minlength: 5
            },			
			confirm_password: {
			required: true,
			equalTo: "#password"
			}, 
			//gst: "required",
			city: "required",
			state: "required",
			pin_code: {
				required: true,
				number: true
			},
			delivery_location: "required",
			/*account_number: "required",
			bank_name: "required",
			bank_address: "required",
			bank_phone_number: {
				required: true,
				number: true
			},
			ifsc_code: "required",*/
			time_slot: "required"			
		},
		messages: {
			email_id:{
			    email_id: "Please enter Email Address..!",
				email: "Please enter a valid email address..!"
			},
			password: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!"
            },
			
			email_check:"Email Address Already Registered",
			confirm_password: {
			required: "Please enter confirm password..!",
			equalTo: "Password and confirm password not matched..!" 
			}
		}
	});	
});	

</script>