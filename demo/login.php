<?php
header("Content-Type:text/html;charset=utf-8");
require __DIR__.'/../autoload.php';
require __DIR__.'/common.php';

#校验数据
if(!isset($_POST['email']) || !isset($_POST['password'])){
    excuteJson('-1',"请填写完整的登录信息");
}

$email = addslashes($_POST['email']);
$rawPassword = addslashes($_POST['password']);

#连接Redis
$redis = new Predis\Client();
#通过Email获取用户ID
$userID = $redis->hget('email.to.id',$email);
empty($userID) && excuteJson('-1',"用户名或密码错误");

$hashedPassword = $redis->hget('user:'.$userID,'password');
!bcryptVerify($rawPassword,$hashedPassword) && excuteJson('-1',"用户名或密码错误");

$nickname = $redis->hget('user:'.$userID,'nickname');
#session
session_start();
$_SESSION['nickname'] = $nickname;

excuteJson('1',"Hello {$nickname}，欢迎进来!");