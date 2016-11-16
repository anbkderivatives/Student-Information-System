<center>
	
	<?php
		
		SESSION_START();
		unset($_SESSION['userId']);
		session_destroy();
		
		header("Location: /=/Ergasia2/index.php?msg=logout");
		exit();
	?>
</center>