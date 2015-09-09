<?php
header("Content-Type:text/html;charset=utf-8");
require __DIR__.'/../autoload.php';
require __DIR__.'/common.php';

#校验数据
if(!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['nickname'])){
    excuteJson('-1',"请填写完整的注册信息");
}

$email = addslashes(trim($_POST['email']));
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    excuteJson('-1',"邮箱格式不正确，请正确填写");
}

$rawPassword = addslashes($_POST['password']);
if(strlen($rawPassword)<6){
    excuteJson('-1',"为了保证安全，密码长度至少为6位");
}

$nickname = addslashes($_POST['nickname']);

#判断用户提交的邮箱是否注册
$redis = new Predis\Client();
if($redis->hexists('email.to.id',$email)){
    excuteJson('-1',"该邮箱已经被注册过");
}

#密码加密
$hashedPassword = bcryptHash($rawPassword);

#首先获取自增用户ID
$userID = $redis->incr('user:count');
$redis->hmset("user:{$userID}",array(   
    'email'    => $email,
    'password' => $hashedPassword,
    'nickname' => $nickname,
    'add_time' => date('Y-m-d H:i:s',time())
));

#记录下邮箱和用户ID的对应关系
$redis->hset('email.to.id',$email,$userID);

#记录所有用户ID
$redis->lpush('user:list:id',$userID);

#提示用户注册成功
excuteJson('1',"恭喜！注册成功");
