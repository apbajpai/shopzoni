	
	<?php 	
	if(isset($time_slot) && $time_slot[0]->id!=""){ ?>
	
	<div class="col-md-6">
		<label>Time Slot</label>
		<select class="form-control" id="time_slot_id" name="time_slot_id" >
			<option value="">Select time slot</option>
			<?php 			
				foreach($time_slot as $time){
					if($time_slot_id == $time->id) $selected='selected="selected"';
					else $selected='';
					$order_ending_time = $time->order_ending_time;
					$system_time = date("H:i");
					$system_date = date("d-m-Y");
					$dateTimestamp1 = strtotime($system_date);
					$dateTimestamp2 = strtotime($delivery_date);
					if($system_time<$order_ending_time || $dateTimestamp1<$dateTimestamp2){
			?>
			<option value="<?php echo $time->id; ?>" <?php echo $selected ?>><?php echo date('g:i A', strtotime($time->fromtime)); ?> - <?php echo date('g:i A', strtotime($time->totime)); ?></option>
				<?php } } ?>
		</select>
	</div>
	
	<?php }else{ ?>
	<div class="col-md-6" style="margin-top: 25px;">
		<label>&nbsp;</label>
		<span style="color:red">Please Choose Next Date. </span>
	</div>
	<?php } ?>
	<div id="check_maximum_orderDIV" class="col-md-12" style="margin-top: -12px;"></div>
	

	
<script>	

jQuery('#time_slot_id').change(function(){
		jQuery("#confirmDiv").show();
		time_slot_id = jQuery(this).val();
		//alert(time_slot_id);
		if(time_slot_id!=""){				
			url = "<?php echo base_url(); ?>check-maximum-order/"+time_slot_id+"/<?php echo $delivery_date; ?>";	
			//alert(url);			
			jQuery('#check_maximum_orderDIV').load(url);			
		}else{			
			jQuery('#check_maximum_orderDIV').html("");			
		}
});
</script>
	