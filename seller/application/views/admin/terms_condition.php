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
					<th class="head1" style='width: 70%;'>Terms & Conditions</th>
					<th class="head1" style='width: 10%;'>Modified Date</th>
					<th class="head0" style='width: 20%;'>Actions</th>
				</tr>
			</thead>
			
			
			<tbody>
				<?php 
				/*echo "<pre>";
				print_r($records);
				echo "</pre>";  */
				
				$i=0;foreach($records as $data){$i++;
				?>
					<tr class='gradeA'>
						<td><?php echo $i; ?></td>
						<td style="padding-left: 0.5cm; "><?php echo $data->description; ?></td>
						<td><?php if($data->date_modified=="0000-00-00 00:00:00"){ echo "";  }else{ echo date("M d, Y h:i:s A", strtotime($data->date_modified)); }?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/terms_conditions/addedit/<?php echo $data->id; ?>"><strong>Edit</strong></a> <br>
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



    
