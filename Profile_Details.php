<?php
if(!isset($_SESSION))
{
    session_start();
}

if (basename($_SERVER['PHP_SELF']) == basename(__file__))
{
    die('Access Denied, Direct Access Not Premitted!');
}

?>
<!-- Main Content-->
<div class="page-wrapper">
    <div class="container-fluid pt-25">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">User Profile</h6>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row ">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="datable_1" class="table table-hover display  pb-30" >
                                        <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Date of Birth</th>
                                            <th>SSN</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php


                                        $sql =  "SELECT * " .
                                            " FROM employee " .
                                            " WHERE emp_Id=" . $_SESSION['uid'] ;


                                        $querys = mysqli_query($AWSCN, $sql);
                                        if($querys)
                                        {
                                            while ($row = mysqli_fetch_array($querys))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row["EMP_ROLE"] ?></td>
                                                    <td><?php echo $row["F_Name"] ?></td>
                                                    <td><?php echo $row["L_Name"] ?></td>
                                                    <td><?php echo $row["EMP_ADDR"] ?></td>
                                                    <td><?php echo $row["EMP_EMAIL"] ?></td>
                                                    <td><?php echo $row["EMP_DOB"] ?></td>
                                                    <td><?php echo $row["EMP_SSN"] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Role</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Date of Birth</th>
                                            <th>SSN</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
