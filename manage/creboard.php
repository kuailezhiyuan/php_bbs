<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2019/5/22
 * Time: 14:43
 */
header("content-type:text/html;charset=utf-8");
//连接MYSQL服务器
$connection=new mysqli("localhost","root","","db_luntan");
//判断是否连接成功
if($connection->connect_error){
    die("连接失败：".$connection->connect_error);
}
$sql="create table tbl_board(
bid int(10) not null auto_increment,
boardName varchar(50) not null,
parentid int(11) not null,
primary key (bid))";
//如果连接成功
if($connection->query($sql)==true){
    echo "tbl_board创建成功！";
}else{
    echo "tbl_board创建失败：".$connection->error;
}
$connection->close();
?>
