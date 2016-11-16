<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jquery.1.4.2.js"></script>

<script type="text/javascript" src="jsDatePick.jquery.min.1.3.js"></script>


<script type="text/javascript">

	window.onload = function(){

		new JsDatePick({

			useMode:2,

			target:"Date_Id",

			dateFormat:"%Y-%m-%d"

		});

	};

</script>
<center>
	
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
	?>
	<?php
		include ("manage_user.php");
	?>		
	
	<?php
		//define the variables
			$temp_user_id="";
			$user_id="";
			$user_name="";
			$password="";
			$role="";
			$first_name = "";
			$last_name = "";
			$address = "";
			$mail = "";
			$registration_date="";
			
			$Input_username="";
			$Input_name="";
			$Input_last="";
	?>
    
				<br>	
				<form name="searchform" method="post" action="modify_delete_user.php">
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
	//------------------update xristi----------------------------
		if ( isset($_POST['submit']) && $_POST['submit'] == "Update") {
			//get new values to insert
			$user_id=$_POST['user_id'];
			
			$user_name = $_POST['xristis'];
			$password = $_POST['kwdikos'];
			$role = $_POST['dropdown_role'];
			$first_name = $_POST['onoma'];
			$last_name = $_POST['epwnimo'];
			$mail = $_POST['mail'];
			$address = $_POST['dieuthinsi'];
			$registration_date = $_POST['im_eggrafis'];
			
			$error = 0;
			
			//check user_name
			if ($user_name == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Χρηστη!<br></font>";
			$error = 1;
			}
			//check password
			//if ($password == "") {
			//echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Κωδικό!<br></font>";
			//$error = 1;
			//}
			//check role
			if ($role == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το Ρολο!<br></font>";
			$error = 1;
			}
			//check first_name
			if ($first_name == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το Όνομα!<br></font>";
			$error = 1;
			}

			//check last_name
			if ($last_name == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το Επώνυμο!<br></font>";
			$error = 1;
			}
			
			//check registration_date
			if ($registration_date == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε την Ημερομηνια Εγγραφής!<br></font>";
			$error = 1;
			}
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else {
				
				$pass= md5($password);
				if($role == "Admin") $ro=1;
				if($role == "Professor") $ro=2;
				if($role == "Student") $ro=3;
						//kane eisagogi tis times stin vasi
										
								mysql_query("START TRANSACTION");
								if($password =="")	//den paremvaloume sto password
								{
								$sql = "
								UPDATE user SET
									user_name='".$user_name."',
									Id_Role='".$ro."',
									first_name='".$first_name."',
									last_name='".$last_name."' ,
									address='".$address."' ,
									mail ='".$mail."',
									registration_date ='".$registration_date."'
								WHERE Id_User = '".$user_id."'";
								}
								else	//paremvaloume sto password
								{
								$sql = "
								UPDATE user SET
									user_name='$user_name',
									password='$pass',
									Id_Role='$ro',
									first_name='$first_name',
									last_name='$last_name' ,
									address='$address' ,
									mail ='$mail',
									registration_date ='$registration_date'
								WHERE Id_User = '$user_id'";
								}
								echo $user_name."	".$first_name."	  ".$last_name; //."  ".$user_id;
								  $result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
								  //echo $sql;
								  //$row = mysql_fetch_assoc($result);
								  if ($result) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Η επεξεργασία ολοκληρώθηκε με επιτυχία!!!<br></strong>";
											  }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η επεξεργασία δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
			}
		}
	?>
	
    <?php
			//------------------delete xristi----------------------------
				if ((isset($_GET['user_id'])) && ($_GET['status']=='delete')) {
				$user_id=$_GET['user_id'];
				mysql_query("START TRANSACTION");
				$sql = "delete FROM user
									WHERE
						Id_User = '$user_id'";
										  
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				if ($result) {
					mysql_query("COMMIT");
					echo "<font color=\"#3300FF\"><strong><br>Η διαγραφή του χρήστη ολοκληρώθηκε με επιτυχία!!!<br></strong>";
				}
				else {
					mysql_query("ROLLBACK");
				}
			}
	?>
	

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
								<table class="view">
								<tr>
                                <th>UserName</th>
                                <th>Role</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Address</th>
                                <th>Registration</th>
								<th>Update</th>
                                <th>Delete</th>
								</tr>
						<?php
								while ($row = mysql_fetch_assoc($result)) {
						?>
							
								<tr class="alt">
                                <td><?php echo $row['user_name']; ?></td>
                                <td><?php echo $row['Id_Role']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
								<td><?php echo $row['last_name']; ?></td>
								<td><?php echo $row['mail']; ?></td>
								<td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['registration_date']; ?></td>
								<td valign="center" align="center">
								<form name="updateform" method="post" action="modify_delete_user.php">
								<input type="hidden" name="status" value="update">
								<input type="hidden" name="user_id" value="<?php echo $row['Id_User']; ?>">
								<BUTTON TYPE="submit" name="submit" value="update1" CLASS="image1"></BUTTON>
								</form>
                                
                                <td align="center"><a onClick="return confirm('Είσαι σίγουρος ότι θες να διαγράψεις τον χρήστη <?php echo $row['first_name']." ".$row['last_name']; ?> ?')" href="modify_delete_user.php?status=delete&user_id=<?php echo $row['Id_User']; ?>"><img src="http://localhost/=/Ergasia2/icons/delete.png"></a></td>
								</tr>
                                
						<?php		
								}
						?>	
								</table>
            <?php
				} //end of if
            ?>

	<?php
			//------------------update1 xristi----------------------------
				if ( isset($_POST['submit']) && $_POST['submit'] == "update1") {
				$user_id=$_POST['user_id'];
				
				//echo $user_id;
				
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
				from user where Id_User = '$user_id'";			
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				
				
				$row = mysql_fetch_assoc($result);
				$user_id=$row['Id_User'];
				$user_name = $row['user_name'];
				//$password = md5($row['password']);
				$role = $row['Id_Role'];
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$mail = $row['mail'];
				$address = $row['address'];
				$registration_date = $row['registration_date'];
			
	?>	
    							<br>
								<table class="view">
								<tr>
                                <th>UserName</th>
                                <th>Role</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Address</th>
                                <th>Registration</th>
								<th>Update</th>
                                <th>Delete</th>
								</tr>
								</table>
					<br>
					<h4><font color=\"#8A2BE2\">Modify User!<br></font></h4>
					<form name="contactform" method="post" action="modify_delete_user.php">
						<br/>
						<table width="50%" class=form>
						<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
								<tr>
									<td class=form_subheader>User Name: *</td>
									<td><input type="text" name="xristis" maxlength="50" size="30" value=<?php echo $user_name ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Password: *</td>
									<td><input type="text" name="kwdikos" maxlength="50" size="30" value=<?php echo $password ?>> </td>
								</tr>
								<tr>
									<td class=form_subheader>Role : * </td>
									<td><select name="dropdown_role" value=<?php echo $role;?>>
										<option> <?php  if($role==1)echo "Admin";
														if($role==2)echo "Professor";
														if($role==3)echo "Student";?></option>
										<option> <?php echo "Admin" ?></option>
										<option> <?php echo "Professor" ?></option>
										<option> <?php echo "Student" ?></option>
										</select> </td>
								</tr>
								<tr>
									<td class=form_subheader>First Name: *</td>
									<td><input type="text" name="onoma" maxlength="50" size="30" value=<?php echo $first_name ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Last Name: *</td>
									<td><input type="text" name="epwnimo" maxlength="50" size="30" value=<?php echo $last_name ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Address: </td>
									<td><input type="text" name="dieuthinsi" maxlength="50" size="30" value=<?php echo $address ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Mail: </td>
									<td><input type="text" name="mail" maxlength="50" size="30" value=<?php echo $mail ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Registration Date: *</td>
									<td><input type="text" name="im_eggrafis" id="Date_Id" maxlength="50" size="30" value=<?php echo $registration_date ?>></td>
								</tr>
                                </tr>
								<tr>
									<td valign="top" align="right"></td>
									<td align=left><input type="submit" name="submit" value="Update"></td>
								</tr>
						
							</table>
					</form>
       
       <?php
				} //end if
	   ?>

</center>