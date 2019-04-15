<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品信息管理</title>
    <link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
</head>
<body>
        <?php 

        require("menu.php");//引入导航栏
        //1.导入配置文件
        require("dbconfig.php");
        //2.连接数据库
        $link = mysql_connect(HOST, USER, PASS) or die("数据库连接出错");
        //2.1设置编码
        mysql_query('set name utf8');
        //2.2选择数据库
        mysql_select_db(DBNAME, $link);
        //3.执行语句
        $sql = 'select * from stu where id=' . $_GET['id'];

        $result = mysql_query($sql, $link);

        if ($result && mysql_num_rows($result) > 0) {
            $stu= mysql_fetch_assoc($result);
        }
        ?>
    <div class="container">
        <h3 class="text-center">添加学生信息</h3>
    <?php $stu['name'];?>
        <form enctype="multipart/form-data" method="POST" action="action.php?a=update">
            <input name="id" type="hidden" value="<?php echo $stu['id']; ?>">
            <div class="form-group">
                <label >姓名：</label>
                <input  type="text" name="name" class="form-control"   placeholder="名称" value="<?php echo $stu["name"]; ?>">
            </div>
            <div class="form-group">
                <label >性别：</label>
                <select class="form-control" name="sex">
                    <option   <?php echo $stu['sex'] == 0 ? "selected" : ""; ?> value="0">女</option>
                    <option   <?php echo $stu['sex'] == 1 ? "selected" : ""; ?> value="1">男</option>
                </select>
            </div>
            <div class="form-group">
                <label >年龄：</label>
                <input value="<?php echo $stu['age']; ?>" type="text" name="age" class="form-control"  placeholder="年龄">
            </div>

            <div class="form-group">
                
                <button type="submit" class="btn btn-success">提交</button>

               <button type="reset" class="btn btn-danger">重置</button>
           
            </div>
        </form>

    </div>
    <br/>
    <br/>
    <br/>
    <?php 
    //4.关闭数据库连接
    mysql_close($link);
    ?>
</body>
</html>