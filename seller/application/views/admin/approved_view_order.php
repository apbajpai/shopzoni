<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/tables.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/forms.js"></script>
<div class="centercontent tables">
	<div class="pageheader notab">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><?php if( $this->session->flashdata('message')) {?>
		<?php echo $this->session->flashdata('message'); ?><?php } ?></span>		
	</div><!--pageheader-->	
	<div id="contentwrapper" class="contentwrapper">
	
		<?php //Search start ?>
		<!--<form action="" method="POST" id="searchfm" name="searchfm">
			<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb">
				<tbody>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Buyer:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="name" id="name" value="<?php echo $search['name']; ?>">
						</td>
						<td rowspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
					</tr>
					
				</tbody>
			</table>
		</form>
		<br>-->
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
					<?php 
					if($records[0]->type==1){ ?>
					<th class="head0">Delivery Location :</th>					
					<th class="head1"><?php echo $records[0]->delivery_location; ?></th>
					<th class="head0">Delivery Date : </th>
					<th class="head1"><?php echo date("d-m-Y",strtotime($records[0]->delivery_date)); ?></th>
					<th class="head0">Time Slot :</th>				
					<th class="head1" colspan="3">[<?php echo date('g:i A', strtotime($records[0]->fromtime)); ?>-<?php echo date('g:i A', strtotime($records[0]->totime)); ?>]</th>
					<?php } ?>
				</tr>
				<tr>
					<th class="head0">Name : </th>
					<th class="head1"><?php echo $records[0]->buyer_name; ?></th>	
					<th class="head0">Business Name : </th>
					<th class="head1"><?php $buyer_business_name = $records[0]->buyer_business_name; echo wordwrap($buyer_business_name,20,"<br>\n",TRUE); ?></th>
					<?php if($records[0]->type==1){ ?>		
					<th class="head0">Shipping Charge : </th>
					<th class="head1"><?php echo $records[0]->shipping_charge; ?></th>	
					<?php } ?>
				</tr>
				
				<?php if($records[0]->type==1){ ?>
				<tr>									
					<th class="head0" style="color:red">Billing Address : </th>
					<th class="head0" colspan="8">&nbsp;&nbsp;&nbsp;<?php echo $records[0]->billing_name; ?>&nbsp;&nbsp;&nbsp;   
					<?php echo $records[0]->billing_address; ?>&nbsp;&nbsp;&nbsp;  
					<?php echo $records[0]->billing_pincode; ?>&nbsp;&nbsp;&nbsp;
					Phone : <?php echo $records[0]->billing_mobile; ?>&nbsp;&nbsp;&nbsp;
					Email : <?php echo $records[0]->billing_email; ?></th>
				</tr>
				<?php }else if($records[0]->type==0){ ?>
				<tr>									
					<th class="head0" style="color:red">Billing Address : </th>
					<th class="head0" colspan="8">&nbsp;&nbsp;&nbsp;<?php echo $records[0]->name; ?>&nbsp;&nbsp;&nbsp;   
					<?php echo $records[0]->address; ?>&nbsp;&nbsp;&nbsp;  
					<?php echo $records[0]->pincode; ?>&nbsp;&nbsp;&nbsp;
					Phone : <?php echo $records[0]->mobile; ?>&nbsp;&nbsp;&nbsp;
					Email : <?php echo $records[0]->email; ?></th>
				</tr>				
				<?php } ?>	
					
				<?php if($records[0]->type==1){ ?>
				<tr>
					<th class="head0" style="color:#652C3B">Shipping Address :</th>													
					<th class="head0" colspan="8">&nbsp;&nbsp;&nbsp;<?php echo $records[0]->delivery_name; ?> &nbsp;&nbsp;&nbsp;
					<?php echo $records[0]->delivery_address; ?>&nbsp;&nbsp;&nbsp;
					<?php echo $records[0]->delivery_pincode; ?>&nbsp;&nbsp;&nbsp;
					Phone : <?php echo $records[0]->delivery_mobile; ?>&nbsp;&nbsp;&nbsp;
					Email : <?php echo $records[0]->delivery_email; ?>
					</th>					
				</tr>
				<?php } ?>
				
			</thead>
			
			<thead>
				<tr>
					<th class="head0">Order ID</th>
					<th class="head1">Product Name</th>
					<th class="head1">Offer</th>
					<th class="head0">Qty</th>
					<th class="head1">Unit</th>
					<th class="head0">Price</th>				
					<th class="head1">Amount</th>
					<!--<th class="head0">Status</th>-->					
					<th class="head1">Date</th>
					<th class="head0">Actions</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 				
				$i=0; foreach($records as $data){$i++;
						switch ($data->order_status) {
							case 1: 
								$order_status = "Added To Cart";
								break;
							case 3:
								$order_status = "Order Placed";
								break;
							case 4:
								$order_status = "Order Approved";
								break;
							case 5:
								$order_status = "Order Cancel";
								break;
						}
				?>
					<tr class='gradeA'>
						<td><?php echo $data->order_id; ?></td>
						<td><?php echo $data->product_name; ?></td>	
						<td><?php $str = $data->product_offer;;
							echo wordwrap($str,25,"<br>\n",TRUE); ?></td>	
						<td><?php echo $data->total_quantity; ?></td>
						
						<?php if($data->packet[0]->id!=""){ 
						foreach($data->packet as $row){						
						?>						
						<td><?php echo $data->product_weight; ?>-<?php echo $data->product_unit; ?></td>
						<td><i class="fa fa-inr"></i> <?php echo $data->product_price; ?></td>					
						<td><i class="fa fa-inr"></i> <?php echo ($data->product_price*$data->total_quantity); ?>.00</td>	
						<?php } }else{ ?>
						<td><?php echo $data->product_weight; ?>-<?php echo $data->product_unit; ?></td>
						<td><i class="fa fa-inr"></i> <?php echo $data->product_price; ?></td>					
						<td><i class="fa fa-inr"></i> <?php echo ($data->product_price*$data->total_quantity); ?></td>	
						<?php } ?>
						
						<!--<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>-->
						<td><?php echo GetDateFormat($data->date_created); ?></td>	
						<td>
							<div id="orderstatusDiv<?php echo $data->id; ?>">
								<?php if($data->order_status==3){ ?>
								<input onclick="approveOrderStatus('<?php echo $data->id; ?>')" type="submit" name="order_status" id="order_status" value="Approve">
								<?php }else if($data->order_status==4){ ?>
								Approved
								<?php }else if($data->order_status==5){ ?>
								Cancel by Buyer
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
	
	function approveOrderStatus(cart_id) {
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/order/approveOrderStatus",
			data: {
				cart_id : cart_id
			}
		})
		.done (function(data) {
			jQuery('#orderstatusDiv'+data).html("Approved"); 
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
</script>



    
