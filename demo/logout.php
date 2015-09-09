<?php

session_start();
unset($_SESSION['nickname']);

echo json_encode(array('code'=>1,'msg'=>'退出成功!'));