<html>
	<head>
		<title>简单的在线文件管理</title>
		<link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
	    <meta charset="UTF-8">
	</head>
	<body>
		<center>
			<h3>目录下的文件信息<h3>
			<h4><a href='filesystem.php?action=add'>创建文件</a></h4>
			<table  class="table table-bordered text-center" >
			<tr><th>序号</th><th>名称</th><th>类型</th><th>大小</th><th>创建时间</th><th>操作</th></tr>
				<?php
					//简单的在线文件管理
					$path = './';
					date_default_timezone_set('PRC');//设置为LAX
					$filelist = ["filesystem.php"];

								//一.根据action的信息值做对应操作
					switch ($_GET['action']) {
						case 'del':
							{
								unlink($_GET['filename']);
								break;
							}
						case 'create':
							{
								$filename = trim($path,"/")."/".$_POST["filename"];

								if(file_exists($filename)){
									die('文件已存在');
								}
								$f=fopen($filename,'w');//'w' 写入方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之。  
								fclose($f);
								break;
							}
						case 'update':
							{
								$filename = $_POST["filename"];
								$content = $_POST["content"];
								if(!file_exists($filename)){
									die('文件不存在');
								}
								file_put_contents($filename,$content);

								break;
							}
						default:
											# code...
							break;
					}
								//二.浏览指定目录下的文件
										//判断path是否存在 并且是否是个目录
					if (!file_exists($path) || !is_dir($path)) {
						die("$path  目录无效");
					}

					$dir = opendir($path);
					if ($dir) {
						$i = 0;
						while ($f = readdir($dir)) {
							if ($f == "." || $f == ".." || in_array($f,$filelist)) {
								continue;
							}

							$file = trim($path, "/") . "/" . $f;
							$i++;

							echo "<tr>";
							echo "<td>{$i}</td>";
							echo "<td>{$f}</td>";
							echo "<td>" . filetype($file) . "</td>";
							echo "<td>" . filesize($file) . "</td>";
							echo "<td>" . date("Y-m-d H:i:s", filectime($file)) . "</td>";
							echo "<td>
							
							<a href='filesystem.php?action=del&&filename={$file}'>删除</a>
							<a href='filesystem.php?action=edit&&filename={$file}'>编辑</a>
							</td>";
							echo "</tr>";
						}
						closedir($dir);
					}
				//判断是否需要创建文件表单
				if($_GET['action']=="add"){
					echo '</table>';
					echo "<div class='form-group'><form action='filesystem.php?action=create' method='post'>";
					echo "<lable>新建文件</lable><input class='form-control' type='text' name='filename' size='12'/> ";
					echo "<input class='btn btn-success' type='submit' value='提交'/>";
					echo "</form></div>";
				}

				//判断是否需要修改文件表单
				else if($_GET['action']=="edit"){
					
					$filename=$_GET["filename"];
							//2.获取文件内 的内容
					$fileinfo = file_get_contents($filename);
					echo '</table>';
				
					echo "<div class='form-group'><form action='filesystem.php?action=update' method='post'>";
					echo "<lable>编辑</lable><input class='form-control' type='hidden' name='filename' value='{$filename}' size='12'/> ";
					echo '<br/>'.$filename.'<br/>';
					echo "<textarea name='content' cols='40' rows='6'>{$fileinfo}</textarea><br/><br/>";
					echo "<input class='btn btn-success' type='submit' value='提交'/>";
					echo "</form></div>";
				}else{
					echo '</table>';
				}
			
			?>
 		</center>
	</body>
</html>