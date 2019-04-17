<?php 
include('./db.php');
// var_dump($_SERVER['QUERY_STRING']); 
// var_dump($_SERVER['REQUEST_METHOD']);

if(array_key_exists('apiType',$_REQUEST)){
    // Database::[$_REQUEST['apiType']]();
    $callBackName='Database::'.$_REQUEST['apiType'];
echo $callBackName;
    //动态调用静态方法使用call_user_func,mixed call_user_func( callable $callback[, mixed $parameter[, mixed $...]] )
    //第一个参数 callback 是被调用的回调函数，其余参数是回调函数的参数。
    // call_user_func(callBackName,array());
};
// var_dump($_REQUEST);
// echo'<br/>';
// var_dump($_POST);