<html>
<head>
    <title>看帖</title>
    <meta http-equiv="description" content="show topic">
    <meta http-equiv="content-type" content="text/html: charset=UTF-8">
    <Link rel="stylesheet" type="text/css" href="style/style.css"/>

    <script type="text/javascript" language="javascript">
        //删除回帖提示
        function deleteReply(title, replyId, boardId, currentPage) {
            if (window.confirm("您确定要删除标题为：" + title + ",的帖子吗？")) {
                var url = "manage/deDeleteReply.php?replyId=" + replyId + "&boardId=" + boardId + "&currentPage=" + currentPage
            :
                window.location = url
            :
            }
        }
    </script>
</head>
<body>
<?php
header("content-type:text/html;charset=utf-8");
include "include/head.php";
?>
<!--    主体   -->
<div>
    <!--导航-->
    <br/>
<?php
$boardId = $_GET["boardId"];//板块编号
$curPage = $_GET["currentPages"];//当前页码
$curReplyPage = $_GET["currentReplyPage"];//当前回帖页码
$topicId = $_GET["topicId"];//当前帖子编码
$boardName = "";//板块名称
$curBoard = array();//当前板块信息
$curTopic = array();//当前帖子
$msg = "";//出错信息

$connection = new mysqli("localhost", "root", "", "db_luntan");
//检测连接
if ($connection->connect_error) {
    die("连接失败: " . $connection->connect_error);
}
$connection->query("SET NAMES utf8");
if (isset($boardId)) {//判断板块参数是否存在
    $strQuery = "select *from tbl_board where bid ='$boardId'";
    $result = $connection->query($strQuery);
    if ($result->num_rows > 0) {
        $curBoard = $result->fetch_assoc();//查询指定板块信息
        $boardIIame = $curBoard["boardName"];
    } else {
        $msg = "板块不存在！";
    }
    $strQuery = "select * from tbl_topic,tbl_user where tbl_topic.uid= tbl_user.uid and tid='$topicId'";
    $result = $connection->query($strQuery);
    if ($result->num_rows > 0) {
        $curTopic = $result->fetch_assoc();//查询指定帖子信息
    }
} else {
    $msg = "版块编号不存在！";
}
if ($msg != "") {
    header("location: ../error.php?msg=$msg");//转入出错页面
}
$pageSize = 5;//定义页面容量
$page = $curReplyPage + 1;
if ($page >= 1) {//分页处理
    $page--;
}
$page = $page * $pageSize;
//分页查询
$strQuery = "select * from tbl_reply,tbl_user WHERE tbl_reply.uId=tbl_user.uid AND tbl_reply.tId='$topicId' order by publishtime desc limit $page ,$pageSize";
$replies = $connection->query($strQuery);//取1页回帖信息
$strQuery = "select * from tbl_reply where tid = '$topicId'";
$countresult = $connection->query($strQuery);
$replyNum = $countresult->num_rows;//统计当前帖子的回帖信息
//计算总页数
$pages = $replyNum % $pageSize == 0 ? $replyNum / $pageSize : (int)($replyNum / $pageSize) + 1;
$explor =
    <<<HTML_STR
<B><a href="index.php">论坛首页</a> </B>>>
<B><a href="list.php?boardId=$boardId&currentPage=0">$boardName</a> </B>
HTML_STR;
echo $explor;
?>
</div>
<br>
<!--      新帖      -->
<div>
    <a href='post.php<?php echo "boardId=$boardId&topicId=$topicId&currentPage=$curPage" ?>'>

        <img src="image/reply.png" style="height: 32px" name="td_reply" border="0" id="td_reply"></a>
        <a href="post.php?boardId=<?php echo $boardId ?>">
        <img src="image/post.png" name="td_post" border="0" id="td_post"></a>
</div>
<!--  翻页  -->
<div>
    <?php
    $html_page = "";
    if ($curReplyPage < 1) {//判断是否为第一页
        $html_page = "上一页|";
    } else {
        $curReplyPage--;
        $html_page = "<a href='detail.php?boardId=$boardId&currentPage=$curPage&currentReplayPage=$currentReplayPage&topicId=$topicId'>上一页</a>|";
        $curReplyPage++;
    }

    if (($curReplyPage + 1) >= $pages) {//判断是否为最后一页
        $html_page .= "下一页";
    } else {
        $curReplyPage++;
        $html_page .= "<a href=' '>下一页</a >";
    }
    $tup = $curReplyPage + 1;
    $html_page .= "|当前第 $tup 页/共$pages 页";
    echo $html_page;
    ?>
</div>
<!--本页主题的标题-->
<div>
    <table collSpacing="0" cellpadding="0" width="100%">
        <tr>
        <th class="h">
            本页主题：<?php echo $curTopic["Title"] ?>
        </th>
        </tr>
        <th class="tr2">
            <TD></TD>
        </th>
    </table>
</div>

<!----主题   ----->
<?php
    //显示帖子信息
    $html_str=

<<<HTML_STR
    <div class="t">
        <table cellSpacing="0" cellspacing="0" width="100%">
            <tr class="tr1">
              <th >
                <B> $curTopic[uName]</B><BR/>
                <img src="image/head/$curTopic[head]"/>
                <BR/>注册:$curTopic[regTime]<BR/>
              </th>
              <th>
                  <h4>$curTopic[Title]</h4>
                  <div>$curTopic[Content]</div>
                  <DIV class="tipad gray">
                            发表：[$curTopic[publishTime] ] 最后修改：[$curTopic[modifyTime] ]
                  </DIV>
              
              </th>
              </tr>
              </table>
              </div>
HTML_STR;
    if($replies->num_rows>0){//判断当前帖子是否有回帖
        $curId="";
        if (isset($_SESSION["current_user"])) {//判断是否登录
            $current_user = $_SESSION["current_user"];//取当前用户信息
            $curId = $current_user["uid"];
        }

        foreach($replies as $reply){
            $tmp = "";
        if($curId==$reply["uid"]){
            $tmp .= <<<HTML_STR
            <A href="javascript:deleteReply('$reply[Title]',' $reply[rId]','$boardId','$curPage') ">[删除]</A>
            <A HREF="update.php?currentPage=$curPage&currentReplyPage=$curReplyPage&boardId=$boardId&topicId=$topicId&replyId=$reply[rId] ">[修改]</A>
HTML_STR;
        }
        $html_str.=<<<HTML_STR
            <div class="t">
        <table cellSpacing="0" cellspacing="0" width="100%">
            <tr class="tr1">
              <th >
                <B> $reply[uName]</B><BR/>
                <img src="image/head/$reply[head]"/>
                <BR/>注册:$reply[regTime]<BR/>
              </th>
              <th>
                  <h4>$reply[Title]</h4>
                  <div>$reply[Content]</div>
                  <DIV class="tipad gray">
                            发表：[$reply[publishTime] ] 最后修改：[$reply[modifyTime] ]
                  </DIV>
              
              </th>
              </tr>
              </table>
              </div>
HTML_STR;
    }
    }
    echo $html_str.$tmp ;
    ?>
</div>
<br>
<div>
    <?php
    $html_str = <<<HTML_STR
<div style="margin: 0 auto">
    <form name="postForm" onsubmit="return valid()" action="manage/doReply.php" method="post">
        <input type="hidden" name="boardId" value="$boardId">
        <input type="hidden" name="topicId" value="$topicId">
        <br>标题：
        <input class="input" tabindex="1" type="text" maxlength="20" size="40" name="title">
        <br>
        <br>内容：
        <textarea tabindex="2" cols="40" rows="6" name="content"></textarea>
        <br>
        <br>
        <input class="btn" tabindex="3" type="submit" value="提交">
    </form>
</div>
HTML_STR;
    echo $html_str;
    ?>
</div>
<!--声明 -->
<br/>
<center class="gray">2019 php 版权所有</center>
</body>
</html>
