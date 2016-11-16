<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link href="http://localhost/=/Ergasia2/style.css" rel="stylesheet" type="text/css">
<title>Administrator</title>
</head>
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
<center>
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
	?>
	<h4><font color="#3300FF"> Selection of Lessons</font></h4>
		
	<?php
		$user_id="";
		$Input_username="";
		$Input_name="";
		$Input_last="";
	?>
	
				<form name="searchform" method="post" action="select_lesson.php">
						<h3> User Search : </h3>
						<table width="50%" class=form>
                        		<tr>
									<td class=form_subheader>User Name: </td>
									<td><input type="text" name="s1" maxlength="50" size="30" value=<?php echo $Input_username ?>> </td>
								</tr>
								<tr>
									<td class=form_subheader>Όνομα: </td>
									<td><input type="text" name="s2" maxlength="50" size="30" value=<?php echo $Input_name ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Επώνυμο: </td>
									<td><input type="text" name="s3" maxlength="50" size="30" value=<?php echo $Input_last ?>> </td>
								</tr>
								
								<tr>
									<td valign="top" align="right"></td>
									<td align=left><input type="submit" name="submit" value="Search"></td>
								</tr>
						</table>
						
				</form>
				
	<?php
			//------------------search xristi----------------------------
				if ( isset($_POST['submit']) && $_POST['submit'] == "Search") {
				//get values from search
				$Input_username = $_POST['s1'];
				$Input_name = $_POST['s2'];
				$Input_last = $_POST['s3'];
				
				$sql = "select *
						from user 
						where ((first_name='$Input_name' && last_name='$Input_last') || user_name='$Input_username')";	
								
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				
			?>
								<br>
								<form name="confirm_form" method="POST" action="select_lesson.php">
								<table class="view">
								<tr>
								<th>Selection</th>
                                <th>UserName</th>
                                <th>Role</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Address</th>
                                <th>Registration</th>
								</tr>
								
								
						
						<?php
								while ($row = mysql_fetch_assoc($result)) {
						?>
							
								
								<tr class="alt">
								<td><input type="radio" name="radio_user" value=<?php echo $row['Id_User'];?> > </td>
								
																
                                <td><?php echo $row['user_name']; ?></td>
                                <td><?php echo $row['Id_Role']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
								<td><?php echo $row['last_name']; ?></td>
								<td><?php echo $row['mail']; ?></td>
								<td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['registration_date']; ?></td>
                                
								</tr>
						<?php	
								}
						?>	
								</table>
				
				  		<table width="50%" class=form>
                        		<tr>
									<td valign="top" align="right"></td>
									
									<td align=left><input type="submit" name="submit" value="Confirm_Choice"></td>
								</tr>
						</table>
						</form>
								
            <?php
				} //end of if
            ?>
			
			
	<?php	//-------------------------Confirm_Choice------------------------------------------------
		if ( isset($_POST['submit']) && $_POST['submit'] == "Confirm_Choice") {
			//$user_id=$_POST['radio_user'];
			if(empty($_POST['radio_user']))	echo "<font color=\"#FF0000\">Δεν επιλεχτηκε Χρηστης!<br></font>";
			else
			{
			$user_id=$_POST['radio_user'];
			$sql="
			SELECT Id_Role
			FROM user
			WHERE Id_User='$user_id'
			";
			$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
			$row = mysql_fetch_assoc($result);
				
			if($row['Id_Role'] != 3) echo "<font color=\"#FF0000\">Ο χρηστης που επιλεξατε δεν ειναι φοιτητης!<br></font>";
			else
			{
			/* o metavlitis sql2 epistrefei ta pedia twn mathimatwn pou den exei perasei o epilegmenos foititis */
				$sql2="
				SELECT * 
				FROM lesson
				WHERE Id_Lesson != ALL(
						SELECT lesson.Id_Lesson
						FROM lesson, successfull_lesson
						WHERE successfull_lesson.Id_Student='$user_id' and successfull_lesson.Id_Lesson = lesson.Id_Lesson ) 
				";
				$result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er"));
				
		?>
			
			<br>
			<h3> Selection of Lessons from current user search</h3>
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
				<form name="checkbox_form" method="post" action="select_lesson.php">
		<?php
				while ($row2 = mysql_fetch_assoc($result2)) 
				{
		?>
				<tr class="alt">
				
				<td><input type="checkbox" name="chboxIdLessons[]" value="<?php echo $row2['Id_Lesson'];?>" /></td>
				
				<td><?php echo $row2['title']; ?></td>
					<td><?php	$temp=$row2['Id_Teacher'];
							$sql3="SELECT last_name
								FROM user
								WHERE ID_User='$temp'";
							$result3 = mysql_query($sql3) or die(header("Location: error.php?msg=dat_er"));
							$row3 = mysql_fetch_assoc($result3);
							echo $row3['last_name'];
						?>
					</td>
				<td><?php echo $row2['semister']; ?></td>
				<td><?php echo $row2['ECTS_units']; ?></td>
				<td><?php echo $row2['date_start']; ?></td>
				<td><?php echo $row2['date_end']; ?></td>
				<td><?php echo $row2['active']; ?></td>
				</tr>
				
		<?php		
				}//end while
		?>
				<br>
				<table width="50%" class=form method="POST" action="select_lesson.php">
                        		<tr>
									<td valign="top" align="right"></td>
									<td><input type="hidden" name="passuserid" value="<?php echo $user_id;?>" /></td>
									<td align=left><input type="submit" name="submit" value="Confirm_Selected"></td>
								</tr>
				</table>
				</form>
		<?php
			}
			}
		}
		?>

				<?php
						if ( isset($_POST['submit']) && $_POST['submit'] == "Confirm_Selected") {
						//$selected_less = $_POST['chboxIdLessons'];
						$user_id=$_POST['passuserid'];
						if(empty($_POST['chboxIdLessons']))
						{
							echo "<font color=\"#FF0000\">Δεν επιλεχτηκε κανενα μαθημα !<br></font>";
						}
						else
						{
						$selected_less = $_POST['chboxIdLessons'];
						$N = count($selected_less);
						$date=Date("Y-m-d");
						for($i=0; $i < $N; $i++)
						{
							$sql="
							INSERT	into selection_lesson
							(Id_Student,
							Id_Lesson,
							selection_date
							) 
							values
							(
							'$user_id',
							'$selected_less[$i]',
							'$date'
							)";
							mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
						}
						echo "<font color=\"#3300FF\"><strong><br>Η Δηλωση Μαθηματων ολοκληρώθηκε με επιτυχία!!!<br></strong>";
						}
				}
				?>
			 
	
</center>