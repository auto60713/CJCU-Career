<?php

$data=$_GET["data"];
$key='C3J8cu4t3155n3s60M31L12I';
$iv='Ic8y3pc6Lc5y3MS1';
$blocksize = 16;
$pad = $blocksize - (strlen($data) % $blocksize);
$data_final = $data . str_repeat(chr($pad), $pad);
$result= base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data_final, MCRYPT_MODE_CBC, $iv));
$result=substr($result, 0, -2)."2";
echo $result;


?>