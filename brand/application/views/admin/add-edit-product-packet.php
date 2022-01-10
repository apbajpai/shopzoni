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
	$mrp=$row->mrp;
	$weight=$row->weight;	
	$unit=$row->unit;	
	$status=$row->status;
	$date_created=$row->date_created; 
	$date_modified=$row->date_modified; 
	$created_by=$row->created_by;	
	
	$product_name = $product_records->name;
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
			<form enctype="multipart/form-data" method="post" class="stdform" id="product" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url()?>admin/product_packet/save">	
				
				<p>
					<label>Product Name</label>
					<span class="field">
						<input type="text" name="product_name" id="product_name" class="longinput" disabled="disabled" value="<?php echo $product_name?>" />
					</span>					
				</p>
				<p>
					<label>Unit Value<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="weight" id="weight" class="longinput" value="<?php echo $weight?>" />
					</span>					
				</p>
				
				<p>
					<label>Unit<font color='red'>*</font></label>
					<span class="field">
					<select name="unit" id="unit">
						<option value="Piece" <?php if($unit=="Piece")echo 'selected';?>>Piece</option>
						<option value="kilogram" <?php if($unit=="kilogram")echo 'selected';?>>kilogram</option>						
						<option value="Gram" <?php if($unit=="Gram")echo 'selected';?>>Gram</option>						
						<option value="Metre" <?php if($unit=="Metre")echo 'selected';?>>Metre</option>
						<option value="Centimetre" <?php if($unit=="Centimetre")echo 'selected';?>>Centimetre</option>
						<option value="Inch" <?php if($unit=="Inch")echo 'selected';?>>Inch</option>
						<option value="Litre" <?php if($unit=="Litre")echo 'selected';?>>Litre</option>						
						<option value="Quintal" <?php if($unit=="Quintal")echo 'selected';?>>Quintal</option>
						<option value="Metric Ton" <?php if($unit=="Metric Ton")echo 'selected';?>>Metric Ton</option>
						<option value="Foot" <?php if($unit=="Foot")echo 'selected';?>>Foot</option>
						<option value="Millilitre" <?php if($unit=="Millilitre")echo 'selected';?>>Millilitre</option>
					</select>
					</span>
				</p>
				
				<p>
					<label>MRP<font color='red'>*</font></label>
					<span class="field">						
						<input name="mrp" id="mrp" class="longinput" value="<?php echo $mrp?>" />
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
			weight: "required",	
			unit: "required",			
			mrp: {
			  required: true,
			  number: true
			}					
		},
		messages: {
			
		}
	});	
	
});	

</script>