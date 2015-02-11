<?php
session_start();

include_once("cjcuweb_lib.php");


if($_SESSION['level'] == $level_company) $dir = "img_company/";
else if($_SESSION['level'] == $level_department||$_SESSION['level'] == $level_staff) $dir = "img_department/";
else $dir = "img_user/";


if(!isset($_SESSION['level'])){
	echo "No permission!"; exit();
}

$rename = $dir.$_SESSION['username'].'.jpg';

session_write_close();


$fileName = $_FILES["file1"]["name"]; // 取得檔案名稱
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // 取得檔案再php tmp 資料夾裡的名稱
$fileType = $_FILES["file1"]["type"]; // 檔案類型
$fileSize = $_FILES["file1"]["size"]; // 檔案大小
$fileErrorMsg = $_FILES["file1"]["error"]; //是否錯誤 0 = false; 1 = true


if (!$fileTmpLoc) { // 檔案有無被選擇，有的話會在 TMP 資料夾裡有建立此檔案
    echo $rename;
    exit();
}


// 將檔案傳送到指定目錄下 我設定 uf 資料夾
if(move_uploaded_file($fileTmpLoc, $rename)){

	chmod($rename, 0777);
    echo $rename;

} else {
    echo $rename;
}


?>