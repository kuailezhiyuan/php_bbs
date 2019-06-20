<html>
<head>
    <title>发布帖子</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <?php
    $boardNnme = "" ;//板块名称
    $boardId = "" ;//板块编号
    $topicId = empty($_GET["topicId"])?"":$_GET["topicId"];//帖子编号
    $currentPage = empty($_GET["currentPage"])?0:$_GET["currentPage"];//当前页码
    if (!empty($_GET["boardId"])) {//判断是否带参数
        $boardId = $_GET["boardId"];
    }else {
        $msg = "板块编号不存在！";
        die(header("locetion: ../error.php?msg=$msg"));//转入出错页面
    }
    $connection = new mysqli("localhost", "root", "", "db_luntan");
    //检测连接
    if ($connection->connect_error) {
        die("连接失败: " . $connection->connect_error);
    }
    $connection->query("SET NAMES utf8");
    $boardstr ="select * from tbl_board where bid='$boardId'";
    $result = $connection->query($boardstr);
    if ($result->num_rows > 0) {
        $curBoard = $result->fetch_assoc();//查询指定板块信息
        $boardNnme = $curBoard["boardName"];
    }
    ?>
</head>

<body>
<?php
header("content-type:text/html;charset=utf-8");
include "include/head.php";
?>
<div>
    <?php
    $explor =
    <<<HTML_STR
    <B><a href="index.php">论坛首页</a> </B>>>
    <B><a href="list.php?currentPages=0&boardId=$boardId&currentPage=0">$boardNnme</a> </B>
HTML_STR;
    echo $explor;
    ?>
</div>
<br>
<div>
    <?php
    $html_str = <<<HTML_STR
<div>
    <form name="postForm" onsubmit="return valid()" action="manage/doPost.php" method="post">
        <input type="hidden" name="boardId" value="$boardId">
        <input type="hidden" name="topicId" value="$topicId">
        <input type="hidden" name="currentPage" value="$currentPage">
        <br>标题：
        <input class="input" tabindex="1" type="text" maxlength="20" size="40" name="title">
        <br>
        <br>内容：
        <textarea tabindex="2" cols="29" rows="6" name="content"></textarea>
        <br>
        <br>
        <input class="btn" tabindex="3" type="submit" value="提交">
    </form>
</div>
HTML_STR;
        echo $html_str;
    ?>
</div>
<!--声明 -->
<br/>
<center class="gray">2019 php 版权所有</center>
</body>
</html>