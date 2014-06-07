<?
include("sqlsrv_connect.php");

echo get_work_id($conn,'12');

function get_work_id($conn,$obj_id){

$params = array($obj_id);
$sql = "select company_id from work where id=?";
$result = sqlsrv_query($conn, $sql, $params );
if($result){
	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ;
	return $row[0];
}else die(print_r( sqlsrv_errors(), true));

}
?>