<?
/* 廠商管理工作要用到的AJAX都放在這裡 */

session_start(); 


// 身分
include('cjcuweb_lib.php');



switch($_POST['mode']){

  case 0://移除不該檢視的頁面
      remove_page($_POST['workid']);
  break;

  case 1://開始實習
      work_state_change($_POST['workid'],4);
  break;

  case 2://完成實習,結束應徵
      work_state_change($_POST['workid'],5);
  break;

  case 3://回傳可執行的動作
      echo_work_divbtn_array($_POST['workid']);
  break;


  case 4://系所媒合老師
      department_match($_POST['tea_no'],$_POST['line_no']);
  break;

  case 5://該實習錄取的學生
      match_stu_array($_POST['workid']);
  break;

}






//移除不該檢視的頁面
function remove_page($workid){
  include_once("sqlsrv_connect.php");


  $sql = "select [check] from work where id =?"; 
  $stmt = sqlsrv_query($conn, $sql, array($workid));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  else die(print_r( sqlsrv_errors(), true));

  switch($row[check]){

  case 0: case 2: case 3: //第一階段
      echo json_encode(array(array('#workedit-content-apply','#page-apply'),array('#workedit-content-start','#page-start')));
  break;
  case 1: case 4://第二階段
      echo json_encode(array(array('#workedit-content-edit','#page-edit')));
  break;
  case 5: //第三階段
      echo json_encode(array(array('#workedit-content-edit','#page-edit'),array('#workedit-content-start','#page-start')));
  break;

  }
}



//工作能執行的動作
function echo_work_divbtn_array($workid){
  include_once("sqlsrv_connect.php");


  $sql = "select work_prop_id,[check] from work where id =?"; 
  $stmt = sqlsrv_query($conn, $sql, array($workid));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  else die(print_r( sqlsrv_errors(), true));

 //幾個array:幾個按鈕 , divbtn_id:按鈕的ID , divbtn_text:按鈕的內容
switch($row[work_prop_id]){

  case 3:  //實習

          switch($row[check]){

          case 1:  //應徵中
              echo json_encode(array(array('divbtn_id'=>'divbtn-start','divbtn_text'=>'開始實習')));
          break;

          case 4:  //實習中
              echo json_encode(array(array('divbtn_id'=>'divbtn-end','divbtn_text'=>'完成實習')));
          break;

          default: echo json_encode(0);
          }
  break;

  default: //工讀
      echo json_encode(array(array('divbtn_id'=>'divbtn-end','divbtn_text'=>'結束應徵')));

}

}


//改變工作的狀態
function work_state_change($workid,$check){
	include_once("sqlsrv_connect.php");

  $sql = "select work_prop_id,[check] from work where id =?"; 
  $stmt = sqlsrv_query($conn, $sql, array($workid));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

    switch($check){

          case 4: 
              $text = '結束應徵並開始實習!';
          break;

          case 5:  
              switch($row[work_prop_id]){

              case 3:  //實習
                  $text = '完成實習!';
              break;
                      
              default:
                  $text = '結束應徵!';
              }
             
          break;
    }
		
//改變工作狀態
	$sql  = "update work set [check]=(?) where id =?"; 
//改變應徵狀態
//只改變該工作有錄取(以上)的
  $sql2  = "update line_up set [check]=(?) where work_id =? and [check] IN (1,4)"; 
//沒錄取的通通變成不通過
  $sql3  = "update line_up set [check]=2 where work_id =? and [check] <4"; 

  

        if( sqlsrv_query($conn, $sql, array($check,$workid)) ){
          if( sqlsrv_query($conn, $sql2, array($check,$workid)) ){
            if( sqlsrv_query($conn, $sql3, array($workid)) ){

                echo $text;

            }else echo '操作失敗!狀況三';
          }else echo '操作失敗!狀況二';
        }else echo '操作失敗!狀況一';


}



//新增媒合配對
function department_match($tea_no,$line_no){
  include_once("sqlsrv_connect.php");


  $sql  = "update line_up set match_no=(?) where no=?"; 

  if( sqlsrv_query($conn, $sql, array($tea_no,(int)$line_no)) ) echo 'Success';     
  else echo '操作失敗!';
    
}



//該實習錄取的學生
function match_stu_array($workid){

include("sqlsrv_connect.php");

$sql = "SELECT u.user_no stuid,u.user_name stuname FROM cjcu_user u,line_up l WHERE u.user_no=l.user_id AND l.work_id=? AND (l.[check]=1 OR l.[check]>3)";

$para = array($workid);
$stmt = sqlsrv_query($conn, $sql, $para);


    if($stmt) {

      $match_stu_array = array();

      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )  $match_stu_array[] = $row;

      echo json_encode($match_stu_array); 
    }


}



?>