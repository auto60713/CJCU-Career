<?php
if($_POST['email']==null){echo 'No permission!'; exit();}
header("Content-Type:text/html; charset=utf-8");


include_once("sqlsrv_connect.php");

      
$sql = "select id,pw,ch_name name,email from company where email =?"; 
$stmt = sqlsrv_query($conn, $sql, array(trim($_POST['email'])));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  else die(print_r( sqlsrv_errors(), true));

  if($row[email]==null) {echo "很抱歉，我們的記錄中沒有該電子郵件地址，請重試。";  exit();}






//開始寄信
require("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; // turn on SMTP authentication
//這幾行是必須的

$mail->CharSet = "utf-8"; //設置字符集編碼
$mail->Encoding = "base64";//設置文本編碼方式


//st937072000@gmail.com
//wetai30254
$mail->Username = "komicabot@gmail.com";
$mail->Password = "xup6ai4u83";
//這邊是你的gmail帳號和密碼

$mail->FromName = "長榮大學-媒合系統";
//寄件者名稱(你自己要顯示的名稱)
$webmaster_email = "cweny@mail.cjcu.edu.tw";
//回覆信件至此信箱


$email= trim($row[email]);
// 收件者信箱
$name="廠商";
// 收件者的名稱or暱稱
$mail->From = $webmaster_email;


$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Squall.f");
//這不用改

$mail->WordWrap = 50;
//每50行斷一次行

//$mail->AddAttachment("/XXX.rar");
// 附加檔案可以用這種語法(記得把上一行的//去掉)

$mail->IsHTML(true); // send as HTML

$mail->Subject = "請妥善保管您的帳號密碼";
// 信件標題
$mail->Body = "<h1><a href='localhost/cjcuweb/change_pw.php?id=".$row[id]."&pw='".$row[pw].">前往修改密碼</a></h1>";
//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)


if(!$mail->Send()){
echo "寄信發生錯誤：" . $mail->ErrorInfo;
//如果有錯誤會印出原因
}
else{
echo "success";
}
?>