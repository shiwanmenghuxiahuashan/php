<html>
	<head>
		<title>php与MySQL的增删改查</title>
		<link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
	</head>
	<body>
		<center>
			<?php include("menu.php"); //导入导航栏  ?>
			<h3>学生信息管理<h3>
			<hr>
			<table  class="table table-bordered text-center" >
				<tr>
					<th  class=" text-center" >学生id</th>
					<th  class=" text-center" >名字</th>
					<th  class=" text-center" >性别</th>
					<th  class=" text-center" >年龄</th>
					<th  class=" text-center" >添加时间</th>
					<th  class=" text-center" >操作</th>
				</tr>
				<?php
				//1.导入配置文件
				require("dbconfig.php");
				//2.获取数据库连接
				$link = mysql_connect(HOST, USER, PASS) or die('数据库连接失败');
				//2.1 选择数据库
				mysql_query('set names utf8');//设置编码 解决中文乱码问题
				mysql_select_db("lileidb");
				//3.拼装语句
				$sql = "select * from stu";
				//4.执行结果
				$result = mysql_query($sql);
				//5.判断是否成功
				if (mysql_affected_rows($link) > 0) {
					//5.1 解析结果集
					while ($row = mysql_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td>{$row['name']}</td>";
						echo "<td>",($row['sex']==0?"女":"男"),"</td>";
						echo "<td>" ,$row['age'] ,"</td>";
						echo "<td>" . date("Y-m-d H:i:s", $row['addtime']) . "</td>";
						echo "<td> 
													<a href='action.php?a=del&id={$row['id']}'>删除</a> 
													<a href='edit.php?id={$row['id']}'>修改</a></td>";
						echo "</tr>";
					}
				} else {
					echo '<tr><td class="text-center" colspan="6">暂无学生</td></tr>';
				}
				//6. 释放结果集，关闭数据库
				mysql_close($link);
				?>
			</table>
		</center>
	</body>
</html>