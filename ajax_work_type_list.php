<?
include("sqlsrv_connect.php");

$id = trim($_POST['id']) ;
$list = trim($_POST['list'])  ;

$table=($list=='1')?"work_type_two":"work_type_three";
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array($id);
$sql = "select id,name from ".$table." where parent_no=?";
$result = sqlsrv_query($conn, $sql, $params , $options );
if($result){
	echo '<option>請選擇</option>';
	while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
		echo '<option value="'.$row[0].'">'.$row[1].'</option>';
	}
}
else die(print_r( sqlsrv_errors(), true));
?>