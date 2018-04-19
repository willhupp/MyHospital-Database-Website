<?php
session_start();
if($_SESSION['user_id']=='')	//not logged in
{
	header("location:http://localhost/login.php");
}
if(!empty($_POST["logout"])) 	//clicked log out
{
	$_POST["login"] = '';
	session_destroy();
	header("location:http://localhost/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hospital Website</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/custom.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Hospital</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
                    <li>
                        <form action="" method="post" id="frmLogout">
							<input class="btn btn-link" type="submit" name="logout" value="Logout">
						</form>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<style>
	body
	{
		padding-top: 65px;
	}
</style>
    <!-- Page Content -->
    <div class="container">
	<h3>Search Patient to Update</p>
	<form id="SearchUserForm" class="form-group" method="post" action="php/update.php">
	<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
		<input name="FirstName" type="text" class="form-control" placeholder="First Name">
		<br>
		<input name="LastName" type="text" class="form-control" placeholder="Last Name">
		<br>
		<input type="submit" name="submit">
	</form>
	<?php
	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hospital";

		$conn = new mysqli($servername, $username, $password, $dbname);
		$_SESSION["fn"] = '';
		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		if(!empty($_SESSION["fn"]))
		{
			// Performing SQL query
			$sql = "SELECT * FROM people WHERE Fname = '".$_SESSION["fn"]."' AND Lname = '".$_SESSION["ln"]."'and role ='patient'";
			/*
			
			
			
				*****MUST ADD ERROR CHECKING***
				ie patient named * does not exist or this person is a doctor
			
			
			*/
			$result = $conn->query($sql);
			
			if($result->num_rows > 0)	//successfully found a user with that name combo
			{
				while($row = $result->fetch_assoc())
				{
					$hid =  $row['HID'];
					$lname = $row['Lname'];
					$fname = $row['Fname'];
					$dob = $row['DOB'];
					$email = $row['E-mail'];
					$phone = $row['Phone'];
					/*$username = $row['Username'];
					$password = $row['Password'];
					$role = $row['Role'];*/
					
					
					echo "<h1> HID :$hid </h1>";
					echo "<table  class='table table-hover'>";
					echo "<tr>";
					echo "<td>First name: </td>";
					echo '<td>';
					echo $fname;
					echo '</td>';
					
					echo "<tr>";
					echo "<td>Last name: </td>";
					echo '<td>';
					echo $lname;
					echo '</td>';
					
					echo "<tr>";
					echo "<td>Date of Birth: </td>";
					echo '<td>';
					echo $dob;
					echo '</td>';
					
					echo "<tr>";
					echo "<td>Email: </td>";
					echo '<td>';
					echo $email;
					echo '</td>';
					
					echo "<tr>";
					echo "<td>Phone #: </td>";
					echo '<td>';
					echo $phone;
					echo '</td>';
					echo "</table>";
				}

			}
		}
		?>
		
		
	
	
    </div>
	
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
