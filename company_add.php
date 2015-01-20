<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>長大職涯網-廠商註冊</title>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="lib/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript">

    $('#view-header').load('public_view/header.php');


	$(function(){

	    $("#zone").append($("<option></option>").attr("value", 0).text("國內"));
		$("#zone").append($("<option></option>").attr("value", 1).text("國外"));

		$('#zone').change(function() {
			
			change_zone_list();
		});


		function change_zone_list(){
			var zone = $('#zone').val();
			$("#zone_name option").remove();

			$.ajax({
			    type:"POST",
			    async:false, 
			    url:"ajax_zone_list.php",
			    data:"zone="+zone,
			    success:function(msg){ $('#zone_name').html(msg); },
			    error: function(){alert("網路連線出現錯誤!");}
			});
		}

		change_zone_list();

		<?php //接受後端php傳來的js陣列
		    include("js_company_type.php"); 
		?> 
        for(var i=0;i<company_type_array.length;i++)
        $("#company_type").append($("<option></option>").attr("value", company_type_array_id[i]).text(company_type_array[i]));

       
	});
	

	

</script>
<style type="text/css">

.register{
	background-color: #FFFFFF;
	width: 700px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 20px;
	margin-bottom: 50px;

	padding: 20px;
    border:#000000 1px solid; 
}
label.error{

	color: #D50000;
	font-weight: bold;
	margin-left: 10px;
}

.yes{
    color: #00CC00;
	font-weight: bold;
	margin-left: 10px;
}
.no{
    color: #D50000;
	font-weight: bold;
	margin-left: 10px;
}
</style>
</head>

<body>
<div id="view-header"></div>

<div id="cont" class="register">

<h1>廠商註冊</h1><hr>
<form id="commentForm" name="form" method="post" action="company_add_finish.php">
	<!--用table來對齊表格-->
	有*字號為必填項目
<table>                                                        
<tr><td>帳號*：</td>            <td><input type="text" val="" name="id" id="account"/><span class="check_echo"></span></td></tr>
<tr><td>密碼*：</td>            <td><input type="password" name="pw" id="pw"/></td></tr>
<tr><td>再一次輸入密碼*：</td>  <td><input type="password" name="pw2"/></td></tr>
<tr><td>公司名稱(中文)*：</td>  <td><input type="text" name="ch_name"/></td></tr>
<tr><td>公司名稱(英文)：</td>   <td><input type="text" name="en_name"/></td></tr>
<tr><td>公司電話*：</td>        <td><input type="text" name="phone"/></td></tr>
<tr><td>傳真：</td>             <td><input type="text" name="fax"/></td></tr>
<tr><td>Email*：</td>           <td><input type="text" name="email"/></td></tr>
<tr><td>統一編號*：</td>        <td><input type="text" name="uni_num"/></td></tr>
<tr><td>負責人姓名*：</td>      <td><input type="text" name="boss_name" /></td></tr>
<tr><td>公司行業類型 :</td>     <td><select name="type" id="company_type"></select></td></tr>

<tr><td>公司地點：</td>         <td><select name="zone" id="zone"></select>  
			                        <select name="zone_name" id="zone_name"></select></td></tr>
<tr><td>公司地址*：</td>        <td><input type="text" name="address"/></td></tr>
<tr><td>員工人數*：</td>        <td><input type="text" name="staff_num"/></td></tr>
<tr><td>公司資本額：</td>       <td><input type="text" name="budget"/></td></tr>
<tr><td>公司網址：</td>         <td><input type="text" name="url" class="url"/></td></tr>
</table>

公司簡介：<br><textarea name="introduction" cols="45" rows="5"></textarea> <br>
<br><br>

<input type="submit" name="button" value="確定" />　　
<input type="button" value="取消" onclick=""/>
</form>


</div>

<script type="text/javascript">
//欄位限制
$(document).ready(function() { 

        $("#commentForm").validate({ 
            rules: { 
                //id:      { required:true,rangelength:[4,20] },
                pw:      { required:true,rangelength:[4,20] },
                pw2:     { required:true,equalTo:"#pw" },
                ch_name: { required:true,maxlength:20 },
                en_name: { maxlength:20 },
                phone:   { required:true,maxlength:12 },
                fax:     { maxlength:12 },
                email:   { required:true,email:true },
                uni_num: { required:true,rangelength:[8,8],digits:true },
                boss_name:    { required:true,maxlength:12 },
                zone_name:    { required:true },
                address:      { required:true,maxlength:40 },
                staff_num:    { required:true,digits:true },
                budget:       { digits:true },
                url:          { url:true },
                introduction: { maxlength:80 }
            }
        }); 

        jQuery.extend(jQuery.validator.messages, {
            required: "此為必填項目",
            email: "請輸入正確的電子信箱",
            url: "請輸入正確的網址",
            digits: "請輸入數字",
            equalTo: "密碼不正確",
            maxlength: jQuery.validator.format("不得超過{0}個字"),
            rangelength: jQuery.validator.format("不符合格式"),
        });

      
      
        //檢測帳號是否重複
	    $("#account").change(function() {
	    	var account = $("#account").val();
	    	if(account.length < 4) $(".check_echo").html("最少要4個字元").attr('class','check_echo no');
            else if(account.length > 20) $(".check_echo").html("不得超過20個字元").attr('class','check_echo no');
          else{
            $.ajax({
			    type:"POST",
			    url:"check_company_id.php",
			    data:{id:account},
			    success:function(boo){

                    if(boo==1) $(".check_echo").html('<i class="fa fa-check"></i>').attr('class','check_echo yes');
	                else $(".check_echo").html("這個帳號已被使用").attr('class','check_echo no');
			    }
			});
          }

		});

});


</script>
</body>
</html>





