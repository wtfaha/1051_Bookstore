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
			
		</style>
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
							<li><a href="Book.php">Book</a></li>
							<li><a href="Stock.php">Stock</a></li>
							<li><a href="Publisher.php">Publisher</a></li>
							<li class="active"><a href="Sales.php">Sales</a></li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="row-md-8 center">
		<!-- ======================================================================================================================================================= -->
						<!--Book-->
						<br><br>
						
					<form name="mfrom" method="post">
						<center>
						<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:70%;" rules="all">
							<thead bgcolor="lightskyblue" class="textCss2">
							<tr>
								<td>ID</td>
								<td>ISBN</td>
								<td>買(0)or賣(1)</td>
								<td>單價</td>
								<td>數量</td>
								<td>TOTAL</td>
								<td>***</td>
							</tr>
							</thead>
							<tbody>
							<tr>
							  <?php
									include "dbFinal_conn.php";
									$sql = "SELECT MAX(ID) AS maxID FROM sales";
									$stmt1 = mysqli_query($db,$sql); // 執行SQL查詢
									$result = mysqli_fetch_array($stmt1);
									#$total_record=mysqli_num_rows($stmt1);  // 取得記錄數
									echo "<td name=".$result[0].">";
									$resultID = $result[0]+1;
									print($resultID);
								  ?> </td> 
							  <td>
								<select name="ISBN">
	　								<?php
										include "dbFinal_conn.php";
										$query = "SELECT ISBN FROM book";			
										if($stmt = $db->query($query))
										{
											while($result=mysqli_fetch_object($stmt))
											{
												echo "<option value=".$result->ISBN.">".$result->ISBN."</option>";
											}
										}
									?>
								</select>
							  </td> 
							  <td>
								<!--<input type="radio" name="buyORsale" value="buy" />買
								<input type="radio" name="buyORsale" value="sell"/>賣-->
								<input type="text" id="buyORsale" name="buyORsale" value=""/>
							  </td> 
							  <td><input type="text" id="price" name="price" value=""/></td> 
							  <td><input type="text" id="number" name="number" value=""/></td> 
							  <td><input type="text" id="total" name="total" value=""/></td> 
							  <td><input type="submit" name="button" value="新增"></td>
							</tr>
							</tbody>
						</table>
						</center>
		<!-- ======================================================================================================================================================= -->					
					</div>
				</div>
		</form>
	</body>
</html>

<?php
include "dbFinal_conn.php";
if(isset($_POST["ISBN"]) && isset($_POST["buyORsale"]) && isset($_POST["price"]) && isset($_POST["number"]) && isset($_POST["total"]))	
{	 
	 $sql_query = "INSERT INTO sales (ID, ISBN, buyORsale, price, number, total) VALUES (";
	 $sql_query  .= "'".$resultID."',";
	 $sql_query  .= "'".$_POST["ISBN"]."',"; 
	 $sql_query  .= "'".$_POST["buyORsale"]."',"; 
	 $sql_query  .= "'".$_POST["price"]."',"; 
	 $sql_query  .= "'".$_POST["number"]."',";
	 $sql_query  .= "'".$_POST["total"]."')";	
	 $add_result = mysqli_query($db, $sql_query);
	 #print($sql_query);
	 $sql0 ="SELECT SUM(number) AS num0 FROM sales WHERE buyORsale = 0 AND ISBN =" .$_POST["ISBN"];
	 $sql1 ="SELECT SUM(number) AS num1 FROM sales WHERE buyORsale = 1 AND ISBN =" .$_POST["ISBN"];
	 $stmt0 = mysqli_query($db, $sql0);
	 $stmt1 = mysqli_query($db, $sql1);
	 $result0 = mysqli_fetch_assoc($stmt0);
	 $result1 = mysqli_fetch_assoc($stmt1);
	 if($result1['num1']>0)
		$result2 = $result0['num0']-$result1['num1'];
	 else
		$result2 = $result0['num0'];
	 $sql2 ="UPDATE stock SET inventory_level = $result2 WHERE ISBN =".$_POST["ISBN"];
	 $stmt2 = mysqli_query($db, $sql2);
	 
	 if($add_result == TRUE)
	 {
		header('Location: Sales.php');
	 }
	 else
	 {
		 echo "<script type='text/javascript'>alert('新增失敗，請重新新增');</script>";
	 }
}

?>