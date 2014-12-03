<?php session_start(); 
header("Content-Type:text/html; charset=utf-8");
include_once("sqlsrv_connect.php");




$old_pw = trim($_POST['old_pw']);
$new_pw = md5(trim($_POST['new_pw']));

$sql = "select id,pw,ch_name name from company where id =?"; 
$stmt = sqlsrv_query($conn, $sql, array($_SESSION['username']));

    if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    else die(print_r( sqlsrv_errors(), true));

    if($row[pw]!=$old_pw) {echo "密碼錯誤，請重試。";  exit();}


    $sql = "update company set pw=(?) where id ='".$_SESSION['username']."'"; 
    if( sqlsrv_query($conn, $sql, array($new_pw)) ) echo "success";
       


?>