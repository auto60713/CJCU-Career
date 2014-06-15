<?

//管理員的資料
function echo_staff_detail_array($user_id){

include_once("sqlsrv_connect.php");

//select了兩次t.pic 確認後刪除
$sql = "select u.user_no,u.user_name,u.dep_no,u.dep_name,u.role,t.pic,t.phone,t.email,t.pic
		from cjcu_user u, cjcu_staff t
		where u.user_no =? and t.user_no=u.user_no";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var staff_detail_array = ". json_encode($row) . ";\n";
}





//老師的資料
function echo_teacher_detail_array($user_id){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

//設定前端要呈現的資料

	$column_name = array("帳號","姓名","系所");
	$input_name = array("user_no" , "user_name" , "dep_name");

//取出資料
	$sql = "select user_no userno,user_name username,dep_name depname "
		  ."from cjcu_user where user_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var user_detail_array = ". json_encode($row) . ";\n";

    echo "var column_name = ['".implode("','", $column_name)."'];\n";
    echo "var input_name = ['".implode("','", $input_name)."'];\n";

}




?>