<?php

trip_aes(321);


function trip_aes($data) {
    $key='C3J8cu4t3155n3s60M31L12I';
    $iv='Ic8y3pc6Lc5y3MS1';
    $blocksize = 16;
    $pad = $blocksize - (strlen($data) % $blocksize);
    $data = $data . str_repeat(chr($pad), $pad);
    $result= base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv));
    $result= substr($result, 0, -2)."2";
    echo "111".$result;
}

function detrip_aes($data) {
    $key='C3J8cu4t3155n3s60M31L12I';
    $iv='Ic8y3pc6Lc5y3MS1';
    $data=substr($data, 0, -1)."==";
    $result= mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($data), MCRYPT_MODE_CBC, $iv);
    return $result;
}
?>