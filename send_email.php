<?php
header("Content-Type:text/html; charset=utf-8");

if(isset($_POST['mode'])) $mode = $_POST['mode']; else $mode = "";
if(isset($_POST['mail_address'])) $mail_address = $_POST['mail_address']; else $mail_address = "";

//需要into的內容{被寄者email,信件標題,內容}
switch($mode){

    case 1://忘記密碼

        include_once("sqlsrv_connect.php");

        $sql = "select id,pw,ch_name name,email from company where email =?"; 
        $stmt = sqlsrv_query($conn, $sql, array( trim($mail_address) ));

        if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
        else die(print_r( sqlsrv_errors(), true));

        if($row['email']==null) {echo "很抱歉，我們的記錄中沒有該電子郵件地址，請重試。";  exit();}

        send_email($row['email'],"請妥善保管您的帳號密碼","<h2>帳號：".$row['id']."</h2><h2>密碼：".$row['pw']."</h2>");
    break;

    case 2://新廠商申請需要審核
        //send_email("komicabot@gmail.com","長大職涯網 有新的廠商註冊需要審核","<h1><a href='http://localhost/cjcuweb/staff_manage.php#staff-audit0'>前往查看</a></h1>");
        //function寫在company_add_finish.php那邊
    break;


}




//開始寄信
function send_email($mail_address,$mail_title,$mail_cont){

/*
//請設定管理員的gmail帳號密碼
$staff_id = "cjcu.department.career@gmail.com";
$staff_pw = "career1820";

require("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; 
//這幾行是必須的

$mail->CharSet = "utf-8"; 
//設置字符集編碼
$mail->Encoding = "base64";
//設置文本編碼方式



$mail->Username = $staff_id;
$mail->Password = $staff_pw;
//這邊是主機的gmail帳號密碼

$mail->FromName = "長大職涯網";
//寄件者名稱(你自己要顯示的名稱)
$webmaster_email = $staff_id;
//回覆信件至此信箱


$email= $mail_address;
//收件者信箱
$name= "親愛的用戶";
//收件者的名稱


$mail->From = $webmaster_email;
$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Squall.f");
//這不用改

$mail->WordWrap = 50;
//每50行斷一次行

//$mail->AddAttachment("/XXX.rar");
//附加檔案可以用這種語法(記得把上一行的//去掉)

$mail->IsHTML(true); 

$mail->Subject = $mail_title;
//信件標題
$mail->Body = $mail_cont;
//信件內容(可使用html語法)



    //如果有錯誤會印出原因
    if( !$mail->Send() ) echo "寄信發生錯誤：" . $mail->ErrorInfo;   
    else */echo "success";
    
}
?>