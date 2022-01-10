<?php header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=order.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); ?>


		<table cellpadding="0" cellspacing="0" border="1" class="stdtable">
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
					<th class="head0" style='width: 5%;'>Date</th>
					<th class="head1" style='width: 15%;'>Order ID</th>
					<th class="head1" style='width: 15%;'>Seller</th>
					<th class="head1" style='width: 10%;'>Email</th>
					<th class="head0" style='width: 10%;'>Phone</th>
					<th class="head0" style='width: 20%;'>Buyer</th>	
					<th class="head0" style='width: 10%;'>Email</th>	
					<th class="head0" style='width: 10%;'>Phone</th>					
					<th class="head0" style='width: 10%;'>Status</th>					
						
				</tr>
			</thead>
			
			
			<tbody>
				<?php 
				/*echo "<pre>";
				print_r($records);
				echo "</pre>";   */
				
				$i=0;foreach($records as $data){$i++;
						switch ($data->order_status) {
							case 1: 
								$order_status = "Added To Cart";
								break;
							case 3:
								$order_status = "Order Placed";
								break;
							case 4:
								$order_status = "Order Approved";
								break;
							case 5:
								$order_status = "Order Cancel";
								break;
						}				
				?>
					<tr class='gradeA'>					
						<td><?php if($data->date_created >0){ echo $data->date_created; }?></td>
						<td><?php echo $data->order_id; ?></td>
						<td><?php echo $data->business_name; ?></td>
						<td><?php echo $data->email_id; ?></td>
						<td><?php echo $data->mobile_number; ?></td>
						<td><?php echo $data->buyer_name; ?></td>
						<td><?php echo $data->buyer_email; ?></td>
						<td><?php echo $data->buyer_mobile;?></td>
						<td><?php echo $order_status;?></td>
						
					</tr>
				<?php }?>	
			</tbody>				
			
		</table>
		

    
