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
	$name=$row->name;	
	$start_date=$row->start_date;
	$end_date=$row->end_date;
	$cash_back=$row->cash_back;
	$status=$row->status; 
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
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="offer" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/offer/save">	
				
				<p>
					<label>Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>
				
				<p>
					<label>Cash Back<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="cash_back" id="cash_back" class="longinput" value="<?php echo $cash_back?>" />
					</span>					
				</p>
				
				<p>
					<label>Start Date</label>
					<span class="field">
						<input id="start_date" name="start_date" class="width100" type="text" value="<?php echo $start_date?>">
					</span>
				</p>
				
				<p>
					<label>End Date</label>
					<span class="field">
						<input id="end_date" name="end_date" class="width100" type="text" value="<?php echo $end_date?>">
					</span>
				</p>
				
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
	jQuery("#offer").validate({
		rules: {
			name: required,	
			cash_back: required,	
		},
		messages: {
			name: {
				required: "Please enter name",
			},			
		}
	});
});	


	jQuery("#start_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1910:'
	});
	
	jQuery("#end_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1910:'
	});
</script>