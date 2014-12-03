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
else if ($mod == "stu") $sql = "SELECT sd_stud_name username FROM career_student_data WHERE sd_stud_no = ?";

        $stmt = sqlsrv_query( $conn, $sql ,array($user));

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        if ($row[username]!='') $GLOBALS['header_name'] = $row[username];
        else { $GLOBALS['header_name'] = $user; }
        
        }

        sqlsrv_free_stmt($stmt);
        //釋放記憶體資源
}

function echo_data($user,$lev){

	include_once("../cjcuweb_lib.php");

	if(isset ($user)){

		echo '<span><a href="logout.php">登出</a></span>';

		if( $lev == $level_company) {
            echo_username($user,'com');
            echo '<span><a href="change_pw.php">修改密碼</a></span>';
            echo '<span id="header-notice"><a href="company_manage.php#company-notice">通知</a></span>';
			echo '<span><a href="company_manage.php">管理</a></span>';
			echo '<span class="username"><a href="company-'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
		else if( $lev == $level_department) {
            echo_username($user,'dep');
            echo '<span><a href="change_pw.php">修改密碼</a></span>';
            echo '<span id="header-notice"><a href="department_manage.php#department-notice">通知</a></span>';
            echo '<span><a href="department_manage.php">管理</a></span>';
			echo '<span class="username"><a href="department-'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
		else if( $lev == $level_student){
            echo_username($user,'stu');
            echo '<span id="header-notice"><a href="student_manage.php#student-notice">通知</a></span>';
            echo '<span><a href="student_manage.php">管理</a></span>';
			echo '<span class="username"><a href="student-'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}
		else if( $lev == $level_staff){
            echo_username($user,'dep');
            echo '<span><a href="change_pw.php">修改密碼</a></span>';
			echo '<span><a href="staff_manage.php">管理</a></span>';
			echo '<span class="username"><a href="department-'.$user.'">'.$GLOBALS['header_name'].'</a></span>';
		}

		else if( $lev == $level_teacher){
            echo_username($user,'user');
            echo '<span><a href="teacher_manage.php">管理</a></span>';
			echo '<span class="username"><a href="http://eportal.cjcu.edu.tw/Syllabus/Home/Eportfolio">'.$GLOBALS['header_name'].'</a></span>';
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
			url: 'ajax_get_news_num.php',
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
        	$('.error_echo').text("").css({lineHeight:"0px",opacity:0});
    	});

    	//登入ajax
    	$( ".btn-submit-login" ).click(function() {
    		var sel = $("select[name=sel]").val(),
    		    id  = $("input:text[name=id]").val(),
    		    pw  = $("input:password[name=pw]").val();


    	//判斷欄位是否為空
			if(id==""){
				$('.error_echo').text("請輸入帳號").animate({lineHeight:"40px",opacity:1}, 200); 
			}
			else if(pw==""){
				$('.error_echo').text("請輸入密碼").animate({lineHeight:"40px",opacity:1}, 200); 
			}
			else {
                $.ajax({
		          type: 'POST',
		          url: 'login_connect.php',
		          data:{sel:sel,id:id,pw:pw},
		          success: function (data){ 
                      if(data==1) location.reload();
                      else $('.error_echo').text("身分或帳號密碼錯誤").animate({lineHeight:"40px",opacity:1}, 200); 
		           
		          }
		        });

			}
		
	    });
	
	});
</script>



<!--<div id="header">-->
    <a href="index.php" style="cursor: pointer;">
	<div class="sub"><img src="http://www.cjcu.edu.tw/zh_tw/images/id.jpg"></div>
	<div class="sub2"> 
        <h1>長大職涯網</h1>
	</div>
	</a>
	<div class="sub3"> 

	</div>
	<div class="sub4"> 
	<? echo_data($user,$lev)	 ?>  
	</div>

<!-- light box -->

<div id="login-lightbox">
<div id="cont" class="login">
<h1>登入 <i class="fa fa-times login-exit" id="login-exit"></i><br></h1>
<div class="form" name="login">
選擇身分：
<select name ="sel" class="login-select">
  <option value="school" selected="selected">學生登入</option>
  <option value="company">公司廠商</option>
  <option value="department">系所單位</option>
  <option value="teacher">老師登入</option>
</select><br>

<span class="error_echo"></span><br>
<i class="fa fa-user login-icon"></i><input type="text" name="id" placeholder="輸入帳號" class="login-input"><br>
<i class="fa fa-lock login-icon"></i><input type="password" name="pw" placeholder="輸入密碼" class="login-input"></span>
<br>
<input type="submit" class="btn-submit-login" name="button" value="登入" />
<a href="forgotpwd.php">忘記密碼</a> 

<p class="login-hint">學生請選擇學校登入，廠商未註冊請先<a href="company_add.php" class="login-signup">註冊新帳號</a>。</p>
</div>
</div>
</div>

</div>



</body>
</html>