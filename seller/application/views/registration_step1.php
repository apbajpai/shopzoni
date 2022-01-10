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
	
	
	
	
<div class="container">
  <div class="row">
    <div class="account_creation_tag">
    	<div class="col-md-2"></div>
      <div class="">
        <div class="col-md-1 round colomactive">1</div>
        <div class="col-md-2 Account_head">Account Creation</div>
        <div class="col-md-1 arrow_img"><img src="<?php echo base_url(); ?>img/arrows_1.png" /></div>
      </div>
      <div class="">
        <div class="col-md-1 round">2</div>
        <div class="col-md-2 Account_head">Verification of Details</div>
        <div class="col-md-1 arrow_img"><img src="<?php echo base_url(); ?>img/arrows_1.png" /></div>
      </div>
      <!--<div class="">
        <div class="col-md-1 round">3</div>
        <div class="col-md-2 Account_head">Seller Information</div>
        <div class="col-md-1 arrow_img"><img src="<?php echo base_url(); ?>images/arrows_1.png" /></div>
      </div>-->
    </div>
  </div>
</div>


<div role="main" class="main shop">
  <div class="container">
    <hr class="tall">
    <div class="row">
      <div class="col-md-12">
		<?php if($msg!=''){ ?>
				<div style="text-align:center; color:#FF4500;"><?php echo $msg; ?></div>
		<?php } $msg='';?>
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="panel-body">
		  
            <form enctype="multipart/form-data" method="post" class="stdform" id="seller" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>save">
              
              <div class="form-group">
                <label for="Your Name">Name<font color='red'>*</font></label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name?>">
              </div>
              <div class="form-group">
                <label for="Your Name">Attach ID Proof</label>
                <input type="file" name="identity_proof">(jpg | png | jpeg | gif )
				<input type="hidden" name="identity_proof_old" id="identity_proof_old" value="<?php echo $identity_proof; ?>">
				<?php if($identity_proof){?><span id="identity_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $identity_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#identity_proof_old').val('');jQuery('#identity_proof_old_data').hide()">remove</a></span><?php }?>
              </div>
			  
			  
			  <div class="form-group">
                <label for="Your Name">Business Name<font color='red'>*</font></label>
                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" value="<?php echo $business_name?>">
				<div style="color:red"><b>You won't be able to edit Business Name after submission of the form<b></div>
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Business Address<font color='red'>*</font></label>
                <input type="text" class="form-control" name="business_address" id="business_address" placeholder="Business Address" value="<?php echo $business_address?>">
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Address Proof</label>
                <input type="file" name="address_proof">(jpg | png | jpeg | gif )
				<input type="" name="address_proof_old" id="address_proof_old" value="<?php echo $address_proof; ?>">
				<?php if($address_proof){?><span id="address_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $address_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#address_proof_old').val('');jQuery('#address_proof_old_data').hide()">remove</a></span><?php }?>
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Mobile Number<font color='red'>*</font></label>
                <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number" value="<?php echo $mobile_number?>">
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="<?php echo $phone_number?>">
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Email ID<font color='red'>*</font></label>
                <input type="text" class="form-control" name="email_id" id="email_id" placeholder="Email ID" value="<?php echo $email_id?>">
				<div style="color:red"><b>You won't be able to edit Email ID after submission of the form<b></div>
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Password<font color='red'>*</font></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password?>">
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">Confirm Password<font color='red'>*</font></label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password?>">
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">GST Number<font color='red'>*</font></label>
                <input type="text" class="form-control" name="gst" id="gst" placeholder="GST Number" value="<?php echo $gst?>">
              </div>

			  <div class="form-group">
                <label for="Your Name">Attached Proof</label>
                <input type="file" name="gst_proof">(jpg | png | jpeg | gif )
						<input type="hidden" name="gst_proof_old" id="gst_proof_old" value="<?php echo $gst_proof; ?>">
						<?php if($gst_proof){?><span id="gst_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $gst_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#gst_proof_old').val('');jQuery('#gst_proof_old_data').hide()">remove</a></span><?php }?>
              </div>
			  
			    <div class="form-group">
					<label>State<font color='red'>*</font></label>
					<span class="field">					
					<select id="state_id" name="state_id" style="width:300px;">
					<option value="" selected="selected">Select State</option>
					<?php						
						foreach($state_records as $val){
							if($state_id == $val->id)$selected='selected="selected"';
							else $selected='';
					?>
						<option value="<?php echo $val->id; ?>" <?php echo $selected ?>><?php echo $val->state_name; ?></option>
					<?php
						}
					?>
					</select>					
					</span>					
			    </div>
				
				
			    <div class="form-group" id="citydiv">	
					<label>City / District<font color='red'>*</font></label>					
					<span class="field">
						<select id="city_id" name="city_id" style="width:300px;">	
						<option value="" selected="selected">Select City / District</option>
							<?php						
								foreach($city_records as $city){
									if($city_id == $city->id) $selected='selected="selected"';
									else $selected='';
							?>
								<option value="<?php echo $city->id; ?>" <?php echo $selected ?>><?php echo $city->district_name; ?></option>
							<?php
								}
							?>
					</select>
					</span>					
			    </div>
				
				
			    <div class="form-group" id="pincodediv">		
					<label>Pin Code<font color='red'>*</font></label>
					<span class="field">
						<select id="pincode_id" name="pincode_id" style="width:300px;">	
						<option value="" selected="selected">Select Pin Code</option>
							<?php						
								foreach($pincode_records as $pincode){
									if($pincode_id == $pincode->id) $selected='selected="selected"';
									else $selected='';
							?>
								<option value="<?php echo $pincode->id; ?>" <?php echo $selected ?>><?php echo $pincode->pincode; ?></option>
							<?php
								}
							?>
					</select>
					</span>					
				</div>

			  <!--<div class="form-group">
                <label for="Your Name">State<font color='red'>*</font></label>
					<select name="state" id="state">
						<option value="" <?php if($state=="")echo 'selected';?>>-Select-</option>
						<option value="Andhra Pradesh" <?php if($state=="Andhra Pradesh")echo 'selected';?>>Andhra Pradesh</option>
						<option value="Arunachal Pradesh" <?php if($state=="Arunachal Pradesh")echo 'selected';?>>Arunachal Pradesh</option>						
						<option value="Assam" <?php if($state=="Assam")echo 'selected';?>>Assam</option>						
						<option value="Bihar" <?php if($state=="Bihar")echo 'selected';?>>Bihar</option>						
						<option value="Chhattisgarh" <?php if($state=="Chhattisgarh")echo 'selected';?>>Chhattisgarh</option>						
						<option value="Goa" <?php if($state=="Goa")echo 'selected';?>>Goa</option>						
						<option value="Gujarat" <?php if($state=="Gujarat")echo 'selected';?>>Gujarat</option>						
						<option value="Haryana" <?php if($state=="Haryana")echo 'selected';?>>Haryana</option>						
						<option value="Himachal Pradesh" <?php if($state=="Himachal Pradesh")echo 'selected';?>>Himachal Pradesh</option>						
						<option value="Jammu and Kashmir" <?php if($state=="Jammu and Kashmir")echo 'selected';?>>Jammu and Kashmir</option>						
						<option value="Jharkhand" <?php if($state=="Jharkhand")echo 'selected';?>>Jharkhand</option>
						<option value="Karnataka" <?php if($state=="Karnataka")echo 'selected';?>>Karnataka</option>							
						<option value="Kerala" <?php if($state=="Kerala")echo 'selected';?>>Kerala</option>						
						<option value="Madhya Pradesh" <?php if($state=="Madhya Pradesh")echo 'selected';?>>Madhya Pradesh</option>						
						<option value="Maharashtra" <?php if($state=="Maharashtra")echo 'selected';?>>Maharashtra</option>						
						<option value="Manipur" <?php if($state=="Manipur")echo 'selected';?>>Manipur</option>						
						<option value="Meghalaya" <?php if($state=="Meghalaya")echo 'selected';?>>Meghalaya</option>						
						<option value="Mizoram" <?php if($state=="Mizoram")echo 'selected';?>>Mizoram</option>						
						<option value="Nagaland" <?php if($state=="Nagaland")echo 'selected';?>>Nagaland</option>						
						<option value="Odisha" <?php if($state=="Odisha")echo 'selected';?>>Odisha</option>						
						<option value="Punjab" <?php if($state=="Punjab")echo 'selected';?>>Punjab</option>						
						<option value="Rajasthan" <?php if($state=="Rajasthan")echo 'selected';?>>Rajasthan</option>						
						<option value="Sikkim" <?php if($state=="Sikkim")echo 'selected';?>>Sikkim</option>						
						<option value="Tamil Nadu" <?php if($state=="Tamil Nadu")echo 'selected';?>>Tamil Nadu</option>	
						<option value="Telangana" <?php if($state=="Telangana")echo 'selected';?>>Telangana</option>
						<option value="Tripura" <?php if($state=="Tripura")echo 'selected';?>>Tripura</option>						
						<option value="Uttar Pradesh" <?php if($state=="Uttar Pradesh")echo 'selected';?>>Uttar Pradesh</option>						
						<option value="Uttarakhand" <?php if($state=="Uttarakhand")echo 'selected';?>>Uttarakhand</option>						
						<option value="West Bengal" <?php if($state=="West Bengal")echo 'selected';?>>West Bengal</option>
						<option value="Andaman and Nicobar Islands" <?php if($state=="Andaman and Nicobar Islands")echo 'selected';?>>Andaman and Nicobar Islands</option>
						<option value="Chandigarh" <?php if($state=="Chandigarh")echo 'selected';?>>Chandigarh</option>
						<option value="Dadra and Nagar Haveli" <?php if($state=="Dadra and Nagar Haveli")echo 'selected';?>>Dadra and Nagar Haveli</option>
						<option value="Daman and Diu" <?php if($state=="Daman and Diu")echo 'selected';?>>Daman and Diu</option>
						<option value="Lakshadweep" <?php if($state=="Lakshadweep")echo 'selected';?>>Lakshadweep</option>
						<option value="National Capital Territory of Delhi" <?php if($state=="National Capital Territory of Delhi")echo 'selected';?>>National Capital Territory of Delhi</option>
						<option value="Pondicherry" <?php if($state=="Pondicherry")echo 'selected';?>>Pondicherry</option>												
					</select>
              </div>
			  
			  <div class="form-group">
                <label for="Your Name">City<font color='red'>*</font></label>
                <input type="text" class="city" name="city" id="city" placeholder="city" value="<?php echo $city?>">
              </div>
			  
              <div class="form-group">
                <label for="Your Name">Pin Code<font color='red'>*</font></label>
                <input type="text" class="form-control" name="pin_code" id="pin_code" placeholder="Pin Code" value="<?php echo $pin_code?>">
              </div>	
			  			  
			  <div class="form-group">
                <label for="Your Name">Account Number</label>
                <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Account Number" value="<?php echo $account_number?>">
              </div>	
			  
			  <div class="form-group">
                <label for="Your Name">Bank Name</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?php echo $bank_name?>">
              </div>	
			  <div class="form-group">
                <label for="Your Name">Bank Address</label>
                <input type="text" class="form-control" name="bank_address" id="bank_address" placeholder="Bank Address" value="<?php echo $bank_address?>">
              </div>	
			  
			  <div class="form-group">
                <label for="Your Name">Bank Phone Number</label>
                <input type="text" class="form-control" name="bank_phone_number" id="bank_phone_number" placeholder="Bank Phone Number" value="<?php echo $bank_phone_number?>">
              </div>	
			  
			  <div class="form-group">
                <label for="Your Name">IFSC Code</label>
                <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code" value="<?php echo $ifsc_code?>">
              </div>	
			  
			  <div class="form-group">
                <label for="Your Name">Attached Cancelled Cheque</label>
                <input type="file" name="cancelled_cheque">(jpg | png | jpeg | gif )
				<input type="hidden" name="cancelled_cheque_old" id="cancelled_cheque_old" value="<?php echo $cancelled_cheque; ?>">
				<?php if($cancelled_cheque){?><span id="cancelled_cheque_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $cancelled_cheque;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#cancelled_cheque_old').val('');jQuery('#cancelled_cheque_old_data').hide()">remove</a></span><?php }?>
              </div>-->
			  
			  <!--<div class="form-group">
                <label for="Your Name">Time Slot</label>
                <input type="text" class="form-control" name="time_slot" id="time_slot" placeholder="Time Slot" value="<?php echo $time_slot?>">
              </div>-->	
			  
			  <!--<div class="form-group">
                <label for="Your Name">Status</label>
                <select name="status">
						<option value="0" <?php if($status==0)echo 'selected';?>>No</option>
						<option value="1" <?php if($status==1)echo 'selected';?>>Yes</option>						
					</select>
              </div>-->
			  
			  <!--<div class="form-group">
                <label for="Your Name">Delivery Location (Maximum 20) </label>
                <input type="text" class="form-control" name="delivery_location" id="delivery_location" placeholder="Delivery Location (Maximum 20)" value="<?php echo $delivery_locatione?>">
              </div>-->		  
			  
			  <div class="form-group">
                <label for="Your Name">Type</label>
                <select name="type" id="type">
					<option value="0" <?php if($type=='B2B')echo 'selected';?>>Wholesale</option>
					<option value="1" <?php if($type=='B2C')echo 'selected';?>>Retail</option>				
				</select>
              </div>
			  
			  <div class="form-group">
                 By signup, you agree to our <a target="_blank" href="<?php echo base_url(); ?>termsconditions">Terms & Conditions</a>
              </div>
			 
			  		    
              <button type="submit" class="btn btn-lg btn-primary appear-animation bounceIn appear-animation-visible">Submit</button>
            </form>
			
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
jQuery('#state_id').change(function(){
		state_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>cityDropdown/"+state_id;
		jQuery('#citydiv').load(url);
});
</script>


<script>
jQuery.noConflict();
// Code that uses other library's $ can follow here.
</script>

<script>
jQuery(document).ready(function(){	
	jQuery('#delivery_location').tagsInput();	
	jQuery('#time_slot').tagsInput();
	jQuery.validator.setDefaults({ ignore: '' });
	jQuery("#seller").validate({
		rules: {		
			name: "required",
			business_name: "required",
			business_address: "required",
			mobile_number: {
				required: true,
				number: true
			},
			phone_number: {
				//required: true,
				//number: true
			},
			email_id: {
				required: true,
				email: true
			},
			email_check:"required",
			password: {
                required: true,
                minlength: 5,
				maxlength: 20
            },			
			confirm_password: {
			required: true,
			equalTo: "#password"
			}, 
			gst: "required",
			state_id: "required",
			city_id: "required",
			pincode_id: "required",
			/*pin_code: {
				required: true,
				number: true
			}, */
			delivery_location: "required",
			/*account_number: "required",
			bank_name: "required",
			bank_address: "required",
			bank_phone_number: {
				required: true,
				number: true
			},
			ifsc_code: "required", */
			time_slot: "required"			
		},
		messages: {
			email_id:{
			    email_id: "Please enter Email Address..!",
				email: "Please enter a valid email address..!"
			},
			password: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!",               
                maxlength: "Your password must be less than equal to 20 characters..!"               
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