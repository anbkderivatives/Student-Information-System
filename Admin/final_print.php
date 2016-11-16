<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<title>Print</title>
</head>
<center>
	
	<?php
		include ("C:/xampp/htdocs/=/Ergasia2/database.php");
		//echo $_GET['id_user'];
		$user_id=$_GET['id_user'];
	?>
	<?php
		$sql="
		SELECT *
		FROM user
		WHERE Id_User='$user_id'
		";
		$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
		$row = mysql_fetch_assoc($result);
	?>
	
	<h2> Βεβαιωση Σπουδων </h2>	<br/>
	Βεβαιωνεται οτι ο/η <?php echo $row['last_name']." ".$row['first_name'];?> με ΑΜ: <?php echo $row['user_name'];?> , ειναι φοιτητης του τμηματος<br>
	Μηχανικων Πληροφοριακων και Επικοινωνιακων Συστηματων του Πανεπιστημιου Αιγαιου , για το ακαδημαικό ετος <?php $date=Date("Y"); echo ($date-1)."-".$date;?>. <br>
	Ο ανωτερω εκανε εγγραφη για πρωτη φορα την <?php echo $row['registration_date'];?>.<br>
	Συνολο ετων φοιτησης : 5 <br><br>
	
	Η βεβαιωση εκδιδεται για καθε νομιμη χρηση. <br>
	
	<h4 align="right"> Ο/Η Γραμματεας του Τμηματος. <h4>
	
	
</center>