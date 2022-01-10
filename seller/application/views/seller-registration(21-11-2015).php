<!DOCTYPE html>
<html lang="en">
<head>
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
                                       <!--<form method="POST" action="wtb.php" >
									      <input type="hidden" name="send_to" value="query@shanmukhaventure.com" />
										  <div class="contact_form_div">
                                            <h1>Contact Form</h1>
                                            <div class="contact_form">
                                                <div class="contact_form_left">Name:</div>
                                                <div class="contact_form_right"><input type="text" name="Name" class="contact_textbox_style" /></div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="contact_form">
                                                <div class="contact_form_left">Email:</div>
                                                <div class="contact_form_right"><input type="email" name="Email" class="contact_textbox_style" required /></div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="contact_form">
                                                <div class="contact_form_left">Phone:</div>
                                                <div class="contact_form_right"><input type="text" name="Phone" class="contact_textbox_style" required/></div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="contact_form">
                                                <div class="contact_form_left">Message:</div>
                                                <div class="contact_form_right"><textarea class="contact_textarea_style" name="message"></textarea></div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="contact_form">
                                                <div class="contact_form_left">&nbsp;</div>
                                                <div class="contact_form_right"><input type="submit" name="submit" class="contact_button_style" value="Send" /></div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
										</form>-->
										
										
										
										
										
										
										<form enctype="multipart/form-data" method="post" class="stdform" id="seller" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>seller_registration/save">	
										

										<div class="contact_form">
											<div class="contact_form_left">Seller Name:</div>
											<div class="contact_form_right"><input type="text" name="seller_name" id="seller_name" class="longinput" value="<?php echo $seller_name?>" /></div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Email:</div>
											<div class="contact_form_right">
											<input type="text" name="email_id" id="email_id" class="longinput" value="<?php echo $email_id?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">Seller Address:</div>
											<div class="contact_form_right">
											<input type="text" name="seller_address" id="seller_address" class="longinput" value="<?php echo $seller_address?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										<div class="contact_form">
											<div class="contact_form_left">Address Proof:</div>
											<div class="contact_form_right">
											<input type="file" name="image1">(jpg | png | jpeg | gif )
											<input type="hidden" name="image1_old" id="image1_old" value="<?php echo $image1; ?>">
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
				
										
										<div class="contact_form">
											<div class="contact_form_left">Phone Number:</div>
											<div class="contact_form_right">
											<input type="text" name="phone_number" id="phone_number" class="longinput" value="<?php echo $phone_number?>" />
											</div>
											<div class="clr"></div>
										</div>
				
										
										<div class="contact_form">
											<div class="contact_form_left">Delivery Location:</div>
											<div class="contact_form_right">
											<input type="text" name="delivery_location" id="delivery_location" class="longinput" value="<?php echo $delivery_location?>" />
											</div>
											<div class="clr"></div>
										</div>
				
				
										<div class="contact_form">
											<div class="contact_form_left">Shop Name:</div>
											<div class="contact_form_right">
											<input type="text" name="shop" id="shop" class="longinput" value="<?php echo $shop?>" />
											</div>
											<div class="clr"></div>
										</div>
				
				
										<div class="contact_form">
											<div class="contact_form_left">Bank Account Number:</div>
											<div class="contact_form_right">
											<input type="text" name="bank_account_number" id="bank_account_number" class="longinput" value="<?php echo $bank_account_number?>" />
											</div>
											<div class="clr"></div>
										</div>
				
										
										<div class="contact_form">
											<div class="contact_form_left">Upload Cancelled Cheque:</div>
											<div class="contact_form_right">
											<input type="file" name="image2">(jpg | png | jpeg | gif )
						<input type="hidden" name="image2_old" id="image2_old" value="<?php echo $image2; ?>">
						<?php if($image2){?><span id="image2_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $image2;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image2_old').val('');jQuery('#image2_old_data').hide()">remove</a></span><?php }?>	
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
											<div class="contact_form_left">GST/VAT:</div>
											<div class="contact_form_right">
											<input type="text" name="gst" id="gst" class="longinput" value="<?php echo $gst?>" />
											</div>
											<div class="clr"></div>
										</div>
										
										
										<div class="contact_form">
											<div class="contact_form_left">Uplasd Registration Copy:</div>
											<div class="contact_form_right">
											<input type="file" name="image3">(jpg | png | jpeg | gif )
						<input type="hidden" name="image3_old" id="image3_old" value="<?php echo $image3; ?>">
						<?php if($image3){?><span id="image3_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $image3;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image3_old').val('');jQuery('#image3_old_data').hide()">remove</a></span><?php }?>	
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
											<div class="contact_form_left">Mobile Number:</div>
											<div class="contact_form_right">
											<input type="text" name="mobile_number" id="mobile_number" class="longinput" value="<?php echo $mobile_number?>" />
											</div>
											<div class="clr"></div>
										</div>
				
				
										<div class="contact_form">
											<div class="contact_form_left">Status/Publish:</div>
											<div class="contact_form_right">
											<select name="status">
												<option value="0" <?php if($status==0)echo 'selected';?>>No</option>
												<option value="1" <?php if($status==1)echo 'selected';?>>Yes</option>												
											</select>
											</div>
											<div class="clr"></div>
										</div>
				
						
										<div class="contact_form">
											<div class="contact_form_left">Mobile Number:</div>
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
	jQuery("#seller").validate({
		rules: {
			seller_name: "required",
			email_id: {
				required: true,
				email: true
			},
			seller_location: "required",
			seller_address: "required",
			pin_code: {
				required: true,
				number: true
			},
			
			phone_number: {
				required: true,
				number: true
			},
			delivery_location : "required",
			shop : "required",
			bank_account_number : "required",
			city : "required",
			state : "required",
			gst: {
				required: true,
				number: true
			},
			time_slot : "required",
			mobile_number : "required",
			mobile_number: {
				number: true
			}
		},
		messages: {
			name: "Please enter article title"
		}
	});
	
	
});	

</script>