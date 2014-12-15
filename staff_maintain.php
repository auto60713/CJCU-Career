<?php
session_start(); 
if(isset($_SESSION['level'])){
    if($_SESSION['level']!=1){ 
    	echo "No permission"; exit; 
    }
}
else{ 
	echo "No permission"; exit; 
}
?>

<!doctype html>
<html>
<head>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css?v=0">
	<script>

	$(function(){

		// TAB Control 
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});
		tabgroup[0].click();

	});

	</script>

</head>

<body>

<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 工作</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-building-o tab-img"></i> 公司</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-book tab-img"></i> 系所</div>
</div>


<div class="workedit-content" id='workedit-content'>

    <!--工作-->
	<div tabtoggle='workedit2' class="work_page">

        <h1 class="title">關閉不合法工作</h1>
        <table>
        <tr><td style="width:140px">請輸入工作編號</td><td><input type="text" name="close_work_id" value=""></td></tr>
        </table>
        <button type="button" onclick="close_work()">送出</button>
	</div>

    <!--公司-->
	<div tabtoggle='workedit2' class="com_page workedit-content-hide">
        <h1 class="title">關閉不合法公司</h1>
        <table>
        <tr><td style="width:140px">請輸入公司帳號</td><td><input type="text" name="close_com_id" value=""></td></tr>
        </table>
        <button type="button" onclick="close_company()">送出</button>
	</div>

    <!--系所-->
	<div tabtoggle='workedit2' class="dep_page workedit-content-hide">
        <h1 class="title">新增系所</h1>
        <table>
        <tr><td style="width:140px">請輸入系所帳號</td><td><input type="text" name="dep_id" value=""></td></tr>
        <tr><td>系所中文名稱</td><td><input type="text" name="dep_name" value=""></td></tr>
        <tr><td>密碼預設</td><td><input type="text" name="dep_pw" value="1234" disabled></td></tr>
        </table>
        <button type="button" onclick="add_department()">送出</button>
	</div>
</div>

</body>
<script type="text/javascript">

function echo_work_name(workid) {

		$.ajax({
			type:"POST",
			url: "ajax_echo_name.php",
			data:{mode:'work',workid:workid},
              success: function (data) { 
                  if(data != 0) return data;
              }
		});    	
}


//關閉工作
function close_work() {

	var workid = $('input:text[name=close_work_id]').val();
	var workname = echo_work_name(workid);

	if (confirm ("確定要關閉工作「"+workname+"」?")){

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:0,workid:workid},
              success: function (data) { 
              	if(data == 'Success'){
              	   var log = $('<h4>').addClass('log').text("已經關閉工作「"+workname+"」了");
              	   $('.work_page').append(log);
              	}
			    else alert(data);
			  }
		});    	

	}
}

//關閉公司
function close_company() {

	var comid = $('input:text[name=close_com_id]').val();
	if (confirm ("確定要關閉公司 "+comid+" ?")){

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:1,comid:comid},
              success: function (data) { 
              	if(data == 'Success'){
              	   var log = $('<h4>').addClass('log').text("已經關閉公司"+comid+"了");
              	   $('.com_page').append(log);
              	}
			    else alert(data);
			  }
		});    	

	}
}
 

//新增系所
function add_department() {

	var dep_id = $('input:text[name=dep_id]').val();
	var dep_name = $('input:text[name=dep_name]').val();
	if (confirm ("確定要新增系所 "+dep_name+" ?")){

		$.ajax({
			type:"POST",
			url: "ajax_maintain.php",
			data:{mode:2,depid:dep_id,depname:dep_name},
              success: function (data) { 
              	if(data == 'Success'){
              	   var log = $('<h4>').addClass('log').text("已經新增系所'"+dep_name+"'了");
              	   $('.dep_page').append(log);
              	}
			    else alert(data);
			  }
		});    	

	}
}


</script>
</html>