<?php
header("Content-Type:text/html;charset=utf-8");
require __DIR__.'/../autoload.php';

$title = "Redis实现注册登录";
session_start();

#如果已经登录
if(isset($_SESSION['nickname'])){
    $redis = new Predis\Client();
    $all_id = $redis->lrange('user:list:id','0','-1');
    $result = [];
    if(!empty($all_id)){
        foreach ($all_id as $key => $id) {
            $info = $redis->hmget('user:'.$id,['nickname','email','password','add_time']);
            $result [] = $info;
        }
    }
    $nickname = $_SESSION['nickname'];
}

require __DIR__.'/register_view.php';