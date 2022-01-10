<?php
include("includes/top.php");
//error_reporting(0);
if(isset($_POST["button"]) and $_POST["button"]=="Submit") 
{
	$target_dir = "excel/";
	$target_file = $target_dir . basename($_FILES["excel"]["name"]); 
	
	$file_name = basename($_FILES["excel"]["name"]);
	//$res = $obj_db->checkExist(TBL_EXCEL,'name',$file_name); 
	$res = 0;	
	if($res==0){
	
	if (move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file)) {
		ini_set("display_errors",1);
		require_once 'excel/excel_reader2.php';
		$xls = new Spreadsheet_Excel_Reader($target_file);
		
		
		
		$i=0;
		for ($row=2; $row<=$xls->rowcount(); $row++) {
			$j=0;
			for ($col=1; $col<=$xls->colcount(); $col++) {
				$data[$i][$j]= $xls->val($row,$col); 
				$j++;
			}
			$i++;
		}
		//echo "<pre>"; print_r($data); echo "</pre>"; exit;
		
		$dataArr1 = array('name'         				=>$file_name,
						'seller_id'         			=>$seller_id,
						'date_created'         			=>$date_created,
						'status'         				=>0);
	
		$obj_db->insert_data(TBL_EXCEL,$dataArr1);
		$excel_inserted_id = $obj_db->insertID();
		
		$result_del = $obj_db->delete_data(TBL_PRODUCT,'seller_id='.$seller_id); 
		
		
		$cnt=0; $str=''; $msg1=''; $msg2='';
		foreach($data as $key=>$row){
			$cnt++;
			if($row[0]!='' && $seller_id!=''){			
				
				$product_name			= 	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[0]));
				$manufacturer			=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[1]));
				$color					=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[2]));
				$description			=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[3]));
				$unit					=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[4]));
				$weight					=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[5]));
				$size					=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[6]));	
				$quantity				=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[7]));
				$minimum_quantity_alert	=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[8]));	
				$tax_category			=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[9]));
				$price					=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[10]));
				$mrp					=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[11]));
				$discount				=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[12]));
				$offer_code				=	trim(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[13]));
				
				
				$seller_id  		= $_REQUEST['seller_id'];
				$category_id		= $_REQUEST['category_id'];
				$sub_category_id	= $_REQUEST['sub_category_id'];
				$section_id			= $_REQUEST['section_id'];
				$brand_id			= $_REQUEST['brand_id'];
				$date_created 			= date("Y-m-d");
				
				if($sub_category_id!='')
					$category_id = $sub_category_id;
				
				$dataArr = array('seller_id'         		=>$seller_id,
								'product_name'         		=>$product_name,
								'code'       				=>$code,
								'image'         			=>$image,
								'category_id'         		=>$category_id,
								'section_id'         		=>$section_id,
								'brand_id'        			=>$brand_id,
								'manufacturer'    			=>$manufacturer,
								'color'       				=>$color,
								'description'       		=>$description,
								'unit'        	 			=>$unit,
								'weight'        	 		=>$weight,
								'size'        	 			=>$size,
								'quantity'        	 		=>$quantity,
								'minimum_quantity_alert'   	=>$minimum_quantity_alert,
								'tax_category'        	 	=>$tax_category,
								'price'        	 			=>$price,
								'mrp'        	 			=>$mrp,
								'discount'        	 		=>$discount,
								'offer_code'        	 	=>$offer_code,
								'date_created'        	 	=>$date_created,
								'date_modified'        	 	=>$date_modified,
								'created_by'        	 	=>$created_by,
								'status'         			=>1);										
										
				$obj_db->insert_data(TBL_PRODUCT,$dataArr); 
						
			}else{
				if($cnt==1)
					$str.=$cnt;
				else
					$str.=','.$cnt;
			}
		}
			//echo $msg2;
			if($str!=''){
				//$msg2.="Row  - ".$str."   Due to Blank Seller Id or Product name error, not uploaded out of (".$cnt." Row)";
				$msg1= "The file ". basename( $_FILES["excel"]["name"]). " has been uploaded sucessfully...";
			}else{
				$msg1= "The file ". basename( $_FILES["excel"]["name"]). " has been uploaded sucessfully...";
			}						
		
		//$msg1= "The file ". basename( $_FILES["excel"]["name"]). " has been uploaded.";		
		} else {
				$msg2= "Sorry, File Allready uploaded.";
		}
		
		}else{
				$msg2= "Sorry, File Allready uploaded.";
		}
}


$seller 	= $obj_db->getTableAllData(TBL_SELLER,$whereClause="status = 1");
$category 	= $obj_db->getTableAllData(TBL_CATEGORY,$whereClause="status = 1");
$sections 	= $obj_db->getTableAllData(TBL_SECTION,$whereClause="status = 1");
$brands 	= $obj_db->getTableAllData(TBL_BRAND,$whereClause="status = 1");


//print_r($seller);

?>

 <script src="js/ajax.js"></script>
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <? //include("includes/topmenu.php") ?>
  <tr>
    <td valign="top" bgcolor="#e6e6e6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
       <? //include("includes/left.php") ?> 
        <td height="520"  align="left" valign="top" style="padding:0 10px 0 10px; "><table style="border:#666 solid 1px;" width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td bgcolor="#666" class="head_inner" style=" padding:3px 0 3px 7px"><?=$breadcrumb?></td>
          </tr>
          
        <tr>
          
           <form action="" method="post" name="add_purchase" id="add_purchase" enctype="multipart/form-data" onsubmit="return validate();">
         
            <td style="padding:5px 7px 5px 7px;" bgcolor="#f8f9f7" >
            <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse">
            <?php if($msg1!=''){ ?>
              <tr class="row1">               
                <td colspan="3" align="left" style="color:#00CC00" width="100%"><strong><?php echo $msg1; ?></strong></td>                
              </tr>
              <?php }else if($msg2!=''){ ?>              
              <tr class="row1">               
                <td colspan="3" align="left" style="color:#FF3300" width="100%"><strong><?php echo $msg2; ?></strong></td>                
              </tr> 
              <?php } ?>              
              
			  
			  <tr class="row1">
                <td><span class="form_name">Download Excel</span></td>
                <td align="center">&nbsp;</td>
                <td>
					<a href="excel/product.xls">Click Here To Download Excel</a>
				</td>
              </tr>
			  
			  
			  
			  <tr class="row1">
                <td><span class="form_name">Seller</span></td>
                <td align="center">&nbsp;</td>
                <td>
					<select name="seller_id" id="seller_id" onchange="">
						<option value="">Select Seller</option>
						<?php							
							foreach($seller as $sel){
								if($seller_id==$sel['id'])$selected='selected="selected"';
								else $selected='';
						?>
								<option value="<?php echo $sel['id']; ?>" <?php echo $selected ?>><?php echo $sel['name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
              </tr>
              
			  
			  <tr class="row2">
                <td><span class="form_name">Section</span></td>
                <td align="center">&nbsp;</td>
                <td>
					<select name="section_id" id="section_id">
						<option value="">Select Section</option>
						<?php
							foreach($sections as $val){
								if($section_id==$val['id'])$selected='selected="selected"';
								else $selected='';
						?>
								<option value="<?php echo $val['id']; ?>" <?php echo $selected ?>><?php echo $val['name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
              </tr>
			  
			  
              <tr class="row2">
                <td><span class="form_name">Category</span></td>
                <td align="center">&nbsp;</td>
                <td>
					<select name="category_id" id="category_id" onchange="subCategory(this.value)">
						<option value="">Select Category</option>
						<?php
							foreach($category as $cat){
								if($parent_id == $cat['id'])$selected='selected="selected"';
								else if($category_id==$cat['id'])$selected='selected="selected"';
								else $selected='';
						?>
								<option value="<?php echo $cat['id']; ?>" <?php echo $selected ?>><?php echo $cat['name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
              </tr>
			  
			  <tr class="row1">
                <td><span class="form_name">Brand</span></td>
                <td align="center">&nbsp;</td>
                <td>
					<select name="brand_id" id="brand_id">
						<option value="">Select Brand</option>
						<?php
							foreach($brands as $val){
								if($brand_id==$val['id'])$selected='selected="selected"';
								else $selected='';
						?>
								<option value="<?php echo $val['id']; ?>" <?php echo $selected ?>><?php echo $val['name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
              </tr>
			  
			  <tr class="row1">				
                <td><span class="form_name">Sub Category</span></td>
                <td align="center">&nbsp;</td>
                <td>
					<div id="subcategory">
				</td>
              </tr>
			  
              
              <tr class="row1">
                <td><span class="form_name">Upload Excel</span></td>
                <td align="center">&nbsp;</td>
                <td><input name="excel" type="file" id="excel" /></td>
              </tr>
              

             <tr class="row2">
                <td valign="middle">&nbsp;</td>
                <td align="center" valign="middle">&nbsp;</td>
                <td valign="middle">
                <input name="button" id="button" type="submit" value="Submit" class="add_button"  />
                <input name="button" id="button" type="button" value="Back" class="add_button" onclick="window.location='<?=$redirectURL;?>';"/>
                <input name="button" id="button" type="reset" value="Reset" class="add_button"  />
                <?PHP if($eid!='' && $eid>0){ ?>
                <input type="hidden" name="action1" id="action" value="edit"/>
                <input type="hidden" name="eid" id="eid" value="<?=$eid?>" /></td>
                <?php }else{ ?>                
                <input type="hidden" name="action1" id="action" value="add"/>
                <?php } ?>
                <input type="hidden" name="submitform" id="submitform" value="yes"/>
                   
                </tr>
              
              </table>
            </form>
        </tr>
			
			
        </table></td>
      </tr>
    </table></td>
  </tr>
  <? //include("includes/footer.php") ?>
</table>

