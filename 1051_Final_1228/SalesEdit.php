<?php
// UPDATE SALES DATA -------------------------------------------------

include "dbFinal_conn.php";
if(isset($_POST["ISBN"]) && isset($_POST["buyORsale"]) && isset($_POST["price"]) && isset($_POST["number"]))	
{	 
	//RECOVER STOCK
	$count = "SELECT number FROM sales WHERE ID = '".$_POST["ID"]."'";
	$sql_query = "UPDATE stock SET inventory_level = inventory_level - '".$count."' WHERE ISBN = '".$_POST["ISBN"]."'";
	mysqli_query($db, $sql);
	
	//UPDATE SALES
	$sql_query = "UPDATE sales SET ISBN=";
	$sql_query  .= "'".$_POST["ISBN"]."',"; 
	$sql_query  .= "buyORsale=";
	$sql_query  .= "'".$_POST["buyORsale"]."',"; 
	$sql_query  .= "price=";
	$sql_query  .= "'".$_POST["price"]."',";
	$sql_query  .= "number=";	 
	$sql_query  .= "'".$_POST["number"]."',";
	$sql_query  .= "total=";
	$sql_query  .= "'".$_POST["price"]*$_POST["number"]."'";
	$sql_query  .= " WHERE ID=";	 
	$sql_query  .= "'".$_POST["ID"]."'";
	 
	//UPDATE STOCK
	if(mysqli_query($db, $sql_query)){
		$sql_query = "UPDATE stock SET inventory_level = inventory_level + '".$_POST["number"]."' WHERE ISBN = '".$_POST["ISBN"]."'";
		mysqli_query($db, $sql_query);
	}
	
	header('Location: SalesEdit.php');
}
?>

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
			.button{
				text-align: center;
				color: darkblue;
			}
			a:hover	{text-decoration:none; cursor:pointer;}		
		</style>
		
		<script>
			function ChangeContent(ID){
				document.getElementById("ID").value = ID;
				document.getElementById("mfrom").action = "SalesEdit.php";
				document.getElementById("mfrom").submit();
			}
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
				<!--publisher-->				
				<?php
				include "dbFinal_conn.php";
				$sql = "SELECT * FROM sales"; //在test資料表中選擇所有欄位
				$result = mysqli_query($db,$sql); // 執行SQL查詢
				$total_fields=mysqli_num_fields($result); // 取得欄位數
				$total_records=mysqli_num_rows($result);  // 取得記錄數
				?> 
					
				<center>
					<form id="mfrom" method="post" action="SalesEdit.php">
<!-- ============================================================================START FORM============================================================== -->
						<input type="hidden" id="ID" name="ID" value="<?php echo isset($_POST["ID"])?$_POST["ID"]:""?>">
					<?php
						if(isset($_POST["ID"]) && !empty($_POST["ID"]) ){
					?>
<!-- ============================================================================EDIT SALES DATA============================================================== -->
							<br>
<!-------------------------------------button-back-------------------------------------------------------------------->						
							<h4>
								<a href="SalesEdit.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【back】</a>
							</h4>
<!-------------------------------------button-back--------------------------------------------------------------------->
							<br>
						<?php
							$ISBN = $_POST["ID"];
							
							$sql = "SELECT * FROM sales WHERE ID=?";
							if($stmt = $db->prepare($sql)){
								$stmt->bind_param("s", $ISBN);
								$stmt->execute();
								$stmt->bind_result($ID,$ISBN,$buyORsale,$price,$number,$total);				
								if($stmt->fetch()){						
						?>
									<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:70%;" rules="all">
										<thead bgcolor="lightskyblue" class="textCss2">
										<tr>
											<td>ID</td>
											<td>ISBN</td>
											<td>買or賣</td>
											<td>單價</td>
											<td>數量</td>
										</tr>
										</thead>
										<tbody>										
											<tr>
												<td><input type="hidden" id="ID" name="ID" value="<?php echo $ID;?>"/><?php echo $ID;?></td>
												<td><input type="text" id="ISBN" name="ISBN" value="<?php echo $ISBN;?>"/></td> 
												<td><input type="text" id="buyORsale" name="buyORsale" value="<?php echo $buyORsale;?>"/></td> 
												<td><input type="text" id="price" name="price" value="<?php echo $price;?>"/></td> 
												<td><input type="text" id="number" name="number" value="<?php echo $number;?>"/></td>
											</tr>
										</tbody>
									</table>
									<br>
<!-------------------------------------button-save--------------------------------------------------------------------->
									<input type="submit" name="button" value="save" style="height:30px; width:42px; font: 20px;"/>
<!-------------------------------------button-save--------------------------------------------------------------------->
					<?php
								}
							}
						}
						else{
					?>
<!-- ============================================================================SHOW SALES LIST============================================================== -->					
							<br>
<!-------------------------------------button-new--------------------------------------------------------------------->
						
							<h4>
								<a href="SalesAdd.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【new】</a>
							</h4>
<!-------------------------------------button-new--------------------------------------------------------------------->
							<br>
							
							<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:70%;" rules="all">
								<thead bgcolor="lightskyblue" class="textCss2">
									<tr>
										<td>ID</td>
										<td>ISBN</td>
										<td>買or賣</td>
										<td>單價</td>
										<td>數量</td>
										<td>total</td>
									</tr>
								</thead>
								<tbody>
								<?php
									$sql = "SELECT * FROM sales";
									if($stmt = $db->prepare($sql)){
										$stmt->execute();
										$result = $stmt->get_result();
										
										while($rows = $result->fetch_assoc()){
								?>
											<tr>
												<td>
													<a onclick="ChangeContent('<?php echo $rows['ID'];?>');"><?php echo $rows['ID'];?></a>
												</td> 
												<td><?php echo $rows['ISBN'];?></td> 
												<td><?php echo $rows['buyORsale'];?></td>
												<td><?php echo $rows['price'];?></td>							 
												<td><?php echo $rows['number'];?></td>							 
												<td><?php echo $rows['total'];?></td>  
											</tr> 
								<?php
										}
									}
								?>
								</tbody>
							</table>
<!-------------------------------------button-delete--------------------------------------------------------------------->
							<br>
							<h4 align="center">
									<a href="SalesDelete.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【delete】</a>
							</h4>
<!-------------------------------------button-delete--------------------------------------------------------------------->
					<?php			
						}
					?>
<!-- ======================================================================================================================================================= -->					
			</div>
		</div>
	</div>
	</div>
	</body>
</html>