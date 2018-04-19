<?php

/*
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	// Store user input in vars
		$First = $_POST['FirstName'];
		$Last = $_POST['LastName'];
		
	}
	*/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hospital";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	$sql="UPDATE people SET Fname='".$_POST["firstname"]."',Lname='".$_POST["lastname"]."' ,DOB = '".$_POST["dob"]."',Phone='".$_POST["phone"]."' WHERE HID='". $_POST["hid"] ."'";
	// ,E-mail= '" . $_POST["email"] . "'
	$result = $conn->query($sql);     
	$_SESSION["fn"]=$_POST["firstname"];
	$_SESSION["ln"]=$_POST["lastname"];
	$_SESSION["dob"]=$_POST["dob"];
	$_SESSION["phone"]=$_POST["phone"];
	$hospitalID= $_POST["hid"];
	

	//$_SESSION["email"]
	//need to fix concatenation
	//echo "<a href='http://localhost/PatientProfile.php?hid=$hid'>".$hid."</a>";

	header('location: http://localhost/PatientProfile.php?hid='.$hospitalID);
				
?>

