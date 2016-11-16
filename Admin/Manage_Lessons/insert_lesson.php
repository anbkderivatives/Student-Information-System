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
		new JsDatePick({

			useMode:2,

			target:"Date_Id2",

			dateFormat:"%Y-%m-%d"

		});

	};

</script>

<center>
	
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
	?>
	<?php
		include ("manage_lesson.php");
	?>
	<?php
		$title="";
		$Id_Teacher="";
		$semister="";
		$ECTS_units="";
		$date_start = "";
		$date_end = "";
		$active = "";
	?>
	
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Insert") {
			
			$title= $_POST['titlos'];
			$Id_Teacher = $_POST['dropdown_teacher'];
			$semister= $_POST['dropdown_semister'];
			$ECTS_units= $_POST['etcs_monades'];
			$date_start = $_POST['im_enarksis'];
			$date_end = $_POST['im_liksis'];
			$active = $_POST['dropdown_active'];
			
			
			$error = 0;
			
			//check title
			if ($title == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Τιτλο του Μαθηματος!<br></font>";
			$error = 1;
			}
			//check ECTS_units
			if ($ECTS_units == "") 
			{
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τις ECTS μοναδες!<br></font>";
			$error = 1;
			}
			
			
				if ($error == 1) 
				{
				 echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
				}
				else 
				{
					mysql_query("START TRANSACTION");
					$sql = 
					"INSERT into lesson
					(Id_Teacher ,
					title,
					semister,
					ECTS_units,
					date_start ,
					date_end ,
					active
					) 
					values
					(
					'$Id_Teacher',
					'$title',
					'$semister',
					'$ECTS_units',
					'$date_start' ,
					'$date_end' ,
					'$active' )";
				
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
				if ($result) {     
					mysql_query("COMMIT");
					echo "<font color=\"#3300FF\"><strong><br> Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!<br></strong>";
						    }
				 else {
					mysql_query("ROLLBACK");
					echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
					  }
				}
		}
	?>
	
	<br/>	
				<form name="contactform" method="post" action="insert_lesson.php">
						
						<table width="50%" class=form>
								<tr>
									<td class=form_subheader>Title : *</td>
									<td><input type="text" name="titlos" maxlength="50" size="30" value=<?php echo $title ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Semister: *</td>
									<td><select name="dropdown_semister" value=<?php echo $semister ?>>
										<option> <?php echo "1" ?></option>
										<option> <?php echo "2" ?></option>
										<option> <?php echo "3" ?></option>
										<option> <?php echo "4" ?></option>
										<option> <?php echo "5" ?></option>
										<option> <?php echo "6" ?></option>
										<option> <?php echo "7" ?></option>
										<option> <?php echo "8" ?></option>
										<option> <?php echo "9" ?></option>
										<option> <?php echo "10" ?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td class=form_subheader>Teacher : * </td>
									<?php
										mysql_query("START TRANSACTION");
										$kathigites = 
										"SELECT *
										FROM user  
										WHERE Id_Role = 2 
										ORDER BY last_name asc";
										
										$result = mysql_query($kathigites) or die(header("Location: error.php?msg=dat_er"));
									?>
									
									<td><select name="dropdown_teacher" >
										<?php while ($row = mysql_fetch_assoc($result)){?>
										<option value=<?php echo $row['Id_User']?> ><?php echo $row['last_name']." ".$row['first_name']; ?></option>
										<?php }//end while?>
										</select> 
									</td>
									 <!--<input type="hidden" name="teacher_id" value=<?php //echo $row['Id_User'] ?>> -->
									
								</tr>
								<tr>
									<td class=form_subheader>ECTS units: *</td>
									<td><input type="text" name="etcs_monades" maxlength="50" size="30" value=<?php echo $ECTS_units ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Date Start: </td>
									<td><input type="text" name="im_enarksis" id="Date_Id" maxlength="50" size="30" value=<?php echo $date_start ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Date End: </td>
									<td><input type="text" name="im_liksis" id="Date_Id2" maxlength="50" size="30" value=<?php echo $date_end ?>></td>
								</tr>
                                <tr>
									<td class=form_subheader>Active: </td>
									<td><select name="dropdown_active" value=<?php echo $active ?>>
										<option> <?php echo "disable" ?></option>
										<option> <?php echo "enable" ?></option>
										</select> 
									</td>
								</tr>
								<tr>
									<td valign="top" align="right"></td>
									<td align=left><input type="submit" name="submit" value="Insert"></td>
								</tr>
						</table>
						
				</form>
</center>