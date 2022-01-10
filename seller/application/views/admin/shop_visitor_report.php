<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/tables.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/plugins/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE; ?>js/custom/forms.js"></script>


<script>
	jQuery(document).ready(function(){		
		//Examples of how to assign the Colorbox event to elements
		jQuery(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
		

		jQuery(".pagination ul li a").click(function() {
			frm = jQuery('#searchfm');
			frm.attr("action", jQuery(this).attr("href"));
			jQuery(this).attr("href", "javascript:void(0)");
			jQuery('#searchfm').submit();
		});
		
		jQuery('#category_id').change(function(){
		cat_id = jQuery(this).val();
		jQuery('#sub-category').load('/admin/product_category/subCatDropdown/'+cat_id+'/list_page');
		/*if(cat_id=='44'){
		jQuery('#hide_photo_category').hide();
		jQuery('#excerpt').html('default');
		}
		else jQuery('#hide_photo_category').show();*/
		});
		
		
	});
	function getSubcategory(sub_category_id){
		cat_id = jQuery('#category_id').val();
		jQuery('#sub-category').load('/admin/product_category/subCatDropdown/'+cat_id+'/list_page/'+sub_category_id);
		/*if(cat_id=='44'){
		jQuery('#hide_photo_category').hide();
		jQuery('#excerpt').html('default');
		}
		else jQuery('#hide_photo_category').show();*/
		}
	
</script>
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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Seller Code:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="seller_code" id="seller_code" value="<?php echo $search['seller_code']; ?>" placeholder="Seller Code">
						</td>
					</tr>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">From Date:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="from_date" id="from_date" value="<?php echo $search['from_date']; ?>" placeholder="YYYY-MM-DD">
						</td>
						
												
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">To Date:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="to_date" id="to_date" value="<?php echo $search['to_date']; ?>" placeholder="YYYY-MM-DD">
						</td>
						
						<td rowspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
					</tr>
					
				</tbody>
			</table>
		</form>
		
		<form action="<?php echo base_url(); ?>admin/report/export_shop_visitor" method="POST" id="searchfm" name="searchfm">
			<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb">
				<tbody>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Seller Code:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="seller_code" id="seller_code" value="<?php echo $search['seller_code']; ?>" placeholder="Seller Code">
						</td>
					</tr>
					<tr>						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">From Date:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="from_date" id="from_date" value="<?php echo $search['from_date']; ?>" placeholder="YYYY-MM-DD">
						</td>
						
												
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">To Date:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="to_date" id="to_date" value="<?php echo $search['to_date']; ?>" placeholder="YYYY-MM-DD">
						</td>
						
						<td rowspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Export To Excel" style="padding:15px 10px;">
						</td>
					</tr>
					
				</tbody>
			</table>
		</form>
		<br>
		<?php //search ends ?>
	
	
	
		<input type="hidden" name="controller" id="controller" value="report" />
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
		<div class="pagination" style="float:right; margin:20px 0px 20px 0px;">
			<ul>
				<?php echo $pagination_links; ?>
			</ul>
		</div>
	</div><!-- #updates -->
</div><!--contentwrapper-->
<br clear="all" />
</div><!-- centercontent -->



    
