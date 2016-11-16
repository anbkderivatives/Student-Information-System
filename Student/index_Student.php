
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
	
	<BR>
	<h4><font color="#3300FF"> WELCOME STUDENT HOME </font></h4>
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
			<h5>Καλως ηρθες :<?php echo $row['first_name']." ".$row['last_name'];?></h5>
			
			<img src="/=/Ergasia2/Student/upload/<?php echo $Id_User?>.jpg" width="300" height="200" /> 
			<p>
			<table width="20%" class=form>
								<tr>
									<td class=form_subheader>User Name: </td>
									<td><?php echo $row['user_name'];?></td>
								</tr>
								<tr>
									<td class=form_subheader>Password: </td>
									<td><?php //echo $row['password']; ?></td>
								</tr>
								<tr>
									<td class=form_subheader>Role : </td>
									<td><?php if($row['Id_Role']==1) echo "Admin";
											  if($row['Id_Role']==2) echo "Professor";
											  if($row['Id_Role']==3) echo "Student";?></td>
								</tr>
								<tr>
									<td class=form_subheader>First Name: </td>
									<td><?php echo $row['first_name']; ?></td>
								</tr>
                                <tr>
									<td class=form_subheader>Last Name: </td>
									<td><?php echo $row['last_name']; ?></td>
								</tr>
                                <tr>
									<td class=form_subheader>Address: </td>
									<td><?php echo $row['address']; ?></td>
								</tr>
                                <tr>
									<td class=form_subheader>Mail: </td>
									<td><?php echo $row['mail']; ?></td>
								</tr>
                                <tr>
									<td class=form_subheader>Registration Date: </td>
									<td><?php echo $row['registration_date']; ?></td>
								</tr>
						</table>

</center>
</body>

