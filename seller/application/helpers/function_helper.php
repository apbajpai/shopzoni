<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('pr'))
{
	function pr($val){		
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}
}

if (!function_exists('GetCategoryCode'))
{
	function GetCode($name, $id){
		//$clean=Translate($name);
		
		$category_code = url_title($name, '-', TRUE);
		$category_code = $category_code.'-'.$id;
		return $category_code;
	}
}

if (!function_exists('GetSlug'))
{
	function GetSlug($name, $id){		
		//$clean=Translate($name);
		
		$slug = url_title($name, '-', TRUE);
		$slug = $slug.'-'.$id;
		return $slug;
	}
}
if (!function_exists('createURL'))
{
	$curr_url='';
	function createURL($array){		
		foreach($array as $key=>$value)
		{
		$curr_url.=$value.'/';
		}
		
		return base_url($curr_url);
	}
} 
if (!function_exists('GetSlugTitle'))
{
	function GetSlugTitle($name, $id){		
		//$clean=Translate($name);
		
		$slug = url_title($name, '-', TRUE);
		$slug = $slug.'-'.$id;
		return $slug;
	}
} 

if (!function_exists('GetSlugnew'))
{
	function GetSlugnew($name, $id, $table, $inc=0){
		$clean = Translate($name);
		$slug = url_title($clean, 'dash', TRUE);
		
		if($inc > 0)
		$slug = $slug.'-'.$inc;
		
		$CI =& get_instance();
		$CI->load->database();
		$query = $CI->db->query("SELECT slug FROM ".$table." where slug = '$slug' and id != '$id' ");
		//echo $CI->db->last_query();
		if ($query->num_rows() > 0) {
			$inc++;
			$slug = GetSlugnew($name, $id, $table, $inc);
		}
		return $slug; 
	}
}

if(!function_exists('GetUrl')){
	function GetUrl($slug1='', $slug2=''){
		if($slug1!='' && $slug2='')
			$url=base_url().$slug1;
		if($slug1!='' && $slug2!='')
			$url=base_url().$slug1.'/'.$slug2;
		return $url;
	}
}


if (!function_exists('GetStatus'))
{
	function GetStatus($val){
		$status = '';
		switch($val)
		{
			case 1:
			$status = '<span class="active">Active</span>';
			break;
			case 0:
			$status = '<span class="inactive">Inactive</span>';
			break;
			case 5:
			$status = '<span class="deleted">Deleted</span>';
			break;
			default:
			$status = '<span class="active">Active</span>';
		}
		return $status;
	}
}

if (!function_exists('GetDateFormat'))
{
	function GetDateFormat($date){
		if($date){
			return strtoupper(date("M d \, Y", strtotime($date)));
		}
		else{
			return '-';
		}
	}
}

if (!function_exists('GetDateFormatNew'))
{
	function GetDateFormatNew($date){
		if($date){
			return strtoupper(date("d M Y", strtotime($date)));
		}
		else{
			return '-';
		}
	}
}

if (!function_exists('GetDateTimeFormat'))
{
	function GetDateTimeFormat($date){
		if(strpos($date, '0000-00-00') === false){
			return strtoupper(date("M d \, Y H:i a", strtotime($date)));
		}
		else{
			return '-';
		}
		
	}
}

if (!function_exists('GetDateFormat'))
{
	function GetDateFormat($date){
		if(strpos($date, '0000-00-00') === false){
			return strtoupper(date("d/m/Y", strtotime($date)));
		}
		else{
			return '-';
		}
		
	}
}

if (!function_exists('GetTitleById'))
{
	function GetTitleById($table, $id, $column = 'name'){
		$CI =& get_instance();
		$CI->load->database();
		
		$query = $CI->db->query("SELECT $column FROM $table where id = '$id' LIMIT 1");
		$row = $query->row();
		return $row->$column;
	}
}

if (!function_exists('SetPriority'))
{
	function SetPriority($table, $where = '', $column = 'priority'){
		$CI =& get_instance();
		$CI->load->database();
		
		$query = $CI->db->query("SELECT max($column) as max_priority FROM $table where 1=1 $where");
		$row = $query->row();
		return $row->max_priority+1;
	}
}




function curl($url,$params = array(),$is_coockie_set = false)
{

if(!$is_coockie_set){
/* STEP 1. let’s create a cookie file */
$ckfile = tempnam ("/tmp", "CURLCOOKIE");

/* STEP 2. visit the homepage to set the cookie properly */
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec ($ch);
}

$str = ''; $str_arr= array();
foreach($params as $key => $value)
{
$str_arr[] = urlencode($key)."=".urlencode($value);
}
if(!empty($str_arr))
$str = '?'.implode('&',$str_arr);

/* STEP 3. visit cookiepage.php */

$Url = $url.$str;

$ch = curl_init ($Url);
curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);
return $output;
}

function Translate($word, $conversion = 'hi_to_en')
{
	$word = urlencode($word);

	if($conversion == 'en_to_hi')
	$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&tl=hi&ie=UTF-8&oe=UTF-8&multires=0&otf=1&ssel=3&tsel=3&sc=1';
	
	else if($conversion == 'hi_to_en')
	$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&tl=en&ie=UTF-8&oe=UTF-8&multires=0&otf=1&ssel=3&tsel=3&sc=1';

	$response = curl($url);
	
	$response = str_replace("[","",$response);
	$response = str_replace("]","",$response);
	$response = "[".preg_replace('/,+/', ',', $response)."]";
	
	$name_en = json_decode($response);
	
	
	$trans_str = $name_en[0];
	
	if($trans_str == ''){
		$trans_str = $name_en[1];
	}
	
	if($trans_str == ''){
		$trans_str = $word;
	}
	
	//echo $trans_str;
	
	return $trans_str;
}

if (!function_exists('getCatSubcatTitle'))
{
	function getCatSubcatTitle($id){
		$CI =& get_instance();
		$CI->load->database();
		
		$query = $CI->db->query("SELECT id, parent_id, name FROM tbl_category where id = '$id' LIMIT 1");
		$row = $query->row();
		if(($row->parent_id) != 0){
			$query1 = $CI->db->query("SELECT name FROM tbl_category where id = '$row->parent_id' LIMIT 1");
			$row1 = $query1->row();
			$parent_name=$row1->name;			
		}
		if($parent_name)
			return $parent_name." &rarr; ".$row->name;
		else
			return $row->name;
	}
}

if (!function_exists('redirect404'))
{
	function redirect404(){
		ob_start();
		header("Location: /error", TRUE, 301);
		exit;
	}
}

