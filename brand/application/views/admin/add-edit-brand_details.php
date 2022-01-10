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
	$description=$row->description;	
	$status=$row->status;
	$date_created=$row->date_created; 
	$date_modified=$row->date_modified; 
	$created_by=$row->created_by; 
	$added_by=$row->added_by; 	
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/brand_details/save">	
										
				<p>
					<label>Description</label>
					<span class="field">
						<textarea name="description" class="tinymce"><?php echo $description?></textarea>
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
			description: "required"			
		},
		messages: {
			description: "Please enter article title"
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

});

</script>