<?php
header("content-type:text/html;charset=utf-8");
//链接mysql服务器
$connection=new mysqli("localhost","root","","db_luntan" );
//判断是否链接成功
if($connection->connect_error){
    die("连接失败：".$connection->connect_error);
}
$msg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST["uName"];
    $pass=$_POST["uPass"];
    $gender=$_POST["gender"];
    $head=$_POST["head"];

if(isset($name)) {
    $insertstr = "insert into tbl_user(uName,uPass,gender,head,regTime) VALUES";
    $format = "%Y/%m/%d %H:%M:%S";
    $regTime = strftime($format);
    $insertstr = $insertstr . "('$name','$pass','$gender','$head','$regTime')";
    if ($connection->query($insertstr) == true) {
        echo "新用户注册成功";
        header("Refresh:2;url=../index.php");//跳转到首页页面
        return;
    } else {
        echo "新用户注册失败". $connection->error;
        "Error:".$insertstr."<br>".$connection->error;
    }
    $connection->close();
}else{
   // echo "用户名不能为空";
    $msg="用户名不能为空";

}
}
?>