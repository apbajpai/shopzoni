<? 
@session_start();

@header('Cache-Control: no-cache');
@header('Pragma: no-cache');
include_once("classes.php");

include_once("functions.php");
include_once("database.php");

include_once("db_array.php");
include_once("page.inc.php");
include_once('configure.php');


/*if(!(strstr($_SERVER["REQUEST_URI"],'check_login.php')) and !(strstr($_SERVER["REQUEST_URI"],'index.php')))
{
check_member_login();
}else{ */

//include_once("pagination/pagination.php");
$obj_db=new DB();
$obj_db->open();
$obj_db1=new DB();
$obj_db1->open();
$obj_db2=new DB();
$obj_db2->open();
$obj_db3=new DB();
$obj_db3->open();
$page=new page();

$page=new page();
extract($_REQUEST);


?>