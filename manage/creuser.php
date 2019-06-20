<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18
 * Time: 11:17
 */
header("content-type:text/html;charset=utf-8");
//链接mysql服务器
$connection=new mysqli("localhost","root","","db_luntan" );
//判断是否链接成功
if($connection->connect_error){
    die("连接失败：".$connection->connect_error);
}
//如果连接成功
$sql="create table tbl_user(
uid int(11) not null auto_increment,
uName varchar(20) not null,
uPass varchar(20) not null,
uhead varchar(20) not null,
gender smallint(6) not null,
regTime timestamp not null default current_timestamp,PRIMARY KEY(uid));";
if($connection->query($sql)==true){
    echo "tbl_user创建成功";
}
else{
    echo "tbl_user创建失败：".$connection->error;
}
$connection->close();
?>

