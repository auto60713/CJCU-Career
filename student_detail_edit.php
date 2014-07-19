<? session_start(); 
include('cjcuweb_lib.php');
if(!isset($_SESSION['username']) || $_SESSION['level'] != $level_student) {
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


<body>
<script>
//後端傳來個人資料
<? include_once("js_detail.php"); echo_student_detail($_SESSION['username']); ?>

	$(function(){
	
		var detail_column = "",detail_input = "",idx = 0;

		for(var key in student_profile_array){
			
			//資料的敘述
			detail_column+=column_name[idx]+"<br>";
			
			//資料的內容
            detail_input+=student_profile_array[key]+"<br>";
            
			idx++;
		}	


		//把資料倒進相對的位置
		$('#detail_column').html(detail_column);
		$('#detail_input').html(detail_input);

	});
</script>
<!-- 呈現欄位名稱 -->
<div style="float:left; padding-right:50px;" id="detail_column"></div>
<!-- 個人資料 -->
<form method="post" action="updata.php" id="detail_input"></form>

</body>
</html>
