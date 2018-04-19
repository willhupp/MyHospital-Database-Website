<?php
//Gather form info
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
		//check of login has info
	
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{	// Store user input in vars
	$textupdate = $_POST['status'];	//Fname
	$patienthid=$_SESSION["hid"] ;
	$doctorusername=$_SESSION["user_id"];
	//"SELECT * FROM people WHERE Fname = '".$First."' AND Lname = '".$Last."' AND Role='patient'";
	$sql="SELECT * FROM `people` WHERE `Username` = '".$doctorusername."'";
	$result=$conn->query($sql);
	
	if($result->num_rows > 0)	//successfully logged in
	{
		while($row = $result->fetch_assoc())
		{
			$doctorhid = $row['HID'];	//session start
			
		}	
	}
	
		$mydate=getdate(date("U"));
	$fulldate = "$mydate[month],$mydate[mday],$mydate[year] ";
	$sql='INSERT INTO `records` (`Postdate`, `Doctorhid`, `Patienthid`,`Recordid`,`Comment`) VALUES ("'.$fulldate.'", "'.$doctorhid.'","'.$patienthid.'","","'.$textupdate.'")';
	$result = $conn->query($sql);     

}	
	$hospitalID= $_SESSION["hid"];
		
	header('location: http://localhost/PatientProfile.php?hid='.$hospitalID);
		
		
?>