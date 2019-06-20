<?php

session_start();
$nsg = "";
$rs = 0;
if (isset($_POST["uid"]) && isset($_POST["uName"])) {
    $uid = $_POST["uid"];
    $uName = $_POST["uName"];
    $uPass = $_POST["uPass"];
    $head = $_POST["head"];
    $gender = $_POST["gender"];


    //创建链接
    $connection = new mysqli("localhost", "root", "", "db_luntan");
//检测链接
    if ($connection->connect_error) {
        die("连接失败:" . $connection->connect_error);
    }
    $sql = "UPDATE tbl_user SET uName='$uName',uPass='$uPass',head='$head',gender='$gender' WHERE uid='$uid' ";
    $rs = mysqli_query($connection, $sql);

    if ($rs <= 0) {
        $msg = "用户失败";
    } else {
        header("location: ../userdetail.php");
        return;

    }
} else {
    $msg = "用户名不能为空或无法获取用户编号";
}
header("location: ../error.php?msg=$msg");//转入出错页面
?>
