<?php session_start(); 
include('cjcuweb_lib.php');
if($_SESSION['level'] == $level_student){
	if(trim($_SESSION['username']) != $_GET['userid']){

    echo "<br>No permission";
 	exit; 
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script> 
	$(function(){

		$('#view-header').load('public_view/header.php #header');

		
        
		<?php  //load data
		    include_once("js_detail.php"); echo_student_profile($_GET['userid']); 
		?>

        $(".profile-pic-img").attr("src",'http://esrdoc.cjcu.edu.tw/esr_photo/'+student_profile_array['sd_syear'].trim()+'/'+student_profile_array['sd_no'].trim()+'.jpg');

		$('title,#sd_name').text(student_profile_array['sd_name']);
		$('#sd_no').text(student_profile_array['sd_no']);
		$('#sd_birthday').text(student_profile_array['sd_birthday']);

        $('#es_name').text(student_profile_array['es_name']);

        $('#dm_data').text(student_profile_array['dm_name']+student_profile_array['sd_grade']+student_profile_array['cla_name']);
        $('#sd_syear').text(student_profile_array['sd_syear']);

        $('#sd_addr').text(student_profile_array['sd_addr']);
        $('#sd_phone').text(student_profile_array['sd_phone']);


	});
	</script>

</head>

<body>


<div id="view-header"></div>

<div class="b-space div-align">


<div class="profile-content overfix">
<div class="profile-boxleft">
	<h2>關於</h2>

	<img class="profile-pic-img" src="">

	<!-- 以下欄位為此系統最後決定之履歷表 -->
    <h3>基本資訊</h3>
	<p><span class="profile-span-title">姓名</span><span id="sd_name"></span></p>
	<p><span class="profile-span-title">學號</span><span id="sd_no"></span></p>
	<p><span class="profile-span-title">生日</span><span id="sd_birthday"></span></p>

    <br><hr><br>
	<h3>學校資訊</h3>
    <p><span class="profile-span-title">學制</span><span id="es_name"></span></p>
	<p><span class="profile-span-title">系所班級</span><span id="dm_data"></span></p>
    <p><span class="profile-span-title">使用配當</span><span id="sd_syear"></span></p>

    <br><hr><br>
	<h3>聯絡資訊</h3>
	<p><span class="profile-span-title">地址</span><span id="sd_addr"></span></p>
	<p><span class="profile-span-title">電話</span><span id="sd_phone"></span></p>

	<br><hr><br>


</div>


<div class="profile-boxright">

<div class="profile-boxinner"><h2>電子履歷</h2>
尚未開放
</div>

</div>


</div>





</div>

</body>
</html>