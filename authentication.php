<?php
	include ("index.php");
	include ("database.php");
?>
<?php

	
	if (isset($_POST['login']) && ($_POST['login']=="Login"))
	{
	 $username=$_POST['username'];
	 $password= md5($_POST['pwd']);
	}
	//echo $password;
	$sql="select * from user
			where user_name='$username' and password='$password' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result); //epistrefei to plithos twn grammws  tou apotelesmatos tis erwtisis sql (gia tin periptwsi mas einai 1)
	//echo $num;
	
	
	if ($num == 1)
	{
	SESSION_Start();
	$temp=mysql_fetch_assoc($result);
	$_SESSION['userId'] = $temp['Id_User'];
	
	if($temp['Id_Role'] == 1) { header("Location: Admin/index_Admin.php"); exit();}
	if($temp['Id_Role'] == 2) { header("Location: Professor/index_Professor.php"); exit();}
	if($temp['Id_Role'] == 3) { header("Location: Student/index_Student.php"); exit();}
	}
	else{
	echo "<center><font color=\"#FF0000\">Η Αυθεντικοποιηση απετυχε!<br></font> </center>";
	}
	
?>