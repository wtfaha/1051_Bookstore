<!--	Publisher	-->
<html>
	<head>
		<title>微草堂</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- META 的功能僅是用來註明這些網頁資訊，且提供給瀏覽器或是搜尋引擎，並非是要給寫給瀏覽網頁的＂人＂看的內容。-->
        
		<!-- 設計自己blog的瀏覽器網址icon圖示 -->
		<link rel = "Shortcut Icon" type = "image/x-icon" href = "BookStore_picture/icon.ico" />
      
		<!-- 加載Bootstrap --> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<!-- 加載css、js -->
		<link rel="stylesheet" type="text/css" href="BookStore_frame_css.css">
		<script src="BookStore_frame_js.js"></script>
		
		<!-- 加入以下css即可修改最上面背景圖片 -->
		<!-- 務必要加在載入BookStore_frame_css.css之後才可以覆蓋掉-->	
		<style type = "text/css">
			.jumbotron{
				/*background-color: white; */
				background-image: url('BookStore_picture/book1.jpg');	/* 最上面的背景 在此修改圖片* //* 建議大小為828x315 */
				background-repeat:no-repeat;
				opacity: 0.8;
				margin: 0;
				padding: 0;
				border: 0;
				padding-left: 3%;
				/*color: #2e2d4d;*/
				height: 70%;
				background-size: cover;
				text-align: center;	/*字體水平置中*/
				vertical-align: middle;/*nouse*/
				/*line-height: 70%;*/
			}
			.textCss2{
				text-shadow:1px 1px 1px rgba(138,138,138,1);
				font-weight:bold;
				font-variant:small-caps;
				color:white;
				letter-spacing:5pt;
				word-spacing:2pt;
				//font-size:3em;
				font-family:comic sans, comic sans ms, cursive, verdana, arial, sans-serif;
			}			
			a:hover	{text-decoration:none; cursor:pointer;}
		</style>
		
		<script>
			
		</script>
	</head>
	<body>
	<div class="container-fluid">
	<div class="row content">
		<div class="jumbotron wrapper">
			<div class="textCss titleCenter">
				<h1>阅微<br>草堂</h1>
				<h6>Reading Micro Grass</h6>
			</div>
		</div>
		<div class="col-md-12 center">
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="Homepage.php">阅微草堂</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li class="active"><a href="Book.php">Book</a></li>
							<li><a href="Stock.php">Stock</a></li>
							<li><a href="Publisher.php">Publisher</a></li>
							<li><a href="Sales.php">Sales</a></li>
						</ul>
					</div>
				</div>
			</nav>
			
			<!-- 搜尋 -->
			<br>
			<div class="col-md-5">
				<!--button-edit------>
				<center>
					<h4><a href="BookEdit.php" style="border:4px lightskyblue solid; width:80%; text-align:center;">【edit】</a></h4>
				</center>	
			</div>
			<div class="col-md-6">
				<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
					<div class="col-md-4">
						<select class="form-control input-sm" name="choice" id="id2" onchange="changeData()">
							<option value="">請選擇小於多少</option>
		　					<option value="inventory_level">庫存</option>
						</select>
					</div>
					<div class="col-md-6">
						<div id="changeType">
							<input class="form-control input-sm" type="text" name="data" id="id1" />
						</div>
					</div>
					<div class="col-md-2">
						<input class="btn btn-mode input-sm" type="submit" name="submit" value="搜尋" />
					</div>
				</form>
			</div>
			<div class="row-md-8 center">
<!-- ======================================================================================================================================================= -->
				<!--Book-->

				<br><br>
				<?php
				include "dbFinal_conn.php";
				$sql = "SELECT ISBN, Book_name, category, Author_name, Translator_name, publisher_name, published_date, price, inventory_level FROM book natural join stock";
				$result = mysqli_query($db,$sql); // 執行SQL查詢
				$total_fields=mysqli_num_fields($result); // 取得欄位數
				$total_records=mysqli_num_rows($result);  // 取得記錄數
				?> 
					
				<center>
				<br>
				<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:80%;" rules="all">
					<thead bgcolor="lightskyblue" class="textCss2">
					<tr>
						<td>ISBN</td>
						<td>書名</td>
						<td>類別</td>
						<td>作者</td>
						<td>譯者</td>
						<td>出版社</td>
						<td>出版日期</td>
						<td>價錢</td>
					</tr>
					</thead>
					<tbody>
					
					<?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choice"]!=null && $_POST["data"]!=null){
							$choice = $_POST["choice"];
							$data = $_POST["data"];
							$sql = "SELECT ISBN, Book_name, category, Author_name, Translator_name, publisher_name, published_date, price 
									FROM book 
									WHERE ISBN =( SELECT ISBN FROM stock WHERE inventory_level < '$data')";
						}
						else {
							$sql = "SELECT ISBN, Book_name, category, Author_name, Translator_name, publisher_name, published_date, price 
									FROM book  
									ORDER BY ISBN asc";
							
						}
						$result = mysqli_query($db,$sql); // 執行SQL查詢
						if($total_records > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<tr><td>" . $row["ISBN"]. "</td>";		//印出ISBN欄位的值
								echo "<td>" . $row["Book_name"]. "</td>";		//印出Book_name欄位的值
								echo "<td>" . $row["category"]. "</td>";		//印出category欄位的值
								echo "<td>" . $row["Author_name"]. "</td>";		//印出Author_name欄位的值
								echo "<td>" . $row["Translator_name"]. "</td>";	//印出Translator_name欄位的值
								echo "<td>" . $row["publisher_name"]. "</td>";	//印出publisher_name欄位的值
								echo "<td>" . $row["published_date"]. "</td>";	//印出published_date欄位的值
								echo "<td>" . $row["price"]. "</td>";		//印出price欄位的值
								echo "</tr>";
							}
						}
						mysqli_close($db);
					?>
					
					
					</tbody>
				</table>
				</center>
<!-- ======================================================================================================================================================= -->					
			</div>
		</div>
	</body>
</html>