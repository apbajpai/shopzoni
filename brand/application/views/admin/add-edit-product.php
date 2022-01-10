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
	$name=$row->name;
	$model_no=$row->model_no;
	$image=$row->image;
	$brand_id=$row->brand_id;
	$category_id=$row->category_id;
	//$sub_category_id=$row->sub_category_id;
	$section_id=$row->section_id;
	$manufacturer=$row->manufacturer;
	$color=$row->color;
	$short_description=$row->short_description;
	$description=$row->description;
	$unit=$row->unit;
	$weight=$row->weight;
	$size=$row->size;
	$quantity=$row->quantity;
	$quantity_option=$row->quantity_option;
	$minimum_quantity_alert=$row->minimum_quantity_alert;
	$tax_category=$row->tax_category;
	$price=$row->price;
	$mrp=$row->mrp;
	$meta_title=$row->meta_title;
	$meta_description=$row->meta_description;
	$meta_keywords=$row->meta_keywords;
	$seo_canonical=$row->seo_canonical;
	$offer=$row->offer;
	$status=$row->status;
	$date_created=$row->date_created; 
	$date_modified=$row->date_modified; 
	$created_by=$row->created_by; 
	$added_by=$row->added_by; 
	
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/product/save">	
					
				<!--<p>
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
				</p>-->
				
									
				<p>
					<label>Product Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
						<label class="error" style="display:none;">Please enter <?php echo $name?></label>
					</span>					
				</p>
				
				<p>
					<label>Model No.<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="model_no" id="model_no" class="longinput" value="<?php echo $model_no?>" />
						<label class="error" style="display:none;">Please enter <?php echo $model_no?></label>
						<label class="error" for="model_no" generated="true"><?php echo $validation_msg; ?></label>
					</span>						
				</p>
				
				<!---<p>
					<label>Product Image</label>
						<span class="field">
						<input type="file" name="image">(jpg | png | jpeg | gif ) [width 750 X height 350]
						<input type="hidden" name="image_old" id="image_old" value="<?php echo $image; ?>">
						<?php if($image){
						if($added_by==2)
							$image_path = "http://shopzoni.com/seller/public/uploads/product/".$image;
						else if($added_by==1)
							$image_path = base_url()."public/uploads/product/".$image;
						
						?><span id="image_old_data"><br><br><img src="<?php echo $image_path;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image_old').val('');jQuery('#image_old_data').hide()">remove</a></span><?php }?>	
					</span>
				</p>--->	

				<p>
					<label>Section<font color='red'>*</font></label>
					<span class="field">
						<select name="section_id" id="section_id">
							<option value="">Select Section</option>
							<?php echo $section_id;
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
				
				<p id="category">
					<label>Category<font color='red'>*</font></label>
					<span class="field">
						<select name="category_id" id="category_id">
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
					<?php } ?>
				</p>
				
				<p>
					<label>Manufacturer</label>
					<span class="field">
						<input type="text" name="manufacturer" id="manufacturer" class="longinput" value="<?php echo $manufacturer?>" />
					</span>					
				</p>
				
				<p>
					<label>Color</label>
					<span class="field">
						<input type="text" name="color" id="color" class="longinput" value="<?php echo $color?>" />
					</span>					
				</p>
				
				<p>
					<label>Short Description</label>
					<span class="field">
						<textarea name="short_description" id="short_description" rows="5" cols="60" ><?php echo $short_description?></textarea>
					</span>	
				    <span class="field" style="font-weight:bold">Not More than 140 Character.</span>	
				</p>
				
				<p>
					<label>Description</label>
					<span class="field">
						<textarea name="description" class="tinymce"><?php echo $description?></textarea>
					</span>					
				</p>
				
				<p>
					<label>Unit<font color='red'>*</font></label>
					<span class="field">
					<select name="unit" id="unit">
						<option value="pc." <?php if($unit=="pc.")echo 'selected';?>>Piece</option>
						<option value="kg." <?php if($unit=="kg.")echo 'selected';?>>Kilogram</option>						
						<option value="metre" <?php if($unit=="metre")echo 'selected';?>>metre</option>
						<option value="cm." <?php if($unit=="cm.")echo 'selected';?>>Centimetre</option>
						<option value="inch" <?php if($unit=="inch")echo 'selected';?>>inch</option>
						<option value="litre" <?php if($unit=="litre")echo 'selected';?>>litre</option>
						<option value="mtr." <?php if($unit=="mtr.")echo 'selected';?>>mtr.</option>
						<option value="cm." <?php if($unit=="cm.")echo 'selected';?>>cm.</option>
						<option value="mm." <?php if($unit=="mm.")echo 'selected';?>>mm.</option>
						<option value="ml." <?php if($unit=="ml.")echo 'selected';?>>ml.</option>
						<option value="kg." <?php if($unit=="kg.")echo 'selected';?>>kg.</option>
						<option value="gm." <?php if($unit=="gm.")echo 'selected';?>>gm.</option>						
						<option value="Gram" <?php if($unit=="Gram")echo 'selected';?>>Gram</option>
						<option value="Quintal" <?php if($unit=="Quintal")echo 'selected';?>>Quintal</option>
						<option value="Metric Ton" <?php if($unit=="Metric Ton")echo 'selected';?>>Metric Ton</option>
						<option value="Foot" <?php if($unit=="Foot")echo 'selected';?>>Foot</option>
						<option value="Millilitre" <?php if($unit=="Millilitre")echo 'selected';?>>Millilitre</option>	
						<option value="Ounce" <?php if($unit=="Ounce")echo 'selected';?>>Ounce</option>					
						<option value="Pound" <?php if($unit=="Pound")echo 'selected';?>>Pound.</option>
						<option value="pc." <?php if($unit=="pc.")echo 'selected';?>>pc.</option>
						<option value="Dozen" <?php if($unit=="Dozen")echo 'selected';?>>Dozen</option>
						<option value="ft." <?php if($unit=="ft.")echo 'selected';?>>ft.</option>
						<option value="Gallon" <?php if($unit=="Gallon")echo 'selected';?>>Gallon</option>
						<option value="Milligram" <?php if($unit=="Milligram")echo 'selected';?>>Milligram</option>
						<option value="mg." <?php if($unit=="mg.")echo 'selected';?>>mg.</option>
						<option value="Oz." <?php if($unit=="Oz.")echo 'selected';?>>Oz.</option>
					</select>
					</span>
				</p>
				
				<p>
					<label>Weight</label>
					<span class="field">
						<input type="text" name="weight" id="weight" class="longinput" value="<?php echo $weight?>" />
					</span>					
				</p>
				
				<p>
					<label>Size(L*B*H)</label>
					<span class="field">
						<input type="text" name="size" id="size" class="longinput" value="<?php echo $size?>" />
					</span>					
				</p>
				
				<p>
					<label>Tax Category</label>
					<span class="field">
						<input type="text" name="tax_category" id="tax_category" class="longinput" value="<?php echo $tax_category?>" />
					</span>					
				</p>

				<p>
					<label>MRP</label>
					<span class="field">						
						<input name="mrp" id="mrp" class="longinput" value="<?php echo $mrp?>" />
					</span>					
				</p>
				
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
			//seller_id: "required",
			name: "required",	
			model_no: "required",
			section_id: "required",			
			category_id: "required",			
			sub_category_id: "required",
			brand_id:"required",
			short_description: {
			  //required: true,
			  maxlength: 140
			},
			/*image: {
				accept: "png|jpg|gif"
			},*/			
			unit: "required",
			quantity: {
			  //required: true,
			  number: true
			},
			minimum_quantity_alert: {
			 // required: true,
			  number: true
			},
			tax_category: {
			 // required: true,
			  number: true
			},
			price: {
			  required: true,
			  number: true
			},
			mrp: {
			  //required: true,
			  number: true
			}					
		},
		messages: {
			name: "Please enter article title",
			sub_category_id: "This field is required. [if there is no sub category then add it.]"
		}
	});
	
	jQuery('#section_id').change(function(){
		sec_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>admin/category/categoryDropdown/"+sec_id;
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