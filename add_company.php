<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>廠商註冊</title>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script>

	function ajax_check(id,true_func,false_func){
	var boo = false;
	$.ajax({
	type:"POST",
	async:false, 
	url:"check_isexist_company.php",
	data:"id="+id,
	success:function(msg){ boo = (msg == "0")? false_func(boo) :true_func(boo); },
	error: function(){alert("網路連線出現錯誤!");}
	});
	return boo;
	}

	// jQuery AJAX 沒辦法同步得解法
	function true_func(boo){boo = true ; return boo;}
	function false_func(boo){boo = false; return boo;}

	function check_data() {
		if(document.form.id.value==""){
			alert("account is null");
			return false;
		}
		else if(document.form.pw.value==""){
			alert("password is null");
			return false;
		}
		else if(document.form.ch_name.value==""){
			alert("ch_name is null");
			return false;
				}
		else if(document.form.uni_num.value==""){
			alert("uni_num is null");
			return false;
				}
		else if(document.form.name.value==""){
			alert("name is null");
			return false;
				}
		else if($('#pw').val() != $(this).val()){
			alert("password is not match");
			return false;
		}
		else if( ajax_check(document.form.id.value,true_func,false_func) ){	
			alert("account is exist");
			return false;
		}
		else return true;
	}


	$(function(){

			function true_func(boo){boo = true ; return boo;}
			function false_func(boo){boo = false; return boo;}
			function ajax_check(id,true_func,false_func){
			var boo = false;
			$.ajax({
			type:"POST",
			async:false, 
			url:"check_isexist_company.php",
			data:"id="+id,
			success:function(msg){ boo = (msg == "0")? false_func(boo) :true_func(boo); },
			error: function(){alert("網路連線出現錯誤!");}
			});
			return boo;
			}
			// jQuery AJAX 沒辦法同步得解法
			

		$('#id').change(function(event) {

			if($(this).val()==""){
				$('#id_hint').css('color', '#F00').html('帳號不可為空');
			}
			else{
				if(ajax_check($(this).val(),true_func,false_func)){
					$('#id_hint').css('color', '#F00').html('帳號已被使用');
				}
				else{
					$('#id_hint').css('color', '#0F0').html('帳號可以使用');
				}
			}
		});


		$("#zone").append($("<option></option>").attr("value", 0).text("國內"));
		$("#zone").append($("<option></option>").attr("value", 1).text("國外"));
		change_zone_list();




		$('#pw').change(function() {
		if($('#pw').val()=="") $('#pw_hint1').css('color', '#F00').text('密碼不可為空');
		else  $('#pw_hint1').text('');
		});


		$('#pw2').change(function() {

		var match = false, empty= false,status='';
		if($('#pw').val() != $('#pw2').val() ) match = true;

		if($('#pw2').val()=="") empty =true;

		if(match) status+='密碼不符 ';
		if(empty) status='此欄不可為空';

		$('#pw_hint2').css('color', '#F00').text(status);
		});

	


		$('#zone').change(function() {
			var zone = $(this).val();
			// 清空地點細目
			change_zone_list();
		});


		function change_zone_list(){
			var zone = $('#zone').val();
			$("#zone_name option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_zone_list.php",
			data:"zone="+zone,
			success:function(msg){ $('#zone_name').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		}


	});
	

	

</script>
</head>
<body>
<h1>廠商註冊</h1><hr>
<form name="form" method="post" action="add_company_finish.php" onsubmit="return check_data();">
帳號*：<input type="text" name="id" id="id"/> <span id="id_hint"></span> <br>
密碼*：<input type="password" name="pw" id="pw" /> <span id="pw_hint1"></span> <br>
再一次輸入密碼*：<input type="password" name="pw2" id="pw2" /> <span id="pw_hint2"></span><br>
公司名稱(中文)*：<input type="text" name="ch_name" /> <br>
公司名稱(英文)： <input type="text" name="en_name" /> <br>
公司電話*：<input type="text" name="phone" /> <br>
傳真：<input type="text" name="fax" /> <br>
統一編號*：  <input type="text" name="uni_num" /> <br>
負責人姓名*：<input type="text" name="name" /> <br>
負責人大頭照檔：<input type="file" name="pic" /> <br>
Email：<input type="text" name="email" /> <br>
公司行業類型 : <select name="type" id="company_type"></select><br>

<script> //接受後端php傳來的js陣列
<?php include("js_company_type.php"); ?> 
    for(var i=0;i<company_type_array.length;i++)
    $("#company_type").append($("<option></option>").attr("value", company_type_array_id[i]).text(company_type_array[i]));
</script>

公司地點* : <select name="zone" id="zone"></select>  
			<select name="zone_name" id="zone_name"></select> <br>
公司地址*： <input type="text" name="address" /> <br>
公司資本額：<input type="number" name="budget" min="0" max="999999999"/> <br>
公司簡介：<br><textarea name="introduction" cols="45" rows="5"></textarea> <br>
公司證明相關文件掃描檔(營利事業登記證或公司立案證明或其他相關證明文件) <br>
<input type="file" name="doc" />  <br>
員工人數：<input type="number" name="staff_num" min="1" max="99999"/> <br>
公司網址：<input type="text" name="url" /> <br>

<input type="submit" name="button" value="確定" />
<input type="button"  value="取消" onclick="location.href='company_login.php'"/>
</form>
</body>
</html>





