<?php
session_start();//启动会话
?>

<html>
	<head>
		<title>商品信息管理</title>
		<link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
	</head>
	<body>
		<center>

			<?php include("menu.php"); //导入导航栏  ?>

			<h3>浏览我的购物车</h3>
			<table  class="table table-bordered text-center" >
				<tr>
					<th>商品编号</th>
					<th>商品名称</th>
					<th>商品图片 </th>
					<th>单价</th>
					<th>数量</th>
					<th>小计</th>
					<th>操作</th>
				</tr>
			<?php
				//视频里
		$sum = 0;//总金额变量
		if (isset($_SESSION['shoplist'])) {
			foreach ($_SESSION['shoplist'] as $k => $v) {
				echo '<tr>';
				echo "<td>{$v['id']}</td>";
				echo "<td>{$v['name']}</td>";
				echo "<td><img  class='img-reposive' src='./uploads/s_{$v['pic']}'></td>";
				echo "<td>{$v['price']}</td>";
				echo "<td>";
					echo '<button class="btn btn-defalut" onclick="change(false,'.$v["id"].')">-</button>';
					echo  $v['num'];
					echo '<button class="btn btn-defalut"  onclick="change(true,'.$v["id"].')">+</button>';
				echo "</td>";
				echo "<td>" . ($v['num'] * $v['price']) . "</td>";
				echo "<td><a href='clearCart.php?id={$v['id']}'>删除</a></td>";
				echo '</tr>';
				$sum += $v['num'] * $v['price'];
			}
		} else {
			echo '<tr><td class ="text-center" colspan="7">空</td></tr>';
		}
				
				//我写的
				// foreach ($_SESSION['shoplist'] as $key => $value) {
				// 	echo '<tr>';
				// 	foreach ($value as $k => $v) {
				// 		echo '<td data-key="'.$k.'">';
				// 		if($k=="addtime"){
				// 			echo  date('Y-m-d H:m:s',$v);
				// 		}else if($k == 'pic'){
				// 			echo  '<img  class="img-reposive" src="./uploads/s_'.$v.'">';
				// 		}else{
				// 			echo $v;
				// 		}
					
				// 		echo '</td>';
				// 	}
				// 	echo '</tr>';
				// }

		?>
			<tr>
				<th>总计金额：</th>
				<th colspan="5"><?php echo $sum; ?></th>
				<th>&nbsp;</th>
			</tr>
			
			</table>
		</center>
		<script>
			function change(isAdd,id){
				var _num=null;
				if(isAdd){
					_num=1;
				}else{
					_num=-1;
				}
				window.location.href="updateCart.php?id="+id+"&num="+_num;
			}
		</script>
	</body>
</html>