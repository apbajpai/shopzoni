<?php foreach($pincode_records as $key => $pin){
	if($key == 0)
		$pincode_data .= '"'.$pin->pincode.'"';
	else
		$pincode_data .= ',"'.$pin->pincode.'"';
}
?>

		
		

	<label>Pincode<font color='red'>*</font></label>
	<span class="field">
	<select id="pincode_id" name="pincode_id" style="width:300px;">	
		<?php
			foreach($pincode_records as $pin){ ?>
				<option value="<?php echo $pin->id; ?>" <?php echo $selected ?>><?php echo $pin->pincode; ?></option>
		<?php
			}
		?>
	</select>
	</select>
	</span>					
	
	
	