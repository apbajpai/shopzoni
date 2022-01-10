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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Select Seller:</td>
						<td style="width:22%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<select name="seller_id" id="seller_id" style="width:70%;">
								<option value="">Choose One</option>
							<?php
							foreach($sellers as $seller){							
								$selected = ($search['seller_id'] == $seller->id)?'selected="selected"':'';
								?>
								<option value="<?php echo $seller->id; ?>" <?php echo $selected ?>><?php echo $seller->business_name; ?></option>
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
	
	
	
		<input type="hidden" name="controller" id="controller" value="product" />
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
					<th class="head1" style='width: 10%;'>Seller</th>
					<th class="head1" style='width: 70%;'>Terms & Conditions</th>
					<th class="head1" style='width: 10%;'>Added Date</th>					
				</tr>
			</thead>
			
			
			<tbody>
				<?php 
				/*echo "<pre>";
				print_r($records);
				echo "</pre>";  */
				$uri4 = $this->uri->segment(4);
				$i=0;foreach($records as $data){$i++;
				
				if($uri4)
					$sl=(($uri4-1)*$per_page)+$i;
				else
					$sl=$i;
				?>
					<tr class='gradeA'>
						<!--<td><?php echo $data->id; ?></td>-->
						<td><?php echo $sl; ?></td>
						<td><?php echo $data->business_name; ?></td>
						<td style="padding-left: 0.5cm; "><?php echo $data->description; ?></td>
						<td><?php 
						if($data->date_created>0){					
							echo date("M d, Y h:i:s A", strtotime($data->date_created));
						}else if($data->date_modified >0){
							echo date("M d, Y h:i:s A", strtotime($data->date_modified));
						}

						?></td>						
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

	function sell(id){
		//alert(id);
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/brand_product/sell_yours",
			data: {				
				product_id : id,				
			}
		})
		.done (function(data) { 
			//alert(data);
			//$('#cartDiv').html(data); 
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}
	
	
</script>



    
