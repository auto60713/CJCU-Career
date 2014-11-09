<?
/*
本程式為管理員對於 工作 或 公司 進行審查後，修改審查紀錄
*/

session_start(); 
session_write_close();

// 審核頁面  身分驗證
include('cjcuweb_lib.php');

if($_SESSION['level']!=$level_staff){
	echo "0-1"; 
	exit; 
}


//data: {censored:c, obj_id:obj_id, type:t, msg:m},
include("sqlsrv_connect.php");
$staff_no = $_SESSION['username'];
$censored = trim($_POST['censored']);
$obj_id = trim($_POST['obj_id']);
$type = trim($_POST['type']) ;
$msg = trim($_POST['msg']) ;
$obj_name = trim($_POST['obj_name']) ;


// 新增一筆審核紀錄
$params = array($staff_no,$type,$obj_id,$censored,$msg);
$sql = "insert into audit(staff_no,type,obj_id,censored,msg)"
		." values(?,?,?,?,?)";
$result = sqlsrv_query($conn, $sql, $params);

if(!$result){
	echo '0-2';
	exit;
}
else{
	// 判斷要修改公司或是工作的資料表
	switch ($type) {
		case '0':
			$table = 'company';
			$cname = 'censored';
			break;
		case '1':
			$table = 'work';
			$cname = '[check]';
			break;
		default:
			echo '0-3'; exit;
	}
	// 修改審核欄位資料
	$params2 = array($censored,$obj_id);
	$sql2 = "update ".$table." set ".$cname."=? where id=?";
	$result2 = sqlsrv_query($conn, $sql2, $params2);

	if(!$result2){
		echo '0-4';
		exit;
	}
	else{
		// 修改完畢後，新增一筆新的通知紀錄
		include_once('msg_lib.php');
		$recvid = ($type=='0')? $obj_id : get_work_id($conn,$obj_id);
		//echo '0-5-'.$recvid; exit; 
		if( $recvid=='0'){
			echo '0-5-'.$recvid;  exit; 		}

		$recvtxt=($type=='0')?"註冊的公司":"發布的工作";
		$chtxt = ($censored==1)?"通過":"不通過";
		$icon = ($censored==1)?"fa fa-check":"fa fa-times";
		
		$arr =
		array(
		      'conn'=>          $conn,
		      'sender_id'=>     $_SESSION['username'],
		      'sender_level'=>  $_SESSION['level'],
		      'recv_id'=>       $recvid,
		      'recv_level'=>    $level_company,
		      'msg'=>           '您'.$recvtxt.'<b>「'.$obj_name.'」</b>，已被審核<b>'.$chtxt.'</b>，請前往查看。',
		      'icon'=>          $icon
		);
		if(!send_msg($arr)){
			echo "0-6"; exit;
		}

	}




}


function get_work_id($conn,$obj_id){

$params = array($obj_id);
$sql = "select company_id from work where id=?";
$result = sqlsrv_query($conn, $sql, $params );
if($result){
	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ;
	return $row[0];
}
else 
	return '0';

}


?>