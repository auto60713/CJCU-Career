<? 
session_start(); 
include_once("cjcuweb_lib.php");
// 立刻驗證登入身分，防止駭客繞過登入
if(isset ($_SESSION['username']) && $_SESSION['level']==$level_company){
	$company_id = $_SESSION['username'];
}
else{ 
echo "您無權限訪問該頁面!";
exit;
}

include("sqlsrv_connect.php");

// 驗證是否為該公司的工作
$workid = (trim($_POST['workid']));
$userid = (trim($_POST['user']));
$check = (trim($_POST['check']));
$msg = (trim($_POST['msg']));

// 檢查該工作是否為目前登入的公司所有
if(!isCompanyWork($conn,$_SESSION['username'],$workid)){echo '0'; exit();}
function isCompanyWork($conn,$companyid,$workid){
	$sql = "select company_id from work where id=?";
	$params = array($workid);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	//echo "主人是 ".$row[0];
	if($row[0]==$companyid) return true;
	else return false;
}


// 將應徵紀錄的未審核0 改為 審核通過1 或 不通過2
$sql = "update line_up
		set [check]=?
		where user_id=? and work_id=?";

$params = array($check,$userid,$workid);
$result = sqlsrv_query($conn, $sql, $params);

if(!$result){
	echo "0-1";exit;
}


// 用工作ID 取得工作名稱
$work_name='';
$sql = "select name from work where id=?";
$params = array($workid);
$result = sqlsrv_query($conn, $sql, $params);
if($result){
	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ;
	$work_name =  $row[0];
}else {echo '0-2'; exit;};



// 通知系統
// 功能：公司審核學生應徵，通知學生的應徵結果
include_once('msg_lib.php');
$chtxt = ($check=='1')?'通過':'不通過';
$icon =  ($check=='1')?'fa fa-check':'fa fa-times';
$arr =
array(
      'conn'=>          $conn,
      'sender_id'=>     $_SESSION['username'],
      'sender_level'=>  $_SESSION['level'],
      'recv_id'=>       $userid,
      'recv_level'=>    0,
      'msg'=>           '您應徵的工作「<b>'.$work_name.'</b>」審核<b>'.$chtxt.'，</b>請前往查看。',
      'url'=>           '../../../cjcuweb/student_manage.php#student-applywork',
      'icon'=>          $icon
);
if(!send_msg($arr)){
	echo "0-4"; exit;
};

	
// 增加一筆審核紀錄 到資料庫
$sql2 = "insert into apply_audit(company_id,user_id,work_id,censored,msg)"
		." values(?,?,?,?,?)";
$params2 = array($_SESSION['username'],$userid,$workid,$check,$msg);
$result2 = sqlsrv_query($conn, $sql2, $params2);

if(!$result2){echo "0-3"; exit;}





?>