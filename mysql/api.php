<?php
include('./db.php');
include('./base.php');
// var_dump($_SERVER['QUERY_STRING']); 
// var_dump($_SERVER['REQUEST_METHOD']);
if (array_key_exists('apiType', $_REQUEST) && array_key_exists('apiTab', $_REQUEST)) {

   
    $db_op = Base::md5($_REQUEST['apiType']);

    $callBackName = 'Database::' . $db_op;

    $tableName = Base::md5($_REQUEST['apiTab']); 

    // array_keys

    if(Base::isPost()){

        $field=implode(',',array_keys($_POST));
       
        foreach ($_POST as $key => $v) {
            $values[]=$v;
        }

    }
    // $tableName, $fields, $values)


      


    //动态调用静态方法使用call_user_func,mixed call_user_func( callable $callback[, mixed $parameter[, mixed $...]] )
    //第一个参数 callback 是被调用的回调函数，其余参数是回调函数的参数。
    if(call_user_func($callBackName,$tableName,$field,$values,Base::buildStmt(count($values)))){
        echo '<h1 class="text-success">插入成功</h1><a href="./index.html">返回首页</a>';
    };
} else {
    $data = ['msg' => 200, 'info' => '错误'];
    echo json_decode($data);
}

// 
// var_dump($_POST);
