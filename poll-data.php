<?php

$db['hostname'] = 'localhost';
$db['username'] = 'thehoot';
$db['password'] = 'ho13579';
$db['database'] = 'thehoot';


mysql_connect($db['hostname'], $db['username'], $db['password']);
mysql_select_db($db['database']);

function result($qid, $num){
	//echo "select * from result where que_id = $qid and vote = $num";
	$sql = mysql_query("select * from result where que_id = $qid and vote = $num");
	return mysql_num_rows($sql);
}

/*
$query = mysql_query("select * from pole order by que_id");

while($row = mysql_fetch_array($query)){
	$data = array();
	$arr['option'] = $row['opt1_a'];
	$arr['result'] = result($row['que_id'], 1);
	array_push($data, $arr);
	
	
	
	$arr['option'] = $row['opt2_a'];
	$arr['result'] = result($row['que_id'], 2);
	array_push($data, $arr);
	
	$arr['option'] = $row['opt3_a'];
	$arr['result'] = result($row['que_id'], 3);
	array_push($data, $arr);
	
	foreach($data as $key=>$val){
		echo "insert into tbl_poll_option (poll_id, option_name, option_vote) values('".$row['que_id']."', '".$val['option']."', '".$val['result']."');<br>";
		//mysql_query("insert into tbl_poll_option (poll_id, option_name, option_vote) values('".$row['que_id']."', '".$val['option']."', '".$val['result']."')");
	}
}
*/

/*
//update slug
//taken from wordpress
function utf8_uri_encode( $utf8_string, $length = 0 ) {
    $unicode = '';
    $values = array();
    $num_octets = 1;
    $unicode_length = 0;

    $string_length = strlen( $utf8_string );
    for ($i = 0; $i < $string_length; $i++ ) {

        $value = ord( $utf8_string[ $i ] );

        if ( $value < 128 ) {
            if ( $length && ( $unicode_length >= $length ) )
                break;
            $unicode .= chr($value);
            $unicode_length++;
        } else {
            if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

            $values[] = $value;

            if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
                break;
            if ( count( $values ) == $num_octets ) {
                if ($num_octets == 3) {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                    $unicode_length += 9;
                } else {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                    $unicode_length += 6;
                }

                $values = array();
                $num_octets = 1;
            }
        }
    }

    return $unicode;
}

//taken from wordpress
function seems_utf8($str) {
    $length = strlen($str);
    for ($i=0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80) $n = 0; # 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
        elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
        elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
        elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
        elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
        else return false; # Does not match any model
        for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}

//function sanitize_title_with_dashes taken from wordpress
function sanitize($title) {
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

    if (seems_utf8($title)) {
        if (function_exists('mb_strtolower')) {
            $title = mb_strtolower($title, 'UTF-8');
        }
        $title = utf8_uri_encode($title, 200);
    }

    $title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    $title = str_replace('.', '-', $title);
    $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}
$query = mysql_query("select * from tbl_article order by id");

while($row = mysql_fetch_array($query)){
	echo "update tbl_article set slug = '".sanitize($row['title'])."' where id = '".$row['id']."';<br> ";
	//mysql_query("update tbl_article set slug = '".slugify($row['slug'])."' where id = '".$row['id']."' ");

}
*/


//insert images
$query = mysql_query("select * from tbl_article order by id");

while($row = mysql_fetch_array($query)){
	if($row['image'] != ''){
		echo "insert into tbl_article_images (article_id, image) values ('".$row['id']."', '".$row['image']."' ); <br>";
	}

}

?>