<? session_start(); 
include('cjcuweb_lib.php');
if(!isset( $_SESSION['username']) ||  $_SESSION['level']!= $level_staff ) {
 	echo "No permission"; exit; }
?>
<!doctype html>
<html>
<head>
	<script><? include_once("js_detail.php"); echo_staff_detail($_SESSION['username']); ?></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script>

	$(function(){
		$('#st_name').val(staff_detail_array.user_name);
		$('#st_self').val(staff_detail_array.role=='1'?'管理員':'教職員');
	});

</script>

	
</head>

<body>


<form method="post" action="updata.php" id="detail">
	
	<span>姓名</span><input name="st_name" id="st_name" type="text"><br>
	<span>身分</span><input name="st_self" id="st_self" type="text" disabled><br><br>
	<input type='submit' value='資料修改'><br>

</form>

</body>
</html>
