<center>
	
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
	?>
	<?php
		include ("manage_user.php");
			$Input_username="";
			$Input_name="";
			$Input_last="";
	?>
    
				<br>	
				<form name="searchform" method="post" action="information_user.php">
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
				
				$sql = "select
				Id_User,
				user_name,
				password,
				Id_Role,
				first_name,
				last_name ,
				address ,
				mail ,
				registration_date
				from user 
				where ((first_name='$Input_name' && last_name='$Input_last') || user_name='$Input_username')";	
								
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				
			?>
								<br>
						<form name="user_form" method="POST" action="information_user.php">
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
		if ( isset($_POST['submit']) && $_POST['submit'] == "Confirm_Choice") 
		{
			$Id_User=$_POST['radio_user'];
			$sql="
			SELECT *
			FROM user
			WHERE Id_User =  '$Id_User'
			";
			$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
		?>
			<img src="/=/Ergasia2/Student/upload/<?php echo $Id_User?>.jpg" width="300" height="200" /> 
		<?php
			while ($row = mysql_fetch_assoc($result)) 
			{
		?>
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
		<?php
			}
		}
		?>
		
</center>