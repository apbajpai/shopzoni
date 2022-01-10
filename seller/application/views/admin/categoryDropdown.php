<label>Category<font color='red'>*</font></label>
	<span class="field">
		<select name="category_id" id="category_id" onchange="getCategory(this.value);">
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

	
<script>
function getCategory(val){
		//alert(val);
		cat_id = val;		
		url = "<?php echo base_url(); ?>/admin/product_category/subCatDropdown/"+cat_id;
		jQuery('#sub-category').load(url);		
}
</script>