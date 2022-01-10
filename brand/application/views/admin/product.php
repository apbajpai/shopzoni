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
						<!--<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Select Brand:</td>
						<td style="width:22%; vertical-align:top; border-top: 1px solid #ddd;">
							&nbsp;
							<select name="brand_id" id="brand_id" style="width:70%;">
								<option value="">Choose One</option>
							<?php
							foreach($brand as $cat){							
								$selected = ($search['brand_id'] == $cat->id)?'selected="selected"':'';
								?>
								<option value="<?php echo $cat->id; ?>" <?php echo $selected ?>><?php echo $cat->name; ?></option>
							<?php
							}
							?>
							</select>
						</td>-->
						
						<td style="width:14%; vertical-align:top; border-top: 1px solid #ddd;">Product Name:</td>
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
					<th class="head1" style='width: 20%;'>Name</th>
					<th class="head1" style='width: 12%;'>Image</th>
					<th class="head1" style='width: 15%;'>Category => Sub Category</th>
					<th class="head0" style='width: 11%;'>Brand</th>
					<th class="head0" style='width: 7%;'>Status</th>
					<!--<th class="head0" style='width: 7%;'>Price</th>-->
					<th class="head1" style='width: 10%;'>Added Date</th>
					<th class="head0" style='width: 10%;'>ModifiedDate</th>
					<th class="head1" style='width: 15%;'>Actions</th>
				</tr>
			</thead>
			
			<form action="<?php echo base_url(); ?>admin/product/update_price" method="POST" id="price" name="price">
			<tbody>
				<?php 
				/*echo "<pre>";
				print_r($records);
				echo "</pre>";  */
				
				$uri4 = $this->uri->segment(4); 
				if($uri4 >= 2){
					$i=100*($uri4-1);
				}else{
					$i=0; 
				}
				foreach($records as $data){$i++;
				
				$image_path = base_url()."public/uploads/product/".$data->image[0]->image;
				?>
					<tr class='gradeA'>
						<!--<td><?php echo $data->id; ?></td>-->
						<td><?php echo $i; ?></td>
						<td><?php echo $data->name; ?></td>
						<td><img src="<?php echo $image_path;?>" height="80" width="80" /></td>
						<td><?php echo $data->category_name; ?> => <?php echo $data->sub_category_name; ?></td>
						<td><?php echo $data->brand_name; ?></td>
						<td><input type="checkbox" data-id="<?php echo $data->id; ?>" class="status" name="status" id="status_<?php echo $i; ?>" value="1" <?php echo ($data->status == 1)?'checked':''; ?>></td>
						<td><?php echo GetDateFormat($data->date_created); ?></td>						
						<td><?php if($data->date_modified >0){ echo GetDateFormat($data->date_modified); }?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/product/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a> <br>
							<a href="#" onclick="popup('<?php echo base_url() ?>admin/product_image/addedit/<?php echo $data->id; ?>');"><strong>Add Image</strong></a> <br>
							<a href="#" onclick="popup('<?php echo base_url() ?>admin/product_packet/addedit/<?php echo $data->id; ?>');"><strong>Add Packet</strong></a> <br>
							<!--<a href="javascript:;" data-id="<?php echo $data->id; ?>" class="deletelink"><strong>Delete</strong></a><br>-->
						</td>
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
function popup(url){
	    window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1000,height=600");
}
</script>


    
