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
		jQuery('#sub-category').load('/admin/category/subCatDropdown/'+cat_id+'/list_page');
		/*if(cat_id=='44'){
		jQuery('#hide_photo_category').hide();
		jQuery('#excerpt').html('default');
		}
		else jQuery('#hide_photo_category').show();*/
		});
		
		
	});
	function getSubcategory(sub_category_id){
		cat_id = jQuery('#category_id').val();
		jQuery('#sub-category').load('/admin/category/subCatDropdown/'+cat_id+'/list_page/'+sub_category_id);
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
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Model Number:</td>
						<td style="width:18%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<input type="text" name="model_no" id="model_no" value="<?php echo $search['model_no']; ?>">
						</td>
						
						<td colspan="2" style="width:15%; vertical-align:middle; border-top: 1px solid #ddd;">
							<input type="submit" name="btnSearch" id="btnSearch" class="search_submit" value="Search" style="padding:15px 10px;">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<br>
		<?php //search ends ?>
	
	
	
		<input type="hidden" name="controller" id="controller" value="product_report" />
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
				<col class="con0" />
				<col class="con1" />
			</colgroup>
			<thead>
				<tr>
					<th class="head1" style='width: 10%;'>Name</th>
					<th class="head1" style='width: 10%;'>Image</th>
					<th class="head1" style='width: 10%;'>Model No.</th>
					<th class="head0" style='width: 10%;'>Unit Value/Unit/MRP</th>
					<th class="head0" style='width: 7%;'>Size</th>
					<th class="head0" style='width: 7%;'>Discount</th>
					<th class="head0" style='width: 15%;'>Category->Sub Category</th>
					<th class="head0" style='width: 7%;'>Section</th>
					<th class="head0" style='width: 7%;'>Brand</th>				
					<th class="head1" style='width: 7%;'>Added Date</th>
					<th class="head0" style='width: 7%;'>ModifiedDate</th>			
				</tr>
			</thead>
			<b><?php session_start();
			if($this->session->userdata('update_product_msg')!="")
			echo $this->session->userdata('update_product_msg');  
			$data1['update_product_msg'] = "";
		    $this->session->set_userdata($data1);
			?></b>
			
			<tbody>
				<?php 
				/*echo "<pre>";
				print_r($records);
				echo "</pre>"; */	
				
				$sl = 1;
				$image_path = "http://shopzoni.com/brand/public/uploads/product/".$records->image[0]->image;
				if($records->id!=""){
				?>
					<tr class='gradeA'>
						<!--<td><?php echo $records->id; ?></td>-->					
						<td><?php echo $records->name; ?></td>						
						<td><img src="<?php echo $image_path; ?>" height="80" width="80" /></td>
						<td><?php echo $records->model_no; ?></td>	
						<td><?php echo $records->weight; ?>/<?php echo $records->unit; ?>/<?php echo $records->mrp; ?></td>	
						<td><?php echo $records->size; ?></td>
						<td><?php echo $records->discount; ?></td>
						<td><?php echo getCatSubcatTitle($records->category_id); ?></td>	
						<td><?php echo $records->sectin_name; ?></td>
						<td><?php echo $records->brand_name; ?></td>						
						<td><?php echo GetDateFormat($records->date_created); ?></td>						
						<td><?php if($records->date_modified >0){ echo GetDateFormat($records->date_modified); }?></td>						
					</tr>
				<?php } ?>
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



    
