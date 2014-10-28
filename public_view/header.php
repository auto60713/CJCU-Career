<? 
session_start();
$lev = $_SESSION['level'];
$user = $_SESSION['username'];


//抓取資料庫 此username的用戶名稱
function echo_username($user,$mod){

    include("../sqlsrv_connect.php");
     if ($mod == "com")  $sql = "SELECT ch_name  username FROM company WHERE id = ?";
else if ($mod == "dep")  $sql = "SELECT ch_name username FROM department WHERE no = ?";
else if ($mod == "user") $sql = "SELECT user_name username FROM cjcu_user WHERE user_no = ?";

        $stmt = sqlsrv_query( $conn, $sql ,array($user));

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        if ($row[username]!='') $GLOBALS['header_name'] = $row[username];
        else { $GLOBALS['header_name'] = $user; }
        
        }

        sqlsrv_free_stmt($stmt);
        //釋放記憶體資源
}

function echo_data($user,$lev){
	//if($lev=='0')$lev = $_SESSION['level2'];

	include_once("../cjcuweb_lib.php");

	if(isset ($user)){

		echo '<span><a href="../../../cjcuweb/logout.php">登出</a></span>';

		if( $lev == $level_company) {
            echo_username($user,'com');
            echo '<span id="header-notice"><a href="../../../cjcuweb/company_manage.php#company-notice">通知</a></span>';
			echo '<span><a href="../../../cjcuweb/company_manage.php">管理</a></span>';
			echo '<span class="username"><a href="../../../cjcuweb/company/'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
		else if( $lev == $level_department) {
            echo_username($user,'dep');
            echo '<span id="header-notice"><a href="../../../cjcuweb/department_manage.php#department-notice">通知</a></span>';
            echo '<span><a href="../../../cjcuweb/department_manage.php">管理</a></span>';
			echo '<span class="username"><a href="../../../cjcuweb/department/'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
		else if( $lev == $level_student){
            echo_username($user,'user');
            echo '<span id="header-notice"><a href="../../../cjcuweb/student_manage.php#student-notice">通知</a></span>';
            echo '<span><a href="../../../cjcuweb/student_manage.php">管理</a></span>';
			echo '<span class="username"><a href="../../../cjcuweb/student/'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
		else if( $lev == $level_staff){
            echo_username($user,'dep');
			echo '<span id="header-notice"><a href="../../../cjcuweb/department_manage.php#staff-notice">通知</a></span>';	
			echo '<span><a href="../../../cjcuweb/staff_manage.php">管理</a></span>';
			echo '<span class="username"><a href="../../../cjcuweb/staff/'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}

		else if( $lev == $level_teacher){
            echo_username($user,'user');
            echo '<span><a href="../../../cjcuweb/teacher_manage.php">管理</a></span>';
			echo '<span class="username"><a href="../../../cjcuweb/teacher/'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
	}	
	else echo '<span><a href="#" id="login-btn">登入</a></span>';
}



?>


<html>
<body>
<div id="header" class="div-align">
<script>

	$(function(){

		//polling();
		function polling(){
			$.ajax({
			url: '../../../cjcuweb/ajax_get_news_num.php',
			type: 'get',
			})
			.done(function(d) {

				console.log('Get News Num:',d);
				$('.header-notice-num').remove();
				

				if(d!='0')
					$('#header-notice a').append($('<span>').addClass('header-notice-num').html(d));
				//else
					//$('#header-notice a').append($('<span>').addClass('header-notice-num').text(data));
			});
			setTimeout(function(){ polling();},5000);
		}

		$('#header-notice').click(function(event) {
			$('.header-notice-num').remove();
		});



		$('#login-btn').on('click', function(){
       		 $( "#login-lightbox" ).css( "display", "block" ); 
    	});

   		$( "#login-exit" ).click(function() {
        	$( "#login-lightbox" ).css( "display", "none" ); 
    	});

    	//判斷欄位是否為空
	    function check_data(){
		    $("#cont").find("span").text("");
			var boo = true;
			if(document.login.sel.value ==""){$('#sel-null').text("請選擇身分"); boo = false;}
			else if(document.login.id.value ==""){$('#id-null').text("請輸入帳號"); boo = false;}
			else if(document.login.pw.value ==""){$('#pw-null').text("請輸入密碼"); boo = false;}
			else $('#pw-null').text("");
			return boo;
	    }
	
	});
</script>



<!--<div id="header">-->
	<!--舊的<div class="sub"><a href="../../../cjcuweb/home.php"><h1>長大職涯網</h1></a></div>-->
	<div class="sub"><a href="../../../cjcuweb/home.php"><img src="http://www.cjcu.edu.tw/zh_tw/images/id.jpg"></a></div>
	<div class="sub2"> 
	<? echo_data($user,$lev)	 ?>  
	</div>

<!-- light box -->

<div id="login-lightbox">
<div id="cont" class="login">
<h1>登入 <i class="fa fa-times login-exit" id="login-exit"></i><br></h1>
<form class="form" name="login" method="post" action="../../../cjcuweb/login_connect.php" onsubmit="return check_data()">
選擇身分：<select name ="sel" class="login-select">
  <option value="school" selected="selected">在校師生(校友)</option>
  <option value="company">公司廠商</option>
  <option value="department">系所單位</option>
</select><br>

<span class="null-echo" id="sel-null"></span><br>
<i class="fa fa-user login-icon"></i><input type="text" name="id" placeholder="輸入帳號" class="login-input"><span class="null-echo" id="id-null" ></span><br>
<i class="fa fa-lock login-icon"></i><input type="password" name="pw" placeholder="輸入密碼" class="login-input"><span class="null-echo" id="pw-null" ></span>
<br>
<input type="submit" class="btn-submit" name="button" value="登入" />
<a href="forgotpwd.php">忘記密碼</a> 

<p class="login-hint">學生請選擇學校登入，廠商未註冊請先<a href="company_add.php" class="login-signup">註冊新帳號</a>。</p>
</form>
</div>
</div>

</div>



</body>
</html>