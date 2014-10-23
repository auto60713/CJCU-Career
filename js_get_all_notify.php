
<?
function get_all_notify($user,$level){

	include("sqlsrv_connect.php");

	// except company level = 4 , the rest are < 4
	// if it is company, level is 1 ,else 0
	$level= ($level==4)? 1 : 0;

		$para = array($user , $level , $user , $level);
	
		$sql1 ="select * from msg where (recv=? or recv='-all')
		and time>0";
		//and time>(select time from cjcu_notify where user_no=? and user_level=?) ";

		$sql2 ="select * from msg where (recv=? or recv='-all')
		and time<=0";

		$stmt1 = sqlsrv_query($conn, $sql1, $para);
		$stmt2 = sqlsrv_query($conn, $sql2, $para);

		$msglist_array_new = array();
		$msglist_array_old = array();

		if($stmt1 && $stmt2){

			while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
			 $msglist_array_new[] = $row;

			while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) 
			 $msglist_array_old[] = $row;



		 	$para = array($user , $level);
			$sql = "UPDATE cjcu_notify SET isnews=0 ,time=GETDATE() WHERE user_no=? and user_level=?";
			$stmt = sqlsrv_query($conn, $sql, $para);
			if(!$stmt ) die(print_r( sqlsrv_errors(), true));


		}
		else  die(print_r( sqlsrv_errors(), true));

	    echo "var msglist_array_new = ". json_encode($msglist_array_new).";";
	    echo "var msglist_array_old = ". json_encode($msglist_array_old).";";

}
?>