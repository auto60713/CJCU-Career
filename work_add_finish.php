<?php  session_start(); ?>
<html>
<head>
    <title>長大職涯網</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
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
$recruited_date = trim($_POST['recruited_date']);
$bg_date = trim($_POST['bg_date']);
$ed_date = trim($_POST['ed_date']);
if(isset($_POST['match_dep_set'])) $match_dep = trim($_POST['match_dep_set']);
else $match_dep = "";
$work_prop = trim($_POST['work_prop']);
$isoutside = trim($_POST['isoutside']);
$zone_id = trim($_POST['zone_name']);
$recruitment_no = trim($_POST['recruitment_no']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
if(isset($_POST['pay_data']))$pay = trim($_POST['pay_data']);
else $pay = "";
if(isset($_POST['detail']))$detail = trim($_POST['detail']);
else $detail = "";
$up_data = date ("Y-m-d H:i:s");


//廠商代PO
if( $_POST['instead_com']!="0" ) { $company_id = trim($_POST['instead_com']); $publisher = 1; }

if( !isset($name) || !isset($work_type) || !isset($work_prop) || !isset($isoutside) || !isset($zone_id) || !isset($address) || !isset($recruitment_no) || $zone_id==0){
    echo "Enter the details are incorrect!!";
    exit;

}else{

    include("sqlsrv_connect.php");

    $sql = "INSERT INTO work(name,publisher,company_id,work_prop_id,match_dep,work_type_id,recruited_date,start_date,end_date,is_outside,zone_id,address,phone,pay,[recruitment _no],detail,[check],up_data) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $params = array($name,$publisher,$company_id,$work_prop,$match_dep,$work_type,$recruited_date,$bg_date,$ed_date,$isoutside,$zone_id,$address,$phone,$pay,$recruitment_no,$detail,$check,$up_data);
    $result = sqlsrv_query($conn, $sql, $params);
    $echo_text = "工作新增成功!";
    if($result){

        //如果是公司
    if($_SESSION['level'] == 4){
        //寄信給管理員
        include_once("send_email.php"); 
        send_email("career@mail.cjcu.edu.tw","長大職涯網有新的工作「".$name."」需要審核","<h1><a href='http://careerweb.cjcu.edu.tw/staff_manage.php#staff-audit0'>前往查看</a></h1>");
    
        $echo_text = "工作新增成功! 請等待校方審核..";
    }

        echo '<script>document.location.href="'.$href.'_manage.php#'.$href.'-work";</script>';
    }
    else die(print_r( sqlsrv_errors(), true));
}
?>



</body>
</html>
