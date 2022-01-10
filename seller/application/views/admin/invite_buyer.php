<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
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
	$id=$row->id;
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
			<?php 
			if($mail_val==1){ ?>
			<span style="color:green">Mail Sent Successfully...!</span>
			<?php }  ?>
		
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/invite_buyer/invite">	
							
				<p>
					<label>To<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="to" id="to" class="longinput" value="<?php echo $to?>" />
						<label class="error" style="display:none;">Please enter name</label>
					</span>					
				</p>
				
				<p>
					<input type="button" name="view_buyer" id="view_buyer" value="View Buyer">
				</p>
				
				<div id="buyer_list">
				<p>
					<label>&nbsp;</label>
					<input type="checkbox" id="checkAll"/> <b>Check All</b>
				</p>
				<?php foreach($records as $data){ ?>				
				<p>
				<label>&nbsp;</label>
				<input type="checkbox" data-id="<?php echo $data->id; ?>"  name="chk[]" id="chk<?php echo $data->id; ?>" value="<?php echo $data->email; ?>">
				<?php echo $data->email; ?>
				</p>
				<?php } ?>
				</div>
				
				<p>
					<label>Subject</label>
					<span class="field">
						<input type="text" name="subject" id="subject" class="longinput" value="<?php echo $subject?>" />
						<label class="error" style="display:none;">Please enter name</label>
					</span>					
				</p>
				
				<p>
					<label>Description</label>
					<span class="field">
						<textarea name="description" class="tinymce"><?php echo $description?></textarea>
					</span>					
				</p>				
				
				<p class="stdformbutton">				
					<input type="submit"  name="submit" value="Send">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">				
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->



<script>
jQuery( "#buyer_list" ).hide();
jQuery( "#view_buyer" ).click(function() {
  jQuery( "#buyer_list" ).toggle();
});
</script>

<script>

jQuery(document).ready(function(){		
	jQuery("#product").validate({
		rules: {
			//seller_id: "required",
			//to: "required"								
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
});	

</script>

<script>
jQuery("#checkAll").change(function () {
    jQuery("input:checkbox").prop('checked', jQuery(this).prop("checked"));
});
</script>