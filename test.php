<?php
session_start();
session_register("username");
session_commit();


//session記錄檔異動時間在300秒以內，都計算為在線人數
echo onLine(300);

function onLine($second)
{
 $qty = 0;
 //讀取sess_開頭的檔案，如有自定session檔前綴字元的，請自行變更
 foreach (glob(session_save_path()."/sess_*") as $sess_file){
  //session異動時間在300秒以內的，就納入在線人數
  if (filemtime($sess_file)+$second >= time()){
   ++$qty;
  }
 }
 return $qty;
}
?>

