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

if($row){
	$product_id=$row->product_id;
	$id=$row->id;
	$name=$row->name;
	$model_no=$row->model_no;
	$brand_name=$row->brand_name;
	$image="http://shopzoni.com/brand/public/uploads/product/".$row->image[0]->image;
	$seller_id=$row->seller_id;
	$quantity=$row->quantity;
	$minimum_quantity_alert=$row->minimum_quantity_alert;
	
	$quantity_option=$row->quantity_option;
	$weight=$row->weight;
	$unit=$row->unit;
	$mrp=$row->mrp;
	$price=$row->price;
	$offer=$row->offer;
	$color=$row->offer_code;
	$date_created=$row->date_created;
	$date_modified=$row->date_modified;
	$status=$row->status; 
	
	$packet = $row->packet;
}else{	
	$status = 0;
	$date_created = date('Y-m-d');
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/product/save">	
				
				<p>
					<label>Brand Name</label>
					<span class="field">
						<input type="text" readonly="readonly" name="brand_name" id="brand_name" class="longinput" value="<?php echo $brand_name?>" />
					</span>					
				</p>
				
				<p>
					<label>Product Name</label>
					<span class="field">
						<input type="text" readonly="readonly" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>
				
				<p>
					<label>Model No.</label>
					<span class="field">
						<input type="text" readonly="readonly" name="model_no" id="model_no" class="longinput" value="<?php echo $model_no?>" />
					</span>					
				</p>
				
				<p>
					<label>Image</label>
					<span class="field">
						<img src="<?php echo $image; ?>" height="80" width="80" />
					</span>					
				</p>	

				<?php 
				if($packet[0]->id==""){
				?>		
				
				<p>
					<label>&nbsp;</label>
					<span class="field">
						<input type="checkbox" data-id="<?php echo $data->id; ?>"  name="quantity_option" id="quantity_option" onclick="valueChanged();" value="1" <?php echo ($quantity_option == 1)?'checked':''; ?>>
						<br>
						Check Here For Quantity Alert
					</span>					
				</p>
				
				<div id="min_alert">
				<p>
					<label>Quantity</label>
					<span class="field">
						<input type="text" name="quantity" id="quantity" class="longinput" value="<?php echo $quantity?>" />
					</span>					
				</p>

				<p>
					<label>Minimum Quantity Alert</label>
					<span class="field">
						<input type="text" name="minimum_quantity_alert" id="minimum_quantity_alert" class="longinput" value="<?php echo $minimum_quantity_alert?>" />
					</span>					
				</p>
				</div>
				
				<p>
					<label>MRP    </label>								
					<span class="field">
					<b><?php echo $weight; ?>-<?php echo $unit;?>/<i class="fa fa-inr"></i><?php echo $mrp;?></b>
					</span>			
				</p>
				
				<p>
					<label>Price<font color='red'>*</font></label>
					<span class="field">						
						<input name="price" id="price" class="longinput" value="<?php echo $price?>" />
					</span>					
				</p>
				
				<?php }else{ ?>
				
				<p>
					<label><b>Add Packets</b></label>
					<span class="field">						
						&nbsp;
					</span>	
				</p>
				<?php foreach($packet as $key=>$pkt){ ?>				
				<p>
					<label>&nbsp;</label>
					<span class="field">
						<input type="checkbox" data-id="<?php echo $pkt->id; ?>"  name="packet_id[]" id="packet_id<?php echo $pkt->id; ?>"  value="<?php echo $pkt->id; ?>" <?php echo ($packet_records[$key]->status==1)?'checked':''; ?>> <b><?php echo $pkt->weight;?>-<?php echo $pkt->unit;?>/<i class="fa fa-inr"></i><?php echo $pkt->mrp;?></b>
						&nbsp;&nbsp;&nbsp;&nbsp;
						
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" data-id="<?php echo $pkt->id; ?>"  name="pkt_quantity_option[]" id="pkt_quantity_option<?php echo $pkt->id; ?>" onclick="pkt_valueChanged('<?php echo $pkt->id; ?>');" value="1" <?php echo ($packet_records[$key]->quantity_option==1)?'checked':''; ?>>
						&nbsp;&nbsp;&nbsp;&nbsp;
						Quantity Alert
					</span>		
					
					<input type="hidden" name="packet_ids[]" id="packet_ids" value="<?php echo $pkt->id; ?>">
					
				</p>
				
				<!--<p>
					<label>&nbsp;</label>
					<span class="field">
						<input type="checkbox" data-id="<?php echo $pkt->id; ?>"  name="pkt_quantity_option[]" id="pkt_quantity_option<?php echo $pkt->id; ?>" onclick="pkt_valueChanged('<?php echo $pkt->id; ?>');" value="1" <?php echo ($pkt->quantity_option == 1)?'checked':''; ?>>
						<br>
						Check Here For Quantity Alert
					</span>					
				</p>-->
				
				<div id="pkt_min_alert<?php echo $pkt->id; ?>">
				<p>
					<label>Quantity</label>
					<span class="field">
						<input type="text" name="pkt_quantity[]" id="pkt_quantity<?php echo $pkt->id; ?>" class="longinput" value="<?php echo $packet_records[$key]->quantity; ?>" />
					</span>					
				</p>

				<p>
					<label>Minimum Quantity Alert</label>
					<span class="field">
						<input type="text" name="pkt_minimum_quantity_alert[]" id="pkt_minimum_quantity_alert<?php echo $pkt->id; ?>" class="longinput" value="<?php echo $packet_records[$key]->minimum_quantity_alert; ?>" />
					</span>					
				</p>
				</div>
				
				<p>
					<label>Price<font color='red'>*</font></label>
					<span class="field">						
						<input name="pkt_price[]" id="pkt_price<?php echo $pkt->id; ?>" class="longinput" value="<?php echo $packet_records[$key]->price; ?>" />
					</span>					
				</p>
				
				<?php }} ?>
				
				<p>
					<label>Offer</label>
					<span class="field">						
						<textarea name="offer" id="offer" rows="5" cols="30" maxlength="255" ><?php echo $offer?></textarea>
						<br>
						[Offer Upto 255 Character only.]
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
	
	<?php foreach($packet as $key=>$pkt){ ?>
	if(jQuery('#pkt_quantity_option<?php echo $pkt->id; ?>').is(":checked")){			
		jQuery("#pkt_min_alert<?php echo $pkt->id; ?>").show();
	}else{
		jQuery("#pkt_min_alert<?php echo $pkt->id; ?>").hide();
	}		
	<?php } ?>
	
});	


function valueChanged()
{
	if(jQuery('#quantity_option').is(":checked")){			
		jQuery("#min_alert").show();
	}else{
		jQuery("#min_alert").hide();
	}
}

function pkt_valueChanged(id)
{
	var pkt_quantity_option_val = "pkt_quantity_option"+id;
	var pkt_min_alert_val = "pkt_min_alert"+id;
		
	if(jQuery('#'+pkt_quantity_option_val).is(":checked")){	
		jQuery("#"+pkt_min_alert_val).show();
	}else{
		jQuery("#"+pkt_min_alert_val).hide();
	}
}


</script>