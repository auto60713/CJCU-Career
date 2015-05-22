<?php session_start(); ?>
<html>
<head>
    <title>廠商註冊</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php

include("sqlsrv_connect.php");

$id      = trim($_POST['id']);
$pw      = trim($_POST['pw']);
$ch_name = trim($_POST['ch_name']);
$phone   = trim($_POST['phone']);
$boss_name = trim($_POST['boss_name']);
$contact = trim($_POST['contact']);
$type    = trim($_POST['type']);
$zone_id = trim($_POST['zone_name']);
$address  = trim($_POST['address']);
if(isset($_POST['en_name'])) $en_name = trim($_POST['en_name']);
else $en_name = "";
if(isset($_POST['email'])) $email = trim($_POST['email']);
else $email = "";
if(isset($_POST['fax'])) $fax = trim($_POST['fax']);
else $fax = "";
if(isset($_POST['uni_num'])) $uni_num = trim($_POST['uni_num']);
else $uni_num = "";
if(isset($_POST['staff_num'])) $staff_num = trim($_POST['staff_num']);
else $staff_num = "";
if(isset($_POST['budget'])) $budget = trim($_POST['budget']);
else $budget = "";
if(isset($_POST['url'])) $url = trim($_POST['url']);
else $url = "";
if(isset($_POST['introduction'])) $introduction = trim($_POST['introduction']);
else $introduction = "";
$doc = "";


if(empty($id)||empty($pw)||empty($ch_name)||empty($phone)||empty($boss_name)||empty($contact)||empty($address)){
    echo '<p>資料有缺失!</p>';
    echo '<br><a href="company_add.php">確認</a>';
}
else{

    $sql = "INSERT INTO company (id,pw,ch_name,en_name,phone,fax,uni_num,boss_name,contact,email,type,zone_id,address,staff_num,budget,url,introduction,doc,censored) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array($id,$pw,$ch_name,$en_name,$phone,$fax,$uni_num,$boss_name,$contact,$email,(int)$type,(int)$zone_id ,$address,(int)$staff_num,(int)$budget,$url,$introduction,$doc, 0 );
    //type,zone_id,censored資料型態都只有0跟1

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {

        echo '註冊失敗...錯誤類型:"公司無法註冊"';
        die( print_r( sqlsrv_errors(), true));
    }
    else{
        /*新增通知系統
        $sql = "INSERT INTO notify (user_no,user_level,isnews) VALUES (?, ?, ?)";
        $params = array($id, 1 , 0);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ) {

        echo '註冊失敗...錯誤類型:"通知系統"';
        }
        */

        $_SESSION['username'] = $id;
        $_SESSION['level'] = 4;

        echo '<script>';
        echo 'alert("註冊成功! 歡迎您的使用! 自動登入中...");';
        echo 'document.location.href="index.php";';
        echo '</script>';

        //寄信給管理員
        include_once("send_email.php"); mode(2,$ch_name);
        
    
    }

}

?>
</body>
</html>
