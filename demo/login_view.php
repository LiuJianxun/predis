<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>用户登录</title>
</head>
<body>

<center><h1>用户登录</h1></center>
<div style="margin-left:150px;margin-top:20px;font-size:18px;float:left">
<form action="">
登录邮箱:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="email" name="email" value="" style="font-size:15px;width:150px;">&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;
用户密码:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="password" name="password" value="" style="font-size:15px;width:150px;">&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="登录" style="font-size:15px;width:160px;height:28px;margin-left:50px;" onclick="return doCheck();">
<a style="font-size:16px;height:28px;margin-left:50px;" href="./index.php">注册</a>
</form>
</div>

<script type="text/javascript" src="http://upcdn.b0.upaiyun.com/libs/jquery/jquery-1.8.1.min.js"></script>
<script type="text/javascript">
    
    //执行检查
    function doCheck(){
        var email = $.trim($("#email").val());
        if(!email){
            alert("请填写注册邮箱");
            $("#email").focus();
            return false;
        }
        var password = $.trim($("#password").val());
        if(!password){
            alert("请填写登录密码");
            $("#password").focus();
            return false;
        }
        $.post("./login.php",{"email":email,"password":password},function(data){
            alert(data.msg);
            if(1==data.code){
                $("input[type=text]").val("");
                window.location.href="./index.php";
            }
            return false;
        },'json');
    }

</script>

</body>
</html>