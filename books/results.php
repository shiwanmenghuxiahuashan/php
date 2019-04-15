<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>查询结果</title>
    <link rel="stylesheet" href="../../static/css/bootstrap.min.css">
</head>
<body>

<div class="container">
<h1>查询结果</h1>
<h2>
<a href="http://127.0.0.2:4787/php/books/search.html">返回</a>
</h2>
<h2>
<a href="http://127.0.0.2:4787/php/books/newbook.html">新增图书</a>
</h2>
<?php

    //创建短变量名称
$searchtype = $_POST['searchtype'];
$searchterm = trim($_POST['searchterm']);//通过trim()过滤用户不小心输入的空白字符
    
    //验证用户提交数据是否存在
if (!$searchtype || !searchterm) {
    echo '<h2 class="waring">You have not entered search details.Please go back and try again.<smal>您没有输入搜索细节。请返回并再试一次。</smal></h2>';
    exit;
}
    // if(!get_magic_quotes_gpc()){
    //     $searchtype=addcslashes($searchtype);
    //     $searchterm=addcslashes($searchterm);
    // }

$db = new mysqli('localhost', 'xxxxxx', 'xxxxxxxxxxxxxxxxxx', 'xxxxxxxxxx');
    // var_dump($db);
if (!$db) {
    die("连接失败: " . mysqli_connect_errno());
}

$query = "select * from books where " . $searchtype . " like '%" . $searchterm . "%'";
    // $query="select * from books limit 6";
    // $query="select * from books";
$result = $db->query($query);
   
//获取总数据行数返回的行数保存在结果对象的 num_rows成员中
$num_results = $result->num_rows;
// var_dump($num_results);

echo '<h2>找到' . $num_results . '本书</h2>';

echo '<table class="table table-striped"><thead><tr><th>序号</th><th>标题</th><th>作者</th><th>ISBN</th></tr></thead><tbody>';
for ($i = 0; $i < $num_results; $i++) {
        //mysql_fetch_assoc() 函数从结果集中取得一行作为关联数组（这句我一开始没明白...我复制 w3c 的解释，其实就是  从数据库查询结果数据的行以PHP数组形式返回）。
        // 返回根据从结果集取得的行生成的关联数组，如果没有更多行，则返回 false。（每个数据行关键词作为一个属性名，每个值作为数组中相应的值），使用的是$result->fetch_assoc()。
    $row = $result->fetch_assoc();
    //调用stripslashes() 函数以便在显示前整理被转义的值。
    echo '<tr><td>' . ($i + 1) . '</td><td>' . htmlspecialchars(stripslashes($row['title'])) . '</td><td>' . stripcslashes($row['author']) . '</td><td>' . stripcslashes($row['isbn']) . '</td><td>' . stripcslashes($row['price']) . '</td></tr>';
}
echo '</table>';
$result->free();
$db->close();
?>
</div>
</body>