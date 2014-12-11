<?php
session_start(); 

if(isset ($_SESSION['username'])){
 $user_id=$_SESSION['username'];


//$chick = $_POST['check'];
$work_id = $_POST['work_id'];

//工作的階段定義 目前並無直接使用
$pass = 1;
$nopass = 2;
$again = 3;
$enroll = 4;
$noenroll = 5;
$finish = 6;


//變更工作的應徵狀況

/*

這支 ajax 目前僅供 學生 要求再次審核其應徵所用 (check=3)
因此從原先由前端post一個 check 值是非常危險的作法
改由直接固定 check =3 寫死的做法

假設該工作已經審核通過，駭客還可以由本程式把通過的改為要求再次審核
因此需要判斷目前 line_up 該工作是否為不通過(check=2)
若為不通過，才可以進行要求再次審查

*/

	include_once("sqlsrv_connect.php");

	$sql  = "select [check] from line_up where user_id=? and work_id=?"; 
	$stmt = sqlsrv_query($conn, $sql, array( $user_id , $work_id ));

	if($stmt){

		$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

		if( $row['check'] =='2' ){

			$sql2  = "update line_up set [check]=3 where user_id =(?) and work_id=(?)"; 

			//$result = sqlsrv_query($conn, $sql, array( $chick , $user_id , $work_id ));
			$result = sqlsrv_query($conn, $sql2, array( $user_id , $work_id ));
			if($result) echo "OK";
			else echo "NO";

		}
	}
	else echo "NO";
	
}
?>