<?session_start(); 
if(isset ($_SESSION['username'])){
 $user_id=$_SESSION['username'];


$chick = $_POST['check'];
$work_id = $_POST['work_id'];

//工作的階段定義 目前並無直接使用
$pass = 1;
$nopass = 2;
$again = 3;
$enroll = 4;
$noenroll = 5;
$finish = 6;


//變更工作的應徵狀況
include_once("sqlsrv_connect.php");

		$sql  = "update line_up set [check]=(?) where user_id =(?) and work_id=(?)"; 
		sqlsrv_query($conn, $sql, array( $chick , $user_id , $work_id ));





}?>