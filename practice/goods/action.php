<?php
//执行商品信息的增删改查

//一，导入配置和函数库文件
include("functions.php");
include("dbconfig.php");
// //二，链接数据库
try {
    $dbh = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//三，获取action参数的值，做对应的操作
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            {//添加
            //1.获取添加信息
                $name = $_POST["name"];
                $typeid = $_POST["typeid"];
                $price = $_POST["price"];
                $total = $_POST["total"];
                $note = $_POST["note"];
                $addtime = time();

            //2.验证 省略掉，可以交给JS解决
                if (empty($name)) {
                    die("商品名称必须有值！");
                }
            //3.执行图片上传
                $upinfo = uploadFile('pic', './uploads');

                if ($upinfo['error'] === false) {
                    die("图片信息上传失败:" . $upinfo['info']);
                } else {
                    $pic = $upinfo['info'];//获取上传成功的图片名称
                        //4.执行图片缩放
                    imageUpdateSize('./uploads/' . $pic, 50, 50);
                }
               
        
            //5.拼装SQL语句
                $sql = "insert into goods values(null,'{$name}','{$typeid}',{$price},{$total},'{$pic}','{$note}',{$addtime})";
                //查询
                /**
                 * PDO::query() 返回 PDOStatement 对象，或在失败时返回 FALSE。
                 */
                $result = $dbh->query($sql);

              //6.判断并输出结果
                if ($result !== false) {
                    echo "添加商品发布成功";
                } else {
                    echo "添加商品发布失败！" . var_dump($dbh->errorInfo());
                }
                echo '<br /><a href="index.php">查看商品信息</a>';

                $dbh = null;

                break;
            }
        case 'del':
            {//删除
                $sql = "delete from goods where id={$_GET['id']}";

                $result = $dbh->query($sql);

                if ($result != false) {//受影响的行
                    echo '删除成功';
                } else {
                    echo '删除时发生错误。';
                };


                @unlink('./uploads/' . $_GET['picname']);
                @unlink('./uploads/s_' . $_GET['picname']);

                $dbh = null;

                header("Location:index.php");

                break;
            }
        case 'update':
            {//修改

                //1.获取要修改的信息。
                $name = $_POST["name"];
                $typeid = $_POST["typeid"];
                $price = $_POST["price"];
                $total = $_POST["total"];
                $note = $_POST["note"];
                $id = $_POST["id"];
                $pic = $_POST['oldpic'];

                //2.数据验证
                if (empty($name)) {
                    die("商品名称必须有值！");
                }
                //3.判断有无图片上传
                if ($_FILES['pic']['error'] != 4) {
                    $upinfo = uploadFile('pic', './uploads');

                    if ($upinfo['error'] === false) {
                        die("图片信息上传失败:" . $upinfo['info']);
                    } else {
                        /**有图片上传则给PIC赋值新图片名称，否则是老图片名称 */
                        $pic = $upinfo['info'];//获取上传成功的图片名称
                             //4.有图片上传执行缩放。
                        imageUpdateSize('./uploads/' . $pic, 50, 50);
                    }
                }
               
                //5.执行修改
                $sql = "update goods set name='{$name}',typeid='{$typeid}',price={$price},total={$total},pic='{$pic}',note='{$note}' where id={$id}";

                $result = $dbh->query($sql);
              
                //6.判断是否修改成功
                if ($result->rowCount() > 0) {
                    if ($_FILES['pic']['error'] != 4) {
                              //先删除之前图片
                        unlink('./uploads/' . $_POST['oldpic']);
                    //删除缩略图
                        unlink('./uploads/s_' . $_POST['oldpic']);
                    //上传更改后的图片
                    }
                    echo "修改成功";
                } else {
                    echo "修改失败";
                }
                echo '<br /><a href="index.php">查看商品信息</a>';
                $dbh = null;

                break;
            }
        default:
            {
                break;
            }

    }
} else {
    $dbh = null;
};
//四，关闭数据库
