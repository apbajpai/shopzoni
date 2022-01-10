<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>

<?php 
if($row){
	$id=$row->id; 
	$type=$row->type;
	$name=$row->name;	
	$email=$row->email;	
	$address=$row->address;		
	$state_id=$row->state_id;
	$city_id=$row->city_id;	
	$pincode_id=$row->pincode_id;	
	$status=$row->status; 
	$created_by=$row->created_by; 
	$date_created=$row->date_created; 
}
else{
	$status = 1;
	$id = 0;
}


foreach($state_records as $key => $state){
	if($key == 0)
		$state_data .= '"'.$state->state_name.'"';
	else
		$state_data .= ',"'.$state->state_name.'"';
}

foreach($city_records as $key => $city){
	if($key == 0)
		$city_data .= '"'.$city->district_name.'"';
	else
		$city_data .= ',"'.$city->district_name.'"';
}

foreach($pincode_records as $key => $pin){
	if($key == 0)
		$pincode_data .= '"'.$pin->pincode.'"';
	else
		$pincode_data .= ',"'.$pin->pincode.'"';
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="partner" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/partner/save">	
				
				<p>
					<label>Type</label>
					<span class="field">
					<select name="type">
						<option value="1" <?php if($type==1)echo 'selected';?>>Distributor</option>
						<option value="2" <?php if($type==2)echo 'selected';?>>Wholesaler</option>
						<option value="3" <?php if($type==3)echo 'selected';?>>Dealer</option>
						<option value="4" <?php if($type==4)echo 'selected';?>>Retailer</option>
					</select>
					</span>
				</p>
				
				<p>
					<label>Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>

				<p>
					<label>Email<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="email" id="email" class="longinput" value="<?php echo $email?>" />
					</span>					
				</p>
				
				<p>
					<label>Address<font color='red'>*</font></label>
					<span class="field">
						<textarea name="address" id="address" rows="5" cols="60" ><?php echo $address?></textarea>
					</span>					
				</p>
				
				
				<p>
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
				</p>
				
				
				<p id="citydiv">
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
				</p>
				
				
				<p id="pincodediv">
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
				</p>
				
				
				<p>
					<label>Status</label>
					<span class="field">
					<select name="status">
						<option value="1" <?php if($status==1)echo 'selected';?>>Active</option>
						<option value="0" <?php if($status==0)echo 'selected';?>>Inactive</option>
					</select>
					</span>
				</p>	
				
				<p class="stdformbutton">					
					<input type="submit"  name="addedit" id="addedit" value="Submit">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->

<script>

jQuery('#state_id').change(function(){
		state_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>admin/partner/cityDropdown/"+state_id;
		jQuery('#citydiv').load(url);
});


jQuery(document).ready(function(){		
	jQuery("#partner").validate({
		rules: {
			name: "required",	
			email: {
				required: true,
				email: true
			},
			address: "required",	
			state_id: "required",	
			city_id: "required",	
			pincode_id: "required",	
		},
		messages: {
			//name: "Please enter Partner Name",
		}
	});
	
});	
</script>