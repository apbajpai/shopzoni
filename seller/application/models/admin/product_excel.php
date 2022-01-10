<?php 
header("Content-type: application/x-msdownload"); 
header("Content-Disposition: attachment; filename=Departments.xls"); 
header("Pragma: no-cache"); header("Expires: 0");
require ("../includes/ajaxtop.php"); 
$breadcrumb = "Document Management &gt;&gt;&nbsp;";

?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td valign="top" bgcolor="#e6e6e6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td height="100"  align="left" valign="top" style="padding:0 10px 0 10px;  ">
       
       <form action="" method="post" name="department_form" id="department_form">
       
      <table style="border:#6eb21a solid 1px;" width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td bgcolor="#6eb21a" align"center" st yle=" padding:3px 0 3px 7px">Human Resources  &gt;&gt; Departments </td>
            </tr>
          
          <tr>
            <td style="padding:5px 7px 5px 7px;" bgcolor="#f8f9f7"  ><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse">
              <?php 
		
			  if(!empty($msg)){ ?>
                <tr>  ,.
              	<td ><?php echo output_string($dept_desc); ?></td>
                <td ><?php echo output_string($start_date); ?></td>
                <td ><?php echo output_string($end_date); ?></td>              	
                          
    			</tr>
                
                 <?php } } ?>
                 
             <!--
              <tr class="row1">
             
                <td colspan="7" align="center">
                <?php if($Config_add=="Yes") { ?>
           		 <input name="button" id="button" type="button" value="New" class="add_button" onclick="window.location='add_edit_department.php?action=add';" /> 
                 <?php } ?>
                  <?php if($Config_delete=="Yes") { ?>
                 &nbsp;<input name="button" id="button" type="button" value="Delete" class="add_button" onClick="confirmation('Delete');"/>
                 <?php } ?>    			               </td> 
                  </tr>-->
                  
                  <tr class="row2" >
                <td style="" valign="middle" colspan="5" >
              	</td></tr>
               
            </table></td>
            </tr>
        </table></form></td>
      </tr>
    </table></td>
  </tr>
  
</table>
</body>
</html>
