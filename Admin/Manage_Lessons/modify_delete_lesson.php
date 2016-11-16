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
		$lesson_id="";
		$title="";
		$Id_Teacher="";
		$semister="";
		$ECTS_units="";
		$date_start = "";
		$date_end = "";
		$active = "";
	?>

	<?php
		for($i=1;$i<=10; $i++)
		{
	?>	
		<br>
		<table class="view">
		<tr> Lessons of <?php echo $i;?> Semister </tr>
		<tr>
		<th>Title</th>
		<th>Teacher</th>
		<th>Semister</th>
		<th>ECTS Units</th>
		<th>Date Start</th>
		<th>Date End</th>
		<th>Active</th>
		<th>Update</th>
		<th>Delete</th>
		</tr>
	
	<?php
			$sql = "SELECT *
					FROM lesson
					WHERE semister='$i'";
			$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
			
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
			
			<td valign="center" align="center">
			<form name="updateform" method="post" action="modify_delete_lesson.php">
			<input type="hidden" name="status" value="update">
			<input type="hidden" name="lesson_id" value="<?php echo $row['Id_Lesson']; ?>">
			<BUTTON TYPE="submit" name="submit" value="update1" CLASS="image1"></BUTTON>
			</form>
			</td>
                               
            <td align="center">
			<a onClick="return confirm('Είσαι σίγουρος ότι θες να διαγράψεις το μαθημα <?php echo $row['title']; ?> ?')" href="modify_delete_lesson.php?status=delete&lesson_id=<?php echo $row['Id_Lesson']; ?>"><img src="http://localhost/=/Ergasia2/icons/delete.png"></a>
			</td>
			</tr>
	<?php
			}//end while
	?>
			</table>
	<?php
			}//end for
	?>
	
	<?php
			//------------------delete lesson----------------------------
				if ((isset($_GET['lesson_id'])) && ($_GET['status']=='delete')) {
				$lesson_id=$_GET['lesson_id'];
				mysql_query("START TRANSACTION");
				$sql = "delete FROM lesson
									WHERE
						Id_Lesson = '$lesson_id'";
										  
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				if ($result) {
					mysql_query("COMMIT");
					echo "<font color=\"#3300FF\"><strong><br>Η διαγραφή του μαθηματος ολοκληρώθηκε με επιτυχία!!!<br></strong>";
				}
				else {
					mysql_query("ROLLBACK");
				}
			}
	?>

	<?php
			//------------------update1 lesson----------------------------
				if ( isset($_POST['submit']) && $_POST['submit'] == "update1") {
				$lesson_id=$_POST['lesson_id'];
				
				$sql="
				SELECT *
				FROM lesson
				WHERE Id_Lesson='$lesson_id'
				";
				
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				$row = mysql_fetch_assoc($result);
				
				$title=$row['title'];
				$Id_Teacher=$row['Id_Teacher'];
				$semister=$row['semister'];
				$ECTS_units=$row['ECTS_units'];
				$date_start =$row['date_start'];
				$date_end = $row['date_end'];
				$active = $row['active'];
				
	?>	
		<br>
		<h4><font color=\"#8A2BE2\">Modify Lesson!<br></font></h4>
		<form name="contactform" method="post" action="modify_delete_lesson.php">
						
						<table width="50%" class=form>
						<input type="hidden" name="lesson_id" value="<?php echo $lesson_id ?>">
								<tr>
									<td class=form_subheader>Title : *</td>
									<td><input type="text" name="titlos" maxlength="50" size="30" value=<?php echo $title ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Semister: *</td>
									<td><select name="dropdown_semister" >
										<option ><?php echo $semister ?></option>
										<option value=1> <?php echo "1" ?></option>
										<option value=2> <?php echo "2" ?></option>
										<option value=3> <?php echo "3" ?></option>
										<option value=4> <?php echo "4" ?></option>
										<option value=5> <?php echo "5" ?></option>
										<option value=6> <?php echo "6" ?></option>
										<option value=7> <?php echo "7" ?></option>
										<option value=8> <?php echo "8" ?></option>
										<option value=9> <?php echo "9" ?></option>
										<option value=10> <?php echo "10" ?></option>
										
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
										
										/*proepilegmenos kathigitis*/
										$selected_prof="
										SELECT *
										FROM user
										WHERE  Id_User='$Id_Teacher'
										";
										
										$result = mysql_query($kathigites) or die(header("Location: error.php?msg=dat_er"));
										$result2= mysql_query($selected_prof) or die(header("Location: error.php?msg=dat_er"));
									?>
									
									<td>
										<select name="dropdown_teacher" >
										<?php $row2 = mysql_fetch_assoc($result2)?>
										<option value=<?php echo $row2['Id_User']?> ><?php echo $row2['last_name']." ".$row2['first_name']; ?></option>
										
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
										<option> <?php echo $active ?></option>
										<option> <?php echo "disable" ?></option>
										<option> <?php echo "enable" ?></option>
										</select> 
									</td>
								</tr>
								<tr>
									<td valign="top" align="right"></td>
									<td align=left><input type="submit" name="submit" value="Update"></td>
								</tr>
						</table>
						
		</form>
		
		<?php
			}//end 1f
		?>
				
<?php
	//------------------update lesson----------------------------
		if ( isset($_POST['submit']) && $_POST['submit'] == "Update") {
			//get new values to insert
			$lesson_id=$_POST['lesson_id'];
			
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
					"UPDATE lesson SET
					Id_Teacher='$Id_Teacher' ,
					title='$title',
					semister='$semister',
					ECTS_units='$ECTS_units',
					date_start='$date_start' ,
					date_end ='$date_end',
					active='$active'
					WHERE Id_Lesson='$lesson_id'";
				
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
				if ($result) {     
					mysql_query("COMMIT");
					echo "<font color=\"#3300FF\"><strong><br> Η ενημερωση ολοκληρώθηκε με επιτυχία!!!<br></strong>";
						    }
				 else {
					mysql_query("ROLLBACK");
					echo "<font color=\"#FF0000\"><strong><br>Η ενημερωση δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
					  }
				}
			
			
		}
	?>				

	
	
	
</center>