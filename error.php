

<!doctype html public "-//w3c//DTD html 4.01 transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>php管理论坛-错误信息</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<?php
include "include/head.php";
//$urlshang = $_SERVER['HTTP_REFERER']
?>
<!-- 导航 -->
<div>
    &gt;&gt;<b><a href="index.php">论坛首页</a></b>
</div>
<div class="t" align="center">
    <br/>
    <font color="red"><?php echo $_REQUEST["msg"];?></font>
    <br/>
    <br/>
    <input type="button" value="返回" onclick="window.history.back(); return false;"class="btn"/>
    <br/>
    <br/>
</div>
<br>
<center class="gray">2019版权所有</center>
</body>
</HTML>