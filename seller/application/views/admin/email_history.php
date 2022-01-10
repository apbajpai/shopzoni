

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
		<form action="" method="POST" id="searchfm" name="searchfm">
			<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb">
				<tbody>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">To:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="to" id="to" value="<?php echo $search['to']; ?>">
						</td>
						<!--<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">From:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="from" id="from" value="<?php echo $search['from']; ?>">
						</td>--->
						<td rowspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
					</tr>
					
				</tbody>
			</table>
		</form>
		<br>
		<?php //search ends ?>
	
	
		<input type="hidden" name="controller" id="controller" value="address_book" />
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
					<th class="head0">Date</th>
					<th class="head1">To</th>
					<th class="head1">view Message</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0;foreach($records as $data){$i++; //echo "<pre>"; print_r($data); echo "</pre>"; ?>
					<tr class='gradeA'>
						<td><?php echo $i; ?></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>
						<td><?php echo $data->to; ?></td>
						<td><a href="<?php echo base_url() ?>admin/email_history/view_message/<?php echo $data->id; ?>"><strong>View Message</strong></a> <br></td>
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



    
