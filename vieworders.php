<?php
    $DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>鲍勃电子商务</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body>
<h1>顾客订单</h1>
<?php
// @ 抑制报错
    @$fp=fopen("$DOCUMENT_ROOT/order/order.txt",'rb');
    // file end of file 文件结尾
    while(!feof($fp)){
        $order=fgets($fp,999);
        echo nl2br($order).'<br />';
    }

?>
</body>