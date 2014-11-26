<?php
session_start(); 
include_once("sqlsrv_connect.php");


$sql = "select * from company where id=?";
$params = array($_POST['id']);
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$result = sqlsrv_query($conn,$sql,$params,$options);

if($result){
	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);

	// 查無帳號
	if( count($row) ==0 ) echo "1"; 
	else echo "0";
}





?>
