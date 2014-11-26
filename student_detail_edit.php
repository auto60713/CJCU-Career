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

<?  //後端傳來個人資料
    include_once("js_detail.php"); echo_student_detail($_SESSION['username']); 
?>

</script>
<!-- 呈現欄位名稱 -->
要配合學生系統的資料以及電子履歷
<div id="student_data">


</div>

</body>
</html>
