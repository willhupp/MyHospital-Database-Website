<?php

/*
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	// Store user input in vars
		$First = $_POST['FirstName'];
		$Last = $_POST['LastName'];
		
	}
	*/
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hospital";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	$mydate=getdate(date("U"));
	$fulldate = "$mydate[month],$mydate[mday],$mydate[year] ";
	$pathid= $_SESSION["hid"];
	$sql="UPDATE `patient` SET `Checkout` = '".$fulldate."' WHERE `patient`.`HID` = '".$pathid."'";
	$result = $conn->query($sql);     

	header("location:http://localhost/PatientProfile.php?hid=".$_SESSION['hid']);
			
?>