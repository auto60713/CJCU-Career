<?

/* 工作列表轉成JS Array */

//首頁顯示的工作
function echo_work_list_array(){

include("sqlsrv_connect.php");

$para = array();

$sql = "select TOP 3 w.company_id cid, w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date
 from work w,zone z,work_prop p
 where w.zone_id = z.id and work_prop_id = p.id and w.[check] = 1";
//check=1 只秀出通過審核的工作

//搜尋功能開啟======================
if(isset($_GET['search'])) $sql.= " and w.name like '%".$_GET['search']."%'";
if(isset($_GET['type'])) $sql.= " and w.work_type_id = ".$_GET['type'];
if(isset($_GET['prop'])) $sql.= " and w.work_prop_id = ".$_GET['prop'];
if(isset($_GET['io'])) $sql.= " and w.is_outside = ".$_GET['io'];
if(isset($_GET['zone'])) $sql.= " and w.zone_id = ".$_GET['zone'];
//==================================
$sql.= " ORDER BY w.id DESC";
//最新的在前面

$stmt = sqlsrv_query($conn, $sql, $para);


$work_list_array = array();

if($stmt) {

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$work_list_array[] = $row;
		//echo $row; 
	}

	echo "var work_list_array = ". json_encode($work_list_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));


//回傳搜尋後的訊息
$work_length = count($work_list_array);
if($work_length != 0) {echo "var search_log_cont = '共有 '+".$work_length."+' 項工作符合條件';";}
else {echo "var search_log_cont = '沒有工作符合搜尋條件!';";}




}



// 公司管理畫面 管理工作 的 工作清單
function echo_work_manage_list_array($companyid){

	include("sqlsrv_connect.php");
	$para = array($companyid);

	$sql = "select w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date,t.name,w.[check] ch
	 from work w,zone z,work_prop p,work_type t
	 where w.zone_id = z.id and work_prop_id = p.id and w.company_id=? and w.work_type_id=t.id ORDER BY w.id DESC;";

	$stmt = sqlsrv_query($conn, $sql, $para);
	$work_list_array = array();

	if($stmt) while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
	else die(print_r( sqlsrv_errors(), true));


		
	for($i=0;$i<count($work_list_array);$i++){

		// 多少人應徵
		$sql = 'select COUNT(l.work_id)c from line_up l where work_id=?';
		$para = array($work_list_array[$i]['wid']);
		$stmt = sqlsrv_query($conn, $sql, $para);
		if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ;
		$work_list_array[$i]['apply_count']=  $row['c'];
		
		// 多少人錄取
		$sql = 'select COUNT(l.[check])c from line_up l where  work_id=? and [check]=1';
		$para = array($work_list_array[$i]['wid']);
		$stmt = sqlsrv_query($conn, $sql, $para);
		if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ;
		$work_list_array[$i]['check_count']=  $row['c'];

	}

		
	echo "var work_list_array = ". json_encode($work_list_array) . ";";	
}	

//僅列出通過審核的工作 (避免其他使用者看到以及應徵)
function echo_pass_work_array($companyid){

	include("sqlsrv_connect.php");
	$para = array($companyid,1);

	$sql = "select w.id wid,w.name wname,w.is_outside isout,p.name propname
	 from work w,work_prop p
	 where work_prop_id = p.id and w.company_id=? and w.[check]=?";

	$stmt = sqlsrv_query($conn, $sql, $para);
	$pass_work_array = array();

	if($stmt) while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $pass_work_array[] = $row;
	else die(print_r( sqlsrv_errors(), true));

	echo "var pass_work_array = ". json_encode($pass_work_array) . ";";	
}	



//學生應徵的工作
function echo_student_apply_list_array($userid){

		include("sqlsrv_connect.php");
//工作的資料
		$sql = "SELECT w.id wid,w.name wname,w.publisher pub,p.name prop,z.name zone,l.[check] ch,l.match_no tea_name 
				FROM work w,line_up l,work_prop p,zone z 
				WHERE l.user_id=? and w.id=l.work_id and p.id=w.work_prop_id and z.id=w.zone_id";

		$stmt = sqlsrv_query($conn, $sql, array($userid));
		$work_list_array = array();


		if($stmt) {
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
		echo "var work_list_array = ". json_encode($work_list_array) . ";";	
		}
		else die(print_r( sqlsrv_errors(), true));

//找公司名字
		$sql2 = "select c.id comid,c.ch_name comname,d.ch_name depname 
				from line_up l,work w,company c ,department d 
				where l.user_id = ? and w.id = l.work_id and (c.id = w.company_id or d.no = w.company_id)";	

		$stmt2 = sqlsrv_query($conn, $sql2, array($userid));
		$pub_name_array = array();


		if($stmt2) {
		while( $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) $pub_name_array[] = $row2;
		echo "var pub_name_array = ". json_encode($pub_name_array) . ";";	
		}
		else die(print_r( sqlsrv_errors(), true));

}




?>