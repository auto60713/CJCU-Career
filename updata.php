<?php session_start(); 

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

include_once("cjcuweb_lib.php");

//取得登入者的ID跟LEVEL權限

if(isset($_SESSION['username']) $userid = $_SESSION['username'];
if(isset($_SESSION['level']) $userlevel = $_SESSION['level'];

//檢查目前登入者的LEVEL (驗證用)
	switch ($userlevel) {


        case 5:case 1: //系所
	        $params = array($_POST['ch_name'],$_POST['en_name'],$_POST['phone'],$_POST['fax'],$_POST['name'],$_POST['email']);
	        array_push($params,$_POST['address'],$_POST['introduction'],$_POST['url']);
	        department_updata($userid,$params);
	    break;


	    case 4: //公司
	        $params = array($_POST['ch_name'],$_POST['en_name'],$_POST['phone'],$_POST['fax'],$_POST['uni_num'],$_POST['boss_name'],$_POST['email']);
	        array_push($params,$_POST['type'],$_POST['zone_name'],$_POST['address'],$_POST['budget'],$_POST['introduction'],$_POST['staff_num'],$_POST['url']);
	        company_updata($userid,$params);
	    break;

	  


	    default: 
	        echo "you are hacker!";
	    break;
    }



//系所的資料修改
function department_updata($userid,$params)
	{
		include_once("sqlsrv_connect.php");
		
		$sql  = "update department set ch_name=(?), en_name=(?), phone=(?), fax=(?), name=(?), email=(?), address=(?), introduction=(?), url=(?) where no ='".$userid."'"; 
        
        if( sqlsrv_query($conn, $sql, $params) )
        {
        	if($_SESSION['level']==5) echo '修改成功!<meta http-equiv=REFRESH CONTENT=1;url="department_manage.php#department-info">';
            else if($_SESSION['level']==1) echo '修改成功!<meta http-equiv=REFRESH CONTENT=1;url="staff_manage.php#staff-info">';
        }
        else
        {
                echo '修改失敗!';
                die( print_r( sqlsrv_errors(), true));
        }
      
	}

//廠商的資料修改
function company_updata($userid,$params)
	{
		include_once("sqlsrv_connect.php");
		
		$sql  = "update company set ch_name=(?), en_name=(?), phone=(?), fax=(?), uni_num=(?), boss_name=(?), email=(?), type=(?), zone_id=(?), address=(?), budget=(?), introduction=(?), staff_num=(?), url=(?) where id ='".$userid."'"; 
        
        if( sqlsrv_query($conn, $sql, $params) )
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=1;url="company_manage.php#company-info">';
        }
        else
        {
                echo '修改失敗!';
                die( print_r( sqlsrv_errors(), true));
        }
      
	}



?>
