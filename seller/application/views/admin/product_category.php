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
						<?php if($this->uri->segment(3)=="main"){ ?>
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Category Name:</td>
						<?php }else{ ?>
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Sub Category Name:</td>
						<?php } ?>
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
		<br>
		<?php //search ends ?>
		
		<input type="hidden" name="controller" id="controller" value="product_category" />
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
					<?php $role = $this->session->userdata('arole'); 
					if($role==2){
					?>					
					<th class="head1">Sub Category Name</th>
					<?php }else{ ?>
					<th class="head1">Sub Category Name</th>
					<?php } ?>
					<?php if($type != 'main'){?>
					<th class="head0">Category</th>
					<?php }?>
					<th class="head0">Section</th>
					<th class="head1">Status</th>
					<th class="head0">Added Date</th>
					<th class="head1">Modified Date</th>
					<th class="head0">Actions</th>
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
						<td><?php echo $data->sectin_name; ?></td>
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><?php if($data->date_created) echo GetDateFormat($data->date_created); ?></td>
						<td><?php if($data->date_modified!="" && $data->date_modified!='0000-00-00 00:00:00') echo GetDateFormat($data->date_modified); ?></td>
						<td>
						<?php if($type == 'main'){?>
							<a href="<?php echo base_url();?>admin/product_category/addeditmain/<?php echo $data->id; ?>"><strong>Edit</strong></a>
						<?php }else{?>
							<a href="<?php echo base_url();?>admin/product_category/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a>
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



    
