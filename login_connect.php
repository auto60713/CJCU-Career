<?session_start();?>

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
    case "department":
        department_login($conn,$userid,$pw,$level_department);
    break;
    // 竄改資料,登入失敗
    default: login_echo(0);
}


function school_login($conn,$userid,$pw){

    //此登入包含 管理員.指導老師.學生 三種身分 均稱作學校登入

    $sql = "select * from cjcu_user where user_no=?";
    $params  = array($userid);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $result  = sqlsrv_query( $conn , $sql , $params , $options );
    if( $result ){

    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    
        // 資料表查無帳號 , 沒有輸入
        if(count($row) != 0 && $userid != null && $pw != null){

            //管理員驗證
            if($row[role] == 1){
            $_SESSION['username'] = $row[user_no];
            $_SESSION['level']  = $row[role];

            login_echo(2);
            }
            //計中驗證
            else{
            $_SESSION['username'] = $row[user_no];
            $_SESSION['level']  = $row[role];

            login_echo(3);
            }
        }
        else{
            login_echo(0);
        }
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

            login_echo(1);
	    }
        
	    else{

	    	login_echo(0);
	    }
	
    }
}

function department_login($conn,$userid,$pw,$level_department){

    $sql = "select * from department where no=?";
    $params  = array($userid);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $result  = sqlsrv_query( $conn , $sql , $params , $options );
    if( $result ){

    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
    
        // 資料表查無帳號 , 沒有輸入或密碼不符

        if(count($row) != 0 && $userid != null && $pw != null && (trim($row[1])) == $pw){

            $_SESSION['username'] = $userid;
            $_SESSION['level'] = $level_department;

            login_echo(1);
        }
        
        else{

            login_echo(0);
        }
    
    }
}




function login_echo($login_msg){

    switch ($login_msg) {
    case 1:
        echo '登入成功! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    break;
    case 2:
        echo '管理員驗證成功! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    break;
    case 3:
        echo '計中驗證成功! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    break;
    default: 
        echo '帳號或密碼錯誤! 跳轉中...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    }

}

session_write_close(); 

?>