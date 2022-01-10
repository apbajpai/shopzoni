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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">User Name:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="name" id="name" value="<?php echo $search['name']; ?>">
						</td>						
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Select Brand:</td>
						<td style="width:22%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<select name="brand_id" id="brand_id" style="width:70%;">
								<option value="">Choose One</option>
							<?php
							foreach($brand_records as $brand){							
								$selected = ($search['brand_id'] == $brand->id)?'selected="selected"':'';
								?>
								<option value="<?php echo $brand->id; ?>" <?php echo $selected ?>><?php echo $brand->name; ?></option>
							<?php
							}
							?>
							</select>
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
		
		
		<input type="hidden" name="controller" id="controller" value="user" />
		<table cellpadding="0" cellspacing="0" border="0" class="stdtable">
			
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
					<th class="head1">Name</th>
					<th class="head1">Brand Name</th>
					<th class="head0">Email</th>
					<!--<th class="head1">Role</th>-->
					<th class="head0">Status</th>
					<th class="head1">Added Date</th>
					<th class="head0">Actions</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0;foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<td><?php echo $data->id;; ?></td>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->brand_name; ?></td>
						<td><?php echo $data->email; ?></td>
						<!--<td><?php //echo GetTitleById('tbl_role', $data->role); ?></td>-->
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><?php echo GetDateFormat($data->indate); ?></td>
						<td>
							<a href="<?php echo base_url();?>admin/user/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a>
						 | <a href="javascript:;" data-id="<?php echo $data->id; ?>" class="deletelink"><strong>Delete</strong></a>
						</td>
					</tr>
				<?php }?>	
				
			</tbody>
		</table>
		<div class="pagination" style="float:right">
			<?php echo $pagination_links; ?>
		</div>
	</div><!-- #updates -->
</div><!--contentwrapper-->
<br clear="all" />
</div><!-- centercontent -->



    
