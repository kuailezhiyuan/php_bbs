<?php
$html_page = "";
if ($curPage == 0) {//判断是否为第一页
//    $html_page  .= "上一页";
    $html_page  .= "";
} else {
    $curPage--;
    $html_page .= "<a href='list.php?boardId=$bid&currentPages=$curPage'>上一页</a>  ||  ";
    $curPage++;
}
if (($curPage + 1) >= $pages) {//判断是否为最后一页
//  $html_page = "下一页";
    $html_page .= "";
} else {
    $curPage++;
    $html_page .= "<a href='list.php?boardId=$bid&currentPages=$curPage'>下一页</a>  ||  ";
    $curPage--;
}
$tmp = $curPage + 1;
$html_page .= "当前第 $tmp 页/共 $pages 页";
echo $html_page;
?>
