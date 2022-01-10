<?
function check_member_login()
{
	if(!isset($_SESSION['uid']) && $_SESSION['uid']=="" && empty($_SESSION['uid']))
	{
	
		redirect(SITE_PATH.'index.php?msg=3');
	}
}

function redirect($page)
{
	if(!headers_sent())
		header("location:$page");
	else
		echo "<script>location.href='$page'</script>";
}

function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 


function refreshRedirect($page,$time)
{
	if(!headers_sent())
	{
		//header("refresh:$time;url=$page");
	}
	else
	{
		$time=($time*100000000);
		echo "<script>";	
		echo "setTimeout('Redirect()',".$time.");";
		echo "function Redirect()";
		echo "{";
		echo "location.href = '".$page."';";
		echo "}";
		echo "</script>";
	}
}

function input_string($str){
 return addslashes(nl2br(trim($str)));
}

function output_string($str){
 return stripslashes($str);
}

function createDropDownBox($sql,$name,$show_field,$value,$selected,$any="",$other_para="")
{  
	$result=mysql_query($sql);
	if((mysql_num_rows($result))<=0 && empty($any))
		return false;

	if(!is_array($selected))
		$selected_arr[0]=$selected;
	else
		$selected_arr=$selected;

	echo "<select name='$name' id='$name' $other_para>";
	if(!empty($any))
		echo "<option value='$any_value' ".(in_array($any_value,$selected_arr)?'selected':'').">$any</option>";

	while($row=mysql_fetch_array($result))
	{
		echo "<option value='".$row[$value]."'  ".(in_array($row[$value],$selected_arr)?'selected':'').">".$row[$show_field]."</option>";
	}
	if(!empty($any) && $any_pos==1)
		echo "<option value='$any_value' ".(in_array($any_value,$selected_arr)?'selected':'').">$any</option>";
	echo "</select>";		
	//return true;	
}

function createArrayDropDown($arr,$selected_value,$name,$other){
  $str = '<select name="'.$name.'" id="'.$name.'" '.$other.'>';
  $str .= '<option>Select</option>';
 foreach($arr as $key=>$val){
 if($key!=6){
  $str .= '<option';
  $str .= ' value="'.$key.'"';
  if($selected_value==$key) $str .= ' selected';
  $str .= '>'.$val;
  $str .= '</option>';
  }
 }
  $str .= '</select>';
 echo $str;
}

function upload_resize_thumb($uplodDir,$fieldName,$fileType,$imgWidth,$imgHeight,$thumbDir,$thumbWidth,$thumbHeight){
$upl = new UPLOADNEW;
	$filename=$upl->upload_file($uplodDir,$fieldName,true,true,0,$fileType);

		$source     = $uplodDir.$filename;
		$dest       = $uplodDir.$filename;
		$modWidth 	= $imgWidth;
		$modeHeight = $imgHeight;
		$fieldName  = $fieldName;
		if(!empty($filename)){
			$upl->resizeImage($dest,$source,$modWidth,$modeHeight,$fieldName);
		}
		
		if($thumbDir!='0'){
			$source     = $uplodDir.$filename;
			$dest       = $thumbDir.$filename;
			$modWidth 	= $thumbWidth;
			$modeHeight = $thumbHeight;
			$fieldName  = $fieldName;
			if(!empty($filename)){
				$upl->resizeImage($dest,$source,$modWidth,$modeHeight,$fieldName);
			}
		
		}
	return $filename;
}


function upload_resize_thumb1($uplodDir,$fieldName,$fileType,$imgWidth,$imgHeight,$thumbDir,$thumbWidth,$thumbHeight){
$upl = new UPLOADNEW;
	$filename=$upl->upload_file($uplodDir,$fieldName,true,true,0,$fileType);

		$source     = $uplodDir.$filename;
		$dest       = $uplodDir.$filename;
		$modWidth 	= $imgWidth;
		$modeHeight = $imgHeight;
		$fieldName  = $fieldName;
		/*if(!empty($filename)){
			$upl->resizeImage($dest,$source,$modWidth,$modeHeight,$fieldName);
		} */
		
		/*if($thumbDir!='0'){
			$source     = $uplodDir.$filename;
			$dest       = $thumbDir.$filename;
			$modWidth 	= $thumbWidth;
			$modeHeight = $thumbHeight;
			$fieldName  = $fieldName;
			if(!empty($filename)){
				$upl->resizeImage($dest,$source,$modWidth,$modeHeight,$fieldName);
			}
		
		} */
	return $filename;
}

function createImageDir($rootDir,$imageDir,$thumbDir){
    if(!file_exists($rootDir)){
	@mkdir($rootDir); 
	@chmod($rootDir,0777);
	}
	
	if(!file_exists($imageDir)){
	@mkdir($imageDir); 
	@chmod($imageDir,0777);
	}
	
	if(!file_exists($thumbDir)){
	@mkdir($thumbDir); 
	@chmod($thumbDir,0777);
	}
}

function createStatusBox($name,$sel='',$other)
{
	$tmpStr = '<select name="'.$name.'" '.$other.' id="'.$name.'">';
	$tmpStr .= '<option value="1"';
	if($sel==1){
	$tmpStr .= ' selected';
	}
	$tmpStr .= '>Active</option>';
	$tmpStr .= '<option value="0"';
	if($sel==0){
	$tmpStr .= ' selected';
	}
	$tmpStr .='>Inactive</option>';
    $tmpStr .= '</select>';
	echo $tmpStr;
}
function createStatus_Box($name,$sel='',$other)
{
	$tmpStr = '<select name="'.$name.'" '.$other.' id="'.$name.'">';
	$tmpStr .= '<option value="Normal"';
	if($sel=='Normal'){
	$tmpStr .= ' selected';
	}
	$tmpStr .= '>Normal</option>';
	$tmpStr .= '<option value="Admin"';
	if($sel=='Admin'){
	$tmpStr .= ' selected';
	}
	$tmpStr .='>Admin</option>';
	//$tmpStr .= '<option value="Active"';
    $tmpStr .= '</select>';
	echo $tmpStr;
}

function attendence_verification_Box($name,$sel='',$other)
{
	$tmpStr = '<select name="'.$name.'" '.$other.' id="'.$name.'">';
	$tmpStr .= '<option value="True"';
	if($sel=='True'){
	$tmpStr .= ' selected';
	}
	$tmpStr .= '>True</option>';
	$tmpStr .= '<option value="False"';
	if($sel=='False'){
	$tmpStr .= ' selected';
	}
	$tmpStr .='>False</option>';
	//$tmpStr .= '<option value="Active"';
    $tmpStr .= '</select>';
	echo $tmpStr;
}

function pay_period_Box($name,$sel='',$other)
{
	$tmpStr = '<select name="'.$name.'" '.$other.' id="'.$name.'">';
	$tmpStr .= '<option value="Monthly"';
	if($sel=='Monthly'){
	$tmpStr .= ' selected';
	}
	$tmpStr .= '>Monthly</option>';
	$tmpStr .= '<option value="Yearly"';
	if($sel=='Yearly'){
	$tmpStr .= ' selected';
	}
	$tmpStr .='>Yearly</option>';
	//$tmpStr .= '<option value="Active"';
    $tmpStr .= '</select>';
	echo $tmpStr;
}

function transaction_day_Box($name,$sel='',$other)
{
	$tmpStr = '<select name="'.$name.'" '.$other.' id="'.$name.'">';
	$tmpStr .= '<option value="Before"';
	if($sel=='Before'){
	$tmpStr .= ' selected';
	}
	$tmpStr .= '>Before</option>';
	$tmpStr .= '<option value="After"';
	if($sel=='After'){
	$tmpStr .= ' selected';
	}
	$tmpStr .='>After</option>';
	//$tmpStr .= '<option value="Active"';
    $tmpStr .= '</select>';
	echo $tmpStr;
}


function displayName($sql,$name)
{ //echo $sql;
	$result=mysql_query($sql);
	$ro=mysql_fetch_assoc($result);
	$tmpStr = $ro[$name];
	return output_string($tmpStr);
}

function currentDateTime(){
 $tmpStr = date("Y-m-d h:i:s");
 return $tmpStr;
}

function dateFormat($date){
if($date!=''){
 $tmpStr = date("m/d/Y h:i a" , strtotime($date));
 }
 return $tmpStr;
} 

function dateTimeFormat($str){
if($str!=''){
 $tmpStr = date("d/m/Y h:i a" , strtotime($str));
 }
 return $tmpStr;
} 

function dateFormat_weekDay($date){
	$tmpStr = date("l" , strtotime($date));
    return $tmpStr;
}
//################################################################################################################################
//## function for addsing stripslashes in the array                                                                             ##
//## Created on 21-12-2010                                                                                                      ##
//################################################################################################################################
function useraddslashes($user_array)
{
 $new_array_genrated=array();
 foreach($user_array as $key=>$value)
  {
  $new_array_genrated[$key]=addslashes(nl2br(trim($value)));
  }
  return $new_array_genrated;
}

function userstripslashes($user_array)
{
 $new_array_genrated=array();
 foreach($user_array as $key=>$value)
  {
  $new_array_genrated[$key]=stripslashes($value);
  }
  return $new_array_genrated;
}

function getallfolders($folder_type="",$parent_id)
{ 
  $sql="";
  $sql = "select f_id,f_parent_id,f_name from `".TBL_FOLDERS."` where 1";
  if($parent_id!="") $sql.= " and f_type='".$folder_type."' ";
   $sql.=" and f_parent_id='".$parent_id."' and f_status=1 order by f_name asc";
   //echo $sql;
   $result=mysql_query($sql) or die(mysql_error());	 
   if(mysql_num_rows($result)!=0){
   while($row=mysql_fetch_assoc($result))
   { 
    //echo "<br/>child id".$row["f_id"];
      if(!array_search($row["f_id"],$_SESSION['all_folder_list_check']))
	  { 
	  $_SESSION["all_folder_list_check"][]=$row["f_id"];
	  $_SESSION["all_folder_list"][]=$row["f_id"];
	  //if(!array_search($parent_id,$_SESSION['all_parent_folder_list']))
	 // {
	 //  echo "<br/>parent_id". $row["f_parent_id"];
	  $_SESSION["all_parent_folder_list"][]=$row["f_id"];
	  getallfolders($folder_type,$row["f_id"]);
	 // }  
	  }
	 }
   }
}
function getfolder_levels()
{
   $_SESSION["folder_levels"]=array();
   $_SESSION["all_folder_list"]=array();
   $_SESSION['all_folder_list_check']=array();
   $_SESSION['all_parent_folder_list']=array();
   $j=0;
   $k=0;
   $sql = 'select distinct(f_parent_id) from `'.TBL_FOLDERS.'` where 1';
   $sql.= ' and f_status=1 order by f_parent_id asc';
   $result=mysql_query($sql) or die(mysql_error());
   while($row=mysql_fetch_assoc($result))
   {
    $_SESSION['breadcrumb_func']=array();
    $breadcrumb_array=showlastfirstfolderfromlast($row["f_parent_id"]);
	$level_length=count($breadcrumb_array);
	//$level_length=$gen_level_length-1;
	$_SESSION["folder_levels"][$j]["id"]=$row["f_parent_id"];
	$_SESSION["folder_levels"][$j]["level"]=$level_length;
   /*
    $sq2 = 'select f_parent_id from `'.TBL_FOLDERS.'` where 1 and f_status=1 and f_id='.$row["f_parent_id"].' order by f_parent_id asc';
	$result2=mysql_query($sq2) or die(mysql_error());
    if($row2=mysql_fetch_assoc($result2))
	{
	$level_length=0;
	$succ_parent_id=$row2["f_parent_id"];
	 foreach($_SESSION["folder_levels"] as $folder_key=>$folder_value)
	  {
      //if($level_length==0)
	 // {
	  if($succ_parent_id==$_SESSION['folder_levels'][$folder_key]["id"])
	  $level_length=$_SESSION['folder_levels'][$folder_key]["level"];
	  $level_length=$level_length;
	//  }
	 /* else
	  {
	  $succ_parent_id="no";
	  $level_length=$k;
	  }
	  }
	}
	else
	{
	$succ_parent_id="no";
	$level_length=$k;
	}
	
    $_SESSION["folder_levels"][$j]["id"]=$row["f_parent_id"];
	$_SESSION["folder_levels"][$j]["level"]=$level_length;
	$j++;
	if($succ_parent_id=="no")
	$k++;
	*/
	$j++;
	}
}
function createtreefolderdropdown($array_of_folders)
{
$string_concat="<select name=\"parent_id\" class=\"list_form\" id=\"parent_id\"><option value=''>Select Folder</option>
<option value='Root' style=\"padding-left:0px\">->Root</option>";
foreach($array_of_folders as $new_key=>$new_value)
{
$sql = "select f_id,f_parent_id,f_name from `".TBL_FOLDERS."` where f_id='$new_value'";
   $result=mysql_query($sql) or die(mysql_error());
   	 
   if(mysql_num_rows($result)!=0){
   while($row=mysql_fetch_assoc($result))
   { 
   $row=userstripslashes($row);
   $level_length=0;
  foreach($_SESSION["folder_levels"] as $folder_key=>$folder_value)
	  {
      if($level_length==0)
	  {
	  if($row["f_parent_id"]==$_SESSION['folder_levels'][$folder_key]["id"])
	  $level_length=$_SESSION['folder_levels'][$folder_key]["level"];
	  }
	  }
	  $string_padding=$level_length*20;
	  
	 $string_concat.="<option value='".$row['f_id']."' style=\"padding-left:".$string_padding."px;\">  	->".$row["f_name"]."</option>";
   }
   }
   }
   $string_concat.="</select>";
   return $string_concat;
  }
function getallfoldersinmenu($folder_type="",$parent_id)
{ 
//print_r($_SESSION["all_folder_list2"]);
  $sql="";
  $sql = "select f_id,f_parent_id,f_name as top_fname from `".TBL_FOLDERS."` where 1";
  if($parent_id!="") $sql.= " and f_type='".$folder_type."' ";
   $sql.=" and f_parent_id='".$parent_id."' and f_status=1 order by f_name asc";
   $result=mysql_query($sql) or die(mysql_error());	 
   if(mysql_num_rows($result)!=0){
   while($row=mysql_fetch_assoc($result))
   { 
    //  if(!array_search($row["f_id"],$_SESSION['all_folder_list2']))
	  //{ 
	  $_SESSION["all_folder_list2"][]=$row["f_id"];
	  ?>
	 <ul> 
		<?		 
  $sql1="SELECT * FROM `".TBL_FOLDERS."` WHERE f_status=1 and f_parent_id=".$row['f_id']." and f_type='".$folder_type."' order by f_name asc";
					$result1=mysql_query($sql1) or die(mysql_error());
					$numrows=mysql_num_rows($result1);
					if($numrows>0)
					{		
					?>
                     <li class="closed"><span class="folder">
					 <a href="<?=SITE_FILE_NAME_DOCUMENTS.'?type='.$folder_type.'&f='.$row['f_id'];?>"  class="my_css_treeview">
					 <?=output_string($row["top_fname"]);?></a></span>
                <!--<ul>-->
					<?  while($row1=mysql_fetch_assoc($result1)){
				      //extract($row1);	 
            ?>
             <!-- <li><a href="<?=SITE_FILE_NAME_DOCUMENTS.'?type='.$folder_type.'&f='.$row1["f_id"];?>"  class="my_css_treeview"><?=output_string($row1["f_name"]);?></a></li>-->
                   <?
				    
				   }	
				   //echo '</ul>';
				   }
				   else{?>
<li><span class="folder"><a href="<?=SITE_FILE_NAME_DOCUMENTS.'?type='.$folder_type.'&f='.$row['f_id'];?>"  class="my_css_treeview"><?=output_string($row['top_fname']);?></a></span></li>
             <? }
			
	  //if(!array_search($row["f_parent_id"],$_SESSION['all_parent_folder_list2']))
	 // {
	  $_SESSION["all_parent_folder_list2"][]=$row["f_id"];
	  getallfoldersinmenu($folder_type,$row["f_id"]);
	   
	//  }?>  
	 
	  <? //}?> </ul><?
	 }
   }
}
function showlastfirstfolderfromlast($child_id,$class='class="link_paginate"')
{
 
   $result=mysql_query("select f_name,	f_parent_id ,f_type from `".TBL_FOLDERS."` where f_id='".$child_id."'");
   while($row=mysql_fetch_assoc($result))
   {
   //if(!(isset($breadcrumb)))
   // $breadcrumb="";
  $_SESSION['breadcrumb_func'][] = '&nbsp;&gt;&gt;&nbsp;<a href="documents.php?type='.output_string($row["f_type"]).'&f='.$child_id.'" '.$class.' >'.output_string($row["f_name"])."</a>";
  showlastfirstfolderfromlast($row["f_parent_id"],$class);
   }
   
   return $_SESSION['breadcrumb_func'];
}
function showlastfirstfolderfromlast_through_id($child_id)
{
 
   $result=mysql_query("select f_name,	f_parent_id ,f_type,f_id from `".TBL_FOLDERS."` where f_id='".$child_id."'");
   while($row=mysql_fetch_assoc($result))
   {
   //if(!(isset($breadcrumb)))
   // $breadcrumb="";
  $_SESSION['folder_path_id'][] = output_string($row["f_id"]);
  showlastfirstfolderfromlast_through_id($row["f_parent_id"]);
   }
   return $_SESSION['folder_path_id'];
}
function genrate_bread_crumb_string($breadcrumb_array)
{
$breadcrumb_array=array_reverse($breadcrumb_array);
$breadcrumb_new=implode("",$breadcrumb_array);
return $breadcrumb_new;
}
function genrate_folder_path_string($folder_path_array)
{
$folder_path_array=array_reverse($folder_path_array);
$folder_path=implode("/",$folder_path_array);
return $folder_path;
}
function department_Dropdown($selected='',$segrigation='Active',$others="class='list_form'",$notcome='')
{
?>
<select name="deptid" id="deptid" <?=$others?> >
                	<option value="">Select Department</option>
                     <? if($selected!="") { 
					
					if($row_sel=mysql_fetch_assoc(mysql_query("select dept_code,dept_name,dept_id from ".TBL_DEPARTMENT." where dept_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					?>
                    <option value="<?=$row_sel["dept_id"]?>" selected="selected" ><?=$row_sel["dept_name"];?>[<?=$row_sel["dept_code"];?>]</option>
                    <? } }?>
                   <? $dept_sql = "select dept_code,dept_name,dept_id from `".TBL_DEPARTMENT."` where 1 ";
					if($segrigation!="")
					$dept_sql.=" and dept_status='$segrigation'";
					if($notcome!="")
					$dept_sql.=" and dept_id!='$notcome'";
					
					$dept_sql.=" order by dept_name,dept_code asc ";
					
				 $dept_result=mysql_query($dept_sql) or die(mysql_error());
				 while($row_dept=mysql_fetch_assoc($dept_result))
				  {
				  $row_dept=userstripslashes($row_dept);
				  ?>
                    <option value="<?=$row_dept["dept_id"]?>" ><?=$row_dept["dept_name"];?>[<?=$row_dept["dept_code"];?>]</option>	
                    <? } ?>
                </select>
                <?
}




function Company_Dropdown($selected='',$segrigation='Active',$others="class='list_form'")
{
?>
 <select name="companyid" id="companyid" <?=$others?> >
                	<option value="">Select Company</option>	
                    <? if($selected!="") { 
					$row_sel=userstripslashes($row_sel);
					if($row_sel=mysql_fetch_assoc(mysql_query("select company_code,company_name,company_id from ".TBL_COMPANY_DETAILS." where company_id='".$selected."'")))
					{
					?>
                     <option value="<?=$row_sel["company_id"]?>" selected="selected" ><?=$row_sel["company_name"]."[".$row_sel["company_code"]."]";?></option>
                    <? } }?>
                    <? $cost_sql = "select company_code,company_name,company_id from `".TBL_COMPANY_DETAILS."` where 1 ";
					if($segrigation!="")
					$cost_sql.=" and company_status ='$segrigation'";
					$cost_sql.=" order by company_name,company_code asc ";
					
				 $cost_result=mysql_query($cost_sql) or die(mysql_error());
				 while($row_cost=mysql_fetch_assoc($cost_result))
				  {
				  $row_cost=userstripslashes($row_cost);
				  ?>
                    <option value="<?=$row_cost["company_id"]?>" ><?=$row_cost["company_name"];?>[<?=$row_cost["company_code"]?>]</option>	
                    <? } ?>
                </select>
                <?
}


function Job_Dropdown($selected='',$segrigation='Active',$others="class='list_form'")
{
?>
 <select name="jobid" id="jobid" <?=$others?> >
                	<option value="">Select Job</option>	
                    <? if($selected!="") { 
					$row_sel=userstripslashes($row_sel);
					if($row_sel=mysql_fetch_assoc(mysql_query("select job_code,job_name,job_id from ".TBL_JOB_HRM." where job_id='".$selected."'")))
					{
					?>
                     <option value="<?=$row_sel["job_id"]?>" selected="selected" ><?=$row_sel["job_name"]."[".$row_sel["job_code"]."]";?></option>
                    <? } }?>
                    <? $job_sql = "select job_code,job_name,job_id from `".TBL_JOB_HRM."` where 1 ";
					if($segrigation!="")
					$job_sql.=" and job_status='$segrigation'";
					$job_sql.=" order by job_name,job_code asc ";
					
				 $job_result=mysql_query($job_sql) or die(mysql_error());
				 while($row_job=mysql_fetch_assoc($job_result))
				  {
				  $row_job=userstripslashes($row_job);
				  ?>
                    <option value="<?=$row_job["job_id"]?>" ><?=$row_job["job_name"];?>[<?=$row_cost["pos_code"]?>]</option>	
                    <? } ?>
                </select>
                <?
}


function Pay_Period_Dropdown($selected='',$others="class='list_form'")
{
$pay_sql = "select emp_pay_period_name,emp_pay_period_date,emp_pay_period_id from `".TBL_EMP_PAY_PERIOD."` where 1 ";
					$pay_sql.=" order by emp_pay_period_name,emp_pay_period_date asc ";
				
?>
 <select name="payid" id="payid" <?=$others?> >
                	<option value="">Select Pay Period</option>
                     <? if($selected!="") { 
					
					if($row_sel=mysql_fetch_assoc(mysql_query("select emp_pay_period_name,emp_pay_period_date,emp_pay_period_id  from ".TBL_EMP_PAY_PERIOD." where emp_pay_period_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					$month=$row_sel["emp_pay_period_date"];
                  	$month=date_format_for_month($month);
					?>
                     <option value="<?=$row_sel["emp_pay_period_id"]?>" selected="selected" ><?=$row_sel["emp_pay_period_name"];?>[<?=$month;?>]</option>
                    <? } }?>		
                    <? 
					
				 $pay_result=mysql_query($pay_sql) or die(mysql_error());
				 while($row_pay=mysql_fetch_assoc($pay_result))
				  {
				  $row_pay=userstripslashes($row_pay);
				  ?>
                  <?
                  	$month=$row_pay["emp_pay_period_date"];
                  	$month=date_format_for_month($month);
                    //echo $month;
					?>
                    <option value="<?=$row_pay["emp_pay_period_id"]?>" ><?=$row_pay["emp_pay_period_name"];?>[<?=$month;?>]</option>	
                    <? } ?>
                </select>
                <?
}

function Exception_Type_Dropdown($selected='',$others="class='list_form'")
{
$exp_sql = "select exception_name,exception_id from `".TBL_HUSK_EXCEPTION."` where 1 ";
					 $exp_sql.=" order by exception_id ";
				
?>
 <select name="expid" id="expid" <?=$others?> >
                	<option value="">Select Exception Type</option>	
                       <? if($selected!="") { 
					
					if($row_sel=mysql_fetch_assoc(mysql_query("select exception_name,exception_id  from ".TBL_HUSK_EXCEPTION." where exception_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					?>
                     <option value="<?=$row_sel["exception_id"]?>" selected="selected" ><?=$row_sel["exception_name"];?></option>
                    <? } }?>	
                    <? 
				$exp_result=mysql_query($exp_sql) or die(mysql_error());
				 while($row_exp=mysql_fetch_assoc($exp_result))
				  {
				  $row_exp=userstripslashes($row_exp);
				  ?>
                 
                 <option value="<?=$row_exp["exception_id"]?>" ><?=$row_exp["exception_name"];?></option>	
                    <? } ?>
                </select>
                <?
}


function Employee_Dropdown($selected='',$others="class='list_form'")
{
$emp_sql = "select name,emp_code,emp_id from `".TBL_HUSK_EMPLOYEE."` where 1 ";
					$emp_sql.=" order by name,emp_code asc ";
				
?>
 <select name="empid" id="empid" <?=$others?> >
                	<option value="">Select Employee</option>
                       <? if($selected!="") { 
					
					if($row_emp=mysql_fetch_assoc(mysql_query("select name,emp_code,emp_id  from ".TBL_HUSK_EMPLOYEE." where emp_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_emp);
					?>
                     <option value="<?=$row_emp["emp_id"]?>" selected="selected" ><?=$row_emp["name"];?>[<?=$row_emp["emp_code"]?>]</option>
                    <? } }?>	
                    <? 
					
				 $emp_result=mysql_query($emp_sql) or die(mysql_error());
				 while($row_emp=mysql_fetch_assoc($emp_result))
				  {
				  $row_emp=userstripslashes($row_emp);
				  ?>
                 
                    <option value="<?=$row_emp["emp_id"]?>"><?=$row_emp["name"];?>[<?=$row_emp["emp_code"];?>]</option>	
                    <? } ?>
                </select>
                <?
}


function Position_Dropdown($selected='',$segrigation='Active',$others="class='list_form'")
{
?>
 <select name="posid" id="posid" <?=$others?> >
                	<option value="">Select Position</option>
                    <? if($selected!="") { 
					
					if($row_sel=mysql_fetch_assoc(mysql_query("select pos_code,pos_name,pos_id  from ".TBL_POSITION." where pos_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					?>
                     <option value="<?=$row_sel["pos_id"]?>" selected="selected" ><?=$row_sel["pos_name"];?>[<?=$row_sel["pos_code"]?>]</option>
                    <? } }?>	
                    <? $pos_sql = "select pos_code,pos_name,pos_id from `".TBL_POSITION."` where 1 ";
					if($segrigation!="")
					$pos_sql.=" and pos_status='$segrigation'";
					$pos_sql.=" order by pos_name,pos_code asc ";
					
				 $pos_result=mysql_query($pos_sql) or die(mysql_error());
				 while($row_pos=mysql_fetch_assoc($pos_result))
				  {
				  $row_pos=userstripslashes($row_pos);
				  ?>
                    <option value="<?=$row_pos["pos_id"]?>" ><?=$row_pos["pos_name"];?>[<?=$row_cost["pos_code"]?>]</option>	
                    <? } ?>
                </select>
                <?
}




function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 function getimagename($str) {

         if($str=="png") return "notepad.png";
		 else if($str=="xls") return "excel.png";
		 else if($str=="pdf") return "pdf.png";
		 else if($str=="powerpoint") return "powerpoint.png";
		 else if($str=="rtf") return "rtf1.png";
		 else if($str=="txt") return "txt.png";
		 else if($str=="doc") return "word.png";
		 else if($str=="wordpad") return "wordpad.png";
		 else if($str=="jpg") return "jpg.png";
		 else if($str=="jpeg") return "jpeg.png";
		 else if($str=="png") return "png.png";
		 else if($str=="mpeg" || $str=="mpg") return "mpeg.png";
		 else return "rtf2.png";
		 
		 
 }
 function date_format_for_db($str)
 {
  $date_array=explode("/",$str);
  $new_date=$date_array[2]."-".$date_array[1]."-".$date_array[0];
  return $new_date;
 }
 
 function date_format_for_month($str)
 {
  $date_array=explode("-",$str);
  $jd=cal_to_jd(CAL_GREGORIAN,date($date_array[1]),date($date_array[2]),date($date_array[0]));
  $new_date= (jdmonthname($jd,2));
  return $new_date;
 }
  function date_format_for_calender($str)
 {
  $date_array=explode("-",$str);
  $new_date=$date_array[2]."/".$date_array[1]."/".$date_array[0];
  return $new_date;
 }
//---------------------------------------------------------------------------
function getDaysInBetween($start, $end) {
	// Vars
	$day = 86400; // Day in seconds
	//$format = 'Y-m-d'; // Output format (see PHP date funciton)
	$format = 'Y-m-d'; // Output format (see PHP date funciton)
	$sTime = strtotime($start); // Start as time
	$eTime = strtotime($end); // End as time
	$numDays = round(($eTime - $sTime) / $day) + 1;
	$days = array();
	
	// Get days
	for ($d = 0; $d < $numDays; $d++) {
	$days[] = date($format, ($sTime + ($d * $day)));
	}
	
	// Return days
	return $days;
} 
function get_costcenter_from_department($deptid)
{

$result=mysql_query("select cost_center_name,cost_center_code,h_c_c.cost_center_id from ".TBL_DEPARTMENT ." as t_d left join ".TBL_COST_CENTER." as h_c_c on h_c_c.cost_center_id=t_d.cost_center_id where dept_id='$deptid'"); 
if(mysql_num_rows($result)>0)
{
$row=mysql_fetch_assoc($result);
}
else
{
$row["cost_center_name"]="N/A";
$row["cost_center_id"]="N/A";
$row["cost_center_code"]="N/A";
}
return $row;
}

function roles_Dropdown($selected='',$segrigation='Active',$others="class='list_form'")
{
?>
 <select name="roles_id" id="roles_id" <?=$others?> >
                	<option value="">Select Role</option>	
                    <? if($selected!="") { 
					
					if($row_sel=mysql_fetch_assoc(mysql_query("select roles_name,roles_id  from ".TBL_HUSK_ROLES." where roles_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					?>
                     <option value="<?=$row_sel["roles_id"]?>" selected="selected" ><?=$row_sel["roles_name"];?></option>
                    <? } }?>
                    <? $pos_sql = "select roles_name,roles_id from `".TBL_HUSK_ROLES."` where 1 ";
					if($segrigation!="")
					$pos_sql.=" and roles_status='$segrigation'";
					$pos_sql.=" order by roles_name asc ";
					
				 $pos_result=mysql_query($pos_sql) or die(mysql_error());
				 while($row_pos=mysql_fetch_assoc($pos_result))
				  {
				  $row_pos=userstripslashes($row_pos);
				  ?>
                    <option value="<?=$row_pos["roles_id"]?>" ><?=$row_pos["roles_name"];?></option>	
                    <? } ?>
                </select>
                <?
}
function checkavailability($table_name,$primary_key,$afterwhere,$username="")
{
$hint=1;
if (strlen($username) > 0)
  {
  
   $sql = "select ".$primary_key." from ".$table_name." where ".$afterwhere;
  				 $result=mysql_query($sql) or die(mysql_error());
				 $numrows=mysql_num_rows($result);
				 if($numrows>0)
				  {
				    $hint=1;
				  }
				  else
				  {
				  $hint="";
				  }
  }
if ($hint == "")
  {
  $response11=0;
  }
else
  {
  $response11=1;
  }
  return $response11;
}
function show_employees_which_is_not_user($selected='',$segrigation='Active',$others="class='list_form'",$other_conditions='')
{
 $pos_sql = "select t_h_e.name,t_h_e.emp_code,t_h_e.emp_id from ".TBL_HUSK_EMPLOYEE." as t_h_e  where 1 and t_h_e.emp_id NOT IN (select t_u_d.u_empid from ".TBL_USER_DETAILS." as t_u_d) ";
					if($segrigation!="")
					$pos_sql.=" and employee_status='$segrigation' ";
					$pos_sql.=$other_conditions;
					$pos_sql.=" order by name asc ";
				    $pos_result=mysql_query($pos_sql) or die(mysql_error());
					
?>
 <select name="emp_id" id="emp_id" <?=$others?> >
                	<option value="">Select Employee</option>	
                    <? if($selected!="") { 
					
					if($row_sel=mysql_fetch_assoc(mysql_query("select name,emp_code,emp_id from ".TBL_HUSK_EMPLOYEE." where emp_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					?>
                     <option value="<?=$row_sel["emp_id"]?>" selected="selected" ><?=$row_sel["name"]."[".$row_sel["emp_code"]."]";?></option>
                    <? } }?>
                    <? 
				 while($row_pos=mysql_fetch_assoc($pos_result))
				  {
				  $row_pos=userstripslashes($row_pos);
				  ?>
                    <option value="<?=$row_pos["emp_id"]?>" ><?=$row_pos["name"]."[".$row_pos["emp_code"]."]";?></option>	
                    <? } ?>
                </select>
<? }
function get_department_manager_id($dept_id)
{
$sql="select t_h_e.name,t_h_e.emp_code from ".TBL_POSITION." as t_p, ".TBL_HUSK_EMPLOYEE." as t_h_e where t_p.dept_id='$dept_id' and t_p.pos_manager='1' and t_p.pos_id=t_h_e.pos_id";
$result=mysql_query($sql);
if($row=mysql_fetch_assoc($result))
{
 return output_string($row["name"])."[".output_string($row["emp_code"])."]";
}
else
{
return "N/A";
}
}
?>

<?

 function get_locations_dropdown($selected='',$segrigation='Active',$others="class='list_form'",$other_conditions='')
	{
	 $pos_sql = "select loc_id,loc_code,loc_name from ".TBL_LOCATION." where 1 ";
					if($segrigation!="")
					$pos_sql.=" and location_status='$segrigation' ";
					$pos_sql.=$other_conditions;
					$pos_sql.=" order by loc_name asc ";
				    $pos_result=mysql_query($pos_sql) or die(mysql_error());
 $option_var='<select name="location_id" id="location_id" '.$others.' >
                	<option value="">Select Location</option>';	?>
                    <? if($selected!="") { 
					if($row_sel=mysql_fetch_assoc(mysql_query("select loc_id,loc_code,loc_name from ".TBL_LOCATION." where loc_id='".$selected."'")))
					{
					$row_sel=userstripslashes($row_sel);
					
                    $option_var.=' <option value="'.$row_sel["loc_id"].'" selected="selected" >'.$row_sel["loc_name"].'['.$row_sel["loc_code"].']</option>';
                    } }?>
                    <? 
				 while($row_pos=mysql_fetch_assoc($pos_result))
				  {
				  $row_pos=userstripslashes($row_pos);
				  
                     $option_var.='<option value="'.$row_pos["loc_id"].'" >'.$row_pos["loc_name"].'['.$row_pos["loc_code"].']</option>';	
                   }
                $option_var.='</select>';
				return  $option_var;
 }
function get_emp_status_dropdown($selected='',$others="class='list_form'",$other_conditions='')
{ ?>
<select name="emp_status" <?=$others?> id="emp_status">
             <? if($selected!="") { ?>
                  <option selected="selected"><?=$selected?></option>
                  <? }?>
                  <option>Active</option>
                  <option>Inactive</option>
                  <option>Permanent</option>
                  <option>Probation Period</option>
                  <option>Temporary</option>
                  <option>Contractual</option>
                </select> 
<? } ?>
<?
 function getPayrollExceptions($payperid_id){
$sql_exp = "select emp_exception_id,emp_exception_name from ".TBL_EXCEPTION." where emp_pay_period_id='$payperid_id'";
$rs_exp = mysql_query($sql_exp);
$numRow_exp = mysql_num_rows($rs_exp);
if($numRow_exp>=1){

$srt =	'<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse">';
	
	while($row_exp = mysql_fetch_array($rs_exp)){ 
	extract($row_exp);
	$srt .=  '<tr><td valign="top">'.$emp_exception_name.'</td></tr>';
    }
	$srt .='</table>';

} else {
	$srt = '';
}

return $srt;
	
 } 
 
 
function getPayrollExceptionsEmp($payperid_id){
$sql_exp = "select emp_exception_id,emp_exception_name from ".TBL_EXCEPTION." where emp_pay_period_id='$payperid_id'";
$rs_exp = mysql_query($sql_exp);
$numRow_exp = mysql_num_rows($rs_exp);
if($numRow_exp>=1){

$srt =	'<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse">';
$srt .=  '<tr class="rowHead"><td valign="top">Exception</td><td>Employee</td></tr>';
	while($row_exp = mysql_fetch_array($rs_exp)){ 
	extract($row_exp);
	$srt .=  '<tr><td valign="top">'.$emp_exception_name.'</td>';
	$srt .=		  '<td>';
	$sql_exp2 = "select emp.name from ".TBL_HUSK_EMPLOYEE." as emp left join ".TBL_EXCEPTION_MAP." as map on emp.emp_id=map.emp_id left join ".TBL_EXCEPTION." as texc on map.emp_exception_id=texc.emp_exception_id where texc.emp_exception_id=".$emp_exception_id."";
	$rs_exp2 = mysql_query($sql_exp2);
	$numRow_exp2 = mysql_num_rows($rs_exp2);
	if($numRow_exp2>=1){
	$srt .=    '<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse">';
		while($row_exp2 = mysql_fetch_array($rs_exp2)){ 
		extract($row_exp2);
		$srt .=    '<tr><td>'.$name.'</td></tr>';
		}
	$srt .=	   '</table>';
	}
	$srt .=             '</td>
			  </tr>';
  }
	$srt .='</table>';


} else {
	$srt = 'No Exceptions';
}

return $srt;
	
 } 
 function chek($val)
	{
	$sql="select * from  ".TBL_BARCODE." where part_id=$val order by barcode_id asc";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	extract($row);
			if($part_id==$val)
			{
			return 0;
			}else{
			return 1;
			}
	}
 function generate_code($code_pre_fix="",$code_length="",$concatinate="")
{
   $code=$code_pre_fix;

if(strlen($concatinate)<$code_length) 
  {
    $zeroadded='';
   for($i=$code_length;$i>=1;$i--)
   {
			
			if(strlen($concatinate)==$i) 
			{
				$code.=$zeroadded.$concatinate;  
			}
  			else
			{
			
			 $zeroadded.="0";
			 }
  }
 }
else $code.=$concatinate;  
return $code;
}	
function getPart_name($fff){
    $sql="select part_name from  ".TBL_STOCK." where part_id=".$fff;
	$result= mysql_query($sql) or die($obj_db3->error());;
	$row=mysql_fetch_array($result);
	return $row['part_name'];
}
function getStoreName($store_id){
    $sql="select location_name from  ".TBL_LOCATION." where location_id=".$store_id;
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['location_name'];
}

function getGodownName($godown_id){
    $sql="select godown_name from  ".TBL_GODOWN." where godown_id=".$godown_id;
	$result= mysql_query($sql);
	$row=mysql_fetch_array($result);
	return $row['godown_name'];
}
function getPlantName($plant_id){
    $sql="select plant_name from  ".TBL_PLANT." where plant_id=".$plant_id; 
    $result= mysql_query($sql) or die($obj_db2->error());
	$row=mysql_fetch_array($result);
	return $row['plant_name'];
}

function getPartName($part_code){
    $sql="select part_name from  ".TBL_STOCK." where part_code='".$part_code."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['part_name'];
}

function getPartQty($part_code){
    $sql="select quantity from  ".TBL_CHALAN_ITEMS." where part_code='".$part_code."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['quantity'];
}

function getPartUnit($part_code){
    $sql="select unit,chalan_id from  ".TBL_CHALAN_ITEMS." where part_code='".$part_code."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	
	return $row;
}
function getUsername($u_id){
    $sql="select user_name from  ".TBL_USER." where uid='".$u_id."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['user_name'];
}
function getCategory($part_code){
    $sql="select catagory_id from  ".TBL_STOCK." where part_code='".$part_code."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['catagory_id'];
}
function getTotal($loc_name,$loc_id,$part_code){
	 $sql = "SELECT sum(stock_quantity) FROM ".TBL_STOCK_LOCATION."  where  location_id= '".$loc_id;
			 $sql.= "'and  plant_inventory= '".$loc_name."' and  part_code= '".$part_code."'  "; 
 //$sql="select sum(stock_quantity) from  ".TBL_STOCK_LOCATION." where part_code='".$part_code."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return($row[0]);
}

function getCategoryname($catagory_id){
   $sql="select catagory_name from  ".TBL_CATAGORY." where catagory_id='".$catagory_id."'"; 
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['catagory_name'];
}
function getDescription($chalan_id){
   $sql="select comment from  ".TBL_CHALAN." where chalan_id='".$chalan_id."'"; 
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['comment'];
}
function getBarcode($part_code){
    $sql="select st.part_id,bc.barcode from  ".TBL_STOCK." as st LEFT JOIN ".TBL_BARCODE." as bc ON st.part_id=bc.part_id where st.part_code='".$part_code."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['barcode'];
}

// Barcode Category Dropdown

function Category_Dropdown($selected='',$segrigation='Active',$others="class='list_form'"){
?>
<select name="catid" id="catid" <?=$others?> >
<option value=""> Select Category</option>	
<? $cat_sql = "select * from `".TBL_CATAGORY."` where 1 ";
$cat_sql.=" order by catagory_code,	catagory_name asc ";

$cat_result=mysql_query($cat_sql) or die(mysql_error());
while($row_cat=mysql_fetch_assoc($cat_result)){
$row_cat=userstripslashes($row_cat);
?>
<option value="<?=$row_cat["catagory_id"]?>" <?=($row_cat["catagory_id"]==$selected)?'selected=selected':''; ?>><?=$row_cat["catagory_name"];?>[<?=$row_cat["catagory_code"]?>]</option>	
<? } ?>
</select>
<?
}



//Barcode Plant Dropdown
 function Plant_Dropdown($selected='',$segrigation='Active',$others="class='list_form'")
{
?>
<select name="plantid" id="plantid" <?=$others?> >
    <option value=""> Select Plant</option>	
    <? $plant_sql = "select * from `".TBL_PLANT."` where 1 ";
    $plant_sql.=" and plant_status='Undiscard'";
    $plant_sql.=" order by plant_name,	plant_name asc ";
    
    $plant_result=mysql_query($plant_sql) or die(mysql_error());
    while($row_plant=mysql_fetch_assoc($plant_result)){
    $row_plant=userstripslashes($row_plant);
    ?>
    <option value="<?=$row_plant["plant_id"]?>" <?=($row_plant["plant_id"]==$selected)?'selected=selected':''; ?>><?=$row_plant["plant_name"];?></option>	
    <? } ?>
</select>
<?
}

//Barcode Godown Dropdown
 function Godown_Dropdown($selected='',$segrigation='Active',$others="class='list_form'")
{
?>
 <select name="godid" id="godid" <?=$others?> >

    <option value="">Select Inventory</option>	
    <? $god_sql = "select * from `".TBL_GODOWN."` where 1 ";
    $god_sql.="  and godown_status='Undiscard'";
    $god_sql.=" order by godown_name,	godown_name asc ";
    
    $god_result=mysql_query($god_sql) or die(mysql_error());
    while($row_god=mysql_fetch_assoc($god_result)){
    $row_god=userstripslashes($row_god);
    ?>
    <option value="<?=$row_god["godown_id"]?>" <?=($row_god["godown_id"]==$selected)?'selected=selected':''; ?>><?=$row_god["godown_name"];?></option>	
    <? } ?>

</select>
<?
}

//Barcode Plant Dropdown
function Plant_Dropdown_log($selected=''){
$loginLocation = $_SESSION['plant_of_id'];
?>
<select name="plantid" id="plantid" <?=$others?> >
    <option value=""> All</option>	
    <? $plant_sql = "select * from `".TBL_PLANT."` where 1 ";
    $plant_sql.=" and plant_status='Undiscard'";
    $plant_sql.=" order by plant_name,	plant_name asc ";
    
    $plant_result=mysql_query($plant_sql) or die(mysql_error());
    while($row_plant=mysql_fetch_assoc($plant_result)){
    $row_plant=userstripslashes($row_plant);
	if($row_plant["plant_id"]!=$loginLocation){
    ?>
    <option value="<?=$row_plant["plant_id"]?>" <?=($row_plant["plant_id"]==$selected)?'selected=selected':''; ?>><?=$row_plant["plant_name"];?></option>	
    <? }} ?>
</select>
<?
}

//Barcode Godown Dropdown
 function Godown_Dropdown_log($selected=''){
 $loginLocation = $_SESSION['godown_of_id'];
?>
 <select name="godid" id="godid" <?=$others?> >

    <option value="">All</option>	
    <? $god_sql = "select * from `".TBL_GODOWN."` where 1 ";
    $god_sql.="  and godown_status='Undiscard'";
    $god_sql.=" order by godown_name,	godown_name asc ";
    
    $god_result=mysql_query($god_sql) or die(mysql_error());
    while($row_god=mysql_fetch_assoc($god_result)){
    $row_god=userstripslashes($row_god);
	if($row_god["godown_id"]!=$loginLocation){
    ?>
    <option value="<?=$row_god["godown_id"]?>" <?=($row_god["godown_id"]==$selected)?'selected=selected':''; ?>><?=$row_god["godown_name"];?></option>	
    <? }} ?>

</select>
<?
}

function stockCounter($barcode,$loc_id,$loc_name){
  $sql="select stock_quantity from  ".TBL_STOCK_LOCATION." where barcode='".$barcode."' and location_id='".$loc_id."' and plant_inventory='".$loc_name."'"; 
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	$row['stock_quantity']; 
	return $row['stock_quantity'];
}

function itemCounter($chalan_id){
    $sql="select chalan_items_id from  ".TBL_CHALAN_ITEMS." where chalan_id='".$chalan_id."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$num=mysql_num_rows($result);
	return $num;
}

function getBarcodeList($part_code,$loc_id,$loc_name){
$tmpStr = '<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse">';
$sql3 = "SELECT barcode,stock_quantity FROM ".TBL_STOCK_LOCATION." where  part_code= '".$part_code."'";
$sql3 .= " AND  location_id= '".$loc_id."'";
$sql3.= "and  plant_inventory= '".$loc_name."' ORDER BY stock_id DESC"; 

$result3=mysql_query($sql3);

while($row3 = mysql_fetch_array($result3)){
extract($row3); 
$tmpStr .='  <tr class="row1">
    <td>'.$barcode.'</td>
    <td align="right">'.$stock_quantity.'</td>
  </tr>';
}  
$tmpStr .='</table>';

return $tmpStr;
}

function userType($u_id){
	$sql="select user_type from  ".TBL_USER." where uid='".$u_id."'";
	$result= mysql_query($sql) or die($obj_db1->error());
	$row=mysql_fetch_array($result);
	return $row['user_type'];
}

?>