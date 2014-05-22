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
//後端會傳來資料
<? include_once("js_student_detail.php"); echo_student_detail_array($_SESSION['username']); ?>

	$(function(){
	
		var detail_column = "",detail_input = "",idx = 0;
		//var column_name = ["學號","姓名","系所","大頭貼照","生日","綽號","性別","連絡電話","詳細地址","電子信箱","履歷檔案"];
		//var input_name = ["user_no" , "user_name" , "dep_name" , "pic" , "birthday" , "nickname" , "sex" , "phone" , "address" , "email" , "doc"];
		for(var key in user_detail_array){
			
			//column_name的資料
			detail_column+=column_name[idx]+"<br>";

            //input_name的資料
			if(key == "userno"){
            detail_input+=user_detail_array[key]+"<br>";
			}
			else if(key == "sex"){
			detail_input+="<select name ='"+input_name[idx]+"' id='sex'><option value='0'>男</option><option value='1'>女</option></select><br>";
			}
			else{
			detail_input+="<input type='text' name ='"+input_name[idx]+"' value='"+user_detail_array[key]+"'><br>";
			}
			idx++;
		}	
		    detail_input+="<br><input type='submit' value='資料修改'/>";

		//把資料倒進相對的位置
		$('#detail_column').html(detail_column);
		$('#detail_input').html(detail_input);

        //設定sex的資料
		$("#sex").val(user_detail_array.sex);


	});
</script>
<!-- 呈現欄位名稱 -->
<div style="float:left; padding-right:50px;" id="detail_column"></div>
<!-- 個人資料 -->
<form method="post" action="updata.php" id="detail_input"></form>

</body>
</html>
