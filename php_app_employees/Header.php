<?php

if (basename($_SERVER['PHP_SELF']) == basename(__file__))
{
    die('Access Denied, Direct Access Not Premitted!');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo Title ?></title>
    <meta name="author" content="<?php echo Author ?>"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- switchery CSS -->
    <link href="../vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
    <!-- select2 CSS -->
    <link href="../vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Switches CSS -->
    <link href="../vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- Data table CSS -->
    <link href="../vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-- Jasny-bootstrap CSS -->
    <link href="../vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Toast CSS -->
    <link href="../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
