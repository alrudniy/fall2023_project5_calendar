<?php
ob_flush();
session_start();

ini_set('display_errors',0);

require_once (dirname(__file__) . '/DB_Config.php'); //database connection
$dt = new DateTime('now', new DateTimeZone(TMZ)); //Sets the time and date with timezone. 
$CDT = $dt->format('d/m/Y');
if(!empty($_SESSION['uid']))
{
    $Roles=$_SESSION["RE"];
    if ($Roles == 'Manager')
    {

        header("Location: Home_Manager.php");
    }
    else
    {

        header("Location: Home_Employee.php");
    }

}
$errorMsgLogin="";
if(isset($_POST["Submit_But"]))
{
$usernameEmail = mysqli_real_escape_string($AWSCN,$_POST['Username']);
$password = mysqli_real_escape_string($AWSCN,$_POST['UserPass']);
$hash_password= hash('sha512', $password);
define("AUTH_KEY","CSCI340");
$h_pass=md5($hash_password.AUTH_KEY);
if(strlen(trim($usernameEmail))>1 && strlen(trim($h_pass))>1 )
   {
	$user_result = mysqli_query($AWSCN,"select c.user_id, c.emp_id, e.f_name, e.l_name, e.emp_role " . 
										" from credentials c JOIN employee e ON c.emp_id = e.emp_id " .
										" where c.user_id='$usernameEmail' " . 
										" and c.pwd_hash='$password'") or die(mysqli_error($AWSCN));
	if(mysqli_num_rows($user_result) == 1)
	{
    	$user_row = mysqli_fetch_array($user_result);
		$_SESSION['uid'] = $user_row['emp_id'];
		$_SESSION['Name'] = $user_row['f_name']." ".$user_row['l_name'];
        $_SESSION['Role'] = $user_row['emp_role'];
		$Role = $user_row['emp_role'];
		$errorMsgLogin = "Login Successful";
        
        if($Role) {
            if ($Role == 'Manager')
            {
                $_SESSION['RE']=$Role;
                header("Location: Home_Manager.php");
            }
            else // Employee
            {
                $_SESSION['RE']=$Role;
                header("Location: Home_Employee.php");
            }
        }
    }
    else
	{
		$errorMsgLogin = "User credentials are incorrect!";
    }
   }
   else
   {
       $errorMsgLogin = "Enter login credentials.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title> Class Schedule Login</title>
		<meta name="description" content="Payroll Login" />
		<meta name="keywords" content="Payroll Login Page" />
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">

		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
		
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
<!--the logo for drew-->
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="https://moodle.drew.edu/">
						<img class="brand-img mr-10" src="img/drewimage.png" alt="brand"/>
			
					</a>
				</div>
				<div class="clearfix"></div>
			</header>

			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10" style ="font-family:Roboto Serif" style= "font-size:20px" > Login </h3>
											
										</div>

										<div class="form-wrap">
                                            <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2" style="font-family:Roboto Serif" style= "font-size:20px"> Username: </label>
													<!--<input type="email" class="form-control" required="" name="UserEmail" id="exampleInputEmail_2" placeholder="Enter username">-->
													<input type="text" class="form-control" required="" name="Username" id="input_username" >
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2"  style="font-family:Roboto Serif" style= "font-size:20px" >Password: </label>
													<input type="password" class="form-control" required="" name="UserPass" id="exampleInputpwd_2">
                                                    <br/>
                                                    <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="forgot-password.html">forgot password ?</a>
                                                    <div class="clearfix"></div>
												</div>

												<div class="form-group text-center">
                                                    <input type="submit" class="btn btn-info btn-rounded" value="Login" id="Submit_But" name="Submit_But" />
												</div>
                                                <div class="form-group text-center">
                                                    <?php echo $errorMsgLogin; ?>
                                                </div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->
				</div>

			</div>
			<!-- /Main Content -->

		</div>
		<!-- /#wrapper -->

		<!-- JavaScript -->

		<!-- jQuery -->
		<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>

		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>
	</body>
</html>

