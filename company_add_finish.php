<? session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("sqlsrv_connect.php");

$id = trim($_POST['id']);
$pw = trim($_POST['pw']);
$ch_name = trim($_POST['ch_name']);
$en_name = trim($_POST['en_name']);
$phone = trim($_POST['phone']);
$fax = trim($_POST['fax']);
$uni_num = trim($_POST['uni_num']);
$name = trim($_POST['name']);
$pic = trim($_POST['pic']);
$email = trim($_POST['email']);
$type = trim($_POST['type']);
$zone_id = trim($_POST['zone_name']);
$adress = trim($_POST['address']);
$budget = trim($_POST['budget']);
$introduction = trim($_POST['introduction']);
$doc = trim($_POST['doc']);
$staff_num =trim( $_POST['staff_num']);
$url = trim($_POST['url']);


if(empty($id) || empty($pw) || empty($ch_name) || empty($uni_num) || empty($name) || empty($address)){
	echo 'You are hacker!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=add_company.php>';
}

else{
    // 新增公司
	// MD5加密
	$pw = md5($pw);
    $sql = "INSERT INTO company (id,pw,ch_name,en_name,phone,fax,uni_num,name,pic,email,type,zone_id,address,budget,introduction,doc,staff_num,censored,url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array($id, $pw , $ch_name , $en_name , $phone , $fax , $uni_num , $name , $pic , $email , (int)$type , (int)$zone_id , $address , (int)$budget , $introduction , $doc , (int)$staff_num, 0 , $url);
    //type,zone_id,censored資料型態都只有0跟1

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {

        echo '註冊失敗...錯誤類型:"公司無法註冊"';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=company_add.php>';

        die( print_r( sqlsrv_errors(), true));
    }
    else{
        //新增通知系統
        $sql = "INSERT INTO cjcu_notify (user_no,user_level,isnews) VALUES (?, ?, ?)";
        $params = array($id, 1 , 0);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ) {

        echo '註冊失敗...錯誤類型:"通知系統"';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=company_add.php>';
        }
        else{

        $_SESSION['username'] = $id;
        $_SESSION['level'] = 4;

        echo '註冊成功! 登入中...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';
        }
	
	}

}

?>