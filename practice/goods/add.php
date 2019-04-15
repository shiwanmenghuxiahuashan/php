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
        <h3>发布商品信息</h3>
        <form enctype="multipart/form-data" method="POST" action="action.php?action=add">
            <div class="form-group">
                <label >名称：</label>
                <input type="text" name="name" class="form-control"  placeholder="名称">
            </div>
            <div class="form-group">
                <label >类型</label>
                <!-- <input type="text" name="typeid" class="form-control"  placeholder="类型"> -->
                <select class="form-control" name="typeid">
                    <?php
                    include("dbconfig.php");
                    foreach ($typelist as $key => $value) {
                        echo '<option value="' . $key . '">', $value, '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label >单价：</label>
                <input type="text" name="price" class="form-control"  placeholder="单价">
            </div>
            <div class="form-group">
                <label >库存：</label>
                <input type="text" name="total" class="form-control"  placeholder="库存">
            </div>
            <div class="form-group">
                <label >图片：</label>
                <input type="file" name="pic" class="form-control"  placeholder="图片">
            </div>
            <div class="form-group">
                <label >描述：</label>
                <textarea type="text" name="note" class="form-control"  placeholder="描述"></textarea>
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