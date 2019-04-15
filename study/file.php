<?php
$path = './';

$url=$_SERVER['REQUEST_URI'];

if(isset($_GET['dir'])){
    $path=$path.'/'.$_GET['dir'];
}else{
    $url=  $url.'?dir=.';
}
echo __FILE__;
echo realpath($path);exit;

/**打开文件 */
$dh = opendir($path);

if ($dh === false) {
    echo '打开出错';
    exit;
}
$list = [];
while (($item = readdir($dh)) !== false) {
    $list[] = $item;
}


closedir($dh);
// for ($i=0; $i <count($list) ; $i++) { 
//  echo $list[$i],'<br/>';
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        td{
            border:1px solid #014787;
        }
    </style>
</head>
<body>
    <h1>文件管理系统</h1>
    <table>
        <tr>
            <td>序号</td>
            <td>文件名</td>
            <td>操作</td>
        </tr>
        <?php 
           foreach ($list as $k=>$v) {
                echo '<tr>';
                echo ' <td>', $k, '</td>';
                echo ' <td>', $v, '</td>';
                if(is_dir($path.'./'.$v)){
                    echo ' <td><a href="',$url.'/',$v,'">浏览</a></td>';
                }else{
                    echo ' <td><a href="./',$_GET['dir'],$v,'">查看</a></td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>