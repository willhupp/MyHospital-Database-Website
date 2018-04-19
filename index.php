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
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hospital";

		$conn = new mysqli($servername, $username, $password, $dbname);

		//$message = "";

		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		
		
		$sql="SELECT * FROM people WHERE Username='{$_SESSION['user_id']}'";
		$result = $conn->query($sql);
		
		
			while($row = $result->fetch_assoc()) 
			{
				$last = $row['Lname'];
				$first = $row['Fname'];
				$role= $row['Role'];
				
			}
		if($role=='doctor')
		{
			echo '<h1>' . "Welcome Dr." . $last . '</h1>';
		}
		else
		{
			echo '<h1>' . "Welcome " . $first ." " . $last . '</h1>';
		}
		
		
	
	?>
	<!-- Service Panels -->
        <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Services Panels</h2>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-search fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <h4>Search Patients</h4>
                        <p>Search Hospital Records</p>
                        <a href="search.php" class="btn btn-primary">Search Patient Records</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <h4>Create Patient</h4>
                        <p>Insert Hospital Record</p>
                        <a data-dismiss="modal" data-toggle="modal" data-target="#ModalRegister" class="btn btn-primary">Create Patient</a>
                    </div>
                </div>
            </div>
             <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-database fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <h4>Room Search</h4>
                        <p>Search Room Records </p>
                        <a href="searchroom.php" class="btn btn-primary">Room Search</a>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<!-- ModalRegister -->
    <div id="ModalRegister" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Patient</h4>
                </div>
                <div class="modal-body">
                    <form id="RegForm" class="form-group" method="post" action="php/createpatient.php">
                        <div class="row">
						<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input id="fname" type="text" class="form-control" name="firstname" placeholder="Enter Your First Name" />
                                    <span id="fname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Enter Your Last Name" />
                                    <span id="lname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email" />
                                    <span id="em_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                        
						<script type="text/javascript">
							function addSlashes(input) 
							{
								var v = input.value;
								if (v.match(/^\d{2}$/) !== null) {
									input.value = v + '/';
								} else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
									input.value = v + '/';
								}
							}
						</script>	    
							
							
						</div>
						<div class="row">
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">DOB</label>
									<input type="text" class="form-control" name="dob" placeholder="MM/DD/YYYY" onkeyup="addSlashes(this);" maxlength="10" />
									<span id="dob_err"></span>
                                </div>
                            </div>
						
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="roomnum">Room Number</label>
                                    <input type="text" class="form-control" name="roomnum" placeholder="Enter A Room Number" maxlength="4"/>
                                    <span id="roomnum_err"></span>
                                </div>
                            </div>
							<!--<div class="col-md-4">
                                <div class="form-group">
                                    <label>Nurse</label>
                                    <input type="text" class="form-control" name="nursehid" placeholder="Assign A Nursehid" />
                                    <span id="nurse_err"></span>
                                </div>
                            </div> -->
							
							
							
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter A Phone" maxlength="10" />
                                    <span id="phone_err"></span>
                                </div>
                            </div>
							
							<div class="col-md-4">
                                <div class="form-group">
                                    <label>Nurse</label>
                                    <select name="nursehid">		<!-- Want to run a query that enter nurse name in drop down-->
										<?php
											$sql = 'SELECT * FROM `people` WHERE `Role` = "nurse"';
											$result=$conn->query($sql);
											if($result->num_rows > 0)	//successfully logged in
											{
												echo '<option value="0">---Select Nurse---</option>';
												while($row = $result->fetch_assoc())
												{
													$nursefirst=$row['Fname'];
													$nurselast=$row['Lname'];
													$nursehid=$row['HID'];
													echo '<option value='.$nursehid.'>'.$nursefirst.' '.$nurselast.'</option>';
												}
											}
											
										?>
                                    <span id="nurse_err"></span>
                                </div>
                            </div>
							
                        </div>
						
						
						
						

													
						<div class="row">
							<div class="col-md-12 clearfix">
                                <div class="pull-left ">
                                    <br />
									<input type="submit" name="register" value="Register" class="btn btn-danger">
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
