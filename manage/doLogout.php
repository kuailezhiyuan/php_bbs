<?php
header("content-type:text/html;charset=utf-8");
session_start();
session_destroy();
header("location:../index.php");
?>
