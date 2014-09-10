<? session_start(); 
include('cjcuweb_lib.php');
if(!isset($_SESSION['username']) || $_SESSION['level'] != $level_teacher) {
 	echo "<br>No permission";
 	exit; 
}
?>

<!doctype html>
<html lang="en">
<body>
個人資料須配合計中
</body>
</html>
