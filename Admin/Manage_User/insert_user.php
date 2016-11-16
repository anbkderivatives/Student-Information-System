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
			$user_name="";
			$password="";
			$role="";
			$first_name = "";
			$last_name = "";
			$address = "";
			$mail = "";
			$registration_date="";
			
	?>
	
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Insert") {
			//get new values to insert
			$user_name= $_POST['xristis'];
			$password= $_POST['kwdikos'];
			$role= $_POST['dropdown_role'];
			$first_name = $_POST['onoma'];
			$last_name = $_POST['epwnimo'];
			$address = $_POST['dieuthinsi'];
			$mail = $_POST['mail'];
			$registration_date=$_POST['im_eggrafis'];
			
			$error = 0;
			
			//check user_name
			if ($user_name == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Χρηστη!<br></font>";
			$error = 1;
			}
			//check password
			if ($password == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Κωδικό!<br></font>";
			$error = 1;
			}
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
				if($role == "Proffessor") $ro=2;
				if($role == "Student") $ro=3;
						//kane eisagogi tis times stin vasi
										
								mysql_query("START TRANSACTION");
								$sql = "insert into user
													(
			user_name,
			password,
			Id_role,
			first_name,
			last_name ,
			address ,
			mail ,
			registration_date
													)
													values
													(
			'$user_name',
			'$pass',
			'$ro',
			'$first_name' ,
			'$last_name' ,
			'$address' ,
			'$mail' ,
			'$registration_date'
													)";

								  $result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
								  if ($result) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!<br></strong>";
											    }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
			}
		}
	?>
	
				<br/>	
				<form name="contactform" method="post" action="insert_user.php">
						
						<table width="50%" class=form>
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
									<td><select name="dropdown_role" value=<?php echo $role ?>>
										<option> <?php echo "Admin" ?></option>
										<option> <?php echo "Proffessor" ?></option>
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
									<td align=left><input type="submit" name="submit" value="Insert"></td>
								</tr>
						</table>
						
				</form>

</center>