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
	?>
	
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Confirm_Choice") 
		{
		if(empty($_POST['radio_lesson'])) echo "<font color=\"#FF0000\">Δεν επιλεχτηκε μαθημα για βαθμολογηση!<br></font>";
		else
		{
			/* to sql erwtima pou ekteleitai parakatw apokoptei ta pedio Id_Student , opou einai to ID tou foititi me thn teleutaias dilwsi
			tou epilegmenou mathimatos .(Apo tin dilwsi tou mathimatos ews tin simerini imerominia prepei h diafora meta3h  tous 
			na einai mikroteri tou enos xronou, gia na gnwrizoume thn teleutaia akadimaiki dilwsi tou mathimatos)*/
			$Id_Lesson=$_POST['radio_lesson'];
			$sql="
			SELECT DISTINCT Id_Student
			FROM	selection_lesson
			WHERE	Id_Lesson='$Id_Lesson' &&  DATEDIFF( CURDATE(),selection_date) <= 366 
			";
			$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
		?>
		
						
		
				<br>
				<form name="gradeform" method="post" action="manage_grade2.php">
				<table width="50%" class=form>
                        		<tr>
									<td class=form_subheader>Exam Date: </td>
									<td><input type="text" name="exam_date" id="Date_Id" maxlength="50" size="30"> </td>
								</tr>
						</table> <br>
				<table class="view">
				<tr>
				<th>UserName</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Address</th>
				<th>Registration</th>
				<th>Grade</th>
				</tr>
		<?php
			while ($row = mysql_fetch_assoc($result))
			{
				/* sql2 = ta pedia twn epilegmenwn foititwn pros emfanisi */
				$Id_St=$row['Id_Student'];
				$sql2="
				SELECT *
				FROM user
				WHERE Id_User='$Id_St'";
				$result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er"));
				$row2 = mysql_fetch_assoc($result2)
		?>
				
				<tr class="alt">
				<input type="hidden" name="studentid_array[]" value="<?php echo $row2['Id_User']; ?>">
                <td><?php echo $row2['user_name']; ?></td>
                <td><?php echo $row2['first_name']; ?></td>
				<td><?php echo $row2['last_name']; ?></td>
				<td><?php echo $row2['mail']; ?></td>
				<td><?php echo $row2['address']; ?></td>
                <td><?php echo $row2['registration_date']; ?></td>
				<td><select name="dropdown_grades[]" >
										<option value=0> <?php echo "0" ?></option>
										<option value=0.5> <?php echo "0.5" ?></option>
										<option value=1> <?php echo "1" ?></option>
										<option value=1.5> <?php echo "1.5" ?></option>
										<option value=2> <?php echo "2" ?></option>
										<option value=2.5> <?php echo "2.5" ?></option>
										<option value=3> <?php echo "3" ?></option>
										<option value=3.5> <?php echo "3.5" ?></option>
										<option value=4> <?php echo "4" ?></option>
										<option value=4.5> <?php echo "4.5" ?></option>
										<option value=5> <?php echo "5" ?></option>
										<option value=5.5> <?php echo "5.5" ?></option>
										<option value=6> <?php echo "6" ?></option>
										<option value=6.5> <?php echo "6.5" ?></option>
										<option value=7> <?php echo "7" ?></option>
										<option value=7.5> <?php echo "7.5" ?></option>
										<option value=8> <?php echo "8" ?></option>
										<option value=8.5> <?php echo "8.5" ?></option>
										<option value=9> <?php echo "9" ?></option>
										<option value=9.5> <?php echo "9.5" ?></option>
										<option value=10> <?php echo "10" ?></option>
										
					</select> 
				</td>
				</tr>
		<?php
			}
		?>
				</table>
				<br>
				<table width="50%" class=form method="POST" action="manage_grade.php">
                        		<tr>
									<td valign="top" align="right"></td>
									<input type="hidden" name="pass_idlesson" value="<?php echo $Id_Lesson;?>" />
									<td align=left><input type="submit" name="submit" value="Confirm"></td>
								</tr>
				</table>
				</form>
		
		<?php
		}//small if
		}//big if
	?>
	
	<?php
			if ( isset($_POST['submit']) && $_POST['submit'] == "Confirm") 
			{
				//echo $_POST['exam_date'],"<BR>";
				if(empty($_POST['studentid_array']))
				{
					echo "<font color=\"#FF0000\">Error! Δεν υπαρχει φοιτητης για βαθμολογια!<br></font>";
				}
				if(empty($_POST['dropdown_grades']))
				{
					echo "<font color=\"#FF0000\">Error! Δεν επιλεχτηκαν βαθμολογιες!<br></font>";
				}
				else
				{
				$studentid_array = $_POST['studentid_array'];
				$Id_Lesson=$_POST['pass_idlesson'];
				$dropdown_grades=$_POST['dropdown_grades'];
				
				$exam_date=$_POST['exam_date'];
				
				$N = count($studentid_array); // to idio N tha exei epishs kai to dropdown_grades
				
				//--- To parakatw sql => Kataxwrisi eggrafwn ston pinaka analytikis vathmologias ------
				for($i=0; $i < $N; $i++)
				{
					//echo $studentid_array[$i] . "-". $dropdown_grades[$i]."<br>";
					$sql="
							INSERT	into detailed_grading
							(Id_Student,
							Id_Lesson,
							grade,
							exam_date
							) 
							values
							(
							'$studentid_array[$i]',
							'$Id_Lesson',
							'$dropdown_grades[$i]',
							'$exam_date'
							)";
					mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				}
				
				//--- To parakatw sql => Kataxwrisi eggrafwn me vathmo >= 5, ston pinaka epityximena mathimata ------
				for($i=0; $i < $N; $i++)
				{
					if( $dropdown_grades[$i] >= 5 )
					{
					$sql="
							INSERT	into successfull_lesson
							(Id_Student,
							Id_Lesson,
							grade,
							success_date
							) 
							values
							(
							'$studentid_array[$i]',
							'$Id_Lesson',
							'$dropdown_grades[$i]',
							'$exam_date'
							)";
					mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
					}
				}
				echo "<font color=\"#3300FF\"><strong><br>Η Βαθμολογηση Μαθηματων στους αντιστοιχους φοιτητες ολοκληρώθηκε με επιτυχία!!!<br></strong>";
				}
			}
	?>
</center>