<!doctype html public "-//w3c//DTD html 4.01 transitional//EN">
<html>
<head>
    <title>php管理论坛--登录</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <script language="JavaScript">
        function init() {
            document.loginFrom.head[9].checked = true;
        }

        function check() {
            if (document.loginFrom.uName.value == "") {
                alert("用户名不能为空");
                return false;
            }
            if (document.loginFrom.uPass.value == "") {
                alert("密码不能为空");
                return false;
            }
        }
    </script>
</head>
<body onload="init()">
<?php
include "include/head.php";
if (isset($_SESSION["current_user"])) {
    header("location:./index.php");
}
?>
<br/>
<!-- 导航 -->
<div>
    <b><a href="index.php">论坛首页</a></b>
</div>
<!--注册表单-->
<div class="t" style="margin-top: 15px" align="center">
    <form name="loginFrom" onsubmit="return check()" ACTION="manage/doLogin.php" method="post"
    <br/>用 &nbsp; 户 &nbsp; 名;
    <input class="input" tabindex="1" type="text" maxlength="20" size="40" formmethod="post" name="uName">
    <br/>
    <br/>
    <br/>密 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 码 ; &nbsp;
    <input class="input" tabindex="2" type="password" maxlength="20" size="40" formmethod="post" name="uPass">
    <br/>
    <br/>
    <input class="btn" tabindex="4" type="submit" value="登录">
    </form>
</div>
<center class="gray">2019 PHP 版权所有</center>
</body>
</html>