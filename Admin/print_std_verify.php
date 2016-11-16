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
	<BR>
	<h4><font color="#3300FF"> Verification of Studies</font></h4>
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
	?>
	
	<?php
		//define the variables
		
			$user_id="";
			
			$Input_username="";
			$Input_name="";
			$Input_last="";
	?>
    	
				<form name="searchform" method="POST" >
					<h3> User Search </h3>
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
								<form name="confirm_form" method="POST" action="print_std_verify.php">
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
			
					
			
			
			<?php
					if ( isset($_POST['submit']) && $_POST['submit'] == "Confirm_Choice") {
						$user_id=$_POST['radio_user'];
						//echo "Hello";
						//echo $user_id;
						$sql="
						SELECT Id_Role
						FROM user
						WHERE Id_User='$user_id'
						";
						$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
						$row = mysql_fetch_assoc($result);
						
						if($row['Id_Role'] == 3) header ("Location:final_print.php?id_user=$user_id");
						else echo "<font color=\"#FF0000\">Ο χρηστης που επιλεξατε δεν ειναι φοιτητης!<br></font>";
					}
			 ?>

	</center>