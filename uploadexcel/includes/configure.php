<?
ini_set("session.cookie_lifetime",7200);
ini_set("session.gc_maxlifetime",7200);
ini_set("max_execution_time",300);

define ("SITE_NAME" , 'UploadExcel');
//define ("SITE_PATH" , 'http://localhost/uploadexcel/');
define ("SITE_PATH" , 'http://uploadexcel.shopzoni.com/');
define ("SITE_CONFIGURATION" ,   SITE_PATH.'configuration/');
define ("SITE_DMS" ,   SITE_PATH.'document_management/');
define ("SITE_PAYROLL" ,   SITE_PATH.'payroll/');
define ("SITE_ERROR" ,   SITE_PATH.'error/');
define ("SITE_HRM" ,   SITE_PATH.'HRM/');
define ("SITE_IMAGE" , SITE_PATH.'images/');
define ("SITE_CSS" , SITE_PATH.'css/');
define ("SITE_JS" , SITE_PATH.'js/');
define ("SITE_UI" , SITE_PATH.'ui/');
define ("SITE_BASE" , SITE_PATH.'base/');
define ("SITE_LIB" , SITE_PATH.'lib/');
define ("SITE_FILE_UPLOAD" , SITE_PATH.'DMS/Manual/');
define ("SITE_FILE_NAME_DOCUMENTS" , 'documents.php');
define ("SITE_FILE_NAME_ADD_EDIT_DMS_FOLDER" , 'add_edit_dms_folder.php');
define ("SITE_FILE_NAME_ADD_DOC_FILES" , 'add_doc_files.php');
define ("SITE_ICONS" , 'icons/');
define ("SITE_REDIRECT_URL_PAGE_EXPIRE" , SITE_ERROR."pageexpire.php");
define ("SITE_REDIRECT_URL_NO_PERMISSION" , SITE_ERROR."access_denied.php");
define ("SITE_MODULE_HRM_ID" , '7');
define ("SITE_MODULE_HRM_SUBM_EMPLOYEE_PERSONAL" , '8');
define ("SITE_MODULE_HRM_SUBM_EMPLOYEE_ACTION" , '9');
define ("CODE_BARCODE_PREFIX" , 'JCN');
define ("CODE_BARCODE_MIN_LENGTH" , '6');

define ("PER_PAGE_RECORD" , '50');
//$redirectURL_pageexpire=SITE_ERROR."pageexpire.php";
//$redirectURL_nopermission=SITE_ERROR."access_denied.php";

?>
