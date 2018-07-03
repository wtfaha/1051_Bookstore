<html>
	<head>
		<title>微草堂</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- META 的功能僅是用來註明這些網頁資訊，且提供給瀏覽器或是搜尋引擎，並非是要給寫給瀏覽網頁的＂人＂看的內容。-->
        
		<!-- 設計自己blog的瀏覽器網址icon圖示 -->
		<link rel = "Shortcut Icon" type = "image/x-icon" href = "BookStore_picture/icon.ico" />
      
	</head>
	<body>
		
		<?php
			$localhost = 'localhost';	//主機名或IP位址
			$user = 'root';				//MYSQL使用者名稱
			$password = '123';			//MYSQL使用者密碼
			$database = '1051_finalproject';	//Database名稱
			//port 為連結 MySQ L Server 使用的埠號（ 非必填 ）
			//socket 為使用的 socket （非必填 ）。
			
			//進行連線
			$db = mysqli_connect($localhost, $user, $password, $database);
			if(mysqli_connect_errno()) {
				printf ("Connect failed: ".mysqli_connect_error());
				exit();
			}
			mysqli_set_charset($db, "utf8");		//設定編碼
			mysqli_select_db($db, "1051_finalproject");	//連線狀態中更換資料庫////選擇資料庫1051_finalproject
			//mysqli_close()//斷掉連接
		?>
		
	</body>
</html>