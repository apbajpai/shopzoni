<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<?php 
if($row){
	$id=$row->id; 
	$parent_id=$row->parent_id; 
	$section_id=$row->section_id; 
	$name=$row->name; 
	$code=$row->code;
	$slug=$row->slug; 
	$slug=explode('-',$row->slug);
	array_pop($slug);
	$slug=implode('-',$slug);
	$type = $this->uri->segment(3);
	
	
	$status=$row->status; 
	$created_by=$row->created_by; 
	$date_created=$row->date_created; 
	$date_modified=$row->date_modified; 
}
else{
	$status = 1;
	$show_home = 0;
	$menu_item = 0;
	$slug = '';
	$id = 0;
	
	$type = $this->uri->segment(3);
}
?> 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo validation_errors(); ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="category" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/category/save">	
				
							
				<p>
					<label>Section<font color='red'>*</font></label>
					<span class="field">
						<select name="section_id" id="section_id">
							<option value="">Select Section</option>
							<?php
								foreach($section as $val){
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
				
				<?php if($type == 'addedit'){ 				
								/* echo "<pre>";
								print_r($category);
								echo "</pre>"; */
				?>
				
				<p id="category_drop">
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
				
				<?php } ?>
				
				<p>
					<?php if($type == 'addeditmain'){ ?>
					<label>Category Name<font color='red'>*</font></label>
					<?php } else{ ?>
					<label>Sub Category Name<font color='red'>*</font></label>
					<?php } ?>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
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
					<input type="hidden" name="menu_item" id="menu_item" value="<?php echo $menu_item?>">
					<!--<input type="hidden" name="slug" id="slug" value="<?php echo $slug?>">-->
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->

<script>
jQuery(document).ready(function(){
	
	jQuery("#category").validate({
		rules: {
			section_id: "required",
			category_id: "required",
			parent_id: "required",
					
			name: {
				required: true,
				remote: {
					url: "<?php echo base_url(); ?>admin/category/uniqueCategory",
					type: "post",
					data: {
						name: function() {
							return jQuery( "#name" ).val();
						},
						parent_id: function() {
							return jQuery( "#category_id" ).val();
						},
						id: function() {
							return jQuery( "#id" ).val();
						}
					}
				}
			}, 
			image: {
				accept: "png|jp?g|gif"
			},
			priority: {
				number: true
			}
		},
		messages: {
			name: {
				required: "Please enter category name",
				remote: jQuery.validator.format("{0} is already in use")
			},
			image: {
				accept: "Please select a valid image"
			}
		}
	});
	
	<?php if($type == 'addedit'){ ?>
	jQuery('#section_id').change(function(){
		sec_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>admin/category/categoryDropdown/"+sec_id;
		jQuery('#category_drop').load(url);
	});
	<?php } ?>
	
});	
</script>