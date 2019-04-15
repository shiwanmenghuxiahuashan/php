<?php 
//增删改查的action动作

//1.导入配置文件
require('dbconfig.php');

//2.连接数据库，并选择数据库
$link=mysql_connect(HOST,USER,PASS) or die('数据库连接失败！');

mysql_query('set names utf8');//设置编码 解决中文乱码问题

mysql_select_db(DBNAME,$link);//选择数据库

//3.根据参数A值，做对应操作
switch($_GET['a']){
    case "add":{
        //1.获取要添加的信息
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $age=$_POST['age'];
        $addtime=time();
        //2.拼装SQL语句
        $sql="insert into stu value(null,'{$name}',$sex,$age, $addtime)";
        //3.执行语句
        $result=mysql_query($sql);
        //4.判断执行结果
        if(mysql_affected_rows($link)>0){
            echo '<h3 class="text-success">成功</h3>';
        }else{
            echo '<h3 class="text-danger">失败</h3>';
        }

        
        break;

    };
    case "del":{

        $sql='delete from stu where id='.$_GET['id'];

        $result=mysql_query($sql);
        
        if(mysql_affected_rows($link)>0){
            echo '<h3 class="text-success">成功</h3>';
        }else{
            echo '<h3 class="text-danger">失败</h3>';
        }
        break;
    };
    case "update":{
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $age=$_POST['age'];
        $id=$_POST['id'];
        $sql="update stu set name='{$name}',sex=$sex,age=$age where id={$id}";

        $result=mysql_query($sql);

        if(mysql_affected_rows($link)>0){
            echo '<h3 class="text-success">成功</h3>';
        }else{
            echo '<h3 class="text-danger">失败</h3>';
        }
        break;
    };
    default;
    break;
};
//4.关闭数据库连接
mysql_close($link);

header("Location: http://127.0.0.2:4787/php/lianxi/phpandmysql/index.php"); 
?>