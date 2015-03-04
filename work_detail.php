<?php session_start(); 
include_once("cjcuweb_lib.php");

if(isset($_GET['workid'])) $work_id=$_GET['workid']; else{header("Location: index.php"); exit;}
if(isset($_SESSION['username'])) $user_id = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="js/jquery.js"></script>
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<style type="text/css">
	#ch{
		font-size: 16px;

		margin-left: 10px;
	}
	#date{
		font-size: 12px;
		color: #555;
	}
	#btn-apply{
		width: 100px;
		height: 40px;
		font-size: 16px;
		background-color: #991133;
		color: #FFF;
		text-align: center;
		font-weight: bold;
		border: none;
		cursor: pointer;
		margin-top: 50px;
	}

	#btn-apply:hover{
		background-color: #E0184A;
	}
	</style>
	<script>

	<?php
	include_once("js_work_detail.php"); 
	echo_work_detail_array($_GET['workid']);

	include_once('js_work_list.php'); 
	echo_pass_work_array($GLOBALS['cust_company']);  

	include_once("js_detail.php"); 
	echo_publisher_detail($GLOBALS['publisher'],$GLOBALS['cust_company']); 

	?> 

	</script>
	<script>


	$(function(){	

		$('#view-header').load('public_view/header.php');
		$("#menu").load('public_view/menu.html');
	    $("#footer").load('public_view/footer.html');


		$('title, #name').text(work_detail_array['name']);
		$('#date').text("發佈時間："+work_detail_array['date'].split(" ")[0]);
		$('#prop').text( (work_detail_array['is_outside']=='0'?'校外':'校內')+' '+ work_detail_array['popname']);
		$('#type').text(work_detail_array['typeone']+" > "+work_detail_array['typetwo']+" > "+work_detail_array['typethree']);
		$('#rno').text(work_detail_array['recruitment _no']);
		$('#pay').text(work_detail_array['pay'].split("-")[0] + work_detail_array['pay'].split("-")[1]);
		$('#work_date').text(work_detail_array['start_date'].split(" ")[0]+" ~ "+work_detail_array['end_date'].split(" ")[0]);
		$('#phone').text(work_detail_array['phone']);
		$('#address').text(work_detail_array['address']);
		$('#detail').html(work_detail_array['detail']);

        //優化UI避免與應徵工作混淆
        switch(work_detail_array['check']) {

	        case 0: $('#ch').text('等待審核').css('color', '#444'); break;
		    case 1: $('#ch').text('正在招募').css('color', '#339933'); break;
		    case 3: case 2: $('#ch').text('停止招募').css('color', '#CF6363'); break;   
		    case 4: $('#ch').text('實習中').css('color', '#339933'); break;
        }

		<?php
			function isapplywork($user_id,$work_id){
				include("sqlsrv_connect.php");
				$sql="select count(user_id) from line_up where user_id=? and work_id=?";
		        $params = array($user_id,$work_id);
		        $result = sqlsrv_query($conn, $sql, $params);
		        if($result){
		        	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);   
		        	if($row[0]==0) return true;
		        	return false;
		       }else return false;
			}
			if(isset($_SESSION['username']) && $_SESSION['level']==$level_student && isapplywork($user_id,$work_id))
				echo "show_apply_form();";
		?>

		function show_apply_form(){
			var wid= $('<input>').attr({type: 'hidden',	name: 'workid'}).val(<?php echo $_GET['workid'];?>),
			submit = $('<input>').attr({type: 'submit',name: 'button',id:'btn-apply'}).val('我要應徵'),
			form = $('<form>').attr({name:'getjobform',method:'post',action:'student_apply_job.php',id:'apply_form'});
			$('.profile-boxleft').append(form.append(wid).append(submit));
		}

		var listbox = $('#other_work');
		if(pass_work_array.length==0) listbox.append("公司目前沒有職缺");
		else{
		for(var i=0;i<pass_work_array.length;i++){
			var container = $('<p>').addClass('profile-span-box'),
			tita = $('<a>').attr('href', 'work-'+pass_work_array[i]['wid']).addClass('profile-span-left').text(pass_work_array[i]['wname']),
			titloc = $('<span>').addClass('profile-span-right').text((pass_work_array[i]['isout']=='0'?'校外 ':'校內 ')+ pass_work_array[i]['propname']);
			listbox.append(container.append(tita).append(titloc));
		}
        }

if(work_detail_array['pub'] ==1){
    var pub_type_name = "關於公司",pub_type = "company";
}
else if(work_detail_array['pub'] ==2){
    var pub_type_name = "關於系所",pub_type = "department";
}
        $('#about_work h2').text(pub_type_name);
		$('#pub_name').append($('<a>').attr({'target':'_blank','href':pub_type+'-'+publisher_detail_array['id']}).text(publisher_detail_array['name']));
		$('#pub_boss').text(publisher_detail_array['boss']);
		$('#pub_phone').text(publisher_detail_array['phone']);
		$('#pub_email').text(publisher_detail_array['email']);



	});
	</script>
</head>


<body>
<div id="view-header"></div>
<div id="menu"></div>


<div class="b-space div-align overfix">
<div class="profile-content overfix">

<div class="profile-boxleft">
<h1><span id="name"></span><span id="ch"></span></h1>
<br>
<span id="date"></span>
<br>
<br>

<h3>工作資訊</h3>
<p><span class="profile-span-title">類型</span><span id="type"></span></p>
<p><span class="profile-span-title">性質</span><span id="prop"></span></p>
<p><span class="profile-span-title">招募人數</span><span id="rno"></span></p>
<p><span class="profile-span-title">待遇</span><span id="pay"></span></p>
<br><hr><br>

<h3>工作時間</h3>
<p>
	<span class="profile-span-title">日期</span><span id="work_date"></span>
</p>
<br><hr><br>

<h3>聯絡方式</h3>
<p><span class="profile-span-title">電話</span><span id="phone"></span></p>
<p><span class="profile-span-title">地址</span><span id="address"></span></p>
<br><hr><br>

<h3>工作說明</h3>
<div id="detail"></div>



</div>


<div class="profile-boxright">

<div class="profile-boxinner" id="about_work"><h2></h2>

<p class="profile-span-box">
<span class="profile-span-left">名稱</span>
<span class="profile-span-right" id="pub_name"></span></p>

<p class="profile-span-box">
<span class="profile-span-left">負責人</span>
<span class="profile-span-right" id="pub_boss"></span></p>

<p class="profile-span-box">
<span class="profile-span-left">連絡電話</span>
<span class="profile-span-right" id="pub_phone"></span></p>

<p class="profile-span-box">
<span class="profile-span-left">信箱</span>
<span class="profile-span-right" id="pub_email"></span></p>


</div>

<div class="profile-boxinner" id="other_work"><h2>公司職缺</h2></div>

</div>


</div>
</div>

<!-- 頁尾訊息 -->
<div id="footer"></div>

</body>
</html>
