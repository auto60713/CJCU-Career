<? session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/company_manage.css">
	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script><? include_once("js_detail.php"); echo_student_profile($_GET['userid']); ?></script>
	<script> 
	$(function(){

		$('.profile-pic-change, #profile-btn-edit').hide();

		$('#view-header').load('../public_view/header.php #header');

		// init load data
		$('title,#username').text(student_profile_array['name']);
		$('#userno').text(student_profile_array['number']);
		$('#depname').text(student_profile_array['depname']);



		<?
			if($_GET['userid']==$_SESSION['userid']){
				echo "isStud();";
			}
		?>

		function isStud(){
			$('#profile-btn-edit').show();
			$('.profile-pic').mouseenter(function(event) {
			$('.profile-pic-change').fadeIn(100);
			}).mouseleave(function(event) {
				$('.profile-pic-change').fadeOut(100);
			});
		}

	});
	</script>

</head>

<body>


<div id="view-header"></div>

<div class="div-align">


<div class="profile-content overfix">
<div class="profile-boxleft">
	<h2>關於 <a id="profile-btn-edit" href="../student_manage.php">修改</a> </h2>
	<div class="profile-pic">
	<img class="profile-pic-img" src="<? echo '../img_user/'.$_GET['userid'].'.jpg' ; ?>">
    </div>

	<!-- 以下欄位皆為參考學生系統之欄位所建 -->

	<p><span class="profile-span-title">姓名</span><span id="username"></span></p>
	<p><span class="profile-span-title">學號</span><span id="userno"></span></p>
	<p><span class="profile-span-title">學制</span><span id=""></span></p>
	<p><span class="profile-span-title">院系所別</span><span id="depname"></span></p>
    <p><span class="profile-span-title">使用配當</span><span id=""></span></p>
    <p><span class="profile-span-title">入學資訊</span><span id=""></span></p>
    <p><span class="profile-span-title">連絡電話</span><span id=""></span></p>
    <p><span class="profile-span-title">電子郵件</span><span id=""></span></p>

    <br><hr><br>
	<h3>基本資訊</h3>

	<p><span class="profile-span-title">出生年月</span><span id=""></span></p>
	<p><span class="profile-span-title">戶籍地址</span><span id=""></span></p>
	<p><span class="profile-span-title">通訊地址</span><span id=""></span></p>
	<p><span class="profile-span-title">求學歷程</span><span id=""></span></p>
    <p><span class="profile-span-title">身分證字號</span><span id=""></span></p>
	<p><span class="profile-span-title">緊急聯絡人</span><span id=""></span></p>

</div>


<div class="profile-boxright">

<div class="profile-boxinner"><h2>電子履歷</h2>
<p id="doc"></p>
</div>

</div>


</div>





</div>

</body>
</html>