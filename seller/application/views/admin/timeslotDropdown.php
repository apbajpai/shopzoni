
	<select id="time_slot_id" name="time_slot_id" style="width:300px;">	
		<option value="" selected="selected">Time Slot</option>
			<?php						
				foreach($time_slot as $timeslot){
					if($search['time_slot_id'] == $timeslot->id) $selected='selected="selected"';
					else $selected='';
			?>
				<option value="<?php echo $timeslot->id; ?>" <?php echo $selected ?>><?php echo date('g:i A', strtotime($timeslot->fromtime)); ?>-<?php echo date('g:i A', strtotime($timeslot->totime)); ?></option>
			<?php
				}
			?>
	</select>


	
