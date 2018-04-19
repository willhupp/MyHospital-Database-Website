<?php
//Gather form info
if($_SERVER["REQUEST_METHOD"] == "POST")
{	// Store user input in vars
	$firstname = $_POST['firstname'];	//Fname
	$lastname = $_POST['lastname'];	//Lname
	$email = $_POST['email'];	//E-mail
	$dob = $_POST['dob'];		//DOB
	$phone = $_POST['phone'];	//Phone
	$roomnum = $_POST['roomnum'];
	$nursehid= $_POST['nursehid'];
	
	
	
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
			$sql =	'INSERT INTO `people` (`Lname`, `Fname`, `DOB`, `E-mail`, `Phone`, `Username`, `Password`, `Role`) VALUES ("'.$lastname.'", "'.$firstname.'", "'.$dob.'", "'.$email.'", "'.$phone.'", "asdf", "asdf", "patient")';
			$conn->query($sql);
			
			$findhid = "SELECT HID FROM people where Phone=$phone";
			$result = $conn->query($findhid);
	if($result->num_rows > 0)	//valid search
	{
		
		while($row = $result->fetch_assoc())
		{
			$patienthid=$row['HID'];	//session start
		}
		
	}	
		
		$mydate=getdate(date("U"));
		$fulldate = "$mydate[month],$mydate[mday],$mydate[year] ";
		$sql='INSERT INTO `patient` (`HID`, `Checkin`, `Checkout`) VALUES ("'.$patienthid.'", "'.$fulldate.'"," ")';
		$conn->	query($sql)	;
			
		
			$bed2 = "SELECT Bed2 FROM nurseroom WHERE Roomnum= $roomnum";
			$result=$conn->query($bed2);
			
			//while($row=$result->fetch_assoc())
			//{
				
				//if($result->num_rows > 0)	
				if($result->num_rows > 0)
				{
					//youre going to use update bed2
					
						$sql="UPDATE Nurseroom SET Bed2='".$patienthid."' WHERE Roomnum='". $_POST["roomnum"] ."'"; //NURSE ID FOR WHERE
						// ,E-mail= '" . $_POST["email"] . "'
						$result = $conn->query($sql);     
					
					//echo "there is a patient already in that room";
					
					//break;
				}
				else
				{
						$sql='INSERT INTO `nurseroom` (`HID`, `Roomnum`, `Bed1`,`Bed2`) VALUES ("'.$nursehid.'", "'.$roomnum.'","'.$patienthid.'","'.$patienthid.'")';
						$result = $conn->query($sql);     

					//going to insert bed2
					
					//echo "Empty room";
					//break;
				}
				//if(is_int($row['Roomnum']))
				
			//}
			
			
			
			header("location:http://localhost/index.php");
			//echo "Create Patient Successful";
		}
		
?>

