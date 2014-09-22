<?session_start(); 

//主機設定
//http://belleaya.pixnet.net/blog/post/27410978-%5B%E6%95%99%E5%AD%B8%5D-php-%E5%88%A9%E7%94%A8-phpmailer-%E9%80%8F%E9%81%8E-gmail-%E5%AF%84%E4%BF%A1

include('cjcuweb_lib.php');
include_once("sqlsrv_connect.php");


  $address = trim($_POST['mail']);
      

  $sql = "select id,pw,ch_name name,email mail from company where email =?"; 
  $stmt = sqlsrv_query($conn, $sql, array($address));

  if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
  else die(print_r( sqlsrv_errors(), true));

    if($row[mail]!=$address) echo "很抱歉，我們的記錄中沒有該電子郵件地址，請重試。";
    else{

        $subject = "您好~".$row[name]." 這裡是帳號管理協助。";
        $message = "帳號:".$row[id]."<br>密碼:".md5($row[pw]);
        $FromName = "長榮大學職涯發展組";

        //地址,標題,內容,寄件者
        email_send($address,$subject,$message,$FromName);

        

    }







function email_send($address,$subject,$message,$FromName){

    require("../phpMailer/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 


    $mail->Username = "komicabot@gmail.com";
    $mail->Password = "ejo3vm4up6";
    //這邊是你的gmail帳號和密碼
    $name="廠商";
    //收件者的名稱

    //地址/收件者稱呼,標題,內容(可html),寄件者名稱
    $mail->AddAddress($address,$name);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->FromName = $FromName;

    $mail->SMTPSecure = "ssl";
    $mail->SMTPKeepAlive = true;
    $mail->Mailer = "smtp";


    $mail->From = "unll";
    //回覆信件至此信箱

    $mail->AddReplyTo($webmaster_email,"Squall.f");
    $mail->WordWrap = 50;
    //每50行斷一次行

    //$mail->AddAttachment("/XXX.rar");
    //附加檔案可以用這種語法

    $mail->IsHTML(true); 
    //send as HTML

    if(!$mail->Send()) echo $mail->ErrorInfo;
    //如果有錯誤會印出原因
    else{
    
    echo "電子郵件已寄出，請至對應電子信箱確認。";
    }

}



?>