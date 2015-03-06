<?php

include_once('cjcuweb_lib.php');

// 由於 ajax 請求 json 資料，須從後端檢查是否登入與其身分為學生，才可以執行 echo_apply_audit_array()
$userid = $_SESSION['username'];
//工作負責人轉換
if (preg_match("/-/i", $userid)) $userid = strstr($userid,'-',true);
$level = $_SESSION['level'];
session_write_close();

// 如果前端 POST workid 的話，表示要請求學生該工作的審核歷史紀錄
if(isset($_POST['workid']) &&  $_SESSION['level'] == $level_student ) 
	echo_apply_audit_array($userid,$_POST['workid']);



//管理員審核公司的理由
function echo_audit_detail_array($obj_id,$type){

	include("sqlsrv_connect.php");
	$audit_array = array();
	$para = array($type , $obj_id);
	$sql = "select staff_no,censored,msg,time from audit where type=? and obj_id=? order by time desc";
	$stmt = sqlsrv_query($conn, $sql, $para);
	if($stmt)  
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			$audit_array[] = $row;
	else  
		die(print_r( sqlsrv_errors(), true));

	echo "var audit_array = ". json_encode($audit_array).";";
}



//公司審核學生的歷史紀錄
function echo_apply_audit_array($userid,$workid){

	include("sqlsrv_connect.php");

	$apply_audit_array = array();
	$para = array($userid , $workid);
	$sql = "select * from apply_audit where user_id=? and work_id=? order by time desc";
	$stmt = sqlsrv_query($conn, $sql, $para);
	if($stmt)  
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			$apply_audit_array[] = $row;
	else  
		die(print_r( sqlsrv_errors(), true));

	echo  json_encode($apply_audit_array);

}


?>