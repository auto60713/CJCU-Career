<?php session_start(); 
$filename = 'img_company/'.$_GET['companyid'].'.jpg';
if (!file_exists($filename)) $filename = 'img_company/default.png';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/manage.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script><?php include_once("js_detail.php");	echo_company_detail($_GET['companyid']); 	?></script>
	<script><?php include_once('js_work_list.php'); echo_pass_work_array($_GET['companyid']);  ?></script>
	<script> 
	$(function(){

		$.ajax({
			url:  'public_view/header.php',
			type: 'POST',
			data: {},
			success: function(data) {
                $('#view-header').html(data);
            }
		});
		
		$('.profile-pic-change, #profile-btn-edit').hide();

		// load into container company_detail_array
		$('title , #profile-name').text(company_detail_array['ch_name']);
		$('#ch_name').text(company_detail_array['ch_name']);
		$('#en_name').text(company_detail_array['en_name']);
		$('#boss').text(company_detail_array['boss_name']);
		$('#stuffnum').text(company_detail_array['staff_num']);
		//$('#unicode').text(company_detail_array['uni_num']);
		//$('#budget').text(company_detail_array['budget']);

		$('#phone').text(company_detail_array['phone']);
		$('#email').text(company_detail_array['email']);
		$('#fax').text(company_detail_array['fax']);
		$('#address').text(company_detail_array['zone_name']+" "+company_detail_array['address']);
		$('#cptype').text(company_detail_array['typename']);
		$('#cpurl').append($('<a>').attr({'target':'_blank','href':company_detail_array['url']}).text(company_detail_array['url']));
		$('#introduction').text(company_detail_array['introduction']);

		var listbox = $('#profile-worklist');
		if(pass_work_array.length == 0){listbox.append("目前沒有職缺");}
		else{
		    for(var i=0;i<pass_work_array.length;i++){
		    	var container = $('<p>').addClass('profile-span-box'),
		    	tita = $('<a>').attr('href', 'work-'+pass_work_array[i]['wid']).addClass('profile-span-left').text(pass_work_array[i]['wname']),
		    	titloc = $('<span>').addClass('profile-span-right').text((pass_work_array[i]['isout']=='0'?'校外 ':'校內 ')+ pass_work_array[i]['propname']);
		    	listbox.append(container.append(tita).append(titloc));
		    }
		}

	

	});
	</script>

</head>

<body>


<div id="view-header"></div>

<div class="b-space div-align">




<div class="profile-content overfix">
<div class="profile-boxleft">
<h2>關於 <a id="profile-btn-edit" href="company_manage.php">修改</a> </h2>
<div class="profile-pic">
	<img class="profile-pic-img" src="<?php echo $filename; ?>">
</div>

<h3>公司資訊</h3>
<p><span class="profile-span-title">中文名稱</span><span id="ch_name"></span></p>
<p><span class="profile-span-title">英文名稱</span><span id="en_name"></span></p>
<p><span class="profile-span-title">公司類型</span><span id="cptype"></span></p>
<p><span class="profile-span-title">負責人</span><span id="boss"></span></p>
<p><span class="profile-span-title">員工數</span><span id="stuffnum"></span></p>
<br><hr><br>

<h3>聯絡方式</h3>
<p><span class="profile-span-title">電話</span><span id="phone"></span></p>
<p><span class="profile-span-title">傳真</span><span id="fax"></span></p>
<p><span class="profile-span-title">信箱</span><span id="email"></span></p>
<p><span class="profile-span-title">地址</span><span id="address"></span></p>
<br><hr><br>


<h3>相關連結</h3>
<p><span class="profile-span-title">公司網站</span><span id="cpurl"></span></p>


</div>

<div class="profile-boxright">

<div class="profile-boxinner"><h2>簡介</h2>
<span id="introduction"></span>
</div>

<div class="profile-boxinner" id="profile-worklist">
	<h2>公司職缺</h2>
</div>

</div>



</div>



</div>




</body>
</html>