<?php


	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	// Store user input in vars
		$First = $_POST['Rnum'];		
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
	
	
	$sql = "SELECT * FROM nurseroom WHERE Roomnum = '".$First."'" ;
	$result = $conn->query($sql);
	if($result->num_rows > 0)	//valid search
	{
		session_start();
		$_SESSION["RN"] = $First;
		header("location:http://localhost/searchroom.php");
	}
	else 
	{
		$message = "Invalid Search!";
		header("location:http://localhost/searchroom.php");
	}
	
	
	//PART 2 FOR THE BEDS AND PEOPLE AND SHIT
	
	     
			
?>

