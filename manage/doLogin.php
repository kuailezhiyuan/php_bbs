<?php
/**
 *完成登录操作
 */
header("content-type:text/html;charset=utf-8");
//链接mysql服务器
session_start();
$connection=new mysqli("localhost","root","","db_luntan" );
//判断是否链接成功
if($connection->connect_error){
    die("连接失败：".$connection->connect_error);
}
$msg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST["uName"];
    $pass=$_POST["uPass"];
    if(isset($name)){
    $selectstr="select * from tbl_user where uName='$name'";//写出查询语句
    $result=$connection->query($selectstr);//执行查询，并把查询结果复制给￥result
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        if($pass==$row["uPass"]) {
            $_SESSION["current_user"]=$row;
            header("location:../index.php");
            return;
        }
        else{
           // echo "密码错误";
            $msg="用户名或者密码错误";
        }
    }else {
       // echo "用户名错误";
        $msg="用户名或者密码错误";
    }
        $connection->close();
    }else{
      //  echo "用户名不能为空";
        $msg="用户名不能为空";
    }
    header("location:../error.php?msg=$msg");//跳转到错误显示信息页面
}

?>