<?php 
include("includes/top.php");
$catID = $_REQUEST['catID'];


$sub_category 	= $obj_db->getTableAllData(TBL_CATEGORY,$whereClause="status = 1 and parent_id=".$catID."");

if(count($sub_category) && is_array($sub_category)){

 $str = '<select name="sub_category_id" id="sub_category_id">
			<option value="">Select Sub Category</option>';			
				foreach($sub_category as $cat){					
					$str .='<option value="';
					$str .=$cat["id"]; 
					$str .='">';
					$str .=$cat['name']; 
					$str .='</option>';
				}
		$str .='</select>';
echo $str;
}

?>
