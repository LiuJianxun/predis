<?php

#实现一个加密函数利用crypt
function bcryptHash($rawPassword,$round = 8){
    if($round < 4 || $round > 31) $round = 8;
    $salt = '$2a$'.str_pad($round,2,'0',STR_PAD_LEFT).'$';
    $randomValue = openssl_random_pseudo_bytes(16);
    $salt .= substr(strtr(base64_encode($randomValue),'+','.'), 0,22);
    return crypt($rawPassword,$salt);
}

#校验加密数字是否正确
function bcryptVerify($rawPassword,$storeHash){
    return crypt($rawPassword,$storeHash) == $storeHash;
}

#ajax格式化数据返回
function excuteJson($code,$msg,$info=array()){
    echo json_encode(array('code'=>$code,'msg'=>$msg,'successInfo'=>$info));die;
}