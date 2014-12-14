<?php
/* 應徵者列表轉成JS Array */
function echo_work_apply_list_array($workid){

include("sqlsrv_connect.php");

$para = array($workid);
$sql = "select l.no,l.user_id,l.work_id,l.score,[check],u.sd_stud_name name,u.sd_entrance_syear sd_syear,u.sd_dep_no depno,u.dm_dep_short_name depname 
from line_up l,career_student_data u 
where l.work_id=? and l.user_id= u.sd_stud_no";
$stmt = sqlsrv_query($conn, $sql, $para);

$work_apply_list_array= array();

if($stmt) {
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_apply_list_array[] = $row;
	echo "var work_apply_list_array = ". json_encode($work_apply_list_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}

?>