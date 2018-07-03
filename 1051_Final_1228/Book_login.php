<html>
	<head>
		<title>微草堂</title>
		<meta charset="utf-8">
		<meta http-equiv="refresh"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "Shortcut Icon" type = "image/x-icon" href = "BookStore_picture/icon.ico" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="BookStore_frame_css.css">
		<script src="BookStore_frame_js.js"></script>
		<style type = "text/css">
			#loginFail {
				color: red;
			}
			smallInput {
				white-space:nowrap;
			}
		</style>
		<script></script>
	</head>
	<body>
		<div class="container-fluid">
<!-- ======================================================================================================================================================= -->
					<br><br><br>
					<h1 class="text-center" style="color: #2e2d4d"><strong>阅微草堂</strong></h1><br><br>
					<form class="form-horizontal" action="Book_loginCheck.php" method="POST">
						<div class="form-group">
							<center>
							<div class="col-sm-offset-4 col-sm-4">
								<h6 class="text-center" id="loginFail"></h6>
								<em style="font-size:18px;">帳號&nbsp:&nbsp&nbsp&nbsp</em><input type="text" class="smallInput" name="username" placeholder="帳號" autofocus /><br><br>
								<em style="font-size:18px;">密碼&nbsp:&nbsp&nbsp&nbsp</em><input type="password" class="smallInput" name="password" placeholder="密碼" /><br><br><br><br>
								<input type="submit" class="btn btn-default center-block" value="登入" id="loginId" /><br>
							</div>
							</center>
						</div>
					</form>
<!-- ======================================================================================================================================================= -->
		</div>
	</body>
</html>