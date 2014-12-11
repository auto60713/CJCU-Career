<?php

session_start(); 
session_write_close();

include('cjcuweb_lib.php');

if(!isset($_SESSION['level']){
if($_SESSION['level']!=$level_company){
	echo "0"; 
	exit; 
}
}
else{
	echo "0"; 
	exit; 
}

	//[注意!]這隻程式尚未做身分驗證，之後再補上


include("sqlsrv_connect.php");

if(isset($_POST['objid'])){
	$sql = "update work set [check]=3 where id=?";
	$params = array($_POST['objid']);
}
else{
	$sql = "update company set censored=3 where id=?";
	$params = array($_SESSION['username']);
}

$result = sqlsrv_query($conn, $sql, $params);

if(!$result){
	echo "0"; exit;
}

?>