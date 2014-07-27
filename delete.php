<? session_start(); 



switch($_POST['mode']){

  case 0:
      delete_work($_POST['workid']);
  break;

  case 1:
      delete_lineup($_POST['workid']);
  break;
}









//刪除工作
function delete_work($workid){

include("sqlsrv_connect.php");

    //驗證 這公司是否有刪除此工作的權限
	$sql = "select company_id FROM work where id=?";
	$stmt = sqlsrv_query($conn, $sql, array($workid));
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );

	if($_SESSION['username'] == $row[company_id]){

        $sql = "DELETE FROM work WHERE id = ?";
        $stmt = sqlsrv_query($conn, $sql, array($workid));

        if($stmt) {
            sqlsrv_free_stmt($stmt);
            echo "刪除成功";
        }
        else die(print_r( sqlsrv_errors(), true));
    }
    else{
    	echo "資料驗證不正確 無刪除";
    }

}


//取消應徵
function delete_lineup($workid){

include("sqlsrv_connect.php");

    $sql = "DELETE FROM line_up WHERE work_id = ? and user_id =? and [check] IN (0,2,3)";
    $stmt = sqlsrv_query($conn, $sql, array($workid,$_SESSION['username']));

    if($stmt) {
        sqlsrv_free_stmt($stmt);
        echo "取消成功";
    }
    else die(print_r( sqlsrv_errors(), true));


}





?>