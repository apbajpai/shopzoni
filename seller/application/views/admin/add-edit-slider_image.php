<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>css/plugins/jquery.tagsinput.css">
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>
<script>
	jQuery(document).ready(function(){		
		//Examples of how to assign the Colorbox event to elements
		jQuery(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	});
</script>
<?php 

if($row->id){
	$id=$row->id;	
	$image=$row->image;
	$caption=$row->caption;	
	$img_alt=$row->img_alt;	
	$title=$row->title;	
	$short_desc=$row->short_desc;	
	$redirect_url=$row->redirect_url;	
	$img_desc=$row->img_desc;	
	$status=$row->status;
	$date_created=$row->date_created; 
	$date_modified=$row->date_modified; 
	$created_by=$row->created_by;	
}else{	
	$status = 0;
	$date_created = date('Y-m-d');
	$id = 0;
	$slug = '';
}
?> 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo validation_errors(); ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/slider_image/save">	
													
				<p>
					<label>Image</label>
						<span class="field">
						<input type="file" name="image">(jpg | png | jpeg | gif ) [width 980 X height 200]
						<input type="hidden" name="image_old" id="image_old" value="<?php echo $image; ?>">
						<?php if($image){
							$image_path = base_url()."public/uploads/home_slider_image/".$image;						
						?><span id="image_old_data"><br><br><img src="<?php echo $image_path;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image_old').val('');jQuery('#image_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>
				
				<p>
					<label>Title</label>
					<span class="field">
						<input type="text" name="title" id="title" class="longinput" value="<?php echo $title; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $title?></label>
						<label class="error" for="title" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>
				
				<p>
					<label>Short Description</label>
					<span class="field">
						<input type="text" name="short_desc" id="short_desc" class="longinput" value="<?php echo $short_desc; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $short_desc?></label>
						<label class="error" for="short_desc" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>
				
				<p>
					<label>Redirect URL</label>
					<span class="field">
						<input type="text" name="redirect_url" id="redirect_url" class="longinput" value="<?php echo $redirect_url; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $redirect_url?></label>
						<label class="error" for="redirect_url" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>			
				
				
				<p>
					<label>Caption<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="caption" id="caption" class="longinput" value="<?php echo $caption; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $caption?></label>
						<label class="error" for="caption" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>
				
				<p>
					<label>Alt</label>
					<span class="field">
						<input type="text" name="img_alt" id="img_alt" class="longinput" value="<?php echo $img_alt; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $img_alt?></label>
						<label class="error" for="img_alt" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>	

				<p>
					<label>Description</label>
					<span class="field">
						<input type="text" name="img_desc" id="img_desc" class="longinput" value="<?php echo $img_desc; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $img_desc?></label>
						<label class="error" for="img_desc" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>
								
				<p>
					<label>Status/Publish</label>
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
	jQuery("#product").validate({
		rules: {
			image: {
				accept: "png|jpg|gif"
			},			
			caption: "required",
								
		},
		messages: {
			caption: "Please enter caption"
		}
	});
});	

</script>