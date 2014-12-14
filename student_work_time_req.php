<?php session_start(); 
//header("Content-Type:text/html; charset=utf-8");
header("Location: student_manage.php#work".$_POST['work_id']);

include("sqlsrv_connect.php");

$work_id     = trim($_POST['work_id']);
$date   = trim($_POST['work_date']);
$day    = trim($_POST['work_day']);
$time   = trim($_POST['work_time']);
$matter = trim($_POST['work_matter']);
$hour   = trim($_POST['work_hour']);

if(empty($work_id) || empty($date) || empty($day) || empty($time) || empty($matter) || empty($hour)){
	echo 'You enter data missing!';
}
else{

    $sql = "INSERT INTO work_time (work_id,stud_id,date,day,time,matter,hour) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array((int)$work_id,trim($_SESSION['username']),$date,$day,$time,$matter,(int)$hour);
  

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {

        echo 'Database write error';
        die( console.log('PHP:'.sqlsrv_errors())  );
    }
   
}

?>