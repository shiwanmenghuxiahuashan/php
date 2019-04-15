<html>
	<head>
		<title>商品信息管理</title>
	<link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
	</head>
	<body>
		<center>
			<?php include("menu.php"); //导入导航栏  ?>
			<h3>发布商品信息<h3>
			<table  class="table table-bordered text-center" >
				<tr>
					<th>商品编号</th>
					<th>商品名称</th>
					<th>商品图片</th>
					<th>描述信息</th>
					<th>单价</th>
					<th>库存量</th>
					<th>添加时间</th>
					<th>操作</th>
				</tr>
				<?php
				//从数据库中读取信息并输出到浏览器表格中
				//1.导入配置文件 
			include("dbconfig.php");
				//2. 连接数据库，并选择数据库
			try {
				$dbh = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
				
			//3. 执行商品信息查询
			/**PDO::exec() 在一个单独的函数调用中执行一条 SQL 语句，返回受此语句影响的行数。 
			PDO::exec() 不会从一条 SELECT 语句中返回结果。对于在程序中只需要发出一次的 SELECT 语句，可以考虑使用 PDO::query()。
			对于需要发出多次的语句，可用 PDO::prepare() 来准备一个 PDOStatement 对象并用 PDOStatement::execute() 发出语句。 

			PDO::query() 在单次函数调用内执行 SQL 语句，以 PDOStatement 对象形式返回结果集（如果有数据的话）。 

			如果反复调用同一个查询，用 PDO::prepare() 准备 PDOStatement 对象，并用 PDOStatement::execute() 执行语句，将具有更好的性能。 

			 */
			$sql = "select * from goods";
			$result = $dbh->query($sql);
			/**
			 * PDOStatement::rowCount() 返回上一个由对应的 PDOStatement 对象执行DELETE、 INSERT、或 UPDATE 语句受影响的行数。
			 * 不能用 $row = $result->fetch(PDO::FETCH_ASSOC)  取值判断 $row是否有效
			 * 因为只有一条数据时，会在while处再次获取下一行，而下一行没有值，不会显示
			 */
			$rowCount = $result->rowCount();
			
			if ($rowCount>0) {
			
				//4. 解析商品信息（解析结果集）
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>";
					echo "<td>{$row['id']}</td>";
					echo "<td>{$row['name']}</td>";
					echo "<td><img  class='img-responsive center-block' src='./uploads/s_{$row['pic']}'/></td>";
					echo "<td>{$row['note']}</td>" ,"<td>{$row['price']}</td>";
					echo "<td>{$row['total']}</td>";
					echo "<td>" . date("Y-m-d H:i:s", $row['addtime']) . "</td>";
					echo "<td> 
									<a href='action.php?action=del&id={$row['id']}&picname={$row['pic']}'>删除</a> 
									<a href='edit.php?id={$row['id']}'>修改</a>
									<a href='addCart.php?id={$row['id']}'>放入购物车</a></td>
							</td>";
							
					echo "</tr>";
				}
			}else{
				echo '<tr><td class="text-center" colspan="8">暂无商品</td></tr>';
			}
				//5. 释放结果集，关闭数据库
				// 现在运行完成，在此关闭连接
			$dbh = null;
			?>
			</table>
		</center>
	</body>
</html>