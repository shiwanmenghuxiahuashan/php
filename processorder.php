<!DOCTYPE html>
<?php

 $tireqty= $_GET['tireqty'];#轮胎
  $oliqty= $_GET['oliqty'];#油
  $sparkqty= $_GET['sparkqty'];#火花塞
    $find=$_GET['find'];#如何找到    
    $address=$_GET['address'];#如何找到    
    $DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
 
?>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>鲍勃电子商务</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Bob's Auto Parts {鲍伯汽车配件}   <small> <?php echo '<p>'.date('jS F Y,H:i').'</p>'; ?></small></h1>
                <h5>order processed {订单处理}</h5>
            <a class="link" href="freight.php">运费</a>
            <a class="link" href="vieworders.php">查看订单</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="panel-title">服务器根目录</div>
                </div>
                <div class="panel-body">

                    <?php 
                        echo $DOCUMENT_ROOT;
                    ?>
                </div>
            </div>
          <?php

           echo '';

           $totalqty=0;
           $totalqty=$tireqty+$oliqty+$sparkqty;
           if($totalqty==0){
               echo '<h3>您没有订购商品</h3> ';
               echo '<button class="btn btn-primary" onclick="history.back(-1)"> 返回</button>';
           }else{
                echo '
                    <h2>Order Results</h2>
                    <ul class="list-group" style="width:50%;margin:10px auto">';
                    echo '<li class="list-group-item" >Items ordered (订购) :<span class="badge"> '.$totalqty.'</span></li>';
                    $totalamount=0.00;
            
                    //定义商品价格使用常量
                    define('TIREPRICE',100);#轮胎
                    define('OILPRICE',10);#油
                    define('SPARKPRICE',4);#火花塞
                    //计算总价
                    $totalamount=$tireqty * TIREPRICE
                            +$oliqty*OILPRICE
                            +$sparkqty * SPARKPRICE;
                    echo '<li class="list-group-item" > Subtotal(小计): ￥ <span class="badge">'.number_format($totalamount,2).'</span></li>';
                     //计算税率
                     $taxrate=0.10;
                     $totalamount=$totalamount*(1+$taxrate);
                    echo '<li class="list-group-item" > Total including tax (含税总计): ￥<span class="badge">'.number_format($totalamount,2).'</span></li>';
                        echo '<li class="list-group-item">
                            <ul  class="list-group">'.
                                '<li class="list-group-item">订单详情 <span class="badge">通过 '.$find.' 了解到商店信息</span></li>'.
                                '<li class="list-group-item" >轮胎：'.$tireqty.' 个<span class="badge">'.$tireqty * TIREPRICE.'元</span></li>'.
                                '<li class="list-group-item" >油：'.$oliqty.' 个<span class="badge">'.$oliqty*OILPRICE .'元</span></li>'.
                                '<li class="list-group-item" >火花塞：'.$sparkqty.' 个<span class="badge">'.$sparkqty * SPARKPRICE .'元</span></li>'.
                                '<li class="list-group-item" >送货地址： <span class="badge">'.$address.'</span></li>'.
                                '</ul>'.
                        '</li>';
                echo '</ul>';

                //储存订单
                $fp=fopen("$DOCUMENT_ROOT/order/order.txt",'ab');
                if(!$fp){
                    echo '<p class="bg-warning">订单不能存储<br/>请查看 $fp指针</p>';
                    exit;
                }
                //拼接内容
                $outputstring=$date."\t".$tireqty."轮胎 \t".$oliqty."油 \t".$sparkqty."火花塞 \t"."总计：\t".$totalqty."\t".$address."\r";
                //写文件
                fwrite($fp,$outputstring);
                //关闭指针
                fclose($fp);


           }
         
          ?>
        </div>
    </div>
</body>
</html>