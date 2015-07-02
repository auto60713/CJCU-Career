<?php


	include("../sqlsrv_connect.php");

	$sql = "select view_num from view_num";
	$stmt = sqlsrv_query($conn, $sql, array());

 
	if($stmt) while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $view_num = $row['view_num']+1;
	else die(print_r( sqlsrv_errors(), true));

	echo $view_num;

	$sql = "update view_num set view_num=(?)"; 
    sqlsrv_query($conn, $sql, array($view_num));    


?>