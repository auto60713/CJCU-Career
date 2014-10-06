<?

//列出該系上所有的"實習中"的學生
function echo_line_up_array($dep_no){

include("sqlsrv_connect.php");

$sql = "select u.user_no userid,u.user_name username,w.id wid,w.name wname,c.id comid,c.ch_name comname,l.no line_no
 from line_up l,cjcu_user u,work w,company c
 where l.[check]=4 and l.match_no is NULL and u.dep_no=? and l.user_id=u.user_no and w.id=l.work_id and c.id=w.company_id";

$para = array($dep_no);
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $line_up_array = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$line_up_array[] = $row;
	}

	echo "var line_up_array = ". json_encode($line_up_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}




//列出該系上所有的老師
function echo_dep_teacher_array($dep_no){

include("sqlsrv_connect.php");

$sql = "select u.user_no teacherid,u.user_name teachername from cjcu_user u where u.dep_no=? and role=2";

$para = array($dep_no);
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $dep_teacher_array = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$dep_teacher_array[] = $row;
	}

	echo "var dep_teacher_array = ". json_encode($dep_teacher_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}




//列出該系上所有的實習
function echo_match_list_array($dep_no){

include("sqlsrv_connect.php");

$sql = "SELECT w.id workid,w.name workname,w.[check] state,c.id comid,c.ch_name comname FROM work w,company c
WHERE w.match_dep=? AND (w.[check]=1 OR w.[check]>3) AND c.id=w.company_id 
ORDER BY workid DESC";

$para = array($dep_no);
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $match_list_array = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$match_list_array[] = $row;
	}

	echo "var match_list_array = ". json_encode($match_list_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}



//列出該老師所對應的實習資料
function echo_match_teacher_array($tea_no){

include("sqlsrv_connect.php");

$sql = "SELECT w.id workid,w.name workname,w.[check] state,c.id comid,c.ch_name comname,u.user_no stuid,u.user_name stuname 
FROM line_up l,work w,company c,cjcu_user u
WHERE l.match_no=? AND w.id=l.work_id AND c.id=w.company_id AND u.user_no=l.user_id";

$para = array($tea_no);
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $match_teacher_array = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$match_teacher_array[] = $row;
	}

	echo "var match_teacher_array = ". json_encode($match_teacher_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}


?>