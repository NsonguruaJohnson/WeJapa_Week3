<?php
	
	$emailErr  = $fnameErr = $snameErr = $dobErr = $passwordErr1 = $passwordErr2 = $genderErr  = '' ;
	$fname = $sname = $email = $password1 = $password2 = $gender = $dept = $dob = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();

		$_SESSION['color'] = $_POST['color'];
		$_SESSION['fname'] = $_POST['fname'];
		$_SESSION['sname'] = $_POST['sname'];
		$_SESSION['email'] = $_POST['email'];

		//header('Location: process-form.php');

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}		


/*
		//$color = $_POST['color'];
		//echo $color;
		echo '<br>';
		$date = $_POST['dob'];
		echo $date;
		

	//if(isset($_POST['color'])){
	/*	$fname = test_name($_POST['fname']);
		$lname = test_name($_POST['lname']);

		*/

		# Test first name
		if (empty($_POST['fname'])){
			$fnameErr = "First Name is required";			
		} else {
			$fname = test_input($_POST['fname']);
		}
		if (!preg_match("/^[a-zA-Z]*$/", $fname)){
			$fnameErr = "Only letters and white spaces allowed";
		}

		# Test second name
		if (empty($_POST['sname'])){
			$snameErr = "Second Name is required";			
		} else {
			$sname = test_input($_POST['sname']);
		}
		if (!preg_match("/^[a-zA-Z]*$/", $sname)){
			$snameErr = "Only letters and white spaces allowed";
		}

		# Test email
		if (empty($_POST['email'])){
			$emailErr = 'Enter email';
		} //else {
			//$email = test_input($_POST['email']);
		
		if (!empty($_POST['email'])){
			$email = test_input($_POST['email']);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailErr = 'Invalid email format';
			}
		}	

		# Test for Date of Birth
		if (empty($_POST['dob'])){
			$dobErr = "Enter Date of Birth";
		}
		if (!empty($_POST['dob'])){
			$dob = $_POST['dob'] ;
		
			date_default_timezone_set('Africa/Lagos');
			$today = strtotime("today");
			$a = strtotime($dob);
			if (($a > $today) || ($a == $today)){
				$dobErr = "Enter a date before today";	
			}
		}

		# Test for Gender
		if(empty($_POST['gender'])){
			$genderErr = "Select a gender";
		}
		if (!empty($_POST['gender'])){
			$no_checked = count($_POST['gender']);
			if ($no_checked > 1){
				$genderErr = "Select only one gender";
			} else {
				$gender = $_POST['gender'][0];
			}
		}

		# Store value of color
		$color = $_POST['color'];
	
		# Test for Department
		
		if (!empty($_POST['department'])){
			$dept = $_POST['department'];
		}

	
		#Test password

		if (empty($_POST['password1'])){
			$passwordErr1 = "Enter Password";
		} else {
			$password1 = $_POST['password1'];
		}	
		if (empty($_POST['password2'])){	
			$passwordErr2 = "Enter Password";
		} else {			
			$password2 = $_POST['password2'];
		}


		if(!empty($_POST['password1'])){


		
			$pattern = "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z])(?=.*[\W]).{15,}$/";
			if (!preg_match($pattern, $password1)){
				$passwordErr1 = "Must contain at least 15 characters with a combination of uppercase letters, lowercase letters, numbers and symbols";
			}
		}
			

		if ($password2 != $password1){
			$passwordErr2 = "Recheck password";
		}


		//$submit = $_POST['submit'];
		if (empty($emailErr) && empty($fnameErr) && empty($snameErr) && empty($dobErr) && empty($passwordErr1) && empty($passwordErr2) && empty($genderErr)) {
			header('Location: welcome.php');

			
			

		} 
	

/*function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}		
*/
	}

	

	//if  


		#This pattern works well
	// pattern="(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z])(?=.*[\W]).{15,}"

?>

<!DOCTYPE html>
<html>
<head>
	<style>
		.error {color: #FF0000;}
	</style>
	<title>Sign up</title>
</head>
<body>
	<form method='post' action='index.php'>
		<div>
			<label>First Name</label>
			<input type="text" name="fname"  value= <?php echo $fname; ?>>			
			<span class='error'><?php echo $fnameErr; ?></span>
		</div>
		<br>
		<div>
			<label>Second Name</label>
			<input type="text" name="sname" value = <?php echo $sname; ?> >
			<span class = 'error'> <?php echo $snameErr; ?></span>
		</div>
		<br>
		<div>
			<label>Email</label>
			<input type="text" name="email" value='<?php echo $email ? $email : ''; ?>'>
			<span class= 'error'> <?php echo $emailErr ?> </span>
			
		</div>
		<br>
		<div>
			<label>Date of Birth</label>
			<input type="date" name="dob" value = <?php echo $dob; ?>>
			<span class='error'> <?php echo $dobErr ?> </span>
		</div>
		<br>
		<div>
			<label>Favourite Color</label>
			<input type="color" name="color" value='<?php echo $color ?>' >
		</div>
		<br>
		<div>
			<legend>Gender</legend>
			<input type="checkbox" name="gender[]" value="male" <?php if ($gender == 'male') echo "checked" ?> >
			<label>Male</label>
			<br>
			<input type="checkbox" name="gender[]" value="female" <?php  if ($gender == 'female') echo "checked" ?> >
			<label>Female</label>
			<br>
						
			<span class= 'error'> <?php echo $genderErr ?> </span>
		</div>
		<br>
		<div>
			<label>Department</label>
			<select name='department' >				
				<option value='IT' <?php if ($dept == 'IT') echo "selected" ?> >IT</option>
				<option value='HR' <?php if ($dept == 'HR') echo "selected" ?> >HR</option>
				<option value='Finance' <?php if ($dept == 'Finance') echo "selected" ?> >Finance</option>
				<option value='Engineering' <?php if ($dept == 'Engineering') echo "selected" ?> >Engineering</option>
				<span class= 'error'> <?php echo $deptErr ?> </span>
			</select>
		</div>
		<br>
		<div>
			<label>Password</label>
			<input type="password"  name="password1" >
			<span class = 'error'> <?php echo $passwordErr1 ?></span>
		</div>
		<br>
		<div>
			<label> Confirm Password</label>
			<input type="password" name="password2">
			<span class = 'error'> <?php echo $passwordErr2 ?></span>
		</div>
		<input type="submit" value='Sign Up' name='submit' >
	</form>

</body>
</html>
