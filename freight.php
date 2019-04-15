<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>鲍勃电子商务</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <h1>Bob's Auto Parts {鲍伯汽车配件} 
              <small> <?php echo '<p>'.date('jS F Y,H:i').'</p>'; ?></small>
           </h1>
        <table class="table table-striped table-hover">
            <tr>
                <td class='text-center'><h3>distance(距离)</h3></td>
                <td class='text-center'><h3>cost(成本)</h3></td>
            </tr>
            <?php 
                $distance=50;
                while ($distance<=600){
                    echo "<tr> 
                            <td class='text-center'>$distance</td>
                            <td class='text-center'>".($distance/10)."元</td>
                         </tr>";
                         $distance+=50;
                }
            ?>
        </table>

            <ul class="list-group">
                <li class="list-group-item">for 循环</li>
                <?php
                    for($_i=0;$_i<16;$_i++){
                        echo '<li class="list-group-item" > 李重楼测试<span class="badge">'.$_i.'</span></li>';
                    }
                ?>
            </ul>

    </div>
</body>
</html>