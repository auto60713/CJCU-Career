<?
/* 學生詳細資料轉成JS Array */
function echo_student_detail_array($user_id){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

//設定前端要呈現的資料

	$column_name = array("學號","姓名","系所","履歷檔案");

	$sql = "select u.user_no userno,u.user_name username,u.dep_name depname,s.doc doc "
		  ."from cjcu_user u,cjcu_student s where u.user_no=? and s.user_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id,$user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var user_detail_array = ". json_encode($row) . ";\n";

    echo "var column_name = ['".implode("','", $column_name)."'];\n";


}

?>