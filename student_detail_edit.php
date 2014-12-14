<?php session_start(); 
include('cjcuweb_lib.php');
if($_SESSION['username'] != $_GET['userid']) {
	echo "<br>No permission";
 	exit; 
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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

			detail_column+="<tr><td class='td1'>"+column_name[idx]+"</td>";

            detail_column+="<td class='td2'>"+user_detail_array[key]+"</td></tr>";
		    
			idx++;
		}	

		$('#detail_column').html(detail_column);


</script>

<div id="student_data">
<table id="detail_column"></table><br>
</div>

</body>
</html>
