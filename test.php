<?php
header("Content-Type:text/html; charset=utf-8");


$to = 'komicabot@gmail.com';
$by = '長大職涯網';
$title = "長大職涯網-測試信件";
//設定 MIME 版本和 Content-type header 內容.
$sCharset = 'big5';
$sHeaders = "MIME-Version: 1.0\r\n".
            "Content-type: text/html; charset=$sCharset\r\n".
            "From: $by\r\n";

$msg = "
<h1>信件內容: 這是一封 HTML 格式的 email</h1>
這裡可以用任何 <strong>HTML 語法</strong>
";

if(mail($to, $title, $msg, $sHeaders)):echo "信件已經發送成功。";
else:echo "信件發送失敗！";
endif;

?>

