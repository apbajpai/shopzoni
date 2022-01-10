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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">To Time:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="totime" id="totime" value="<?php echo $search['totime']; ?>">
						</td>
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">From Time:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="fromtime" id="fromtime" value="<?php echo $search['fromtime']; ?>">
						</td>
						
						<td rowspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
					</tr>
					
				</tbody>
			</table>
		</form>-->
		<br>
		<?php //search ends ?>
	
	
		<input type="hidden" name="controller" id="controller" value="time_slot" />
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
					<th class="head0">SL</th>
					<th class="head1">Delivery Location</th>
					<th class="head1">From Time</th>
					<th class="head1">To Time</th>					
					<th class="head1">Order Ending Time</th>					
					<th class="head1">Maximum No. Of Order</th>					
					<th class="head0">Status</th>
					<th class="head1">Added Date</th>
					<th class="head0">Actions</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0;foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<td><?php echo $i; ?></td>
						<td><?php echo $data->delivery_location; ?></td>
						<td><?php echo $data->fromtime; ?></td>
						<td><?php echo $data->totime; ?></td>						
						<td><?php echo $data->order_ending_time; ?></td>						
						<td><?php echo $data->maximum_no_of_order; ?></td>						
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>
						<td>
							<a href="<?php echo base_url();?>admin/time_slot/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a>
						 | <a href="javascript:;" data-id="<?php echo $data->id; ?>" class="deletelink"><strong>Delete</strong></a>
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



    
