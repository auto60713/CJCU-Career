<?php
session_start(); 
include_once("cjcuweb_lib.php");
// 立刻驗證登入身分，防止駭客繞過登入
if(isset ($_SESSION['username'])){
	$company_id = $_SESSION['username'];
}
else{ //重定向瀏覽器 且 後續代碼不會被執行 
header("Location: index.php");
exit;
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("sqlsrv_connect.php");

// 取得所有表單資料並防止注入
$name =  trim($_POST['name']);
$work_type = (int)trim($_POST['work_type_list2']);
$work_prop = (int)trim($_POST['work_prop']);
$isoutside = (int)trim($_POST['isoutside']);
$zone_id = (int)trim($_POST['zone_name']);
$recruitment_no = (int)trim($_POST['recruitment_no']);
$recruited_date = trim($_POST['recruited_date']);
$bg_date = trim($_POST['bg_date']);
$ed_date = trim($_POST['ed_date']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$pay = trim($_POST['pay_data']);
$detail = trim($_POST['detail']);
$workid = trim($_POST['work-id']);
$up_data = date ("Y-m-d H:i:s");
/* 驗證該工作是否為目前登入的公司所有,如果是才給予繼續
if(!isCompanyWork($conn,$_SESSION['username'],$workid)){echo '你沒有權限訪問改頁面!!'; exit();}
function isCompanyWork($conn,$companyid,$workid){
	$sql = "select company_id from work where id=?";
	$params = array($workid);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	if($row[0]==$companyid) return true;
	else return false;
}
*/
if( !isset($name) || !isset($work_type)  || !isset($work_prop) || !isset($address) || !isset($isoutside) || !isset($recruitment_no) || $zone_id==0){
	echo "Enter the details are incorrect!!!";
	exit;
}else{



	$params = array($name,$work_type,$recruited_date,$bg_date,$ed_date,$work_prop,$isoutside,$zone_id,$address,$phone,$pay,$recruitment_no,$detail,$up_data,$workid);

	$sql = "update work 
			set name=?,work_type_id=?,recruited_date=?,start_date=?,end_date=?,
			work_prop_id=?,is_outside=?,zone_id=?,address=?,phone=?,pay=?,
			[recruitment _no]=?,detail=?,up_data=?
			where id=?";

	$result = sqlsrv_query($conn, $sql, $params);

	if($result){

        if($_SESSION['level'] == 4||$_SESSION['level'] == 6) $who_page = "company";
        else if($_SESSION['level'] == 1) $who_page = "staff";
        else $who_page = "department";

		echo '更新成功! 跳轉中，請稍候...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url='.$who_page.'_manage.php#work'.$workid.'-0>';
	}
	else{
		echo '更新失敗! 請聯絡管理員';
		exit;
	}
}
?>