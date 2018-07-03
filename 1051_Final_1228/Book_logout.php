<?php
	session_start(); 
	include("dbFinal_conn.php");
	$sql = "UPDATE login SET status = 0";
	$db->query($sql);
	header("location:Book_login.php");
	mysqli_close($db);
?>