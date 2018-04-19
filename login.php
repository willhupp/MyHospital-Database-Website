
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hospital Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                <a class="navbar-brand" href="#">Hospital</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a  data-dismiss="modal" data-toggle="modal" data-target="#ModalRegister">Register</a>
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
		//check of login has info
		if(!empty($_POST["login"])) 
		{
			$sql = "SELECT * FROM people WHERE Username='" . $_POST["user_name"] . "' and Password = '". $_POST["password"]."'";
			$result = $conn->query($sql);
			if($result->num_rows > 0)	//successfully logged in
			{
				session_start();
				$_SESSION["user_id"] = $_POST["user_name"];	//session start
				
				header("location:http://localhost/index.php");
			}
			else 
			{
				$message = "Invalid Username or Password!";
			}
		}
		
		?>
		
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
		<h1>Welcome To Our Hospital!</h1>
			<form action="" method="post" id="frmLogin">
				<div class="text text-danger"><?php if(isset($message)) { echo $message; } ?></div>
				<div class="form-group">
					<div><label for="login">Username</label></div>
					<div><input name="user_name" type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<div><label for="password">Password</label></div>
					<div><input name="password" type="password" class="form-control"> </div>
				</div>
				<div class="form-group">
					<input type="submit" name="login" value="Login" class="btn btn-primary">
					<a class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#ModalRegister">New User</a>
				</div>
			</form>
		</div>
	</div><!--./end row-->
		
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
                    <h4 class="modal-title">Register for an account</h4>
                </div>
                <div class="modal-body">
                    <form id="RegForm" class="form-group" method="post" action="php/register.php">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter A Username" />
                                    <span id="uname_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Enter A Password" />
                                    <span id="pw_err"></span>
                                </div>
                            </div>
						

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
                                    <label for="password">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter A Phone" maxlength="10"/>
                                    <span id="phone_err"></span>
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control" name="role" placeholder="Enter A Role" />
                                    <span id="role_err"></span>
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
