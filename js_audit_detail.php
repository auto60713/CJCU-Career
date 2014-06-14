<?
// 取出審核的所有細節


//學校審核公司的理由
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


//公司審核學生的理由
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

	echo "var apply_audit_array = ". json_encode($apply_audit_array).";";

}


?>