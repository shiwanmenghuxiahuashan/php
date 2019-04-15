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

			<h3>添加商品到购物车</h3>
				<?php
				//从数据库中读取要购买的信息，添加到购物车中
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
			/*	PDO::query() 在单次函数调用内执行 SQL 语句，以 PDOStatement 对象形式返回结果集（如果有数据的话）。 
			如果反复调用同一个查询，用 PDO::prepare() 准备 PDOStatement 对象，并用 PDOStatement::execute() 执行语句，将具有更好的性能。 
			 */

			$sql = "select * from goods where id=".$_GET['id'];
		
			$result = $dbh->query($sql);
			/**
			 * PDOStatement::rowCount() 返回上一个由对应的 PDOStatement 对象执行DELETE、 INSERT、或 UPDATE 语句受影响的行数。
			 * 不能用 $row = $result->fetch(PDO::FETCH_ASSOC)  取值判断 $row是否有效
			 * 因为只有一条数据时，会在while处再次获取下一行，而下一行没有值，不会显示
			 */

			//4.判断是否没有找到信息，若有，则读取信息系
			if(empty($result) || $result->rowCount()==0){
				die("没有找到要购买的信息");
			}else{
				$shop=$result->fetch(PDO::FETCH_ASSOC);
				echo '<h3 class="text-success">放入购物车成功</h3>';
			}
			$shop["num"]=1;
			//5.放入购物车(已存在的商品累加)
			if(isset($_SESSION['shoplist'][$shop['id']])){
				$_SESSION['shoplist'][$shop['id']]["num"]++;
			}else{
				$_SESSION['shoplist'][$shop['id']]=$shop;
			}
			
			//释放结果集，关闭数据库
			// 现在运行完成，在此关闭连接
			$dbh = null;
			?>
		</center>
	</body>
</html>