<!doctype html public "-//w3c//DTD html 4.01 transitional//EN">
<html>
<head>
    <title>欢迎访问PHP论坛</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">

</head>
<body>
<?php
header("content-type:text/html;charset=utf-8");
include "include/head.php";
?>
<div class="t">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr class="tr2" align="center">
            <td colspan="2">论坛</td>
            <td>主题</td>
            <td>最后发表</td>
        </tr>
        <!--        主版块-->
        <?php
        //链接mysql服务器
        $connection = new mysqli("localhost", "root", "", "db_luntan");
        //判断是否链接成功
        if ($connection->connect_error) {
            die("连接失败：" . $connection->connect_error);
        }
        $connection->query("SET NAMES utf8");
        //查询主版块
        $boardStr = "select * from tbl_board where parentid=0";
        $result = $connection->query($boardStr);
        $table_html = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $boardName = $row["boardName"];
                $parentid = $row["bId"];
                $table_html .= <<<HTML_TABLE
<!--                主版块-->
                <tr class="tr3">
                    <td colspan="4">
                        $boardName
                    </td>
                </tr>
HTML_TABLE;
                //查询子版块
                $sonStr = "select * from tbl_board where parentid='$parentid'";
                $sonBoards = $connection->query($sonStr);
                if ($sonBoards->num_rows > 0) {
                    while ($son = $sonBoards->fetch_assoc()) {
                        $boardName = $son["boardName"];
                        $bid = $son["bId"];
                        $conntstr = "select * from tbl_topic where bid='$bid'";
                        $conntresult = $connection->query($conntstr);
                        $count = $conntresult->num_rows;
                        $laststr = "select * from tbl_topic,tbl_user where tbl_topic.uid=tbl_user.uid AND bid='$bid' ORDER BY publishTime DESC LIMIT 0,1";
                        $lastresult = $connection->query($laststr);
                        if ($lastresult->num_rows > 0) {
                            $topic = $lastresult->fetch_assoc();
                        }
                        $userName = $topic["uName"];
                        $publishTime = $topic["publishTime"];
                        $title = $topic["Title"];
                        $topicId = $topic["tId"];
                        $table_html .= <<<HTML_TABLE
                        <tr class="tr3">
                            <td width="5%">
                            &nbsp;
                            </td>
                         <th align="left">
                            <img src="image/board.jpg" hight="40px" width="40px">
                            <a href="list.php?boardId=$bid&currentPages=0">$boardName</a>
                         </th>
                         <td align="center">
                            $count
                         </td>
                         <th>
                            <span>
                                <a href="detail.php?boardId=$bid&currentPages=0&currentReplyPage=0&topicId=$topicId">$title</a>
                            </span>
                            <br/>
                         <span>$userName</span>
                         <span class="gray">[$publishTime]</span>
                         </th>
                         </tr>
HTML_TABLE;
                    }
                }
            }
        }
        $connection->close();
        echo $table_html
        ?>
    </table>
</div>
<br>
<center class="gray">2019版权所有</center>
</body>
</html>