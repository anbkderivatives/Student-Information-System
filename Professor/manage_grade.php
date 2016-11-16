<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link href="http://localhost/=/Ergasia2/style.css" rel="stylesheet" type="text/css">
<title>Professor</title>
</head>
<body>
<center>
<img src="http://localhost/=/Ergasia2/icons/sima_aigaiou.jpg">
<br/><br/><br/>
<table class=main_menu>
			<tr>
				<td>
					<a class=menu_a href="index_Professor.php">Home</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="manage_grade.php">Manage Student Grades</a><font color="#ffffff"><b> | </font>
					<a class=menu_a href="/=/Ergasia2/logout.php">Logout</a><font color="#ffffff"><b> | </font>
				</td>
			</tr>
</table>
	<h4><font color="#3300FF"> MANAGE GRADE </font></h4>
	<h5>Select from menu the operations</h5>
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
		SESSION_Start();
		$Id_User=$_SESSION['userId'];	//ID professor
	?>
	
		<br> <h3>Select Lesson for Grading</h3>
		<form name="lesson_form" method="POST" action="manage_grade2.php">
		<table class="view">
		<tr>
		<th>Selection</th>
		<th>Title</th>
		<th>Teacher</th>
		<th>Semister</th>
		<th>ECTS Units</th>
		<th>Date Start</th>
		<th>Date End</th>
		<th>Active</th>
		</tr>
	<?php
		
		//vrskei ta mathimata ta opoia kanei o professor me Id_User=$_SESSION['userId']
		$sql="
		SELECT *
		FROM lesson
		WHERE Id_Teacher='$Id_User'";
		
		$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
		
		while ($row = mysql_fetch_assoc($result))
		{
	?>
			<tr class="alt">
			<td><input type="radio" name="radio_lesson" value=<?php echo $row['Id_Lesson'];?> > </td>
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
			
			</tr>
	<?php
		}//end while
	?>
		</table>
		<table width="50%" class=form>
			<tr>
			<td valign="top" align="right"></td>
									
			<td align=left><input type="submit" name="submit" value="Confirm_Choice"></td>
			</tr>
		</table>
		</form>
		
	
</center>