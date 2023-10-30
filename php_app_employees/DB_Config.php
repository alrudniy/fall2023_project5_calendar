<?php

if (basename($_SERVER['PHP_SELF']) == basename(__file__))
{
    die('Access Denied, Direct Access Not Premitted!');
}

define('Title', 'Payroll Management Application');
define('Footer_Text','University of Scranton');
define('Project_Name','Class Schedule');
define('Author','Joe Merolla');

//Define User Password Length

define('PLength','10');

//Define sending email notification to webmaster & User

define('Email_Address','bolexapp@gmail.com');
define('Subject', 'New User Registration Notification');
define('From','bolexapp@gmail.com');
define('Username','bolexapp@gmail.com');
define('Password','bolexapp1234');
define('SMTP','smtp.gmail.com'); //smtp.gmail.com
define('Port','465'); // 465 or 567
define('Secure','ssl'); // ssl or tls

//Define TimeZone

define('TMZ','America/New_York');

// Authentication Salts

error_reporting(E_ALL);
@ini_set("display_errors", 1);

define('MOP', '0');

//Database Prefix

define('PRE','');

if (MOP == 1)
{
    
    define('DB_NAME', 'p5_calendar');
    /** MySQL Database Username */
    define('DB_USER', 'p5');
    /** MySQL Database Password */
    define('DB_PASSWORD', 'Vkugk195');
    /** MySQL HostName */
    define('DB_HOST', '34.136.218.122');
}

//----- Localhost Credentials

else
{
    /** The Name of the database*/
    define('DB_NAME', 'p5_calendar');
    /** MySQL Database Username */
    define('DB_USER', 'p5');
    /** MySQL Database Password */
    define('DB_PASSWORD', 'Vkugk195');
    /** MySQL HostName */
    define('DB_HOST', '34.136.218.122');
}

//Server Connection

$AWSCN = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$AWSCN)
{
    echo "<b>Error:</b> Unable to connect to MySQL. <br/>" . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL . "<br/>";
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__file__) . '/');