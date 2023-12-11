<?php
ob_flush();
session_start();

ini_set('display_errors', 0);

require_once (dirname(__file__) . '/DB_Config.php'); // Database connection

// Setting the time and date with timezone
$dt = new DateTime('now', new DateTimeZone(TMZ)); 
$CDT = $dt->format('d/m/Y');

if (!empty($_SESSION['uid'])) {
    $Roles = $_SESSION["RE"];
    if ($Roles == 'Manager') {
        header("Location: Home_Manager.php");
        exit();
    } else {
        header("Location: Home_Employee.php");
        exit();
    }
}

$errorMsgLogin = "";
if (isset($_POST["Submit_But"])) {
    $usernameEmail = mysqli_real_escape_string($AWSCN, $_POST['Username']);
    $password = mysqli_real_escape_string($AWSCN, $_POST['UserPass']);
    $hash_password = hash('sha512', $password);
    define("AUTH_KEY", "CSCI340");
    $h_pass = md5($hash_password . AUTH_KEY);

    if (strlen(trim($usernameEmail)) > 1 && strlen(trim($h_pass)) > 1) {
        $user_result = mysqli_query($AWSCN, "SELECT c.user_id, c.emp_id, e.f_name, e.l_name, e.emp_role FROM credentials c JOIN employee e ON c.emp_id = e.emp_id WHERE c.user_id='$usernameEmail' AND c.pwd_hash='$password'");
        if (mysqli_num_rows($user_result) == 1) {
            $user_row = mysqli_fetch_array($user_result);
            $_SESSION['uid'] = $user_row['emp_id'];
            $_SESSION['Name'] = $user_row['f_name'] . " " . $user_row['l_name'];
            $_SESSION['Role'] = $user_row['emp_role'];

            // Redirect to the next page after successful login
            header("Location: NextPage.php"); // Replace "NextPage.php" with your target page
            exit();
        } else {
            $errorMsgLogin = "User credentials are incorrect!";
        }
    } else {
        $errorMsgLogin = "Enter login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Class Schedule Login</title>
    <!-- Include your CSS files here -->
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->

    <!-- Logo and Header -->
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
                <!-- Row for Form -->
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form ml-auto mr-auto no-float card-view pt-30 pb-30">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-30">
                                        <h3 class="text-center txt-dark mb-10">Login</h3>
                                    </div>  
                                    <div class="form-wrap">
                                        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Username:</label>
                                                <input type="text" class="form-control" required="" name="Username" id="input_username">
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10">Password:</label>
                                                <input type="password" class="form-control" required="" name="UserPass" id="exampleInputpwd_2">
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="submit" class="btn btn-info btn-rounded" value="Login" id="Submit_But" name="Submit_But">
                                            </div>
                                            <div class="form-group text-center">
                                                <?php echo $errorMsgLogin; ?>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Register button to show registration form -->
                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-primary btn-rounded" onclick="openModal()">Register</button>
                                    </div>
                                    <!-- Registration Modal -->
                                    <div id="registerModal" style="display:none;">
                                        <h2>Registration Form</h2>
                                        <form id="registrationForm">
                                            <input type="text" id="firstName" name="firstName" placeholder="First Name"><br>
                                            <input type="text" id="middleName" name="middleName" placeholder="Middle Name"><br>
                                            <input type="text" id="lastName" name="lastName" placeholder="Last Name"><br>
                                            <input type="email" id="email" name="email" placeholder="E-mail"><br>
                                            <input type="text" id="phone" name="phone" placeholder="Phone Number"><br>
                                            <select id="gender" name="gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select><br>
                                            <input type="date" id="dob" name="dob" placeholder="DOB"><br>
                                            <input type="text" id="address" name="address" placeholder="Address"><br>
                                            <button type="submit">Submit</button>
                                            <button type="button" onclick="closeModal()">Close</button>
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

    <script>
        function openModal() {
            document.getElementById('registerModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('registerModal').style.display = 'none';
        }

        document.getElementById('registrationForm').onsubmit = function(event) {
            event.preventDefault();
            closeModal();
        };
    </script>

</body>
</html>
