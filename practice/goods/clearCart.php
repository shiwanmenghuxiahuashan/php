<?php
//删除session中的信息
session_start();//启动

if(isset($_GET['id'])){
//删除指定
unset($_SESSION['shoplist'][$_GET['id']]);
}else{
//清空
unset($_SESSION['shoplist']);
}


header("Location:myCart.php");
?>