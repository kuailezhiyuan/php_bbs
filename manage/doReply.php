<?php
/*处理发表回复功能*/
session_start();
$msg = "";//错语信息
//判断当前客户是否为登陆用户
if (isset($_SESSION["current_user"])) {
    $current_user = $_SESSION["current_user"];//取当前用户信息
    $topicId = $_POST["topicId"];//板块编号
    $title = $_POST["title"];//帖子标题
    $content = $_POST["content"];//帖子内容
    $uid=$current_user["uid"];
    $connection = new mysqli("localhost", "root", "", "db_luntan");
    //检测连接
    if ($connection->connect_error) {
        die("连接失败: " . $connection->connect_error);
    }
    $connection->query("SET NAMES utf8");
    //发表新帖子，并判断吧是否出错
    $addStr = "insert INTO tbl_reply (title,content,uid,tid) value ('$title','$content','$uid','$topicId')";
//    echo  $addStr;
    if ($connection->query($addStr) == TRUE) {
//        echo "发表成功";
//        header("location:../index.php");//跳转到首页index。php
//        return;
    }else {
        $msg= "Error: ".$addStr  . "<br>" .$connection->error;
    }

    }
else {
    $msg = "用户未登录，请登录后再发布帖子！";
}
if ($msg != "") {
    header("location: ../error.php?msg=$msg");//转入出错页面
}else{
    echo "<script>alert('发帖成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
$connection->close();
?>