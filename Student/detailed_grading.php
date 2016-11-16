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

	<h4><font color="#3300FF"> Detailed Grading </font></h4>
	<h5>Select from menu the operations</h5>
	
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
		SESSION_Start();
		$Id_User=$_SESSION['userId'];	//ID student
	?>
	
	<?php
		$sql="
		SELECT *
		FROM detailed_grading, lesson
		WHERE detailed_grading.Id_Student = '$Id_User' and detailed_grading.Id_Lesson = lesson.Id_Lesson
		ORDER BY exam_date desc
		";
		$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
	?>
		<br>
		<table class="view">
		<tr>
		<th>Title</th>
		<th>Teacher</th>
		<th>Semister</th>
		<th>ECTS Units</th>
		<th>Date Start</th>
		<th>Date End</th>
		<th>Active</th>
		<th>Grade</th>
		<th>Exam Date</th>
		</tr>
	<?php
		
		while ($row = mysql_fetch_assoc($result)) 
		{
	?>
			<tr class="alt">
			<td><?php echo $row['title']; ?></td>
				<td><?php	$temp=$row['Id_Teacher'];
							$sql2="SELECT last_name
								FROM user
								WHERE ID_User='$temp'";
							$result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er"));
							$row2 = mysql_fetch_assoc($result2);
							echo $row2['last_name'];
					?>
				</td>
			<td><?php echo $row['semister']; ?></td>
			<td><?php echo $row['ECTS_units']; ?></td>
			<td><?php echo $row['date_start']; ?></td>
			<td><?php echo $row['date_end']; ?></td>
			<td><?php echo $row['active']; ?></td>
			<td><?php echo $row['grade']; ?></td>
			<td><?php echo $row['exam_date']; ?></td>
			</tr>
	<?php
			}//end while
	?>
			</table>
	

</center>