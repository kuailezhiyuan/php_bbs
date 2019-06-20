<?php
session_start();
$headBuf = <<<HEAD
<link type="text/css" rel="styleSheet"  href="style/style.css" />   
    <div>
        <img src="./image/logo.gif">
    </div>
    <div class="h">
HEAD;
if (isset($_SESSION["current_user"])) {
    $current_user = $_SESSION["current_user"];
    $user_name = $current_user["uName"];
    $headBuf .= <<<html_head
    您好：<a href="userdetail.php">$user_name</a>&nbsp;|&nbsp;<a href="manage/doLogout.php">退出</a> 
html_head;
} else {
    $headBuf .= <<<html_head
       您尚未<a href="login.php">登录</a>&nbsp;|&nbsp; <a href="reg.php">注册</a>
html_head;

}
$headBuf .= "</div>";
echo $headBuf;//输出顶部区域
?>
