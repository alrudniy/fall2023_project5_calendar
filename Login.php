<?php
ob_flush();
session_start();

ini_set('display_errors', 0);

$dt = new DateTime('now', new DateTimeZone('America/New_York')); 
$CDT = $dt->format('d/m/Y');

if (!empty($_SESSION['uid'])) {
    $Roles = $_SESSION["RE"];
    if ($Roles == 'Manager') {
        header("Location: index_test.php");
        exit();
    } else {
        header("Location: index_test.php");
        exit();
    }
}

$errorMsgLogin = "";
if (isset($_POST["Submit_But"])) {
    $username = $_POST['Username'];
    $password = $_POST['UserPass'];

    // Hardcoded credentials for demonstration
    $validUsername = 'admin';
    $validPassword = 'password';
    $validUsername = 'p5';
    $validPassword = 'Vkugk195';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['uid'] = $username; // Set some session variables if login is successful
        header("Location: index_test.php"); // Redirect to a home page
        exit();
    } else {
        $errorMsgLogin = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Class Schedule Login</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #ADD8E6; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-form-wrap {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px; 
        }

        .form-wrap {
            margin-top: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #007bff;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-rounded {
            border-radius: 20px;
        }

        .error-msg {
            color: red;
            font-size: 14px;
        }
    </style>
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
                                <!-- Register button -->
                                    <div class="form-group text-center">
                                        <a href="register.html" class="btn btn-primary btn-rounded">Register</a>
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


    </script>
</body>
</html>