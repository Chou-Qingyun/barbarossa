<?php
function authcode($str){
	$key = 'd3da6208';
	$str = substr(md5($str), 8, 10);
	echo md5($key . $str);
}

$str = $_GET['code'];
authcode($str);