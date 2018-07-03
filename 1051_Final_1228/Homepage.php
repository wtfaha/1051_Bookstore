<?php
	//login status
	session_start(); 
	include("dbFinal_conn.php");
	$username = "<script type='text/javascript'>document.write(logout1());</script>";
	$sql = "SELECT * FROM login WHERE status = 0 LIMIT 1";
	$result = $db->query($sql);
	if($result->num_rows == 1) {
		header("location:Book_login.php");
	}
	mysqli_close($db);
?>

<!--	Homepage	-->
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
				height: 100%;
				background-size: cover;
				text-align: center;	/*字體水平置中*/
				vertical-align: middle;/*nouse*/
				/*line-height: 70%;*/
			}
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
		<div class="col-md-12">
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
							<li><a href="Book.php">Book</a></li>
							<li><a href="Stock.php">Stock</a></li>
							<li><a href="Publisher.php">Publisher</a></li>
							<li><a href="Sales.php">Sales</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="Book_logout.php">登出</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</body>
</html>