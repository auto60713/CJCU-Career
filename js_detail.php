<?php

/* SQL語法裡面應該要盡量使用別名 不然輸出JSON欄位都被人猜光光*/

if($_GET["stu_no"]) echo_student_detail($_GET["stu_no"]);

/* to profile -------------------------   */

/* 學生 */
function echo_student_profile($stu_no){
include("sqlsrv_connect.php");

	$sql = "select sd_stud_no sd_no,sd_stud_name sd_name,sd_birthday,es_system_name es_name,dm_dep_short_name dm_name,sd_grade_now sd_grade,cla_class_name cla_name,sd_entrance_syear sd_syear,sd_contact_addr sd_addr,sd_cell_phone sd_phone "
		  ."from career_student_data where sd_stud_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($stu_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var student_profile_array = ". json_encode($row) . ";\n";

}


/* 管理員 */
function echo_staff_profile($id){
include_once("sqlsrv_connect.php");

	$sql = "SELECT user_name name FROM cjcu_user WHERE user_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var staff_profile_array = ". json_encode($row) . ";\n";

}


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

/* 學生資料全印出 */
/* 此function為交換機領資料的關鍵 */
function echo_student_detail($user_id){
include_once("sqlsrv_connect.php");

	
	$sql = "select * from career_student_data where sd_stud_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id,$user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var user_detail_array = ". json_encode($row) . ";\n";

}


/* 公司+pofile */
function echo_company_detail($com_id){

include("sqlsrv_connect.php");

    $sql = "select c.ch_name,c.en_name,c.phone,c.fax,c.email,c.uni_num,c.boss_name,t.name typename,z.name zone_name,c.address,c.staff_num,c.budget,c.url,c.introduction,c.censored "
	      ."from company c,zone z,company_type t "
	      ."where c.id= ? and c.type=t.id and c.zone_id=z.id";

	$stmt = sqlsrv_query($conn, $sql, array($com_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var company_detail_array = ". json_encode($row) . ";";
}

/* 公司的位置跟類型 */
function echo_company_type_and_zone($work_id){
include("sqlsrv_connect.php");

// 取出公司類型編號 (因為detail_array是直接取得typename)
    $sql = "select type,zone_id "
	      ."from company "
	      ."where id= ?";

	$stmt = sqlsrv_query($conn, $sql, array($work_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 

	else die(print_r( sqlsrv_errors(), true));

    echo "var company_type = ".$row[type].";";
    echo "var company_zone = ".$row[zone_id].";";
}





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

/* 管理員 */
function echo_staff_detail($user_no){
include_once("sqlsrv_connect.php");

	$sql = "select user_name,role "
	      ."from cjcu_user "
	      ."where user_no= ?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_no));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var staff_detail_array = ". json_encode($row) . ";\n";

}


/* to work detail ------------------------- */

/* 公司或系所的資料 to work detail */
function echo_publisher_detail($pub,$id){

include("sqlsrv_connect.php");
if($pub == 1){

    $sql = "select id,ch_name name,phone,boss_name boss,email FROM company WHERE id= ?";
}
else if(($pub == 2)){

    $sql = "select no id,ch_name name,phone,name boss,email FROM department WHERE no= ?";
}

	$stmt = sqlsrv_query($conn, $sql, array($id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    //發布者
    echo "var publisher_detail_array = ". json_encode($row) . ";";
}


?>

