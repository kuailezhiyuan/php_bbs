<?php
/**创建论坛数据库db_luntan
 */
header("content-type:text/html;charset=utf-8");
//链接mysql服务器
$connection=new mysqli("localhost","root","");
//判断是否链接成功
if($connection->connect_error){
    die("连接失败：".$connection->connect_error);
}
//如果连接成功
$sql="create database db_luntan";
if($connection->query($sql)==true){
    echo "论坛数据库创建成功";
}
else{
    echo "论坛数据库创建失败：".$connection->error;
}
$connection->close();
?>