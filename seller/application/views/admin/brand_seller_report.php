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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Select Brand:</td>
						<td colspan="4" style="width:22%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<select name="brand_id" id="brand_id" style="width:70%;">
								<option value="">Choose One</option>
							<?php
							foreach($brand_record as $brand){							
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
	
	
	
		<input type="hidden" name="controller" id="controller" value="brand_seller_report" />
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
					<th class="head1" style='width: 20%;'>Business Name</th>
					<th class="head1" style='width: 20%;'>Name</th>
					<th class="head1" style='width: 20%;'>Address</th>
					<th class="head0" style='width: 11%;'>Contact No</th>
					<th class="head0" style='width: 7%;'>Email</th>
					<th class="head0" style='width: 7%;'>Type</th>
					<th class="head1" style='width: 10%;'>Brand</th>					
				</tr>
			</thead>
			
			<form action="<?php echo base_url(); ?>admin/product/update_price" method="POST" id="price" name="price">
			<tbody>
				<?php 
				$i=0;foreach($records as $data){$i++;  
				if($data->type==0) 
					$type = "B2B";
				else if($data->type==1)
					$type = "B2C";
				?>
					<tr class='gradeA'>
						<!--<td><?php echo $data->id; ?></td>-->
						<td><?php echo $i; ?></td>
						<td><?php echo $data->business_name; ?></td>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->business_address; ?></td>
						<td><?php echo $data->mobile_number; ?></td>
						<td><?php echo $data->email_id; ?></td>
						<td><?php echo $type; ?></td>
						<td><?php echo $data->brand_name; ?></td>						
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



    
