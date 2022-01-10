<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<?php 
if($row){
	$id=$row->id; 
	$minimum_order_amount=$row->minimum_order_amount;	
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="download_excel" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/download_excel/download">	
				
				<p>
					<label>Category<font color='red'>*</font></label>
					<span class="field">
						<select name="category_id" id="category_id" onchange="if(jQuery(this).val()=='260'){jQuery('#author_p').hide();jQuery('#gauthor_p').show();}">
							<option value="">Select Category</option>
							<?php
								foreach($category as $cat){
									if($parent_id == $cat->id)$selected='selected="selected"';
									else if($category_id==$cat->id)$selected='selected="selected"';
									else $selected='';
							?>
									<option value="<?php echo $cat->id; ?>" <?php echo $selected ?>><?php echo $cat->name; ?></option>
							<?php
								}
							?>
						</select>
					</span>					
				</p>
				
				<p id="sub-category">
					<?php if($parent_id != 0){?>
					<label>Sub Category<font color='red'>*</font></label>
					<span class="field">
						<select name="sub_category_id" id="sub_category_id">
							<option value="">Select Sub Category</option>
							<?php
								foreach($sub_category as $cat){					
									if($category_id == $cat->id)$selected='selected="selected"';
									else $selected='';
									?>
									<option value="<?php echo $cat->id; ?>" <?php echo $selected ?>><?php echo $cat->name; ?></option>
									<?php
								}
							?>
						</select>
					</span>
					<?php }?>
				</p>
				
				<p>
					<label>Section<font color='red'>*</font></label>
					<span class="field">
						<select name="section_id" id="section_id">
							<option value="">Select Section</option>
							<?php
								foreach($sections as $val){
									if($section_id==$val->id)$selected='selected="selected"';
									else $selected='';
							?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected ?>><?php echo $val->name; ?></option>
							<?php
								}
							?>
						</select>
					</span>					
				</p>
				
				<p>
					<label>Brand<font color='red'>*</font></label>
					<span class="field">
						<select name="brand_id" id="brand_id">
							<option value="">Select Brand</option>
							<?php
								foreach($brands as $val){
									if($brand_id==$val->id)$selected='selected="selected"';
									else $selected='';
							?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected ?>><?php echo $val->name; ?></option>
							<?php
								}
							?>
						</select>
					</span>					
				</p>
				
				<!--<p>
					<label>Status</label>
					<span class="field">
					<select name="status">
						<option value="1" <?php if($status==1)echo 'selected';?>>Active</option>
						<option value="0" <?php if($status==0)echo 'selected';?>>Inactive</option>
					</select>
					</span>
				</p>-->	
				
				<p class="stdformbutton">					
					<input type="submit"  name="addedit" id="addedit" value="Download Excel">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->

<script>
jQuery(document).ready(function(){
	jQuery("#download_excel").validate({
		rules: {
			name: required,			
		},
		messages: {
			name: {
				required: "Please enter name",
			},			
		}
	});
});	
</script>