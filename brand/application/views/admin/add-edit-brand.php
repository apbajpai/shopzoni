<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<?php 
if($row){
	$id=$row->id; 
	$name=$row->name;
	$owner=$row->owner;
	$contact_person=$row->contact_person;
	$phone=$row->phone;
	$mobile=$row->mobile;
	$email=$row->email;
	$website=$row->website;
	$communication_address=$row->communication_address;
	$registered_office=$row->registered_office;
	$customer_care_number=$row->customer_care_number;
	$email_feedback=$row->email_feedback;
	$image=$row->image;	
	$status=$row->status; 
	$meta_title=$row->meta_title;
	$meta_description=$row->meta_description;
	$meta_keywords=$row->meta_keywords;
	$seo_canonical=$row->seo_canonical;
	$created_by=$row->created_by; 
	$date_created=$row->date_created; 
}
else{
	$status = 1;
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="brand" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/brand/save">	
				
				<p>
					<label>Brand Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>
				
				<p>
					<label>Brand Owner</label>
					<span class="field">
						<input type="text" name="owner" id="owner" class="longinput" value="<?php echo $owner?>" />
					</span>					
				</p>
				
				<p>
					<label>Brand Contact Person<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="contact_person" id="contact_person" class="longinput" value="<?php echo $contact_person?>" />
					</span>					
				</p>
				
				<p>
					<label>Phone Number</label>
					<span class="field">
						<input type="text" name="phone" id="phone" class="longinput" value="<?php echo $phone?>" />
					</span>					
				</p>
				
				<p>
					<label>Mobile Number<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="mobile" id="mobile" class="longinput" value="<?php echo $mobile?>" />
					</span>					
				</p>
				
				<p>
					<label>Registered Email<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="email" id="email" class="longinput" value="<?php echo $email?>" />
					</span>					
				</p>
				
				<p>
					<label>Website<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="website" id="website" class="longinput" value="<?php echo $website?>" />
					</span>					
				</p>
				
				<p>
					<label>Communication Address<font color='red'>*</font></label>
					<span class="field">
						<textarea name="communication_address" id="communication_address" rows="5" cols="60" ><?php echo $communication_address?></textarea>
					</span>					
				</p>
				
				<p>
					<label>Registered Office</label>
					<span class="field">
						<textarea name="registered_office" id="registered_office" rows="5" cols="60" ><?php echo $registered_office?></textarea>
					</span>					
				</p>
				
				<p>
					<label>Brand Logo <font color='red'>*</font></label>
						<span class="field">
						<input type="file" id="image" name="image">(jpg | png | jpeg | gif ) [Maximum width 200 X height 100]
						<input type="hidden" name="image_old" id="image_old" value="<?php echo $image; ?>">
						<?php if($image){
							$image_path = base_url()."public/uploads/brand/".$image;
						
						?><span id="image_old_data"><br><br><img src="<?php echo $image_path;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image_old').val('');jQuery('#image_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>
				
				<p>
					<label>Customer Care Number<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="customer_care_number" id="customer_care_number" class="longinput" value="<?php echo $customer_care_number?>" />
					</span>					
				</p>
				
				<p>
					<label>Email (Share Feedback)<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="email_feedback" id="email_feedback" class="longinput" value="<?php echo $email_feedback?>" />
					</span>					
				</p>
				
				<?php foreach($department_records as $record){ ?>
				<p>
				<label>&nbsp;</label>
				<input type="checkbox" data-id="<?php echo $record->id; ?>" <?php if($record->map_status==1) echo 'checked';?>  name="chk[]" id="chk<?php echo $record->id; ?>" value="<?php echo $record->id; ?>">
				<?php echo $record->name; ?>
				</p>
				<?php } ?>
				
				<p>
					<label>Meta Title</label>
					<span class="field">
						<textarea name="meta_title" id="meta_title" ><?php echo $meta_title?></textarea>
					</span>
				</p>
				
				<p>
					<label>Meta Description</label>
					<span class="field">
						<textarea name="meta_description" id="meta_description" ><?php echo $meta_description?></textarea>
					</span>
				</p>

				<p>
					<label>Meta Keywords</label>
					<span class="field">
						<textarea name="meta_keywords" id="meta_keywords" ><?php echo $meta_keywords?></textarea>
					</span>
				</p>
				
				<p>
					<label>Meta Canonical</label>
					<span class="field">
						<textarea name="seo_canonical" id="seo_canonical" ><?php echo $seo_canonical?></textarea>
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
jQuery(document).ready(function(){
	jQuery("#brand").validate({
		rules: {
			name: "required",	
			contact_person: "required",						
			mobile: {
				required: true,
				number: true
			},
			email: {
				required: true,
				email: true
			},
			website: "required",	
			communication_address: "required",	
			contact_person: "required",				
			customer_care_number: {
				required: true,
				//number: true
			},
			email_feedback: {
				required: true,
				email: true
			},
			chk: "required",	
				
		},
		
		messages: {
			name: {
				required: "Please enter Brand name",
			},			
		}
	});
});	
</script>