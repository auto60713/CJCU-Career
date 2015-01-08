<?php

//列出該系上"實習中"而且沒有負責老師的學生
function echo_line_up_array($dep_no){

include("sqlsrv_connect.php");

$dep_no = "%".$dep_no."%";
$sql = "select u.sd_stud_no userid,u.sd_stud_name username,w.id wid,w.name wname,c.id comid,c.ch_name comname,l.no line_no
 from line_up l,career_student_data u,work w,company c
 where l.[check]IN(1,4) and l.match_no is NULL and u.sd_dep_no LIKE ? and l.user_id=u.sd_stud_no and w.id=l.work_id and c.id=w.company_id";

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

$dep_no = "%".$dep_no."%";
$sql = "SELECT w.id workid,w.name workname,w.[check] state,c.id comid,c.ch_name comname 
FROM work w,company c
WHERE (w.match_dep LIKE ? OR w.match_dep LIKE '%all%') AND (w.[check]=1 OR w.[check]>3) AND c.id=w.company_id 
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



//列出所有已建立的系所單位
function echo_dep_list(){

include("sqlsrv_connect.php");

$sql = "select * from department where sort = 1 ORDER BY no";

$para = array();
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $dep_list = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$dep_list[] = $row;
	}

	echo "var dep_list = ". json_encode($dep_list) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}


//列出所有已建立的廠商
function echo_com_list(){

include("sqlsrv_connect.php");

$sql = "select id,ch_name name from company where censored=1 ORDER BY ch_name";

$para = array();
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $all_company = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$all_company[] = $row;
	}

	echo "var all_company = ". json_encode($all_company) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}


//列出該公司的管理員
function echo_com_staff_list($com_id){

include("sqlsrv_connect.php");

$sql = "select id,ch_name name,phone,email from company where boss_name = ? and censored = 5";

$para = array($com_id);
$stmt = sqlsrv_query($conn, $sql, $para);


if($stmt) {

    $com_staff_list = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
    {
		$com_staff_list[] = $row;
	}

	echo "var com_staff_list = ". json_encode($com_staff_list) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}



?>