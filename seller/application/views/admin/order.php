<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo VIEWBASE?>css/plugins/jquery.tagsinput.css">



<div class="centercontent tables">
	<div class="pageheader notab">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><?php if( $this->session->flashdata('message')) {?>
		<?php echo $this->session->flashdata('message'); ?><?php } ?></span>		
	</div><!--pageheader-->	
	<div id="contentwrapper" class="contentwrapper">
	
		<?php //Search start ?>
		<form action="" method="POST" id="searchfm" name="searchfm">
			<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb">
				<tbody>
				
				<?php if($this->session->userdata('type')==1){ ?>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Delivery Location:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							<select id="delivery_location_id" name="delivery_location_id" style="width:300px;">	
								<option value="" selected="selected">Select Delivery Location</option>
									<?php						
										foreach($delivery_location as $location){
											if($search['delivery_location_id'] == $location->id) $selected='selected="selected"';
											else $selected='';
									?>
										<option value="<?php echo $location->id; ?>" <?php echo $selected ?>><?php echo $location->delivery_location; ?></option>
									<?php
										}
									?>
							</select>
						</td>
						
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Delivery Date:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input id="delivery_date" name="delivery_date" class="width100" type="text" value="<?php echo $search['delivery_date']; ?>">							
						</td>			
						
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Time Slot:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
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
						</td>							
					</tr>
				<?php } ?>	
					
				
					
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Order Id:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="order_id" id="order_id" value="<?php echo $search['order_id']; ?>">
						</td>
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Email Id:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="email" id="email" value="<?php echo $search['email']; ?>">
						</td>
						<td rowspan="2" colsapn="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
						
					</tr>
					
				</tbody>
			</table>
		</form>
		<br>
		<?php //search ends ?>
	
	
		<input type="hidden" name="controller" id="controller" value="buyer_request" />
		<table cellpadding="0" cellspacing="0" border="0" class="stdtable">
		
			<colgroup>
				<col class="con0" />
				<col class="con1" />
				<col class="con0" />
				<col class="con1" />
				<col class="con0" />				
			</colgroup>
			
			<thead>
				<tr>
					<th class="head1">Date</th>
					<th class="head0">Order ID</th>
					<th class="head1">Buyer Name</th>
					<th class="head1">Phone No.</th>
					<th class="head1">Email Id</th>
					<th class="head1">Address</th>
					<th class="head0">Actions</th>
					<th class="head0">Send Mail</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 				
				$i=0;foreach($records as $data){$i++; ?>
					<tr class='gradeA' <?php if($data->view_status==0){ ?> style="background-color:#FCFB90" <?php } ?>>
						<td><?php echo date("d-m-Y h:i:s A", strtotime($data->date_created)); ?></td>	
						<td><?php echo $data->order_id; ?></td>
						<td><?php echo $data->buyer_name; ?><br><?php echo $data->buyer_business_name; ?> </td>	
						<td><?php echo $data->buyer_mobile; ?></td>
						<td><?php echo $data->buyer_email; ?></td>
						<td><?php echo $data->buyer_address; ?></td>										
						<!--<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>-->
						<td><a href="<?php echo base_url() ?>admin/order/view/<?php echo $data->order_id; ?>"><input type="submit" value="View"> <br></td>
						<td>
							<div id="orderstatusDiv<?php echo $data->order_id; ?>">
								<?php if($data->mailto_buyer_status=='' || $data->mailto_buyer_status==0){ ?>
								<input onclick="sendMailToBuyer('<?php echo $data->order_id; ?>')" type="button" name="send_mail" id="send_mail" value="Send Mail">
								<?php }else if($data->mailto_buyer_status==1){ ?>
								Mail Sent
								<?php } ?>
							</div>
							<!--<a href="javascript:;" data-id="<?php echo $data->id; ?>" class="deletelink"><strong>Delete</strong></a><br>-->
						</td>
					</tr>
				<?php }?>	
				
			</tbody>
		</table>
		<div class="pagination" style="float:right; margin:20px 0px 20px 0px;">
			<ul>
				<?php echo $pagination_links; ?>
			</ul>
		</div>
	</div><!-- #updates -->
</div><!--contentwrapper-->
<br clear="all" />
</div><!-- centercontent -->


<script>

	function sendMailToBuyer(order_id) {	
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/order/sendMailToBuyer",
			data: {
				order_id : order_id,
			}
		})
		.done (function(data) {
			jQuery('#orderstatusDiv'+data).html("Mail Sent"); 
		})
		.fail(function(){ 
			alert("Error"); 
		});
	}
	
	function approveOrderStatus(cart_id) {
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/order/approveOrderStatus",
			data: {
				cart_id : cart_id
			}
		})
		.done (function(data) {
			jQuery('#orderstatusDiv'+data).html("Approve"); 
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}


	function rejectOrderStatus(cart_id) {
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/order/rejectOrderStatus",
			data: {
				cart_id : cart_id
			}
		})
		.done (function(data) { 
			jQuery('#orderstatusDiv'+data).html("Rejected"); 
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}
	
	
	
	jQuery("#delivery_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1910:'
	});
	
	
</script>

<script>
jQuery('#delivery_location_id').change(function(){
		delivery_location_id = jQuery(this).val();		
		if(delivery_location_id!=""){			
			url = "<?php echo base_url(); ?>admin/order/timeslotDropdown/"+delivery_location_id; 
			jQuery('#time_slot_id').load(url);			
		}else{			
			jQuery('#time_slot_id').html("");
			update_shipping_charge();
		}
});
</script>



    
