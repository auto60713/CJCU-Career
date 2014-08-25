<?
/* 廠商管理工作要用到的AJAX都放在這裡 */

session_start(); 
session_write_close();

// 身分
include('cjcuweb_lib.php');



switch($_POST['mode']){

  case 0:
      work_start($_POST['workid']);
  break;

}







//工作結束應徵
function work_start($workid){
	include_once("sqlsrv_connect.php");
		

	$sql  = "update work set check=4 where id ='".$workid."'"; 
    $params  = array();

        if( sqlsrv_query($conn, $sql) )
        {
                echo '已經結束應徵!';
        }
        else
        {
                echo '操作失敗!';
                die( print_r( sqlsrv_errors(), true));
        }



}




?>