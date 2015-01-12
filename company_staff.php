<?php session_start(); 
if(!isset($_SESSION['username'])) { echo 'No permission!'; exit; }
?>

<!doctype html>
<html>
<head>

</head>
<style type="text/css">
h3{
	margin-top: 30px;
}
table.com-staff-list tr td{
	padding-right: 30px;
}
button{
	margin-top: 10px;
}
</style>
<script>
	<?php
    include_once('js_match_list.php'); echo_com_staff_list($_SESSION['username']); 
    ?>

        var body = $('.com-staff-list');
        if(com_staff_list.length == 0){body.text("無");}
        else{

		    for(var i=0;i<com_staff_list.length;i++){

		    	var id = $('<td>').text(com_staff_list[i]['id']),
		        	sname = $('<td>').text(com_staff_list[i]['name']),
		        	phone = $('<td>').text(com_staff_list[i]['phone']),
		        	email = $('<td>').text(com_staff_list[i]['email']),
		    		tr = $('<tr>').append(id,sname,phone,email);
		    		body.append(tr);
		    }
		}


//新增管理員
function add_com_staff(){

	var sid = $('input:text[name=com_sid]').val();
	var spw = $('input:text[name=com_spw]').val();
    var sname = $('input:text[name=com_sname]').val();
    var sphone = $('input:text[name=com_sphone]').val();
    var semail = $('input:text[name=com_semail]').val();

		$.ajax({
			type:"POST",
			url: "ajax_work_edit.php",
			data:{mode:7,sid:sid,spw:spw,sname:sname,sphone:sphone,semail:semail},
              success: function (data) { 
              	if(data == 1){
              	    location.reload();
              	}
			    else alert(data);
			  }
		});    	


}


		
</script>
<body>
    <table class="input">
        <tr><td style="width:140px">新增帳號</td><td><input type="text" name="com_sid" value=""></td></tr>
        <tr><td>密碼</td><td><input type="text" name="com_spw" value=""></td></tr>
        <tr><td>管理員名稱</td><td><input type="text" name="com_sname" value=""></td></tr>
        <tr><td>電話</td><td><input type="text" name="com_sphone" value=""></td></tr>
        <tr><td>email</td><td><input type="text" name="com_semail" value=""></td></tr>
    </table>
    <button type="button" onclick="add_com_staff()">新增</button>

    <h3>目前已建立的工作負責人</h3>
    <table class="com-staff-list">
        <tr><td>帳號</td><td>名稱</td><td>電話</td><td>信箱</td></tr>
    </table>
</body>
</html>
