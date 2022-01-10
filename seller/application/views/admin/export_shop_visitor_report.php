<?php 
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=Shop Visitor Report.xls"); ?>

<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/tables.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/forms.js"></script>



<div class="centercontent tables">
	
	<div id="contentwrapper" class="contentwrapper">
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
					<th class="head1" style='width: 15%;'>Shop Code</th>
					<th class="head1" style='width: 15%;'>Shop Name</th>
					<th class="head1" style='width: 10%;'>Visitor Name</th>
					<th class="head0" style='width: 10%;'>Email</th>
					<th class="head0" style='width: 20%;'>phone</th>	
					<th class="head0" style='width: 10%;'>IP Address</th>	
					<th class="head0" style='width: 10%;'>Date</th>					
				</tr>
			</thead>
			
			<form action="<?php echo base_url(); ?>admin/product/update_price" method="POST" id="price" name="price">
			<tbody>
				<?php 
				/*echo "<pre>";
				print_r($records);
				echo "</pre>"; */ 
				
				$i=0;foreach($records as $data){$i++;?>
					<tr class='gradeA'>
						<!--<td><?php echo $data->id; ?></td>-->
						<td><?php echo $i; ?></td>
						<td><?php echo $data->shop_code; ?></td>
						<td><?php echo $data->business_name; ?></td>
						<td><?php echo $data->buyer_name; ?></td>
						<td><?php echo $data->buyer_email; ?></td>
						<td><?php echo $data->buyer_mobile; ?></td>
						<td><?php echo $data->ip_address; ?></td>
						<td><?php if($data->date_time >0){ echo $data->date_time; }?></td>
					</tr>
				<?php }?>	
			</tbody>				
			</form>
		</table>
		
	</div><!-- #updates -->
</div><!--contentwrapper-->
<br clear="all" />
</div><!-- centercontent -->



    
