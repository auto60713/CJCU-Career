<?php  session_start(); 
header("Content-Type:text/html; charset=utf-8");

include_once("cjcuweb_lib.php");
// 立刻驗證登入身分，防止駭客繞過登入
if(isset ($_SESSION['username'])){
	$company_id = $_SESSION['username'];
}
else{ //重定向瀏覽器 且 後續代碼不會被執行 
header("Location: index.php");
exit;
}

switch ($_SESSION['level']) {

    case 1:
        $href = 'staff';
        $publisher = '2';
        $check = '1';
    break;

    case 4:
        $href = 'company';
        $publisher = '1';
        $check = '0';
    break;

    case 5:
        $href = 'department';
        $publisher = '2';
        $check = '1';
    break;
}




// 取得所有表單資料並防止注入

$name =  trim($_POST['name']);
$work_type = trim($_POST['work_type_list2']);
if(isset($_POST['match_dep']))$match_dep = trim($_POST['match_dep']);
else $match_dep = "";
$year1 = trim($_POST['year1']);
$month1 = trim($_POST['month1']);
$date1 = trim($_POST['date1']);
$hour1 = trim($_POST['hour1']);
$minute1 = trim($_POST['minute1']);
$year2 = trim($_POST['year2']);
$month2 = trim($_POST['month2']);
$date2 = trim($_POST['date2']);
$hour2 = trim($_POST['hour2']);
$minute2 = trim($_POST['minute2']);
$work_prop = trim($_POST['work_prop']);
$isoutside = trim($_POST['isoutside']);
$zone_id = trim($_POST['zone_name']);
$recruitment_no = trim($_POST['recruitment_no']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
if(isset($_POST['pay']))$pay = trim($_POST['pay']);
else $pay = "";
if(isset($_POST['detail']))$detail = trim($_POST['detail']);
else $detail = "";

//廠商代PO
if( $_POST['instead_com']!=null ) { $company_id = trim($_POST['instead_com']); $publisher = 1; }

if( !isset($name) || !isset($work_type)  || !isset($year1) || !isset($month1) || !isset($date1) || !isset($hour1) || !isset($minute1) 
	|| !isset($work_prop) || !isset($isoutside) || !isset($zone_id) || !isset($address) || !isset($year2) || !isset($month2) || !isset($date2) 
	|| !isset($hour2)  || !isset($minute2) || !isset($recruitment_no) || $zone_id==0){
	echo "Enter the details are incorrect!!";
	exit;

}else{

    include("sqlsrv_connect.php");

	//datetime format  1970-01-01 00:00:00
	$start_date = $year1."-".$month1."-".$date1." ".$hour1.":".$minute1.":00";
	$end_date = $year2."-".$month2."-".$date2." ".$hour2.":".$minute2.":00";

	$sql = "INSERT INTO work(name,publisher,company_id,work_prop_id,match_dep,work_type_id,start_date,end_date,is_outside,zone_id,address,phone,pay,[recruitment _no],detail,[check]) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $params = array($name,$publisher,$company_id,$work_prop,$match_dep,$work_type,$start_date,$end_date,$isoutside,$zone_id,$address,$phone,$pay,$recruitment_no,$detail,$check);
	$result = sqlsrv_query($conn, $sql, $params);
	if($result){
		echo '新增成功! 跳轉中，請稍候...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url='.$href.'_manage.php#'.$href.'-work>';
	}
	else die(print_r( sqlsrv_errors(), true));
}
?>
