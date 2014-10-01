<?
include("sqlsrv_connect.php");



$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array($id);
$sql = "select no,ch_name name from department";
$result = sqlsrv_query($conn, $sql, $params , $options );
if($result){
	echo '<option>請選擇</option>';
	while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
		echo '<option value="'.trim($row[0]).'">'.$row[1].'</option>';
	}
}
else die(print_r( sqlsrv_errors(), true));
?>