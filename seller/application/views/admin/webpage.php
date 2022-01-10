<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/tables.js"></script>
<div class="centercontent tables">
	<div class="pageheader notab">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><?php if( $this->session->flashdata('message')) {?>
		<?php echo $this->session->flashdata('message'); ?><?php } ?></span>		
	</div><!--pageheader-->	
	<div id="contentwrapper" class="contentwrapper">
		<!--contenttitle<div class="contenttitle2">
			<h3><?php echo $heading; ?></h3>
		</div>-->
		<table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable">
			<colgroup>
				<col class="con0" />
				<col class="con1" />
				<col class="con0" />
				<col class="con1" />
				<col class="con0" />
				<col class="con1" />
				<col class="con0" />
			</colgroup>
			<thead>
				<tr>
					<th class="head0">ID</th>
					<th class="head1">Title</th>
					<th class="head1">Image</th>
					<th class="head1">Status</th>
					<th class="head1">AddeDate</th>
					<th class="head1">ModifiedDate</th>
					<th class="head1">Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th class="head0">ID</th>
					<th class="head1">Title</th>
					<th class="head1">Image</th>
					<th class="head1">Status</th>
					<th class="head1">AddeDate</th>
					<th class="head1">ModifiedDate</th>
					<th class="head1">Actions</th>
				</tr>
			</tfoot>
			<tbody>
				<?php $i=0;foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<td>
							<?php echo $i; ?>
						</td>
						<td>
							<?php echo $data->title; ?>
						</td>
						<td>
							<?php if($data->image){?><img src="/public/uploads/staticpage/<?php echo $data->image;?>" height="60" width="60" /><?php }?>
						</td>
						<td>
							<?php echo ($data->status)?'Active':'Inactive'; ?>
						</td>
						<td>
							<?php echo $data->added_date; ?>
						</td>
						<td>
							<?php echo $data->modified_date; ?>
						</td>
						<td>
							<a href="<?php echo base_url();?>admin/webpage/addedit/<?php echo $data->webpage_id; ?>"><strong>Edit</strong></a> | 
							<a onclick="return confirm('Are you sure you want to delete this record.');" href="/admin/webpage/deleteRecord/<?php echo $data->webpage_id; ?>"><strong>Delete</strong></a>
						</td>
					</tr>
				<?php }?>	
			</tbody>
		</table>
	</div><!-- #updates -->
</div><!--contentwrapper-->
<br clear="all" />
</div><!-- centercontent -->



    
