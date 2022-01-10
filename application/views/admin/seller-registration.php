<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/tables.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>
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
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Seller Name:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="seller_name" id="seller_name" value="<?php echo $search['seller_name']; ?>">
						</td>
						<td style="width:14%;  vertical-align:top; border-top: 1px solid #ddd;">Email:</td>
						<td style="width:22%;  vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="email_id" id="email_id" value="<?php echo $search['email_id']; ?>">
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
	
	
	
		<input type="hidden" name="controller" id="controller" value="seller_registration" />
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
				<col class="con1" />
			</colgroup>
			<thead>
				<tr>
					<th class="head0" style='width: 5%;'>ID</th>
					<th class="head1" style='width: 35%;'>Seller Name</th>
					<th class="head0" style='width: 10%;'>Email</th>
					<th class="head1" style='width: 7%;'>Status</th>
					<th class="head0" style='width: 10%;'>Added Date</th>
					<th class="head1" style='width: 10%;'>ModifiedDate</th>
					<th class="head0" style='width: 20%;'>Actions</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=0;foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<td><?php echo $data->id; ?></td>
						<td><?php echo $data->display_name; ?></td>
						<td><?php echo $data->email_id; ?></td>
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>
						<td><?php echo GetDateFormat($data->date_modified); ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/seller_registration/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a> <br>
							<a href="javascript:;" data-id="<?php echo $data->id; ?>" class="deletelink"><strong>Delete</strong></a><br>
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



    
