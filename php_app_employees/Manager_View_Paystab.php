<?php
require_once (dirname(__file__) . '/DB_Config.php');
require_once (dirname(__file__) . '/Header.php');
require_once (dirname(__file__) . '/Menu_Bar.php');
$eID = urldecode($_GET["eID"]);
require_once (dirname(__file__) . '/Include_Paystab_Details.php');
require_once (dirname(__file__) . '/Footer.php');
?>
