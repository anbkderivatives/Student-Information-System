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
	
	<h2> �������� ������� </h2>	<br/>
	����������� ��� �/� <?php echo $row['last_name']." ".$row['first_name'];?> �� ��: <?php echo $row['user_name'];?> , ����� �������� ��� ��������<br>
	��������� ������������� ��� �������������� ���������� ��� ������������� ������� , ��� �� ���������� ���� <?php $date=Date("Y"); echo ($date-1)."-".$date;?>. <br>
	� ������� ����� ������� ��� ����� ���� ��� <?php echo $row['registration_date'];?>.<br>
	������ ���� �������� : 5 <br><br>
	
	� �������� ��������� ��� ���� ������ �����. <br>
	
	<h4 align="right"> �/� ���������� ��� ��������. <h4>
	
	
</center>