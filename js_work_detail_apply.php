<?
/* 應徵者列表轉成JS Array */
function echo_work_apply_list_array($workid){

include("sqlsrv_connect.php");

$para = array($workid);
$sql = "select l.user_id,[check],u.user_name name,u.dep_no depno,u.dep_name depname from line_up l,cjcu_user u where l.work_id=? and l.user_id= u.user_no";
$stmt = sqlsrv_query($conn, $sql, $para);

$work_apply_list_array= array();

if($stmt) {
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_apply_list_array[] = $row;
	echo "var work_apply_list_array = ". json_encode($work_apply_list_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}

?>