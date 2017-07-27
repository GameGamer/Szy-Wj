<?php
//$a=hash_file('MD5','1.txt',false);
//创建公钥和私钥
$res=openssl_pkey_new(array('private_key_bits' => 512)); #此处512必须不能包含引号。
//提取私钥
openssl_pkey_export($res, $private_key);
//生成公钥
$public_key=openssl_pkey_get_details($res);
$public_key=$public_key["key"];
//显示数据
//要加密的数据
//私钥加密后的数据
openssl_private_encrypt($a,$encrypted,$private_key);
//加密后的内容通常含有特殊字符，需要base64编码转换下
$encrypted = base64_encode($encrypted);
//公钥解密
openssl_public_decrypt(base64_decode($encrypted), $decrypted, $public_key);
?>
