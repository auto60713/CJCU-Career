<?php
// 廠商管理工作要用到的AJAX都放在這裡 
// 系所實習媒合
session_start(); 


// 身分
include('cjcuweb_lib.php');



switch($_POST['mode']){

  case 0://移除不該檢視的頁面
      remove_page($_POST['workid']);
  break;

  case 1://改變工作的狀態(結束應徵)
      work_state_change($_POST['workid'],$_POST['check']);
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

  case 6://打實習分數
      set_work_score($_POST['no'],$_POST['score']);
  break;

  case 7://新增管理員
      add_com_staff($_POST['sid'],$_POST['spw'],$_POST['sname'],$_POST['sphone'],$_POST['semail']);
  break;

}



//移除不該檢視的頁面
function remove_page($workid){
  include_once("sqlsrv_connect.php");


  $sql = "select [check] from work where id =?"; 
  $stmt = sqlsrv_query($conn, $sql, array($workid));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  else die(print_r( sqlsrv_errors(), true));

  switch($row['check']){

  case 0: case 2: case 3: //該工作沒通過審核
      echo json_encode( array('#page-apply','#page-start') );
  break;
  default: echo json_encode(0);
  }
}



//工作能執行的動作
function echo_work_divbtn_array($workid){
  include_once("sqlsrv_connect.php");


  $sql = "select work_prop_id,[check] from work where id =?"; 
  $stmt = sqlsrv_query($conn, $sql, array($workid));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  else die(print_r( sqlsrv_errors(), true));

  //幾個array:幾個按鈕 , divbtn_id:按鈕的ID , divbtn_text:按鈕的內容 , divbtn_explain:按鈕的說明
  //if $row['work_prop_id']==3 是實習
  switch($row['check']){

    case 1:  //招募狀態
        echo json_encode(array(array('divbtn_id'=>'divbtn-stop','divbtn_text'=>"停止招募",'divbtn_explain'=>'停止應徵後工作招募將不會在首頁出現')));
    break;
    case 4:case 5:  //停止招募狀態
        echo json_encode(array(array('divbtn_id'=>'divbtn-restart','divbtn_text'=>'繼續招募','divbtn_explain'=>'工作上架,且當前的應徵者狀態不會改變')));
    break;

    default: echo json_encode(0);
  }

}


//(0未審核,1通過(應徵中),2未通過,3要求再審,4停止應徵(工作中),5=工作完成,22=不錄取且不能重新再審(工作已被關閉),24=假性刪除)


//改變工作的狀態
function work_state_change($workid,$check){
	include_once("sqlsrv_connect.php");

//改變工作狀態
    	$sql = "update work set [check]=(?) where id =?"; 
      if( !sqlsrv_query($conn, $sql, array($check,$workid)) ) echo '更新工作狀態失敗';

//如果結束應徵 沒錄取的通通變成不通過且不能再審
  if($check==4){

      $sql = "update line_up set [check]=22 where work_id =? and [check] in (0,2,3)"; 
      if( !sqlsrv_query($conn, $sql, array($workid)) ) echo '錯誤! 沒錄取的學生依然可以要求再審';
  }
//如果重新應徵 讓大家可以要求再審
  if($check==1){

      $sql = "update line_up set [check]=3 where work_id =? and [check] = 22"; 
      if( !sqlsrv_query($conn, $sql, array($workid)) ) echo '錯誤! 不能要求再審的學生無法應徵';
  }
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

$sql = "SELECT u.sd_stud_no stuid,u.sd_stud_name stuname,l.match_no tid 
        FROM career_student_data u,line_up l 
        WHERE l.work_id=? AND u.sd_stud_no=l.user_id AND (l.[check]=1 OR l.[check]>3)";

$para = array($workid);
$stmt = sqlsrv_query($conn, $sql, $para);


    if($stmt) {

      $match_stu_array = array();

      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )  $match_stu_array[] = $row;

      echo json_encode($match_stu_array); 
    }


}



//打實習分數
function set_work_score($no,$score){
  include_once("sqlsrv_connect.php");


  $sql  = "update line_up set score=(?) where no=?"; 

  if( sqlsrv_query($conn, $sql, array((int)$score,(int)$no)) ) echo '1';     
  else echo '操作失敗!';
    
}

//新增管理員
function add_com_staff($id,$pw,$name,$phone,$email){
  include_once("sqlsrv_connect.php");

    $id = $_SESSION['username']."-".$id;
    $pw = md5($pw);
    $sql = "INSERT INTO company (id,pw,ch_name,phone,email,boss_name,censored) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($id,$pw,$name,$phone,$email,$_SESSION['username'],5);
  
    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {

        echo 'Database write error';
        die( console.log('PHP:'.sqlsrv_errors())  );
    }
    else{ echo 1;}
   

    
}







?>