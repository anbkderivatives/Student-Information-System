<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link href="http://localhost/=/Ergasia2/style.css" rel="stylesheet" type="text/css">
<title>Administrator</title>
</head>
<body>
<center>
<img src="http://localhost/=/Ergasia2/icons/sima_aigaiou.jpg">
<br/><br/><br/>
<table class=main_menu>
			<tr>
				<td>
					<a class=menu_a href="index_Admin.php">Home</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="Manage_User/manage_user.php">Manage User Accounts</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="Manage_Lessons/manage_lesson.php">Manage Lessons</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="select_lesson.php">Selection of Lessons</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="print_std_verify.php">Print studies Verification</a><font color="#ffffff"><b>|</font>
					<a class=menu_a href="/=/Ergasia2/logout.php">Logout</a><font color="#ffffff"><b> | </font>
				</td>
			</tr>
</table>

	<BR>
	<h4><font color="#3300FF"> WELCOME ADMINISTRATOR HOME </font></h4>
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
		SESSION_Start();
		$Id_User=$_SESSION['userId'];
		$sql="
			SELECT *
			FROM user
			WHERE Id_User='$Id_User'
			";
			$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
			$row = mysql_fetch_assoc($result);		
		?>
			<p>
			<h5>Καλως ηρθατε κυριε/α: <?php echo $row['first_name']." ".$row['last_name'];?></h5>
			
			<img src="/=/Ergasia2/icons/DSC2.jpg" width="600" height="500" /> 
	

</center>
</body>