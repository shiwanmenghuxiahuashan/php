<?php
include('./db.php');
include('./base.php');
// var_dump($_SERVER['QUERY_STRING']); 
// var_dump($_SERVER['REQUEST_METHOD']);
if (array_key_exists('apiType', $_REQUEST) && array_key_exists('apiTab', $_REQUEST)) {

    $md5hash = parse_ini_file('./md5hash.ini');
    var_dump(base::isGet());
    die();
    //从md5hash返回的字符串中截取真正使用表名和数据库名--最后一个索引是真正使用的
    //end() 将 array 的内部指针移动到最后一个单元并返回其值。 mixed end( array &$array)

    $db_op = end(split('_', $md5hash[$_REQUEST['apiType']]));

    $tableName = end(split('_', $md5hash[$_REQUEST['apiTab']]));


    // array_keys


        $callBackName = 'Database::' . $db_op;


    //动态调用静态方法使用call_user_func,mixed call_user_func( callable $callback[, mixed $parameter[, mixed $...]] )
    //第一个参数 callback 是被调用的回调函数，其余参数是回调函数的参数。
    // if(call_user_func(callBackName,array())){

    // };
} else {
    $data = ['msg' => 200, 'info' => '错误'];
    echo json_decode($data);
}
var_dump($_REQUEST);
// echo'<br/>';
// var_dump($_POST);
