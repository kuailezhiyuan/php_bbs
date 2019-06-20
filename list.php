<html>
<head>
    <title>帖子列表</title>
    <META http-equiv=Content-Type content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
</head>
<body>
<?php
header("content-type:text/html;charset=utf-8");
include "include/head.php";
?>
<!- 主体--->
<div>
    <!--导航-->
    <br/>
    <div>
        <?php
        $bid = $_GET["boardId"];//板块编号
        $curPage = $_GET["currentPages"];//当前页码
        $boardName = "";//板块名称
        $curBoard = array();//当前板块信息
        $msg = "";//出错信息
        //连接数据库
        $connection = new mysqli("localhost", "root", "", "db_luntan");
        //检测连接
        if ($connection->connect_error) {
            die("连接失败：" . $connection->connect_error);
        }
        $connection->query("SET NAMES utf8");
        if (isset($bid)) {//判断板块参数是否存在
            $boardStr = "select * from tbl_board WHERE bid='$bid'";
            $curBoard = $connection->query($boardStr);//查询指定板块信息
            if ($curBoard->num_rows >= 0) {//判断是否查询到内容
                $curbankuai = $curBoard->fetch_assoc();
                $boardName = $curbankuai["boardName"];
            } else {
                $msg = "板块不存在";
            }
        } else {
            $msg = "板块编号不存在";
        }

        if ($msg != "") {
            header("location: ./error.php?msg=$msg");//跳转到错误显示信息页面
        }
        $pageSize = 5;//定义页面容量
        $page = $curPage + 1;
        if ($page >= 1) {//分页处理
            $page--;
        }
        $page = $page * $pageSize;
        //分页查询
        $strQuery = "select * from tbl_topic,tbl_user WHERE tbl_topic.uid=tbl_user.uid and bid='$bid' order by publishTime desc limit $page,$pageSize";
        $topicList = $connection->query($strQuery);//分页取指定板块的帖子列表
        $strQuery = "select * from tbl_topic WHERE bid='$bid'";
        $result = $connection->query($strQuery);
        $topicNums = $result->num_rows;//统计板块帖子数
        //计算总页数
        $pages = $topicNums % $pageSize == 0 ? $topicNums / $pageSize : (int)($topicNums / $pageSize) + 1;
        $explor = <<<HTML_STR
              &GT;&GT;<b><A HREF="index.php">论坛首页</A></b>
                <B><a href="list.php?boardId=$bid&currentPages=0">$boardName </a></B>
HTML_STR;
        echo $explor;
        ?>
    </div>
    <br/>
    <!--   新帖   -->
    <div>
        <a href="post.php?boardId=<?php echo $bid ?>"><img style="width: 25px" src="image/post.png" name="td_post" border="0" id="td_post">发表新帖</a>
    </div>
    <!--分页处理-->
    <div>
        <?php
        include "include/list_curPage.php"
        //        分页
        ?>
    </div>
    <div class="t">
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th class="h" style="..." colspan="4">
                    <span></span>
                </th>
            </tr>
            <!--表头  -->
            <tr class="tr2">
                <td>
                </td>
                <td style="width: 80%" align="center">
                    文章
                </td>
                <td style="width: 80%" align="center">
                    作者
                </td>
                <td style="width: 80%" align="center">
                    回复
                </td>
            </tr>
            <!--主体列表-->
            <?php
            $html_topic = "";
            foreach ($topicList as $topic) {//遍历帖子记录
                $tid = $topic["tId"];
                $topicTitle = $topic["Title"];
                $userName = $topic["uName"];
                $strQuery = "select * from tbl_reply WHERE tid='$tid'";
                $result = $connection->query($strQuery);
                $replyCount = $result->num_rows;
                $html_topic .= <<<HTML_TABLE
                <TR CLASS="TR3">
                    <TD>
                    <IMG SRC="image/topic.png" border="0">
                    </TD>
                    <td style="FONT-SIZE: 15PX">
                    <A href="detail.php?boardId=$bid&currentPages=$curPage&currentReplyPage=0&topicId=$tid">$topicTitle</A>
                    </TD>
                    <td align="center">
                    $userName
                    </td>
                    <td align="center">
                    $replyCount
                    </td>
                    </TR>
HTML_TABLE;
            }

            echo $html_topic;//输出帖子列表信息
            ?>
        </table>
    </div>
    <!--翻页-->
    <div>
        <?php
        include "include/list_curPage.php"
//        分页
        ?>
    </div>
</div>
<!--声明 -->
<br/>
<center class="gray">2019 php 版权所有</center>
</body>
</html>