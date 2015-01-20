<?php
session_start(); 
//管理員的處理事項 

if($_SESSION['level']!=1) { echo "No permission"; exit; }
//權限管理


switch($_POST['mode']){

  case 0://關閉不合法工作
      close_work($_POST['workid']);
  break;

  case 1://關閉不合法公司
      close_company($_POST['comid']);
  break;

  case 2://新增系所
      add_department($_POST['depid'],$_POST['depname']);
  break;

  case 3://系所改帳號
      dep_no_updata($_POST['id'],$_POST['no']);
  break;

  case 4://刪除系所
      dep_delete($_POST['id']);
  break;
}


function dep_delete($id){

include("sqlsrv_connect.php");

    $sql = "DELETE FROM department WHERE id = ?";
    $stmt = sqlsrv_query($conn, $sql, array($id));

    if($stmt) {
        sqlsrv_free_stmt($stmt);
        echo "Success";
    }
    else die(print_r( sqlsrv_errors(), true));


}



//關閉不合法工作
function close_work($work_id){

  include_once("sqlsrv_connect.php");

  $sql = "update work set [check]=(?) where id=?"; 

  if( sqlsrv_query($conn, $sql, array(2,$work_id)) ) echo 'Success';     

}

//關閉不合法公司
function close_company($com_id){

  include_once("sqlsrv_connect.php");

  $sql = "update company set [censored]=(?) where id=?"; 

  if( sqlsrv_query($conn, $sql, array(2,$com_id)) ) echo 'Success';     

}

//新增系所
function add_department($dep_no,$dep_name){

  include_once("sqlsrv_connect.php");

  $sql = "INSERT INTO department (no,pw,sort,ch_name) VALUES (?, ?, ?, ?)";

  if( sqlsrv_query($conn, $sql, array($dep_no,1234,1,$dep_name)) ) echo 'Success';     

}


function dep_no_updata($id,$no){

  include_once("sqlsrv_connect.php");

  $sql = "update department set no=(?) where id=?"; 

  if( sqlsrv_query($conn, $sql, array($no,$id)) ) echo '已經儲存修改';     

}
    

?>