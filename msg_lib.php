<?
    /*
    * 通知系統 send_msg  method
    * 參數 arr 為一陣列(須為以下格式，唯msg可選填，其餘不可為空)

      array(
      'conn'=>          $conn,
      'sender_id'=>     $sender_id,
      'sender_level'=>  $sender_level,
      'recv_id'=>       $recv_id,
      'recv_level'=>    $recv_level,
      'msg'=>           $msg,
      'url'=>           $url,
      'icon'=>          $icon
      );

    * conn 資料庫連線物件
    * sender_id 傳送人，通常為SESSION['username']
    * sender_level 傳送人等級，通常為SESSION['level']
    * recv_id 接收人，會收到通知的人
    * recv_level 接收人等級，通常需要先判斷為1~4其中之一
    * msg 傳送訊息(純字串)
    * url 連結的位置(點了會連到哪裡)
    * icon 為一個 font-awesome ICON 的 class 

    */

function send_msg($arr){

    $conn = $arr['conn'];
    $sender_id = $arr['sender_id'];
    $sender_level = ($arr['sender_level']==4)?1:0;
    $recv_id =  $arr['recv_id'];
    $recv_level = ($arr['recv_level']==4)?1:0;
    $msg = $arr['msg'];
    $icon = $arr['icon'];

    $sql1 = "UPDATE notify SET isnews = 1 ,time = GETDATE() WHERE user_no=? and user_level = ?";
    $sql2 = "insert into msg(send,send_level,recv,recv_level,mcontent,icon) values (?,?,?,?,?,?)";

    $params1 = array($recv_id,$recv_level);
    $params2 = array($sender_id,$sender_level,$recv_id,$recv_level,$msg,$icon);

    $result1 = sqlsrv_query($conn, $sql1, $params1);
    $result2 = sqlsrv_query($conn, $sql2, $params2);

    if($result1 && $result2) return true;
    else return false;
    
}
?>