<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function loginFail() {
				sessionStorage.setItem("loginFail", "yes");
				window.location.assign("Book_login.php");
			}
		</script>
	</head>
	<body>
		<?php
			session_start(); 
			include("dbFinal_conn.php");
		?>
		<?php
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM login WHERE username ='$username' AND password = '$password' LIMIT 1";
			$result = $db->query($sql);

			if($result->num_rows == 1) {
				$rows = $result->fetch_array(MYSQLI_NUM);
				//$_SESSION['username'] = $rows['username'];
				$sql2 = "UPDATE login SET status = 1 WHERE username ='$username' AND password = '$password'";
				$db->query($sql2);
				echo "<script type='text/javascript'>loginSuccess('$username');</script>";
				header("location:Homepage.php");
			}
			else {
				echo "<script type='text/javascript'>loginFail();</script>";
			}
			mysqli_close($db);
		?>
	</body>
</html>