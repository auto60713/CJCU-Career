<?

/* to profile -------------------------   */


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







?>

