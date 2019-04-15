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
<?php include("menu.php");//引入导航栏 ?>
    <div class="container">
        <h3 class="text-center">添加学生信息</h3>

        <form enctype="multipart/form-data" method="POST" action="action.php?a=add">
            <div class="form-group">
                <label >姓名：</label>
                <input type="text" name="name" class="form-control"  placeholder="名称">
            </div>
            <div class="form-group">
                <label >性别：</label>
                <select class="form-control" name="sex">
                    <option value="0">女</option>
                    <option value="1">男</option>
                </select>
            </div>
            <div class="form-group">
                <label >年龄：</label>
                <input type="text" name="age" class="form-control"  placeholder="年龄">
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
</body>
</html>