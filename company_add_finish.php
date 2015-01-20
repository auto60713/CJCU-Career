<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("sqlsrv_connect.php");

$id      = trim($_POST['id']);
$pw      = trim($_POST['pw']);
$ch_name = trim($_POST['ch_name']);
if(isset($_POST['en_name'])) $en_name = trim($_POST['en_name']);
else $en_name = "";
$phone   = trim($_POST['phone']);
if(isset($_POST['fax'])) $fax = trim($_POST['fax']);
else $fax = "";
$uni_num = trim($_POST['uni_num']);
$boss_name = trim($_POST['boss_name']);
$email   = trim($_POST['email']);
$type    = trim($_POST['type']);
$zone_id = trim($_POST['zone_name']);
$address  = trim($_POST['address']);
$staff_num = trim( $_POST['staff_num']);
if(isset($_POST['budget'])) $budget = trim($_POST['budget']);
else $budget = "";
if(isset($_POST['url'])) $url = trim($_POST['url']);
else $url = "";
if(isset($_POST['introduction'])) $introduction = trim($_POST['introduction']);
else $introduction = "";
$doc = "";


if(empty($id) || empty($pw) || empty($ch_name) || empty($phone) || empty($uni_num) || empty($boss_name) || empty($address)){
	echo '資料有缺失!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=add_company.php>';
}
else{
    // 新增公司
	// MD5加密
	$pw = md5($pw);
    $sql = "INSERT INTO company (id,pw,ch_name,en_name,phone,fax,uni_num,boss_name,email,type,zone_id,address,staff_num,budget,url,introduction,doc,censored) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array($id,$pw,$ch_name,$en_name,$phone,$fax,$uni_num,$boss_name,$email,(int)$type,(int)$zone_id ,$address,(int)$staff_num,(int)$budget,$url,$introduction,$doc, 0 );
    //type,zone_id,censored資料型態都只有0跟1

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {

        echo '註冊失敗...錯誤類型:"公司無法註冊"';
        die( print_r( sqlsrv_errors(), true));
    }
    else{
        //新增通知系統
        $sql = "INSERT INTO notify (user_no,user_level,isnews) VALUES (?, ?, ?)";
        $params = array($id, 1 , 0);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ) {

        echo '註冊失敗...錯誤類型:"通知系統"';
        }
        else{

        $_SESSION['username'] = $id;
        $_SESSION['level'] = 4;

        echo '註冊成功! 登入中...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

        //寄信給管理員
        include_once("send_email.php"); 
        send_email("komicabot@gmail.com","長大職涯網有新的廠商註冊「".$ch_name."」需要審核","<h1><a href='http://localhost/cjcuweb/staff_manage.php#staff-audit0'>前往查看</a></h1>");
    
        }
	
	}

}

?>