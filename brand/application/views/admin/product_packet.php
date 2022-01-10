<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/tables.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/forms.js"></script>



<div class="centercontent tables">
	<div class="pageheader notab">
		<h1 class="pagetitle"><?php echo $records[0]->product_name; ?> - <?php echo $heading; ?></h1>	
		<span class="pagedesc"><?php if( $this->session->flashdata('message')) {?>
		<?php echo $this->session->flashdata('message'); ?><?php } ?></span>		
	</div><!--pageheader-->	
	
	<div id="contentwrapper" class="contentwrapper">
	<?php //Search start ?>
		<!--<form action="" method="POST" id="searchfm" name="searchfm">
			<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb">
				<tbody>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Caption:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="caption" id="caption" value="<?php echo $search['caption']; ?>">
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
	
	
	
		<input type="hidden" name="controller" id="controller" value="product_packet" />
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
					<th class="head0" style='width: 5%;'>SL</th>
					<th class="head1" style='width: 20%;'>Weight</th>
					<th class="head1" style='width: 20%;'>Unit</th>
					<th class="head1" style='width: 20%;'>MRP</th>					
					<th class="head0" style='width: 7%;'>Status</th>
					<th class="head1" style='width: 10%;'>Added Date</th>
					<th class="head0" style='width: 10%;'>ModifiedDate</th>
					<th class="head1" style='width: 20%;'>Actions</th>
				</tr>
			</thead>
			
			
			<tbody>
				<?php $i=0;foreach($records as $data){ $i++;			
				$image_path = base_url()."public/uploads/product/".$data->image;
				?>
					<tr class='gradeA'>
						<!--<td><?php echo $data->id; ?></td>-->
						<td><?php echo $i; ?></td>
						<td><?php echo $data->weight; ?></td>
						<td><?php echo $data->unit; ?></td>
						<td><?php echo $data->mrp; ?></td>						
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>						
						<td><?php if($data->date_modified >0){ echo GetDateFormat($data->date_modified); }?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/product_packet/addedit/<?php echo $this->session->userdata('product_id'); ?>/<?php echo $data->id; ?>"><strong>Edit</strong></a> <br>							
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



    
