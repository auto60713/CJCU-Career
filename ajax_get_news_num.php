<?php
session_start();
if(!isset($_SESSION['username'])){
	echo "N"; exit;
}
else{
$user=$_SESSION['username'];
$lev = ($_SESSION['level']==4)? 1 : 0;
}

session_write_close();


include("sqlsrv_connect.php");

$params = array($user,$lev,$user,$lev);
$sql = "select COUNT(*) from msg where recv=? and recv_level=? 
		and time > (select time from cjcu_notify where user_no=? and user_level=?)";

$result = sqlsrv_query($conn, $sql, $params );
if($result){

	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ;
	echo $row[0];

}else die(print_r( sqlsrv_errors(), true));

?>