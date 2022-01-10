<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<?php 
if($row){
	$id=$row->id; 
	$name=$row->name;	
	$status=$row->status; 
	$home_status=$row->home_status; 
	$created_by=$row->created_by; 
	$date_created=$row->date_created; 
}
else{
	$status = 1;
	$home_status = 1;
	$id = 0;
}
?> 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo validation_errors(); ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="section" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/section/save">	
				
				<p>
					<label>Section<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>
				
				</p>
				
				<p>
					<label>Show home Page Status</label>
					<span class="field">
					<select name="home_status">
						<option value="1" <?php if($home_status==1)echo 'selected';?>>Active</option>
						<option value="0" <?php if($home_status==0)echo 'selected';?>>Inactive</option>
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
jQuery(document).ready(function(){
	jQuery("#section").validate({
		rules: {
			//name: required,		
			name: {
				required: true,
				remote: {
					url: "<?php echo base_url(); ?>admin/section/uniqueSection",
					type: "post",
					data: {
						name: function() {
							return jQuery( "#name" ).val();
						},						
						id: function() {
							return jQuery( "#id" ).val();
						}
					}
				}
			}, 
		},
		messages: {
			name: {
				required: "Please enter Section name",
				remote: jQuery.validator.format("{0} is already in use")
			},			
		}
	});
});	
</script>