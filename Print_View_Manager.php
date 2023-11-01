<?php
require_once (dirname(__file__) . '/DB_Config.php');
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html>
<body onload="showPrintDialogue()">
<!-- Main Content-->
<div class="page-wrapper">
    <div class="container-fluid pt-25">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Pay Stub Data for
                            <?php

                            $sql = "SELECT f_name, l_name, emp_role " .
                                " FROM employee " .
                                " WHERE emp_id = " . $_GET['uid'];
                            $querys = mysqli_query($AWSCN, $sql);
                            if($querys) {
                                while ($row = mysqli_fetch_array($querys)) {
                                    echo " " . $row["emp_role"] . " " . $row["f_name"] . " " . $row["l_name"] .
                                        ", ID " . $_GET['uid']  ;
                                }
                            }
                            ?>


                            <div class="pull-right">
                                <a href="#" class="pull-left inline-block full-screen">
                                    <i class="zmdi zmdi-fullscreen"></i>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <br>
                        <table border="1">
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
                                " FROM `stub info` s JOIN `store info` e ON S.store_id = e.store_id" .
                                " WHERE s.emp_Id=" . $_GET['uid'] .
                                " ORDER BY PAY_DATE DESC" ;


                            $querys = mysqli_query($AWSCN, $sql);
                            if($querys)
                            {
                                while ($row = mysqli_fetch_array($querys))
                                {
                                    ?>

                                    <tr><td>Stub ID</td><td><?php echo $row["STUB_ID"] ?></td></tr>
                                    <!-- <td><?php echo $row["EMP_ID"] ?></td> -->
                                    <tr><td>Store ID</td><td><?php echo $row["STORE_ID"] ?></td></tr>
                                    <tr><td>Store Address</td><td><?php echo $row["STORE_ADDR"] ?></td></tr>
                                    <tr><td>Store Number</td><td><?php echo $row["STORE_NUMBER"] ?></td></tr>
                                    <tr><td>Hours Worked</td><td><?php echo $row["HRS_WORKED"] ?></td></tr>
                                    <tr><td>Pay Rate</td><td><?php echo $row["PAY_RATE"] ?></td></tr>
                                    <tr><td>Tax Rate</td><td><?php echo $row["TAX_RATE"] ?></td></tr>
                                    <tr><td>Total Earnings</td><td>
                                            <?php $totalEarnings = round($row["PAY_RATE"] * $row["HRS_WORKED"],2);
                                            echo number_format ($totalEarnings, 2, '.', ','); ?></td>
                                        </td></tr>
                                    <tr><td>Net Pay</td><td><?php
                                            $netPay = $totalEarnings * (1 - $row["TAX_RATE"]);
                                            echo number_format ($netPay, 2, '.', ',');
                                            ?>
                                        </td></tr>
                                    <tr><td>Pay Frequency</td><td><?php echo $row["PAY_FREQUENCY"] ?></td></tr>
                                    <tr><td>Pay Date</td><td><?php echo $row["PAY_DATE"] ?></td></tr>


                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <script>
            function showPrintDialogue() {
                window.print();
            }
        </script>

</body>
</html>
