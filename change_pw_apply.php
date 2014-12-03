<?php session_start(); 
header("Content-Type:text/html; charset=utf-8");
include_once("sqlsrv_connect.php");


switch ($_SESSION['level']) {
	
    case 5:case 1://系所改密碼
        $old_pw = trim($_POST['old_pw']);
        $new_pw = trim($_POST['new_pw']);

        $sql = "select no id,pw,ch_name name from department where no =?"; 
        $sql2 = "update department set pw=(?) where no ='".$_SESSION['username']."'"; 
    break;
    
    case 4://廠商改密碼
        $old_pw = md5(trim($_POST['old_pw']));
        $new_pw = md5(trim($_POST['new_pw']));

        $sql = "select id,pw,ch_name name from company where id =?"; 
        $sql2 = "update company set pw=(?) where id ='".$_SESSION['username']."'"; 
    break;
    
}


$stmt = sqlsrv_query($conn, $sql, array($_SESSION['username']));

    if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    else die(print_r( sqlsrv_errors(), true));

    if(trim($row[pw])!=$old_pw) {echo "密碼錯誤，請重試。";  exit();}

    if( sqlsrv_query($conn, $sql2, array($new_pw)) ) echo "success";
       


?>