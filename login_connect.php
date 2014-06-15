<?session_start();

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

$sel    = (trim($_POST['sel']));
$userid = (trim($_POST['id']));
$pw     = (trim($_POST['pw']));

switch ($sel) {
    case "school":
        school_login($conn,$userid,$pw);
    break;
    case "company":
        company_login($conn,$userid,$pw,$level_company);
    break;
    case "staff":
        staff_login($conn,$userid,$pw,$level_teacher,$level_staff);
    break;
    // 竄改資料,登入失敗
    default: login_echo(0);
}


function school_login($conn,$userid,$pw){

    //日後帳號將是計中管理 本系統僅作帳號驗證
    //此登入包含 管理員.指導老師.學生 三種身分 均稱作學校登入

    $sql = "select * from cjcu_user where user_no=?";
    $params  = array($userid);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $result  = sqlsrv_query( $conn , $sql , $params , $options );
    if( $result ){

    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    
        // 資料表查無帳號 , 沒有輸入
        if(count($row) != 0 && $userid != null && $pw != null){

            $_SESSION['username'] = $row[user_no];
            $_SESSION['level']  = $row[role];
            $_SESSION['level2'] = $row[role];

            login_echo(1);
        }
        else{
            login_echo(0);
        }
    }
}


function staff_login($conn,$userid,$pw,$level_teacher,$level_staff){

    // 未完成與學校方面連結驗證 測試版(尚未定案)
    if($userid=='wu'){
        $_SESSION['username'] = $userid;
        $_SESSION['level'] = $level_staff;
         $_SESSION['level2'] = $level_staff;
        login_echo(1);
    }
    else if($userid=='chou'){
        $_SESSION['username'] = $userid;
        $_SESSION['level'] = $level_teacher;
        $_SESSION['level2'] = $level_teacher;
        login_echo(1);
    }
    else{
        login_echo(0);
    }
    
}

function company_login($conn,$userid,$pw,$level_company){

    $sql = "select * from company where id=?";
    $params  = array($userid);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $result  = sqlsrv_query( $conn , $sql , $params , $options );
    if( $result ){

	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
	
	    // 資料表查無帳號 , 沒有輸入或密碼不符
	    if(count($row) != 0 && $userid != null && $pw != null && $row[1] == md5($pw)){

            $_SESSION['username'] = $userid;
            $_SESSION['level'] = $level_company;
            $_SESSION['level2'] = $level_company;

            login_echo(1);
	    }
        
	    else{

	    	login_echo(0);
	    }
	
    }
}


function login_echo($os){

    if($os == 1){
        echo '登入成功! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    }else{
        echo '帳號或密碼錯誤! 跳轉中...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    }
}

session_write_close(); 

?>