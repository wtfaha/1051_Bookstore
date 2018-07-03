<?php
// UPDATE BOOK DATA -------------------------------------------------

include "dbFinal_conn.php";
if(isset($_POST["ISBN"]) && isset($_POST["Book_name"]) && isset($_POST["category"]) && isset($_POST["Author_name"]) && isset($_POST["Translator_name"]) && isset($_POST["publisher_name"]) && isset($_POST["published_date"]) && isset($_POST["price"]))	
{	 
	 $sql_query = "UPDATE book SET Book_name=";
	 $sql_query  .= "'".$_POST["Book_name"]."',"; 
	 $sql_query  .= "category=";
	 $sql_query  .= "'".$_POST["category"]."',"; 
	 $sql_query  .= "Author_name=";
	 $sql_query  .= "'".$_POST["Author_name"]."',";
	 $sql_query  .= "Translator_name=";	 
	 $sql_query  .= "'".$_POST["Translator_name"]."',";
	 $sql_query  .= "publisher_name=";
	 $sql_query  .= "'".$_POST["publisher_name"]."',";
	 $sql_query  .= "published_date=";
	 $sql_query  .= "'".$_POST["published_date"]."',";
	 $sql_query  .= "price=";
	 $sql_query  .= "'".$_POST["price"]."'";
	 $sql_query  .= " WHERE ISBN=";	 
	 $sql_query  .= "'".$_POST["ISBN"]."'";
	 
	 mysqli_query($db, $sql_query);
	 $_POST["ISBN"]="";
	 header('Location: BookEdit.php');
}
?>


<!----Book---->
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
			function ChangeContent(ISBN){
				document.getElementById("ISBN").value = ISBN;
				document.getElementById("mfrom").action = "BookEdit.php";
				document.getElementById("mfrom").submit();
			}
			function ShowPublisher(publisher_name){	
				document.getElementById("publisher_name").value = publisher_name;
				document.getElementById("mfrom").action = "BookEdit.php";
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
					<div class="collapse navbar-collapse" >
						<ul class="nav navbar-nav">
							<li class="active"><a href="Book.php">Book</a></li>
							<li><a href="Stock.php">Stock</a></li>
							<li><a href="Publisher.php">Publisher</a></li>
							<li><a href="Sales.php">Sales</a></li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="row-md-8 center">
<!-- ======================================================================================================================================================= -->
				<!--Book-->
				<?php
				include "dbFinal_conn.php";
				$sql = "SELECT * FROM book"; //在test資料表中選擇所有欄位
				$result = mysqli_query($db,$sql); // 執行SQL查詢
				$total_fields=mysqli_num_fields($result); // 取得欄位數
				$total_records=mysqli_num_rows($result);  // 取得記錄數
				?> 
					
				<center>
					<form id="mfrom" method="post" action="BookEdit.php">
<!-- ============================================================================START FORM============================================================== -->
						<input type="hidden" id="ISBN" name="ISBN" value="<?php echo isset($_POST["ISBN"])?$_POST["ISBN"]:""?>">
						<input type="hidden" id="publisher_name" name="publisher_name" value="<?php echo isset($_POST["publisher_name"])?$_POST["publisher_name"]:""?>">
					<?php
						if(isset($_POST["ISBN"]) && !empty($_POST["ISBN"]) ){
					?>
<!-- ============================================================================EDIT BOOK DATA============================================================== -->
							<br>
<!-------------------------------------button-back-------------------------------------------------------------------->						
							<h4>
								<a href="BookEdit.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【back】</a>
							</h4>
<!-------------------------------------button-back--------------------------------------------------------------------->
							<br>
						<?php
							$ISBN = $_POST["ISBN"];
							
							$sql = "SELECT * FROM book WHERE ISBN=?";
							if($stmt = $db->prepare($sql)){
								$stmt->bind_param("s", $ISBN);
								$stmt->execute();
								$stmt->bind_result($ISBN,$Book_name,$category,$Author_name,$Translator_name,$publisher_name,$published_date, $price);				
								if($stmt->fetch()){						
						?>
									<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:80%;" rules="all">
										<thead bgcolor="lightskyblue" class="textCss2">
										<tr> 
											<th>ISBN</th> 
											<th>書名</th> 
											<th>類別</th> 
											<th>作者</th> 
											<th>譯者</th> 
											<th>出版社</th> 
											<th>出版日期</th> 
											<th>價錢</th>										
										</tr>  
										</thead> 
										<tbody>
											<tr>
												<td><input type="hidden" id="ISBN" name="ISBN" value="<?php echo $ISBN;?>" style="width:100%;"/><?php echo $ISBN;?></td>
												<td><input type="text" id="Book_name" name="Book_name" value="<?php echo $Book_name;?>" style="width:100%;"/></td> 
												<td><input type="text" id="category" name="category" value="<?php echo $category;?>" style="width:100%;"/></td> 
												<td><input type="text" id="Author_name" name="Author_name" value="<?php echo $Author_name;?>" style="width:100%;"/></td> 
												<td><input type="text" id="Translator_name" name="Translator_name" value="<?php echo $Translator_name;?>" style="width:100%;"/></td> 
												<td>
													<!--<input type="text" id="publisher_name" name="publisher_name" style="width:100%;"/>-->
													<select name="publisher_name" style="width:100%;">
						　								<?php
															include "dbFinal_conn.php";
															$query = "SELECT publisher_name FROM publisher";			
															if($stmt = $db->query($query))
															{
																while($result=mysqli_fetch_object($stmt))
																{
																	echo "<option value=".$result->publisher_name.">".$result->publisher_name."</option>";
																}
															}
														?>
													</select><br>
												</td>		 
												<td><input type="text" id="published_date" name="published_date" value="<?php echo $published_date;?>" style="width:100%;"/></td> 						  
												<td><input type="text" id="price" name="price" value="<?php echo $price;?>" style="width:100%;"/></td>
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
						else if(isset($_POST["publisher_name"]) && !empty($_POST["publisher_name"]) ){
					?>
<!-- ============================================================================SHOW PUBLISHER DATA============================================================== -->
							<br>
<!-------------------------------------button-back-------------------------------------------------------------------->						
							<h4>
								<a href="BookEdit.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【back】</a>
							</h4>
<!-------------------------------------button-back--------------------------------------------------------------------->
							<br>					
					<?php
							$publisher_name = $_POST["publisher_name"];
							
							$sql = "SELECT * FROM publisher WHERE publisher_name=?";
							if($stmt = $db->prepare($sql)){//show publisher data 
								$stmt->bind_param("s", $publisher_name);
								$stmt->execute();
								$stmt->bind_result($publisher_name,$publisher_address, $publisher_phone);				
								if($stmt->fetch()){						
					?>
									<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:80%;" rules="all">
										<thead bgcolor="lightskyblue" class="textCss2">
											<tr>
												<td>出版社</td>
												<td>地址</td>
												<td>電話號碼</td>
											</tr>
										</thead> 
										<tbody>
											<tr>
												<td><?php echo $publisher_name;?></td>   
												<td><?php echo $publisher_address;?></td>     				
												<td><?php echo $publisher_phone;?></td> 
											</tr>
										</tbody>
									</table>
					<?php
								}
							}
						}
						else{
					?>
<!-- ============================================================================SHOW BOOK LIST============================================================== -->					
							<br>
<!-------------------------------------button-new--------------------------------------------------------------------->
						
							<h4>
								<a href="BookAdd.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【new】</a>
							</h4>
<!-------------------------------------button-new--------------------------------------------------------------------->
							<br>
							
							<table  border="1" class="table table-hover" style="border:4px lightskyblue solid; width:80%;" rules="all">
								<thead bgcolor="lightskyblue" class="textCss2">
									<tr> 
										<th>ISBN</th> 
										<th>書名</th> 
										<th>類別</th> 
										<th>作者</th> 
										<th>譯者</th> 
										<th>出版社</th> 
										<th>出版日期</th> 
										<th>價錢</th>					 
										<th>庫存</th> 		
									</tr>  
								</thead> 
								<tbody>
								<?php
									$sql = "SELECT ISBN, Book_name, category, Author_name, Translator_name, publisher_name, published_date, price, inventory_level FROM book natural join stock";
									if($stmt = $db->prepare($sql)){
										$stmt->execute();
										$result = $stmt->get_result();
										
										while($rows = $result->fetch_assoc()){
								?>
											<tr>
												<td>
													<a onclick="ChangeContent('<?php echo $rows['ISBN'];?>');"><?php echo $rows['ISBN'];?></a>
												</td> 
												<td><?php echo $rows['Book_name'];?></td> 
												<td><?php echo $rows['category'];?></td> 
												<td><?php echo $rows['Author_name'];?></td> 
												<td><?php echo $rows['Translator_name'];?></td> 
												<td>
													<a onclick="ShowPublisher('<?php echo $rows['publisher_name'];?>');"><?php echo $rows['publisher_name'];?></a>
												</td>
												<td><?php echo $rows['published_date'];?></td> 
												<td><?php echo $rows['price'];?></td>							 
												<td><?php echo $rows['inventory_level'];?></td> 
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
									<a href="BookDelete.php" style="border:4px lightskyblue solid; width:70%; text-align:center; text-decoration:none;">【delete】</a>
							</h4>
<!-------------------------------------button-delete--------------------------------------------------------------------->
					<?php			
						}
					?>
<!-- ======================================================================================================================================================= -->
					</form>					
				</center>					
			</div>
		</div>
	</div>
	</div>
	</body>
</html>


