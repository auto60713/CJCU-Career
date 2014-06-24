<?

/* 公司詳細資料轉成JS Array */
function echo_department_detail_array($dep_no){

include("sqlsrv_connect.php");

    $sql = "select no,name,address,phone from department where no= ?";

	$stmt = sqlsrv_query($conn, $sql, array($dep_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var department_detail_array = ". json_encode($row) . ";";
}


?>

