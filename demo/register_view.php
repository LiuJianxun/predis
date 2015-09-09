<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?=$title?></title>
</head>
<body>

<center><h1>用户注册<?php if(!empty($nickname)): ?>，欢迎回来，<?=$nickname?><?php endif; ?></h1></center>
<div style="margin-left:50px;margin-top:20px;font-size:18px;float:left">
<form action="./register.php">
用户昵称:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="font-size:15px;width:150px;" value="" id="nickname" name="nickname">&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;
注册邮箱:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="font-size:15px;width:150px;" value="" id="email" name="email">&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;
用户密码:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="font-size:15px;width:150px;" value="" id="password" name="password">&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" style="font-size:15px;width:160px;height:28px;margin-left:30px;" value="注册" onclick="return doCheck();">
<?php 
    if(!empty($nickname)):      
?>
<a href="javascript:;" onclick="return exit_login();" style="font-size:16px;height:28px;margin-left:50px;">退出</a>
<?php else: ?>
<a href="./login_view.php" style="font-size:16px;height:28px;margin-left:50px;">登录</a>
<?php endif; ?>
</form>
</div>

<?php
    if(!empty($result)):
?>
<table style="float:left;margin-top:10px;line-height:30px;text-align:center;" width="100%" border="0" bgcolor="#999999" align="center" cellpadding="0" cellspacing="1" class="zimid">
<tbody id="datalist">
    <tr bgcolor="#FFFFFF">
        <td   width="10%"><b>ID</b></td>
        <td   width="10%"><b>用户昵称</b></td>
        <td   width="25%"><b>注册邮箱</b></td>
        <td   width="30%"><b>加密密码</b></td>
        <td   width="5%"><b>操作</b></td>
        <td   width="20%"><b>注册时间</b></td>
    </tr>
    <?php 
        $i = 0;
    foreach ($result as $key => $value): 
        ++$i;
    ?>
    <tr bgcolor="#FFFFFF">
        <td><?=$i?></td>
        <td><?=$value[0]?></td>
        <td><?=$value[1]?></td>
        <td><?=$value[2]?></td>
        <td>-</td>
        <td><?=$value[3]?></td>
    </tr>
<?php endforeach;  ?>
</tbody>
</table> 
<?php endif; ?>

<script type="text/javascript" src="http://upcdn.b0.upaiyun.com/libs/jquery/jquery-1.8.1.min.js"></script>
<script type="text/javascript">
   //执行检查
   function doCheck(){
        var nickname = $.trim($("#nickname").val());
        if(!nickname){
            alert("请填写用户昵称");
            $("#nickname").focus();
            return false;
        }
        var email = $.trim($("#email").val());
        if(!email){
            alert("请填写注册邮箱");
            $("#email").focus();
            return false;
        }
        var password = $.trim($("#password").val());
        if(!password){
            alert("请填写注册密码");
            $("#password").focus();
            return false;
        }
        $.post("./register.php",{"nickname":nickname,"email":email,"password":password},function(data){
            alert(data.msg);
            if(1==data.code){
                $("input[type=text]").val("");
                window.location.reload();
            }
            return false;
        },'json');

   }

   //执行退出
   function exit_login(){
        $.post("./logout.php",{},function(data){
            alert(data.msg);
            if(1==data.code){
                window.location.reload();
            }
            return false;
        },'json');
   }

</script>
</body>
</html>