<?php session_start(); 


switch($_POST['mode']){

  case 1://更新工讀單心得
      updata_WTL_review($_POST['listno'],$_POST['review']);
  break;

  case 2://顯示工讀單心得
      echo_WTL_review($_POST['listno']);
  break;

  case 22://顯示工讀單心得轉hr
      echo_WTL_review_hr($_POST['listno']);
  break;

  case 3://審核通過工讀單
      WTL_pass($_POST['listno']);
  break;

}



function updata_WTL_review($listno,$review){

  include_once("sqlsrv_connect.php");

  $sql = "update work_time_list set review=(?) where no=?"; 

  if( sqlsrv_query($conn, $sql, array($review,$listno)) ) echo 'Success';     

}

function WTL_pass($listno){

  include_once("sqlsrv_connect.php");

  $sql = "update work_time_list set [check]=(?) where no=?"; 

  if( sqlsrv_query($conn, $sql, array(2,$listno)) ) echo 'Success';     

}

function echo_WTL_review($listno){

  include_once("sqlsrv_connect.php");

  $sql = "select review from work_time_list where no=?"; 
  $stmt = sqlsrv_query($conn, $sql, array($listno));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  echo trim($row['review']);

}

function echo_WTL_review_hr($listno){

  include_once("sqlsrv_connect.php");

  $sql = "select [check],review from work_time_list where no=?"; 
  $stmt = sqlsrv_query($conn, $sql, array($listno));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  $data = str_replace("\n", "<hr>", $row['review']);
  echo $row['check']."*.*".$data;

}

?>