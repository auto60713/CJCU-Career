<?php session_start();
header('Content-Type: text/html; charset=utf8');


if(isset($_GET["mode"])) $mode = $_GET["mode"];
else $mode = 0;

if($mode == 1) echo "密碼修改成功，請重新登入。<meta http-equiv=REFRESH CONTENT=2;url=index.php>";
else echo "登出中..<meta http-equiv=REFRESH CONTENT=1;url=index.php>";



session_destroy();
?>
