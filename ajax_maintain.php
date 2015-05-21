<?php
session_start(); 
//管理員的處理事項 

if($_SESSION['level']!=1) { echo "No permission"; exit; }
//權限管理


switch($_POST['mode']){

  case 1://關閉不合法工作
      close_work($_POST['workid']);
  break;

  case 2://新增系所
      add_department($_POST['depid'],$_POST['depname']);
  break;

  case 22://新增單位
      add_department2($_POST['dep2id'],$_POST['dep2name']);
  break;

  case 3://系所改帳號
      dep_no_updata($_POST['id'],$_POST['no']);
  break;

  case 4://刪除系所
      dep_delete($_POST['id']);
  break;

  case 5://新增廠商
      add_company($_POST['comid'],$_POST['comname']);
  break;

  case 6://停權廠商
      ban_company($_POST['comid']);
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


//新增系所
function add_department($dep_no,$dep_name){

  include_once("sqlsrv_connect.php");

  $sql = "INSERT INTO department (no,pw,sort,ch_name) VALUES (?, ?, ?, ?)";

  if( sqlsrv_query($conn, $sql, array($dep_no,1234,1,$dep_name)) ) echo 'Success';     

}
//新增單位
function add_department2($dep2_no,$dep2_name){

  include_once("sqlsrv_connect.php");

  $sql = "INSERT INTO department (no,pw,sort,ch_name) VALUES (?, ?, ?, ?)";

  if( sqlsrv_query($conn, $sql, array($dep2_no,1234,2,$dep2_name)) ) echo 'Success';     

}


//新增廠商
function add_company($com_id,$com_name){

  include_once("sqlsrv_connect.php");

  $sql = "INSERT INTO company (id,pw,ch_name,censored) VALUES (?, ?, ?, ?)";

  if( sqlsrv_query($conn, $sql, array($com_id,1234,$com_name,1)) ) echo 'Success';     

}

function dep_no_updata($id,$no){

  include_once("sqlsrv_connect.php");

  $sql = "update department set no=(?) where id=?"; 

  if( sqlsrv_query($conn, $sql, array($no,$id)) ) echo '已經儲存修改';     

}

function ban_company($id){

  include_once("sqlsrv_connect.php");

  $sql = "update company set censored=(?) where id=?"; 

  if( sqlsrv_query($conn, $sql, array(3,$id)) ) echo 'Success';     

}


?>