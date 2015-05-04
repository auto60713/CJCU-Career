<?php session_start(); 
include('cjcuweb_lib.php');
if(trim($_SESSION['username']) != $_GET['userid']) {
	echo "No permission"; exit; 
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<style type="text/css">
#detail_column{
	padding-left: 40px;
}
.td1{
	font-size: 17px;
	font-weight: bolder;
    width: 100px;
    overflow: hidden;
}
.td2{
    padding-top: 5px;
    padding-bottom: 5px;
}

</style>

<body>
<script>

<?php  //後端傳來個人資料
    include_once("js_detail.php"); echo_student_detail($_GET['userid']); 
?>

    var column_name = ["學號","在學狀態","中文名","英文名","學制代碼","系所代碼","目前年級","班級代碼","入學年","學制名稱","學制簡稱","系所簡稱","系所英文","班級名稱","生日","家電話","手機","電子信箱","郵遞區號","地址"],
		detail_column = "",
		idx = 0;
		
		for(var key in user_detail_array){

			if(idx==0||idx==2||idx==3||idx==6||idx==8||idx==9||idx==11||idx==12||idx==13||idx==14||idx==15||idx==16||idx==17||idx==19){
			detail_column+="<tr><td class='td1'>"+column_name[idx]+"</td>";
            detail_column+="<td class='td2'>"+user_detail_array[key]+"</td></tr>";
		    }

			idx++;
		}	

		$('#detail_column').html(detail_column);
        $('#student_data').fadeIn(300);

</script>

<div id="student_data" style="display:none;">
<table id="detail_column"></table><br>
</div>

</body>
</html>
