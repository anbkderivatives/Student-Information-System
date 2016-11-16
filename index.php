<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link href="style.css" rel="stylesheet" type="text/css">
<title>Login Icarus</title>
</head>
<center>
<body>
<img src="icons/sima_aigaiou.jpg" /> <br/> <br/>
<form name="myform" method="POST" action = "authentication.php" > 
	<table width="35%" class=form>
	<tr>
		<td class=form_subheader> username :</td> <td> <input type="text" name="username"/> </td>
	</tr>
	<tr>
		<td class=form_subheader> password :</td> <td> <input type="password" name="pwd"/> </td>
	</tr>
	<br/>
	</table>
	<br/>
	<table>
	<tr>
		<td align=reight> <input type="submit" name="login" value="Login"/> </td>
	</tr>
	</table>
</form>
	
	<?php
		if (isset($_GET['msg']) && ($_GET['msg']=="logout"))
		{
			echo "<font color=\"#3300FF\"><strong><br>Successfull Logout! Session End!<br></strong>";
		}
	?>
	

</body>
</center>
