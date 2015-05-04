<?php session_start(); 
include('cjcuweb_lib.php');
//個資隱私 只有校方跟廠商能看到學生資料
if(!isset($_SESSION['level'])||$_SESSION['level'] == $level_student){
	//但是自己可以看的到
	if(trim($_SESSION['username']) != $_GET['userid']){

        echo "No permission"; exit; 
}}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<script src="js/jquery-min.js"></script>
    <script src="js/jquery-migrate-min.js"></script>
	<script> 
	$(function(){

		$('#view-header').load('public_view/header.php #header');
        $("#menu").load('public_view/menu.html');
	    $("#footer").load('public_view/footer.html');
		
        
		<?php
		    include_once("js_detail.php"); echo_student_profile($_GET['userid']); 
		    include_once("js_work_list.php"); profile_work_list($_GET['userid']); 
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

        //僅列出company的工作 日後需優化
        if(profile_work_list.length == 0) $('#work_list').append($('<p>').text("沒有工作紀錄"));
        else{
		    for(var i=0;i<profile_work_list.length;i++){

		    	var cname = $('<a>').attr('href','company-'+profile_work_list[i]['cid']).text(profile_work_list[i]['cname']),
		    	    wname = $('<a>').attr('href','work-'+profile_work_list[i]['wid']).text(profile_work_list[i]['wname']);
		    	
		    		$('#work_list').append( $('<p>').append(cname,' - ',wname) );
		    }
		}

	});
	</script>

</head>

<body>


<div id="view-header"></div>
<div id="menu"></div>


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
    <p><span class="profile-span-title">入學年</span><span id="sd_syear"></span></p>

    <br><hr><br>
	<h3>聯絡資訊</h3>
	<p><span class="profile-span-title">地址</span><span id="sd_addr"></span></p>
	<p><span class="profile-span-title">電話</span><span id="sd_phone"></span></p>

	<br><hr><br>
    <h3>工作經歷</h3>
	<div id="work_list"></div>

</div>


<div class="profile-boxright">

<div class="profile-boxinner"><h2>電子履歷</h2>
 <p>尚未開放</p>
</div>

</div>


</div>





</div>
<div id="footer"></div>
</body>
</html>