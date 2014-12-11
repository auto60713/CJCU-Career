<?php
function echo_work_sub_data(){

include("sqlsrv_connect.php");

//此php為進階搜尋要使用的資料呼叫

$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);


// 取得目前時間
$year_array = array();
$year = (int)date("Y"); 
$year_array[] = $year;
$year_array[] = $year++;
$year_array[] = $year++;
echo "var year_array = ". json_encode($year_array) . ";\n";



// 取得"工作類型"資料表
$work_type = array();
$work_type_id = array();
$params = array(0);
$sql = "select * from work_type where parent_no=?";
$result = sqlsrv_query($conn, $sql, $params , $options );
while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
	$work_type_id[] = $row[0];
	$work_type[] = $row[1];
}
echo "work_type_id = ". json_encode($work_type_id) . ";\n";
echo "work_type = ". json_encode($work_type) . ";\n";



// 取得"工作性質"資料表
$work_prop = array();
$work_prop_id = array();
$params = array();
$sql = "select * from work_prop";
$result = sqlsrv_query($conn, $sql, $params , $options );
while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
	$work_prop_id[] = $row[0];
	$work_prop[] = $row[1];
}
echo "var work_prop_id = ". json_encode($work_prop_id) . ";";
echo "var work_prop = ". json_encode($work_prop) . ";";


//因配合搜尋功能 將所有的ARRAY改為全域宣告

}
?>