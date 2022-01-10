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
		<input type="hidden" name="controller" id="controller" value="category" />
		<table cellpadding="0" cellspacing="0" border="0" class="stdtable">
			<colgroup>
				<col class="con0" />
				<col class="con1" />
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
					<th class="head0">SL.NO.</th>
					<th class="head1">Name</th>
					<?php if($type != 'main'){?>
					<th class="head1">Parent</th>
					<?php }?>
					<th class="head0">Priority</th>
					<th class="head1">Status</th>
					<th class="head0">Show on Home Page</th>
					<th class="head1">Added Date</th>
					<th class="head0">Modified Date</th>
					<th class="head1">Actions</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0;foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<td><?php echo $i; ?></td>
						<td><?php echo $data->name; ?></td>
						<?php if($type != 'main'){?>
						<td><?php echo $data->parent_name; ?></td>
						<?php }?>
						<td><?php echo $data->priority; ?></td>
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="show_home" name="show_home" id="show_home_<?php echo $i; ?>" value="1" <?php echo ($data->show_home == 1)?'checked':''; ?>></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>
						<td><?php echo GetDateFormat($data->date_modified); ?></td>
						<td>
						<?php if($type == 'main'){?>
							<a href="<?php echo base_url();?>admin/category/addeditmain/<?php echo $data->id; ?>"><strong>Edit</strong></a>
						<?php }else{?>
							<a href="<?php echo base_url();?>admin/category/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a>
						<?php }?>
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



    
