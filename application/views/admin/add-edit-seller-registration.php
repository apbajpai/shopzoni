<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>css/plugins/jquery.tagsinput.css">
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>ajax/check_email_availability.js"></script>
<script>
	jQuery(document).ready(function(){		
		//Examples of how to assign the Colorbox event to elements
		jQuery(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	});
</script>
<?php 
if($row){
	$id					= $row->id; 
	$display_name		= $row->display_name;
	$name				= $row->name;
	$identity_proof		= $row->identity_proof;
	$business_name		= $row->business_name;
	$business_address	= $row->business_address;
	$address_proof		= $row->address_proof;
	$mobile_number		= $row->mobile_number;
	$phone_number		= $row->phone_number;
	$email_id			= $row->email_id;
	$password			= $row->password;
	$gst				= $row->gst;
	$gst_proof			= $row->gst_proof;
	$city				= $row->city;
	$state				= $row->state;
	$pin_code			= $row->pin_code;
	$delivery_location	= $row->delivery_location;
	$account_number		= $row->account_number;
	$bank_name			= $row->bank_name;
	$bank_address		= $row->bank_address;
	$bank_phone_number		= $row->bank_phone_number;
	$ifsc_code			= $row->ifsc_code;
	$cancelled_cheque	= $row->cancelled_cheque;
	$time_slot			= $row->time_slot;
	$status				= $row->status;
	$created_date		=	$row->created_date; 
	$modified_date		=	$row->modified_date; 
	$created_by			=	$row->created_by; 
	
}else{	
	$status = 0;
	$date_published = date('Y-m-d');
	$id = 0;
}
?> 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo validation_errors(); ?></div></span>
		<span class="pagedesc"><div style="color:red" align="center"><?php echo $validation_msg; ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="seller" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/seller_registration/save">	
							
				<p>
					<label>Display Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="display_name" id="display_name" class="longinput" value="<?php echo $display_name?>" />
						<label class="error" style="display:none;">Please enter Seller Name</label>
					</span>					
				</p>
				
				<p>
					<label>Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>
				
				<p>
					<label>Attach ID Proof</label>
						<span class="field">
						<input type="file" name="identity_proof">(jpg | png | jpeg | gif )
						<input type="hidden" name="identity_proof_old" id="identity_proof_old" value="<?php echo $identity_proof; ?>">
						<?php if($identity_proof){?><span id="identity_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $identity_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#identity_proof_old').val('');jQuery('#identity_proof_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>
				
				<p>
					<label>Business Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="business_name" id="business_name" class="longinput" value="<?php echo $business_name?>" />
					</span>					
				</p>
				
				<p>
					<label>Business Address<font color='red'>*</font></label>
					<span class="field">						
						<textarea name="business_address" id="business_address" rows="5" cols="60" ><?php echo $business_address?></textarea>
					</span>					
				</p>
				
				<p>
					<label>Address Proof</label>
						<span class="field">
						<input type="file" name="address_proof">(jpg | png | jpeg | gif )
						<input type="hidden" name="address_proof_old" id="address_proof_old" value="<?php echo $address_proof; ?>">
						<?php if($address_proof){?><span id="address_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $address_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#address_proof_old').val('');jQuery('#address_proof_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>
				
				<p>
					<label>Mobile Number<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="mobile_number" id="mobile_number" class="longinput" value="<?php echo $mobile_number?>" />
					</span>					
				</p>		
				
				<p>
					<label>Phone Number<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="phone_number" id="phone_number" class="longinput" value="<?php echo $phone_number?>" />
					</span>					
				</p>	

				<p>
					<label>Email ID<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="email_id" id="email_id" class="longinput" value="<?php echo $email_id?>" onblur="check_email_availability(this.value);"/>
						<input type="hidden"  name="email_check" id="email_check" value="0" >
					</span>					
				</p>		

				<p>
					<label>Password<font color='red'>*</font></label>
					<span class="field">
						<input type="password" name="password" id="password" class="longinput" value="<?php echo $password?>" />
					</span>					
				</p>		
				
				<p>
					<label>Confirm Password<font color='red'>*</font></label>
					<span class="field">
						<input type="password" name="confirm_password" id="confirm_password" class="longinput" value="<?php echo $password?>" />
					</span>					
				</p>	
				
				<p>
					<label>VAT/GST<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="gst" id="gst" class="longinput" value="<?php echo $gst?>" />
					</span>					
				</p>
				
				<p>
					<label>Attached Proof</label>
						<span class="field">
						<input type="file" name="gst_proof">(jpg | png | jpeg | gif )
						<input type="hidden" name="gst_proof_old" id="gst_proof_old" value="<?php echo $gst_proof; ?>">
						<?php if($gst_proof){?><span id="gst_proof_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $gst_proof;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#gst_proof_old').val('');jQuery('#gst_proof_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>
				
				<p>
					<label>City<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="city" id="city" class="longinput" value="<?php echo $city?>" />
					</span>					
				</p>
				
				<!--<p>
					<label>State<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="state" id="state" class="longinput" value="<?php echo $state?>" />
					</span>					
				</p>-->
				
				<p>
					<label>State<font color='red'>*</font></label>
					<span class="field">
					<select name="State" id="state">
						<option value="Andhra Pradesh" <?php if($state=="Andhra Pradesh")echo 'selected';?>>Andhra Pradesh</option>
						<option value="Arunachal Pradesh" <?php if($state=="Arunachal Pradesh")echo 'selected';?>>Arunachal Pradesh</option>						
						<option value="Assam" <?php if($state=="Assam")echo 'selected';?>>Assam</option>						
						<option value="Bihar" <?php if($state=="Bihar")echo 'selected';?>>Bihar</option>						
						<option value="Chhattisgarh" <?php if($state=="Chhattisgarh")echo 'selected';?>>Chhattisgarh</option>						
						<option value="Goa" <?php if($state=="Goa")echo 'selected';?>>Goa</option>						
						<option value="Gujarat" <?php if($state=="Gujarat")echo 'selected';?>>Gujarat</option>						
						<option value="Haryana" <?php if($state=="Haryana")echo 'selected';?>>Haryana</option>						
						<option value="Himachal Pradesh" <?php if($state=="Himachal Pradesh")echo 'selected';?>>Himachal Pradesh</option>						
						<option value="Jammu and Kashmir" <?php if($state=="Jammu and Kashmir")echo 'selected';?>>Arunachal Pradesh</option>						
						<option value="Jharkhand" <?php if($state=="Jharkhand")echo 'selected';?>>Jharkhand</option>						
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
						<option value="Puducherry" <?php if($state=="Puducherry")echo 'selected';?>>Puducherry</option>												
					</select>
					</span>					
				</p>
				
				<p>
					<label>Pin Code<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="pin_code" id="pin_code" class="longinput" value="<?php echo $pin_code?>" />
					</span>					
				</p>
				
				<p>
					<label>Delivery Location (Maximum 20)<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="delivery_location" id="delivery_location" class="longinput" value="<?php echo $delivery_location?>" />
					</span>					
				</p>				
							
				<p>
					<label>Account Number<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="account_number" id="account_number" class="longinput" value="<?php echo $account_number?>" />						
					</span>					
				</p>
								
				<p>
					<label>Bank Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="bank_name" id="bank_name" class="longinput" value="<?php echo $bank_name?>" />						
					</span>					
				</p>
				
				<p>
					<label>Bank Address<font color='red'>*</font></label>
					<span class="field">						
						<textarea name="bank_address" id="bank_address" rows="5" cols="60" ><?php echo $bank_address?></textarea>
					</span>					
				</p>
				
				<p>
					<label>Bank Phone Number<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="bank_phone_number" id="bank_phone_number" class="longinput" value="<?php echo $bank_phone_number?>" />						
					</span>					
				</p>			
				
				<p>
					<label>IFSC Code<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="ifsc_code" id="ifsc_code" class="longinput" value="<?php echo $ifsc_code?>" />						
					</span>					
				</p>		
				
				<p>
					<label>Attached Cancelled Cheque</label>
						<span class="field">
						<input type="file" name="cancelled_cheque">(jpg | png | jpeg | gif )
						<input type="hidden" name="cancelled_cheque_old" id="cancelled_cheque_old" value="<?php echo $cancelled_cheque; ?>">
						<?php if($cancelled_cheque){?><span id="cancelled_cheque_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/seller_registration/<?php echo $cancelled_cheque;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#cancelled_cheque_old').val('');jQuery('#cancelled_cheque_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>					
				
				<!--<p>
					<label>Time Slot<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="time_slot" id="time_slot" class="longinput" value="<?php echo $time_slot?>" />						
					</span>					
				</p>-->			
				
				<p>
					<label>Status</label>
					<span class="field">
					<select name="status">
						<option value="0" <?php if($status==0)echo 'selected';?>>No</option>
						<option value="1" <?php if($status==1)echo 'selected';?>>Yes</option>						
					</select>
					</span>
				</p>
									
				<p class="stdformbutton">
					<input type="submit"  name="submit" value="Submit">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">					
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->

<script>
jQuery(document).ready(function(){	
	jQuery('#delivery_location').tagsInput();	
	//jQuery('#time_slot').tagsInput();
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
			phone_number: {
				required: true,
				number: true
			},
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
			gst: "required",
			city: "required",
			state: "required",
			pin_code: {
				required: true,
				number: true
			},
			delivery_location: "required",
			account_number: "required",
			bank_name: "required",
			bank_address: "required",
			bank_phone_number: {
				required: true,
				number: true
			},
			ifsc_code: "required",
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