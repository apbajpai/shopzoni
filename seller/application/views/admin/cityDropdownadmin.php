<?php foreach($city_records as $key => $city){
	if($key == 0)
		$city_data .= '"'.$city->district_name.'"';
	else
		$city_data .= ',"'.$city->district_name.'"';
}
?>

		
		

	<label>City / District<font color='red'>*</font></label>	
	<span class="field">
	<select id="city_id" name="city_id" style="width:300px;">	
	<option value="" selected="selected">Select City / District</option>
		<?php
			foreach($city_records as $city){ ?>
				<option value="<?php echo $city->id; ?>" <?php echo $selected ?>><?php echo $city->district_name; ?></option>
		<?php
			}
		?>
	</select>
	</select>
	</span>		


<script>
jQuery('#city_id').change(function(){
	city_id = jQuery(this).val();
	url = "<?php echo base_url(); ?>admin/seller_registration/pincodeDropdown/"+city_id;
	jQuery('#pincodediv').load(url);
});
</script>	
	