<?
/* 工作列表轉成JS Array */
function echo_work_list_array(){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

$sql = "select w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date
 from work w,zone z,work_prop p
 where w.zone_id = z.id and work_prop_id = p.id";

//搜尋功能開啟======================
if(isset($_GET['search'])) $sql.= " and w.name like '%".$_GET['search']."%'";
if(isset($_GET['type'])) $sql.= " and w.work_type_id = ".$_GET['type'];
if(isset($_GET['prop'])) $sql.= " and w.work_prop_id = ".$_GET['prop'];
if(isset($_GET['io'])) $sql.= " and w.is_outside = ".$_GET['io'];
if(isset($_GET['zone'])) $sql.= " and w.zone_id = ".$_GET['zone'];
//==================================

$stmt = sqlsrv_query($conn, $sql, array());

$work_list_array = array();

if($stmt) {

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
	
	echo "var work_list_array = ". json_encode($work_list_array) . ";";	

}
else die(print_r( sqlsrv_errors(), true));

}

?>