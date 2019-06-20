<!doctype html public "-//w3c//DTD html 4.01 transitional//EN">
<html>
<head>
    <title>php管理论坛--注册</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <script language="JavaScript">
        function init() {
            document.userFrom.head[9].checked = true;
        }

        function check() {
            if (document.userFrom.uName.value == "") {
                alert("用户名不能为空");
                return false;
            }
            if (document.userFrom.uPass.value != document.userFrom.uPass1.value) {
                alert("密码与确认密码不一致");
                return false;
            }
        }
    </script>
</head>
<body>
<?php
include "include/head.php"
?>
<br/>
<!-- 导航 -->
<div>
    <b><a href="index.php">论坛首页</a></b>
</div>
<!-- 用户注册表单 -->
<div class="t" align="center">
    <?php
    if (isset($_SESSION["current_user"])) {
        $current_user = $_SESSION["current_user"];
        $uid = $current_user["uid"];
//链接mysql服务器
        $connection = new mysqli("localhost", "root", "", "db_luntan");
//判断是否链接成功
        if ($connection->connect_error) {
            die("连接失败：" . $connection->connect_error);
        }
        $selectstr = "select * from tbl_user where uid='$uid'";//写出查询语句
        $result = $connection->query($selectstr);//执行查询，并把查询结果复制给￥result
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        }
        $connection->close();
    }
    $fromBuf = <<<HTML_FROM
<div class="t" style="margin-top: 15px" align="center">
    <form name="userFrom" onsubmit="return check()" ACTION="manage/doUpdateUser.php" method="post">
    <input name="uid" type="hidden" value="$user[uid]">
    <br/>用 &nbsp; 户  &nbsp; 名:
        <input class="input" tabindex="1" type="text" maxlength="20" size="40"  name="uName" value="$user[uName]" readonly="true">
        <br/>
        <br/>
        <br/>密 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       码  ;  &nbsp;
        <input class="input" tabindex="2" type="text" maxlength="20" size="40"  name="uPass" value="$user[uPass]">
        <br/>
        <br/>
        <br/>确 认 密 码;
        <input class="input" tabindex="3" type="text" maxlength="20" size="40" name="uPass1">
     
HTML_FROM;
    if ($user["gender"] == 1) {
        $fromBuf .= <<<HTML_FROM
        <br/>性别;
        女<input type="radio" name="gender" value="1" checked="checked">
        男<input type="radio" name="gender" value="2">
        <br/>
HTML_FROM;

    } else {
        $fromBuf .= <<<HTML_FROM
        <br/>性别;
        女<input type="radio" name="gender" value="1" >
        男<input type="radio" name="gender" value="2" checked="checked">
        <br/>
HTML_FROM;
    }
    for ($i = 1; $i <= 15; $i++) {
        if ($user["head"] == "$i.gif") {
            $fromBuf .= "<img src='image/head/$i.gif'><input type='radio' name='head' value='$i.gif' checked='checked'/>";
        } else {
            $fromBuf .= "<img src='image/head/$i.gif'><input type='radio' name='head' value='$i.gif'/>";
        }
        if ($i % 5 == 0) {
            $fromBuf .= "<br/>";
        }
    }
    $fromBuf .= <<<HTML_FORM
<br>
<input class="btn" tabindex="4" type="submit" value="修改">
</form>
HTML_FORM;
    echo $fromBuf;

    ?>
</div>
<br>
<center class="gray">2019 PHP 版权所有</center>
</body>
</html>




