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
                            <h6 class="panel-title txt-dark">Pay Stub Data for
                                <?php
                                $sql = "SELECT f_name, l_name, emp_role " .
                                    " FROM employee " .
                                    " WHERE emp_id = " . $_SESSION['uid'];
                                $querys = mysqli_query($AWSCN, $sql);
                                if($querys) {
                                    while ($row = mysqli_fetch_array($querys)) {
                                        echo $row["f_name"] . " " . $row["l_name"] .
                                            "<br> ID = " . $_SESSION['uid']  .
                                            "<br> " . $row["emp_role"] ;
                                    }
                                }
                                ?> </h6>
                            <form><input class="btnstylega"
                                         onclick="window.open('Print_View_Employee.php','mywindow', 'menubar=1,resizable=1,width=500,height=500')"
                                         type="button" value="Print" /></form>

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
                                            <th>Stub ID</th>
                                           <!-- <th>Employee ID</th> -->
                                            <th>Store ID</th>
                                            <th>Store Address</th>
                                            <th>Store Number</th>
                                            <th>Hours Worked</th>
                                            <th>Pay Rate</th>
                                            <th>Tax Rate</th>
                                            <th>Total Earnings</th>
                                            <th>Net Pay</th>
                                            <th>Pay Frequency</th>
                                            <th>Pay Date</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                       
                                       
                                        $sql =  "SELECT s.STUB_ID, " . 
                                                        "  s.EMP_ID, " . 
                                                        "  s.STORE_ID, " . 
                                                        "  e.STORE_ADDR, " . 
                                                        "  e.STORE_NUMBER, " . 
                                                        "  s.HRS_WORKED, " . 
                                                        "  s.PAY_RATE, " . 
                                                        "  s.TAX_RATE, " . 
                                                        "  s.PAY_FREQUENCY, " .
                                                        "  s.PAY_DATE " .
                                                " FROM `stub info` s JOIN `store info` e ON s.store_id = e.store_id" . 
                                                " WHERE s.emp_Id=" . $_SESSION['uid'] .
                                                " ORDER BY PAY_DATE DESC" ;
                                       
                                                
                                        $querys = mysqli_query($AWSCN, $sql);
                                        if($querys)
										{
										while ($row = mysqli_fetch_array($querys))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $row["STUB_ID"] ?></td>
                                                <!-- <td><?php echo $row["EMP_ID"] ?></td> -->
                                                <td><?php echo $row["STORE_ID"] ?></td>
                                                <td><?php echo $row["STORE_ADDR"] ?></td>
                                                <td><?php echo $row["STORE_NUMBER"] ?></td>
                                                <td><?php echo $row["HRS_WORKED"] ?></td>
                                                <td><?php echo $row["PAY_RATE"] ?></td>
                                                <td><?php echo $row["TAX_RATE"] ?></td>
                                                <td>
                                                    <?php $totalEarnings = round($row["PAY_RATE"] * $row["HRS_WORKED"],2);
                                                    echo number_format ($totalEarnings, 2, '.', ','); ?></td>
                                                </td>
                                                <td><?php
                                                    $netPay = $totalEarnings * (1 - $row["TAX_RATE"]);
                                                    echo number_format ($netPay, 2, '.', ',');
                                                    ?>
                                                </td>
                                                <td><?php echo $row["PAY_FREQUENCY"] ?></td>
                                                <td><?php echo $row["PAY_DATE"] ?></td>
                                              
                                            </tr>
                                        <?php 
                                        } 
                                        }
                                        
                                        ?>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>Stub ID</th>
                                            <!-- <th>Employee ID</th> -->
                                            <th>Store ID</th>
                                            <th>Store Address</th>
                                            <th>Store Number</th>
                                            <th>Hours Worked</th>
                                            <th>Pay Rate</th>
                                            <th>Tax Rate</th>
                                            <th>Total Earnings</th>
                                            <th>Net Pay</th>
                                            <th>Pay Frequency</th>
                                            <th>Pay Date</th>
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
