<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>

<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>css/plugins/jquery.tagsinput.css">
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>js/plugins/timepicker/css/mtimepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>js/plugins/timepicker/css/styles.css" />
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/timepicker/mtimepicker.js"></script>


<?php 
if($row){
	$id=$row->id;		
	$delivery_location_id=$row->delivery_location_id;		
	$totime=$row->totime;	
	$fromtime=$row->fromtime;	
	$order_ending_time=$row->order_ending_time;	
	$maximum_no_of_order=$row->maximum_no_of_order;	
	$status=$row->status; 
	$created_by=$row->created_by; 
	$date_created=$row->date_created; 
}
else{
	//$totime = date("h:i");
	//$fromtime = date("h:i");
	$status = 1;
	$id = 0;
}
?>


<script type="text/javascript">
$(document).ready( function(){
	$('#totime').mTimePicker().mTimePicker( 'setTime', '<?php echo $totime; ?>' );
});

$(document).ready( function(){
	$('#fromtime').mTimePicker().mTimePicker( 'setTime', '<?php echo $fromtime; ?>' );
});

$(document).ready( function(){
	$('#order_ending_time').mTimePicker().mTimePicker( 'setTime', '<?php echo $order_ending_time; ?>' );
});
</script>


<style type="text/css">
  body { background-color:#F5F5F5; font-size: 12px; font-family: Tahoma; color: #555;  }
  .section { background: none repeat scroll 0 0 #FFFFFF; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1); margin-bottom: 27px; padding: 20px; line-height: 18px; }
  ul.section { padding-left: 32px; }
  .section-title { font-size: 20px;line-height: 22px;margin-bottom: 10px;margin-top: 150px;font-weight: normal;}
  .in-section-title {font-size: 18px;line-height: 20px;margin-bottom: 8px;font-weight: normal;}
  pre {background-color: #FAFAFA;border: 1px solid #CCCCCC;color: #000000;font-size: 11px;padding: 4px;}
  a {color: #006096;text-decoration:none;font-weight: bold; }
  a:hover { text-decaration: underline; }
  .definition { display: inline-block; font-family: monospace;font-size: 15px;color: #0070A6;}
  .typization { margin-left: 30px; font-style: italic; }
  .description {display:block;margin-bottom: 20px; margin-left: 10px;}

  #totime {
	background-color:#F9F9F9;
	border:1px solid #AAAAAA;
	border-radius:5px;
	color:#555555;
	font-size:12px;
    padding: 3px;
    width: 72px;
    text-align:center;
  }
  
  #fromtime {
	background-color:#F9F9F9;
	border:1px solid #AAAAAA;
	border-radius:5px;
	color:#555555;
	font-size:12px;
    padding: 3px;
    width: 72px;
    text-align:center;
  }
  
  #order_ending_time {
	background-color:#F9F9F9;
	border:1px solid #AAAAAA;
	border-radius:5px;
	color:#555555;
	font-size:12px;
    padding: 3px;
    width: 72px;
    text-align:center;
  }
  
</style>

 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo $this->session->userdata('validation_errors'); ?></div></span>
		<span class="pagedesc"><div style="color:red;margin-left: 65px; font-size: 150%;"><?php echo $error_msg; ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="time_slotfrm" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/time_slot/save">	
				
							
				<!--<p>
					<label>Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>-->
				
			
				
				<p>
					<label>Delivery Location<font color='red'>*</font></label>
					<span class="field">
						<select name="delivery_location_id" id="delivery_location_id">
							<option value="">Select Delivery Location</option>
							<?php
								foreach($delivery_location as $val){
									if($delivery_location_id==$val->id)$selected='selected="selected"';
									else $selected='';
							?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected ?>><?php echo $val->delivery_location; ?></option>
							<?php
								}
							?>
						</select>
					</span>					
				</p>	
				
				
				
				<p>
					<label>From<font color='red'>*</font></label>
					<span class="field">
						<input id="fromtime" name="fromtime" class="longinput" type="text">
					</span>
				</p>
				
				<p>
					<label>To<font color='red'>*</font></label>
					<span class="field">
						<input id="totime" name="totime" class="longinput" type="text">
					</span>
				</p>
				
				<p>
					<label>Order Ending Time<font color='red'>*</font></label>
					<span class="field">
						<input id="order_ending_time" name="order_ending_time" class="longinput" type="text">
						<?php echo form_error('order_ending_time'); ?>
					</span>
				</p>
				
				
				
				
				<!--<p>
					<label>From<font color='red'>*</font></label>
					<span class="field" style="width:200px; overflow:hidden">
						<select name="from_hour">
							<?php 
							$t1 = 1;
							while($t1<=24){ 
							switch($t1){
								case 1 : $t1_val = '01';
								break;
								case 2:  $t1_val='02';
								break;
								case 3 : $t1_val='03';
								break;
								case 4 : $t1_val='04';
								break;
								case 5 : $t1_val='05';
								break;
								case 6 : $t1_val='06';
								break;
								case 7 : $t1_val='07';
								break;
								case 8 : $t1_val='08';
								break;
								case 9 : $t1_val='09';
								break;
								default: $t1_val=$t1;								
							}
							
							?>
							<option value="<?php echo $t1; ?>" <?php if($status==$t1)echo 'selected';?>><?php echo $t1_val; ?></option>	
							<?php $t1++; } ?>
						</select>
						
						<select name="from_minute">
							<?php 
							$m1 = 1; 
							while($m1<=60){ 
								switch($m1){
								case 1 : $m1_val='01';
								break;
								case 2: $m1_val='02';
								break;
								case 3 : $m1_val='03';
								break;
								case 4 : $m1_val='04';
								break;
								case 5 : $m1_val='05';
								break;
								case 6 : $m1_val='06';
								break;
								case 7 : $m1_val='07';
								break;
								case 8 : $m1_val='08';
								break;
								case 9 : $m1_val='09';
								break;
								default: $m1_val = $m1;
							}
							?>
							<option value="<?php echo $m1; ?>" <?php if($status==$m1)echo 'selected';?>><?php echo $m1_val; ?></option>	
							<?php $m1++; } ?>
						</select>
					</span>
				</p>
				
				
				
				<p>
					<label>To<font color='red'>*</font></label>
					<span class="field" style="width:200px; overflow:hidden">
						<select name="to_hour">
							<?php 
							$t2 = 1;
							while($t2<=24){ 
							switch($t2){
								case 1 : $t2_val = '01';
								break;
								case 2:  $t2_val='02';
								break;
								case 3 : $t2_val='03';
								break;
								case 4 : $t2_val='04';
								break;
								case 5 : $t2_val='05';
								break;
								case 6 : $t2_val='06';
								break;
								case 7 : $t2_val='07';
								break;
								case 8 : $t2_val='08';
								break;
								case 9 : $t2_val='09';
								break;
								default: $t2_val=$t2;								
							}
							
							?>
							<option value="<?php echo $t2; ?>" <?php if($status==$t2)echo 'selected';?>><?php echo $t2_val; ?></option>	
							<?php $t2++; } ?>
						</select>
						
						<select name="to_minute">
							<?php 
							$m2 = 1; 
							while($m2<=60){ 
								switch($m2){
								case 1 : $m2_val='01';
								break;
								case 2:  $m2_val='02';
								break;
								case 3 : $m2_val='03';
								break;
								case 4 : $m2_val='04';
								break;
								case 5 : $m2_val='05';
								break;
								case 6 : $m2_val='06';
								break;
								case 7 : $m2_val='07';
								break;
								case 8 : $m2_val='08';
								break;
								case 9 : $m2_val='09';
								break;
								default: $m2_val = $m2;
							}
							?>
							<option value="<?php echo $m2; ?>" <?php if($status==$m2)echo 'selected';?>><?php echo $m2_val; ?></option>	
							<?php $m2++; } ?>
						</select>
					</span>
				</p>
				
				
				
				<p>
					<label>Order Ending Time<font color='red'>*</font></label>
					<span class="field" style="width:200px; overflow:hidden">
						<select name="order_ending_hour">
							<?php 
							$t3 = 1;
							while($t3<=24){ 
							switch($t3){
								case 1 : $t3_val = '01';
								break;
								case 2:  $t3_val='02';
								break;
								case 3 : $t3_val='03';
								break;
								case 4 : $t3_val='04';
								break;
								case 5 : $t3_val='05';
								break;
								case 6 : $t3_val='06';
								break;
								case 7 : $t3_val='07';
								break;
								case 8 : $t3_val='08';
								break;
								case 9 : $t3_val='09';
								break;
								default: $t3_val=$t3;								
							}
							
							?>
							<option value="<?php echo $t3; ?>" <?php if($status==$t3)echo 'selected';?>><?php echo $t3_val; ?></option>	
							<?php $t3++; } ?>
						</select>
						
						<select name="order_ending_minute">
							<?php 
							$m3 = 1; 
							while($m3<=60){ 
								switch($m3){
								case 1 : $m3_val='01';
								break;
								case 2:  $m3_val='02';
								break;
								case 3 : $m3_val='03';
								break;
								case 4 : $m3_val='04';
								break;
								case 5 : $m3_val='05';
								break;
								case 6 : $m3_val='06';
								break;
								case 7 : $m3_val='07';
								break;
								case 8 : $m3_val='08';
								break;
								case 9 : $m3_val='09';
								break;
								default: $m3_val = $m3;
							}
							?>
							<option value="<?php echo $m3; ?>" <?php if($status==$m3)echo 'selected';?>><?php echo $m3_val; ?></option>	
							<?php $m3++; } ?>
						</select>
					</span>
				</p>--->
				
				
				
				<p>
					<label>Maximum Number Of Order<font color='red'>*</font></label>
					<span class="field">
						<input id="maximum_no_of_order" name="maximum_no_of_order" class="longinput" value="<?php echo $maximum_no_of_order; ?>" type="text">
					</span>
				</p>
				
				
				
								
				<p>
					<label>Status</label>
					<span class="field">
					<select name="status">
						<option value="1" <?php if($status==1)echo 'selected';?>>Active</option>
						<option value="0" <?php if($status==0)echo 'selected';?>>Inactive</option>
					</select>
					</span>
				</p>	
				
				<p class="stdformbutton">					
					<input type="submit"  name="addedit" id="addedit" value="Submit">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->






<script>
jQuery(document).ready(function(){		
	jQuery("#time_slotfrm").validate({
		rules: {			
			maximum_no_of_order: {
				required: true,
				number: true,				
				maxlength: 6
			},
							
		},
		messages: {
			maximum_no_of_order: {               
                maxlength: "Maximum number of orders up to 6 digits."
            },
		}
	});	
});
</script>

