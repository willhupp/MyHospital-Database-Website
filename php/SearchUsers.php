<?php


	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	// Store user input in vars
		$First = $_POST['FirstName'];
		$Last = $_POST['LastName'];
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
	$sql = "SELECT * FROM people WHERE Fname = '".$First."' AND Lname = '".$Last."' AND Role='patient'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)	//valid search
	{
		while($row = $result->fetch_assoc())
		{
			session_start();
			$_SESSION["fn"] = $row['Fname'];	//session start
			$_SESSION["ln"] = $row['Lname'];
			$_SESSION["hid"] = $row['HID'];
			$_SESSION["dob"] = $row['DOB'];
			$_SESSION["e-mail"] = $row['E-mail'];
			$_SESSION["phone"] = $row['Phone'];
		}
		
		header('location:http://localhost/PatientProfile.php?hid='.$_SESSION["hid"]);
	}
	else if(!empty($First) || !empty($Last))
	{	
		session_start();
		$_SESSION["SEARCH_QUERY"] = "SELECT * FROM people WHERE Fname like '%".$First."%' AND Lname like '%".$Last."%' AND Role='patient'";
		header("location:http://localhost/search.php");
	}
	else 
	{
		session_start();
		$_SESSION["SEARCH_QUERY"] = "SELECT * FROM people WHERE Role='patient'";
		header("location:http://localhost/search.php");
	}
	     
			
?>

