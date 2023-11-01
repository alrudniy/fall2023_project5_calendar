<?php

if (basename($_SERVER['PHP_SELF']) == basename(__file__))
{
    die('Access Denied, Direct Access Not Premitted!');
}
?>
<!-- Main Content-->
<div class="page-wrapper">
    <div class="container-fluid pt-25">

        <!-- Row -->
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-5 col-xs-12">
                <div class="panel card-view bg-gradient">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row pa-0">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left txt-light">
                                            <span class="weight-500 uppercase-font block">Total Admins</span>
                                            <span class="block counter"><span class="counter-anim">
											<?php 
									
$querys1 = mysqli_query($AWSCN, "SELECT count(Role_Id) as ADM FROM ".PRE."users Where Role_Id=1");
if($querys1)
{
if($rows = mysqli_fetch_array($querys1))
{
	echo $rows["ADM"];
}
}
?>

</span></span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right txt-light">
                                            <span class="weight-500 uppercase-font block">Total Users</span>
                                            <span class="block counter"><span class="counter-anim">
											<?php 
									
$querys11 = mysqli_query($AWSCN, "SELECT count(Role_Id) as USR FROM ".PRE."users Where Role_Id=2");
if($querys11)
{
if($rows1 = mysqli_fetch_array($querys11))
{
	echo $rows1["USR"];
}
}
?>
											
											
											
											</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
<div class="col-lg-6 col-md-4 col-sm-5 col-xs-12">
                <div class="panel card-view bg-gradient">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row pa-0">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left txt-light">
                                            <span class="weight-500 uppercase-font block">Total Instances</span>
                                            <span class="block counter"><span class="counter-anim">
											<?php 
									
$querys12 = mysqli_query($AWSCN, "SELECT count(Instance_Id) as ST FROM ".PRE."instances");
if($querys12)
{
if($rows22 = mysqli_fetch_array($querys12))
{
	echo $rows22["ST"];
}
}
?>

</span></span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right txt-light">
                                            <span class="weight-500 uppercase-font block">Total Running</span>
                                            <span class="block counter"><span class="counter-anim">
											<?php 
									
$querys112 = mysqli_query($AWSCN, "SELECT count(Instance_Status) as SU FROM ".PRE."instances Where Instance_Status=1");
if($querys112)
{
if($rows12 = mysqli_fetch_array($querys112))
{
	echo $rows12["SU"];
}
}
?>
											
											
											
											</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
        <!-- Row -->

       

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">User & Instance Details</h6>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row pa-0">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table display product-overview border-none" id="support_table">
                                       <tbody>
										<form name="stud_list">
										<table class="table display product-overview border-none" id="support_table">
									   
                                        <tr>
											<th>   </th>
                                            <th>	User ID	</th>
                                            <th>	Student Name	</th>
											<th>	Email Address	</th>
                                            <th>	Instance Id		</th>
                                            <th>	Date Created	</th>
											<th>	Actions			</th>
                                        </tr>
                                        
                                        
										<?php 
										 $querys = mysqli_query($AWSCN, "Select * From ".PRE."users as ui, ".PRE."instances as av where ui.User_Id=av.User_Id");
						//				$querys = mysqli_query($AWSCN,"Select * From ".PRE."users as ui,".PRE."instances as av");
										if($querys)
										{
										while ($row = mysqli_fetch_array($querys))
                                        {
                                            ?>

                                            <tr>
												<td> <input type="checkbox" id="check" name="em[]" value="<?php echo $row["Email_Address"] ?>" ></td>
                                                <td><?php echo $row["User_Id"] ?></td>
                                                <td><?php echo $row["First_Name"]." ".$row["Last_Name"] ?></td>
												<td><?php echo $row["Email_Address"] ?></td>
                                                <td><?php echo $row["Instance_No"] ?></td>
                                                <td><?php echo $row["Created_Date"] ?></td>
                                               
                                                <td><a href="Student_Terminate.php?RID=<?php echo $row["User_Id"] ?>" class="text-inverse" title="Terminate & Delete Instance" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td></td>


                                            </tr>
                                        <?php } }?>
											</table>
											<br/><br/>
											<button type="submit" id='btn1' class="btn btn-success  mr-10" formaction='Multiple_Instance.php'> CREATE </button>
											<br/><br/>
											</form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>
