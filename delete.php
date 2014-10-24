<? session_start(); 



switch ($_SESSION['level']) {

    case 1:
        $publisher = 'staff';
    break;

    case 4:
        $publisher = 'company';
    break;

    case 5:
        $publisher = 'department';
    break;
}




switch($_POST['mode']){

  case 0:
      delete_work($_POST['workid'],$_POST['workname'],$publisher);
  break;

  case 1:
      delete_lineup($_POST['workid']);
  break;
}




//刪除工作(暫不開放)
function delete_work($workid,$workname,$publisher){

include("sqlsrv_connect.php");

    //驗證 這公司是否有刪除此工作的權限
	$sql = "select company_id FROM work where id=?";
	$stmt = sqlsrv_query($conn, $sql, array($workid));
	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );

	if($_SESSION['username'] == $row[company_id]){

        //廠商留紀錄
        $sql = "INSERT INTO msg(recv,mcontent,icon) values(?,?,?)";
        $para = array($row[company_id],'您已刪除工作「<b>'.$workname.'</b>」','fa fa-times');
        sqlsrv_query($conn, $sql, $para);

        //刪除
        $sql = "DELETE FROM work WHERE id = ?";
        $stmt = sqlsrv_query($conn, $sql, array($workid));

        if($stmt) {
            sqlsrv_free_stmt($stmt);

            //查詢此工作有哪些應徵者 並且還沒錄取
            $sql1 = "SELECT user_id FROM line_up WHERE work_id =? AND [check] IN (0,2,3)"; 
            $stmt = sqlsrv_query($conn, $sql1, array($workid));
            if($stmt) while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
                //通知那些應徵者
                $sql3 = "INSERT INTO msg(recv,mcontent,icon) values(?,?,?)";
                $para = array($row[user_id],'你所應徵的工作「<b>'.$workname.'</b>」已被原廠商刪除','fa fa-times');
                sqlsrv_query($conn, $sql3, $para);
               
            }
            //將此工作的還沒錄取的應徵者轉成不錄取
            $sql2 = "UPDATE line_up SET [check]=22 WHERE work_id =? AND [check] IN (0,2,3)"; 
            sqlsrv_query($conn, $sql2, array($workid));
           


            echo $publisher;
        }
        else die(print_r( sqlsrv_errors(), true));
    }
    else{
    	echo "0";
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