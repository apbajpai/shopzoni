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
					<th class="head0">ID</th>
					<th class="head1">Buyer Name</th>
					<th class="head1">Business Name</th>
					<th class="head1">Address</th>
					<th class="head1">Email</th>
					<th class="head1">Seller Name[Code]</th>
					<th class="head1">Seller Email</th>
					<th class="head0">Request Status</th>
					<th class="head0">Date</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0;foreach($records as $data){$i++; 
				
				switch($data->request_status){
					case 0 : $request_status = "Waiting For Approve Or Reject";
							break;
					case 1 : $request_status = "Request Approved";
							break;
					case 2 : $request_status = "Request Rejected";
							break;					
				}
				?>
					<tr class='gradeA' id="requestDiv<?php echo $data->id; ?>">
						<td><?php echo $data->id; ?></td>
						<td><?php echo $data->name; ?></td>	
						<td><?php echo $data->business_name; ?></td>
						<td><?php echo $data->address; ?></td>											
						<td><?php echo $data->email; ?></td>											
						<td><?php echo $data->seller_name; ?>[<?php echo $data->seller_code; ?>]</td>						
						<td><?php echo $data->seller_email; ?></td>						
						<td><?php echo $request_status; ?></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>		
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
	function approveRequest(id) {
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/buyer_request/approveRequest",			
			data: {
				id : id
			}
		})
		.done (function(data) {
			jQuery('#requestDiv'+data).hide(); 
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}


	function rejectRequest(id) {
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/buyer_request/rejectRequest",
			data: {
				id : id
			}
		})
		.done (function(data) { 
		console.log(data);
			jQuery('#requestDiv'+data).hide(); 
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}
</script>




    
