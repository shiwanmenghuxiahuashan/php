<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新闻管理系统</title>
    <link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
</head>
<body>

<?php include("menu.php");//引入导航栏 ?>
    <div class="container">
        <h3 class="text-center">添加新闻</h3>

        <form enctype="multipart/form-data" method="POST" action="action.php?actuib=add">
            <div class="form-group">
                <label >标题：</label>
                <input type="text" name="title" class="form-control"  placeholder="标题">
            </div>
            <div class="form-group">
                <label >关键字：</label>
                <input type="text" name="keywords" class="form-control"  placeholder="关键字">
            </div>
            <div class="form-group">
                <label >作者：</label>
                <input type="text" name="author" class="form-control"  placeholder="关键字">
            </div>
            <div class="form-group">
                <label >内容：</label>
              <textarea class="form-control" name="content" cols="30" rows="10"></textarea>
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