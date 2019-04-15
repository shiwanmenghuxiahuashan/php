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
$isbn = $_POST['isbn'];
$author = $_POST['author'];
$title = $_POST['title'];
$price = $_POST['price'];
    
    //验证用户提交数据是否存在
if (!$isbn || !$author || !$title||!$price) {
    echo '都给哥填上，少一个都不行';
    exit;
}
    // if(!get_magic_quotes_gpc()){
    //     $searchtype=addcslashes($searchtype);
    //     $searchterm=addcslashes($searchterm);
    // }

$db = new mysqli('localhost', 'root', 'zhouzhou100428', 'books');
    // var_dump($db);
if (!$db) {
    die("连接失败: " . mysqli_connect_errno());
}

$query = "insert into books values ('".$isbn."','".$author."','".$title."','".$price."')";
$result = $db->query($query);
if($result){
    echo $db->affected_rows."书已经插入进数据库";
}else{
    echo "出错了";
};

$db->close();
?>
</div>
</body>