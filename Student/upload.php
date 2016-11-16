<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link href="http://localhost/=/Ergasia2/style.css" rel="stylesheet" type="text/css">
<title>Student</title>
</head>
<body>
<center>
<img src="http://localhost/=/Ergasia2/icons/sima_aigaiou.jpg">
<br/><br/><br/>
<table class=main_menu>
			<tr>
				<td>
					<a class=menu_a href="index_Student.php">Home</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="detailed_grading.php">Detailed Grading</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="successfull_lesson.php">Successfull Lessons</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="upload.php">Upload Photo</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="/=/Ergasia2/logout.php">Logout</a><font color="#ffffff"><b> | </font>
				</td>
			</tr>
			
</table>

	<h4><font color="#3300FF"> Upload Photo </font></h4>
	<h5>Select from menu the operations</h5>
	
	<br/><p/>
	<form action="upload.php" method="post" enctype="multipart/form-data">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file" /> <br />
	<input type="submit" name="submit" value="Submit" />
	</form>
	
	<?php
	SESSION_Start();
	$Id_User=$_SESSION['userId'];	//ID student
	
	if (isset($_POST['submit']) && $_POST['submit'] == "Submit")
	{
		if ((($_FILES["file"]["type"] == "image/gif") || 
			($_FILES["file"]["type"] == "image/jpeg") || 
			($_FILES["file"]["type"] == "image/pjpeg"))&& 
			($_FILES["file"]["size"] < 20000000))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				echo "Upload: " . $_FILES["file"]["name"] . "<br />";
				echo "Type: " . $_FILES["file"]["type"] . "<br />";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
				
				
				if ($_FILES["file"]["type"] == "image/gif") $all_ext=$Id_User."."."gif";
				if ($_FILES["file"]["type"] == "image/jpeg") $all_ext=$Id_User."."."jpg";
				if ($_FILES["file"]["type"] == "image/pjpeg") $all_ext=$Id_User."."."jpeg";
								
				move_uploaded_file($_FILES["file"]["tmp_name"], "upload/$all_ext" );
				echo "Stored in: " . "C:/xampp/htdocs/=/Ergasia2/Student/upload/" . $all_ext;
				echo "<font color=\"#3300FF\"><strong><br>Το ανεβασμα ολοκληρωθηκε!!<br></strong>";
			}
		}
		else
		{
			echo "Invalid file";
		}
	
	}
?>
</center>