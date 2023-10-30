<?php
if(!isset($_SESSION))
{
    session_start();
}

if (basename($_SERVER['PHP_SELF']) == basename(__file__)) {
    die('Access Denied, Direct Access Not Premitted!');
}
 ?>
<div class="wrapper theme-5-active pimary-color-pink">
<?php
    require_once (dirname(__file__) . '/Top_Menu.php');
?>
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">

            <li class="navigation-header">
                <span>Main</span>
                <i class="zmdi zmdi-more"></i>
            </li>
			<?php if($_SESSION['RE']=="Employee"){ ?>
            <li>
                <a class="active" href="Home_Employee.php"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Employee Dashboard</span></div><div class="clearfix"></div></a> 
            </li>
			<?php } else {?>
			<li>
                <a class="active" href="Home_Manager.php"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Manager Dashboard</span></div><div class="clearfix"></div></a> 
             	<!-- <a class="active" href="Student_Upload.php"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Add Students</span></div><div class="clearfix"></div></a> 
                 -->
			</li>
			<?php } ?>
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->


