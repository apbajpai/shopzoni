<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>css/plugins/jquery.tagsinput.css">
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>


<?php 
if($row){
	$id=$row->id;		
	$delivery_location=$row->delivery_location;
	$shipping_charge=$row->shipping_charge;	
	$status=$row->status; 
	$created_by=$row->created_by; 
	$date_created=$row->date_created; 
}
else{
	$status = 1;
	$id = '';
}
?>

<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>		
		<span class="pagedesc"><div style="color:red;margin-left: 65px; font-size: 150%;"><?php echo $error_msg; ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="delivery_locationfrm" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/delivery_location/save">	
											
				<p>
					<label>Delivery Location<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="delivery_location" id="delivery_location" class="longinput" value="<?php echo $delivery_location?>" />
					</span>					
				</p>
				
				<p>
					<label>Shipping Charge<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="shipping_charge" id="shipping_charge" class="longinput" value="<?php echo $shipping_charge?>" />
					</span>					
				</p>
				
				<!--<p>
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
				</p>-->
				
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
		url = "<?php echo base_url(); ?>admin/profile/cityDropdown/"+state_id;
		jQuery('#citydiv').load(url);
});

jQuery(document).ready(function(){		
	jQuery("#delivery_locationfrm").validate({
		rules: {
			//seller_id: "required",
			delivery_location: "required",	
			shipping_charge: "required"								
		},
		messages: {
			//delivery_location: "Please enter article title",
			//sub_category_id: "This field is required. [if there is no sub category then add it.]"
		}
	});	
});	

</script>