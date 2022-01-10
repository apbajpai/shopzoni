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
echo "<!-- <pre>";
print_r($row);
echo "</pre> --->";

if($row){
	$id=$row->id;
	$seller_product_id=$row->seller_product_id;
	$seller_id=$row->seller_id;
	$product_name=$row->product_name;
	$image=$row->image;
	$category_id=$row->category_id;
	//$sub_category_id=$row->sub_category_id;
	$section_id=$row->section_id;
	$brand_id=$row->brand_id;
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
	//$discount=$row->discount;
	//$offer_code=$row->offer_code;
	$offer=$row->offer;
	$status=$row->status;
	$date_created=$row->date_created; 
	$date_modified=$row->date_modified; 
	$created_by=$row->created_by; 
	$sell_yours=$row->sell_yours; 
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/brand_approval_product/save">	
								
				<p>
					<label>Brand Wise Product</label>
					<span class="field">
						<select name="brand_id" id="brand_id" disabled="disabled">
							<option value="">Select Brand</option>
							<?php
								foreach($associatedbrands as $assval){
									if($brand_id==$assval->id)$selected='selected="selected"';
									else $selected='';
							?>
									<option value="<?php echo $assval->id; ?>" <?php echo $selected ?>><?php echo $assval->name; ?></option>
							<?php
								}
							?>
						</select>
					</span>		
					<input type="hidden" name="brand_id" id="brand_id" value="<?php echo $selected_brand_id; ?>"
				</p>
				
							
				<p>
					<label>Product Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="product_name" id="product_name" class="longinput" value="<?php echo $product_name?>"/>
						<label class="error" style="display:none;">Please enter <?php echo $product_name?></label>
					</span>					
				</p>
				
				<p>
					<label>Product Image</label>
						<span class="field">
						<input type="file" name="image">(jpg | png | jpeg | gif ) [width 750 X height 350]
						<input type="hidden" name="image_old" id="image_old" value="<?php echo $image; ?>">
						<?php if($image){?><span id="image_old_data"><br><br><img src="<?php echo base_url(); ?>public/uploads/product/<?php echo $image;?>" height="80" width="80" />&nbsp;&nbsp;<a href="javascript:void(0)" onclick="jQuery('#image_old').val('');jQuery('#image_old_data').hide()">remove</a></span><?php }?>	
					</span>
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
				
				<p id="category">
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
					<?php if($parent_id != 0){ ?>
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
						<input type="text" name="color" id="color" class="longinput" value="<?php echo $color?>"/>
					</span>					
				</p>
				
				<p>
					<label>Short Description</label>
					<span class="field">
						<textarea name="short_description" id="short_description" rows="5" cols="60"><?php echo $short_description?></textarea>
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
						<option value="kg" <?php if($unit=="kg")echo 'selected';?>>Kilogram</option>
						<option value="pc" <?php if($unit=="pc")echo 'selected';?>>Piece</option>
						<option value="meter" <?php if($unit=="meter")echo 'selected';?>>meter</option>
						<option value="cm" <?php if($unit=="cm")echo 'selected';?>>Centimiter</option>
						<option value="inch" <?php if($unit=="inch")echo 'selected';?>>inch</option>
						<option value="liter" <?php if($unit=="liter")echo 'selected';?>>liter</option>
					</select>
					</span>
				</p>
				
				<p>
					<label>Weight</label>
					<span class="field">
						<input type="text" name="weight" id="weight" class="longinput" value="<?php echo $weight?>"/>
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
				
				<!--<p>
					<label>Status/Publish</label>
					<span class="field">
					<select name="status">
						<option value="0" <?php if($status==0)echo 'selected';?>>No</option>
						<option value="1" <?php if($status==1)echo 'selected';?>>Yes</option>
						
					</select>
					</span>
				</p>-->				
				
				<p class="stdformbutton">				
					<input type="submit"  name="submit" value="Approve">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
					<input type="hidden" name="seller_product_id" id="seller_product_id" value="<?php echo $seller_product_id?>">
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
			product_name: "required",			
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
		url = "<?php echo base_url(); ?>/admin/product_category/categoryDropdown/"+sec_id;
		jQuery('#category').load(url);
	});
	
	
	
	/*jQuery('#category_id').change(function(){
		cat_id = jQuery(this).val();
		url = "<?php echo base_url(); ?>/admin/product_category/subCatDropdown/"+cat_id;
		jQuery('#sub-category').load(url);		
	}); */
	
	jQuery('#associated_brand_id').change(function(){
		brand_id = jQuery(this).val();
		if(brand_id!=""){
			url = "<?php echo base_url(); ?>admin/brand_product/brand/"+brand_id;			
			jQuery(location).attr('href',url);
		}
	}); 
		
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
	
	if(jQuery('#quantity_option').is(":checked")){			
		jQuery("#min_alert").show();
	}else{
		jQuery("#min_alert").hide();
	}
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