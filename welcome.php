<?php 

	session_start();

	$color = $_SESSION['color'];
	$fname = $_SESSION['fname'];
	$sname = $_SESSION['sname'];
	$email = $_SESSION['email'];


 ?><!DOCTYPE html>
<html>
<head>
	<title>Submitted Contact Form</title>
</head>
<body style='background-color: <?php echo $color; ?>'>
	<h3>Welcome <?php echo $fname  ?>, You have successfully signedup, with email address <?php echo $email ?></h3>

</body>
</html>