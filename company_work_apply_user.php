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



$sql = "update line_up
		set [check]=?
		where user_id=? and work_id=?";

$params = array($check,$userid,$workid);
$result = sqlsrv_query($conn, $sql, $params);


if(!$result){
	echo "0-1";exit;
}



$sql = "UPDATE cjcu_notify
SET isnews = 1 ,time = GETDATE()
WHERE user_no=? and user_level = ?";
$params = array($userid,0);
$result = sqlsrv_query($conn, $sql, $params);

if($result){

	$sql = "insert into msg(send,send_level,recv,recv_level,mcontent,url)
	values (?,?,?,?,?,?)	";
	$params = array($_SESSION['username'],1,$userid,0,'您的工作已被審核','');
	$result = sqlsrv_query($conn, $sql, $params);

	if(!$result){
		echo "0-2"; exit;
	}
	
}




$sql2 = "insert into apply_audit(company_id,work_id,censored,msg)"
		." values(?,?,?,?)";
$params2 = array($_SESSION['username'],$workid,$check,$msg);
$result2 = sqlsrv_query($conn, $sql2, $params2);

if(!$result2){echo "0-3"; exit;}





?>