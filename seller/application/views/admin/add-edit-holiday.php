<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>js/plugins/timepicker/css/mtimepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>js/plugins/timepicker/css/styles.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/timepicker/mtimepicker.js"></script>


<?php 
if($row){	
	$id=$row->id;		
	$seller_id=$row->seller_id;	
	$sunday=$row->sunday;	
	$monday=$row->monday; 
	$tuesday=$row->tuesday; 
	$wednesday=$row->wednesday; 
	$thursday=$row->thursday; 
	$friday=$row->friday; 
	$saturday=$row->saturday; 
	$date_created=$row->date_created; 
}
else{	
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
  
</style>

 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo validation_errors(); ?></div></span>
		<span class="pagedesc"><div style="color:red;margin-left: 65px; font-size: 150%;"><?php echo $error_msg; ?></div></span>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="brand" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/holiday/save">	
				
									
				<p>
					<label><b>Check Here </b></label>
					<span class="field">&nbsp; </span>
				</p>
				
		
				
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="sunday" id="sunday" <?php if($sunday==1){ ?> checked <?php } ?> value="1"> Sunday<br>
					</span>
				</p>
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="monday" id="monday" <?php if($monday==1){ ?> checked <?php } ?> value="1"> Monday<br>
					</span>
				</p>
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="tuesday" id="tuesday" <?php if($tuesday==1){ ?> checked <?php } ?> value="1"> Tuesday<br>
					</span>
				</p>
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="wednesday" id="wednesday" <?php if($wednesday==1){ ?> checked <?php } ?> value="1"> Wednesday<br>
					</span>
				</p>
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="thursday" id="thursday" <?php if($thursday==1){ ?> checked <?php } ?> value="1"> Thursday<br>
					</span>
				</p>
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="friday" id="friday" <?php if($friday==1){ ?> checked <?php } ?> value="1"> Friday<br>
					</span>
				</p>
				<p>
					<label>&nbsp </label>
					<span class="field">
						<input type="checkbox" name="saturday" id="saturday" <?php if($saturday==1){ ?> checked <?php } ?> value="1"> Saurday<br>
					</span>
				</p>
					
				
				<p class="stdformbutton">					
					<input type="submit"  name="addedit" id="addedit" value="Submit">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
					<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $this->session->userdata('seller_id'); ?>">
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->



<script>
jQuery(document).ready(function(){
	jQuery("#brand").validate({
		rules: {
			name: required,			
		},
		messages: {
			name: {
				required: "Please enter name",
			},			
		}
	});
});	
</script>