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

if($product_records->id){
	$product_id=$product_records->id;	
	$product_name=$product_records->name;
}

if($row->id){
	$id=$row->id;	
	$image=$row->image;
	$caption=$row->caption;	
	$img_alt=$row->img_alt;	
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/product_image/save">	
													
				<p>
					<label>Product Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" readonly="readonly" name="product_name" id="product_name" class="longinput" value="<?php echo $product_name?>" />
						<label class="error" style="display:none;">Please enter <?php echo $product_name?></label>
					</span>					
				</p>
				
				<p>
					<label>Product Image</label>
						<span class="field">
						<input type="file" name="image">(jpg | png | jpeg | gif ) [width 750 X height 350]
						<input type="hidden" name="image_old" id="image_old" value="<?php echo $image; ?>">
						<?php if($image){
							$image_path = base_url()."public/uploads/product/".$image;						
						?><span id="image_old_data"><br><br><img src="<?php echo $image_path;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image_old').val('');jQuery('#image_old_data').hide()">remove</a></span><?php }?>	
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
					<label>img_alt<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="img_alt" id="img_alt" class="longinput" value="<?php echo $img_alt; ?>" />
						<label class="error" style="display:none;">Please enter <?php echo $caption?></label>
						<label class="error" for="img_alt" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>
				
				<p>
					<label>img_desc<font color='red'>*</font></label>
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
					<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id?>">	
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
			//seller_id: "required",
			caption: "required",	
			img_alt: "required",			
			img_desc: "required",			
			image: {
				accept: "png|jpg|gif"
			},	
		},
		messages: {
			//name: "Please enter article title",
			//sub_category_id: "This field is required. [if there is no sub category then add it.]"
		}
	});
	
	jQuery('#section_id').change(function(){
		sec_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>/admin/category/categoryDropdown/"+sec_id;
		jQuery('#category').load(url);
	});
	
	
	
	/*jQuery('#category_id').change(function(){
		cat_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>/admin/product_category/subCatDropdown/"+cat_id;
		jQuery('#sub-category').load(url);		
	}); */
		
	jQuery('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : '<?php echo VIEWBASE?>js/plugins/tinymce/tiny_mce.js',

		// General options
		theme : "advanced",
		skin : "themepixels",
		width: "85%",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
		inlinepopups_skin: "themepixels",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,blockquote,|,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,image,help,code,|,preview",
		theme_advanced_buttons3 : "formatselect,|,forecolor,backcolor,removeformat,|,charmap,media,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		relative_urls : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/plugins/tinymce.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	
	/*if(jQuery('#quantity_option').is(":checked")){			
		jQuery("#min_alert").show();
	}else{
		jQuery("#min_alert").hide();
	} */
});	


function valueChanged()
{
	if(jQuery('#quantity_option').is(":checked")){			
		jQuery("#min_alert").show();
	}else{
		jQuery("#min_alert").hide();
	}
}

</script>