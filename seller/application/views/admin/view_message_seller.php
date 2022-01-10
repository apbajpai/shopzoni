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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Name:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="name" id="name" value="<?php echo $search['name']; ?>">
						</td>
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Email:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="email" id="email" value="<?php echo $search['email']; ?>">
						</td>
						
						<td rowspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
					</tr>
					
				</tbody>
			</table>
		</form>
		<br>
		<?php //search ends ?>
	
	
		<input type="hidden" name="controller" id="controller" value="contact_us" />
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
					<th class="head1">Name</th>
					<th class="head0">Email</th>
					<th class="head1">Phone</th>
					<th class="head0">Message</th>
					<th class="head1">Date</th>					
					
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0; foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<td><?php echo $data->id; ?></td>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->email; ?></td>
						<td><?php echo $data->mobile; ?></td>
						<td><div id="message_div<?php echo $data->id; ?>"><?php echo substr($data->message,0,80); if(strlen($data->message)>80){ echo "...<br><a href='#' onclick='view_more(".$data->id.");'><b>Read More..</b></a>"; } ?></div> <div id="view_more_div<?php echo $data->id; ?>" style="display:none;"><?php echo $data->message; echo "...<br><a href='#' onclick='view_less(".$data->id.");'><b>Hide..</b></a>";?></div></td>
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
function view_more(id){	
	jQuery("#message_div"+id).hide();
	jQuery("#view_more_div"+id).show();
}

function view_less(id){	
	jQuery("#message_div"+id).show();
	jQuery("#view_more_div"+id).hide();
}
</script>


    
