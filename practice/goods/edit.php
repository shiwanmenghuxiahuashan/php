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

include("menu.php");//引入导航栏
		//1.导入配置文件 
include("dbconfig.php");
        //2. 连接数据库，并选择数据库
try {
    $dbh = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
/**PDO::exec() 在一个单独的函数调用中执行一条 SQL 语句，返回受此语句影响的行数。
PDO::exec() 不会从一条 SELECT 语句中返回结果。对于在程序中只需要发出一次的 SELECT 语句，可以考虑使用 PDO::query()。
对于需要发出多次的语句，可用 PDO::prepare() 来准备一个 PDOStatement 对象并用 PDOStatement::execute() 发出语句。

PDO::query() 在单次函数调用内执行 SQL 语句，以 PDOStatement 对象形式返回结果集（如果有数据的话）。

如果反复调用同一个查询，用 PDO::prepare() 准备 PDOStatement 对象，并用 PDOStatement::execute() 执行语句，将具有更好的性能。

*/
//3. 获取要修改的商品信息
$sql = "select * from goods where id=" . $_GET['id'];

$result = $dbh->query($sql);

//4.判断是否获取到要编辑的商品信息。
/** 
 * PDO::query() 返回 PDOStatement 对象，或在失败时返回 FALSE。 
 * 所以应该调用PDOStatement的影响行统计方法 rowCount（）
 * 
 * PDOStatement::rowCount — 返回受上一个 SQL 语句影响的行数 
 */

if($result &&$result->rowCount()>0){
     $shop = $result->fetch(PDO::FETCH_ASSOC);
}else{
    die("没有找到要修改的商品信息");
}





?>
    <div class="container">
        <h3>编辑商品信息</h3>
        <form enctype="multipart/form-data" method="POST" action="action.php?action=update">
            <div class="form-group">
                <label>名称：</label>
                <input type="text" name="name" class="form-control" placeholder="名称" value=" <?php echo  $shop['name']; ?>">
            </div>
            <div class="form-group">
                <label>类型</label>
                <!-- <input type="text" name="typeid" class="form-control"  placeholder="类型"> -->
                <select class="form-control" name="typeid">
                    <?php
                    foreach ($typelist as $key => $value) {
                        $sd=$key==$shop['typeid']?'selected="selected"':'';
                        echo '<option '. $sd.' value="' . $key . '">', $value, '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>单价：</label>
                <input type="text" name="price" class="form-control" placeholder="单价" value=" <?php echo  $shop['price']; ?>">
            </div>
            <div class="form-group">
                <label>库存：</label>
                <input type="text" name="total" class="form-control" placeholder="库存" value=" <?php echo  $shop['total']; ?>">
            </div>
            <div class="form-group">
                <label>图片：</label>
                <input type="file" name="pic" class="form-control" placeholder="图片" value=" <?php echo  $shop['pic']; ?>">
            </div>
            <div class="form-group">
                <label>描述：</label>
                <textarea type="text" name="note" class="form-control" placeholder="描述"><?php echo trim( $shop['note']); ?></textarea>
            </div>
            <!-- 显示商品图片 s -->
            <div class="form-group">
                <label>商品图片</label>
               <img  class="img-responsive center-block" src="./uploads/<?php echo $shop['pic']?>" alt="">
            </div>
            <!-- 显示商品图片 e -->


            <!-- 获取商品ID和图片名称 s -->
            <input type="hidden" name="id" value="<?php echo $shop['id']?>">

            <input type="hidden" name="oldpic" value="<?php echo $shop['pic']?>">
            <!-- 获取商品ID和图片名称 e -->
          
          <div class="form-group">

                <button type="submit" class="btn btn-success">修改</button>

                <button type="reset" class="btn btn-danger">重置</button>

            </div>

        </form>
    </div>
    <br />
    <br />
    <br />
</body>

</html>