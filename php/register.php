<?php
//Gather form info
if($_SERVER["REQUEST_METHOD"] == "POST")
{	// Store user input in vars
	$firstname = $_POST['firstname'];	//Fname
	$lastname = $_POST['lastname'];	//Lname
	$email = $_POST['email'];	//E-mail
	$un = $_POST['username'];	//Username
	$pw = $_POST['password'];	//Password
	//$hid = $_POST['hid'];		//HID 
	$dob = $_POST['dob'];		//DOB
	$phone = $_POST['phone'];	//Phone
	$role = $_POST['role'];		//Role
}	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hospital";

		$conn = new mysqli($servername, $username, $password, $dbname);


		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		//check of login has info
		if(!empty($_POST["register"])) 
		{
			$sql =	'INSERT INTO `people` (`Lname`, `Fname`, `DOB`, `E-mail`, `Phone`, `Username`, `Password`, `Role`) VALUES ("'.$lastname.'", "'.$firstname.'", "'.$dob.'", "'.$email.'", "'.$phone.'", "'.$un.'", "'.$pw.'", "'.$role.'")';
			$conn->query($sql);
			header("location:http://localhost/login.php");
		}
		
?>

