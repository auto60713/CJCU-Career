<?


/* SQL語法裡面應該要盡量使用別名 不然輸出JSON欄位都被人猜光光*/


/* to profile -------------------------   */


/* 學生 */
function echo_student_profile($stu_no){
include_once("sqlsrv_connect.php");

	$column_name = array("學號","姓名","系所","履歷檔案");

	$sql = "select user_no number,user_name name,dep_name depname "
		  ."from cjcu_user where user_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($stu_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var student_profile_array = ". json_encode($row) . ";\n";

}


/* 系所 */
function echo_department_profile($dep_no){
include("sqlsrv_connect.php");

    $sql = "select ch_name,en_name,phone,fax,name,email,address,introduction,url "
	      ."from department "
	      ."where no= ?";

	$stmt = sqlsrv_query($conn, $sql, array($dep_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var department_profile_array = ". json_encode($row) . ";";
}




/* to manage -------------------------    */


/* 學生 */
function echo_student_detail($user_id){
include_once("sqlsrv_connect.php");

	$column_name = array("學號","姓名","系所","履歷檔案");

	$sql = "select u.user_no userno,u.user_name username,u.dep_name depname,s.doc doc "
		  ."from cjcu_user u,cjcu_student s where u.user_no=? and s.user_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id,$user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var user_detail_array = ". json_encode($row) . ";\n";

    echo "var column_name = ['".implode("','", $column_name)."'];\n";


}

/* 系所 */
function echo_department_detail($dep_no){
include_once("sqlsrv_connect.php");

	$sql = "select no,ch_name,en_name,phone,fax,name,email,address,introduction,url "
	      ."from department "
	      ."where no= ?";
	
	$stmt = sqlsrv_query($conn, $sql, array($dep_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var department_detail_array = ". json_encode($row) . ";\n";

}

/* 管理員 */
function echo_staff_detail($user_no){
include_once("sqlsrv_connect.php");

	$sql = "select user_name,role "
	      ."from cjcu_user "
	      ."where user_no= ?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var staff_detail_array = ". json_encode($row) . ";\n";

}





?>

