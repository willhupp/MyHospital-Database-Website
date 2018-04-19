<?php
session_start();
if($_SESSION['user_id']=='')	//not logged in
{
	header("location:http://localhost/login.php");
}
else if(!empty($_GET["hid"]) && isset($_SESSION["SEARCH_QUERY"]))
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hospital";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM people WHERE HID = '".$_GET["hid"]."' AND Role = 'patient'";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0)	//successfully logged in
	{
		while($row = $result->fetch_assoc())
		{
			$_SESSION["fn"] = $row['Fname'];	//session start
			$_SESSION["ln"] = $row['Lname'];
			$_SESSION["hid"] = $row['HID'];
			$_SESSION["dob"] = $row['DOB'];
			$_SESSION["e-mail"] = $row['E-mail'];
			$_SESSION["phone"] = $row['Phone'];
			
		}	
	}
	
	$sql = "SELECT * FROM patient WHERE HID = '".$_GET["hid"]."'";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0)	//successfully logged in
	{
		while($row = $result->fetch_assoc())
		{
			$_SESSION["checkin"] = $row['Checkin'];	//session start
			$_SESSION["checkout"] = $row['Checkout'];
		}	
	}
	
	$sql = "SELECT Roomnum FROM nurseroom WHERE Bed1 = '".$_GET["hid"]."' OR Bed2 = '".$_GET["hid"]."'";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0)	//successfully logged in
	{
		while($row = $result->fetch_assoc())
		{
			$_SESSION["roomnum"] = $row['Roomnum'];	//session start
			//echo "$_SESSION["roomnum"] ";
		}	
	}
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
	<div class="row">
		<div class="col-md-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://www.cs.fsu.edu/files/facphotos/gaitrosd.jpg" alt="">
		</div>
		<div class="col-md-4 col-sm-6">
		
		
		<form action="php/checkout.php" method="post" id="frmLogout">
			<input class="btn btn-link" type="submit" name="Checkout" value="Checkout" >
		</form>
		
			
		<form action="php/delete.php" method="post" id="frmLogout">
			<input class="btn btn-link" type="submit" name="Delete" value="Delete" >
		</form>	
			
			
						
		<h1 class="page-header">Name: <?php echo $_SESSION["fn"]." ".$_SESSION["ln"]; ?></h1>
			<strong class="lead">HID: <?php echo $_SESSION["hid"]; ?></strong>
			<br>
			<strong class="lead">Date of Birth: <?php echo $_SESSION["dob"]; ?></strong>
			<br>
			<strong class="lead">E-mail: <?php echo $_SESSION["e-mail"]; ?></strong>
			<br>
			<strong class="lead">Phone: <?php echo $_SESSION["phone"]; ?></strong>
			<br> 
			
			<strong class="lead">Room Number: <?php echo $_SESSION["roomnum"]; ?></strong>
			<br>

			<strong class="lead">Check In Date: <?php echo $_SESSION["checkin"]; ?></strong>
			<br>
			<strong class="lead">Check Out Date: <?php echo $_SESSION["checkout"]; ?></strong>
			<br>
			<br>
			<br>
			
		
		<form action="php/statusupdate.php" method="post" id="frmLogin">
				<div class="form-group">
					<div><label>Status Update:</label></div>
					<div><input name="status" type="text" class="form-control" width="48"></div>
				</div>
				<div class="form-group">
					<input type="submit" name="submit"  class="btn btn-primary">
				</div>
		</form>
		
		<?php
		
					$sql= " SELECT * FROM records WHERE Patienthid= '".$_SESSION["hid"]."'";
				$result = $conn->query($sql);
			if($result->num_rows > 0)	//valid search
			{
				while($row = $result->fetch_assoc())
				{

					$doctorhid= $row['Doctorhid'];					
				}
					
			}	
		
					$sql= " SELECT * FROM people WHERE HID= '".$doctorhid."'";
				$result = $conn->query($sql);
			if($result->num_rows > 0)	//valid search
			{
				while($row = $result->fetch_assoc())
				{
					$lastname = $row['Lname'];	//session start
					$firstname = $row['Fname'];
				}
					
			}	
				
		
			$sql= " SELECT * FROM records WHERE Patienthid= '".$_SESSION["hid"]."' ORDER BY RecordID DESC";
				$result = $conn->query($sql);
			if($result->num_rows > 0)	//valid search
			{
				while($row = $result->fetch_assoc())
				{
					$postdate = $row['Postdate'];	//session start
					echo "$postdate";
					echo "<br>";
					$doctorhid= $row['Doctorhid'];
					
					
					
					echo "Dr. ". "$lastname";
					echo "<br>";
					$comment = $row['Comment'];
					echo "$comment";
					echo "<br>";
					echo "<br>";
					
				}
					
			}	
		
		?>
		
		
		

		</div>
		<div class="col-md-4">
		<br>
		<br>
			<a class="btn btn-default btn-block" data-dismiss="modal" data-toggle="modal" data-target="#ModalRegister" style="float: right;">Update Patient</a>
		</div>
	</div>
	
	
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	 <div id="ModalRegister" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update a Patient</h4>
                </div>
                <div class="modal-body">
                    <form id="RegForm" class="form-group" method="post" action="php/update.php">
                        <div class="row">
						<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">HID</label> 
                                    <input id="fname" type="text" class="form-control" name="hid" value="<?php echo $_SESSION["hid"] ;?> "readonly/>
                                    <span id="fname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">First Name</label> 
                                    <input id="fname" type="text" class="form-control" name="firstname" placeholder="Add a First Name" value="<?php echo $_SESSION["fn"];?>"/>
                                    <span id="fname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Add a Last Name" value="<?php echo $_SESSION["ln"];?>" />
                                    <span id="lname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" name="email" placeholder="Add Patient Email" value="<?php echo $_SESSION["e-mail"];?>" />
                                    <span id="em_err"></span>
                                </div>
                            </div>

                            </div>
                        
                       
						<div class="row">
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">DOB</label>
                                    <input type="text" class="form-control" name="dob" placeholder="Add Patient DOB" value="<?php echo $_SESSION["dob"];?>" maxlength="10" />
                                    <span id="dob_err"></span>
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Add Patient Phone #" value="<?php echo $_SESSION["phone"];?>" maxlength="10"/>
                                    <span id="phone_err"></span>
                                </div>
                            </div>
							
                        </div>
						<div class="row">
							<div class="col-md-12 clearfix">
                                <div class="pull-left ">
                                    <br />
									<input type="submit" name="Updte" value="Update Patient" class="btn btn-danger">
                                </div>
                            </div>
						</div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
