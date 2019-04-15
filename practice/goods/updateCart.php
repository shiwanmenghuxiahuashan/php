<?php
//修改购物车中信息

session_start();//启动会话

$id=$_GET['id'];

$num=$_GET['num'];

if($_SESSION['shoplist'][$id]["num"]<=1 && $num<1 ){
    unset($_SESSION['shoplist'][$id]);
}else{
    $_SESSION['shoplist'][$id]["num"]+=$num;
}


header("Location:myCart.php");

?>