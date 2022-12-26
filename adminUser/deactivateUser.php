<?php 
ob_start();
require 'Load.php';
?>
<html lang="en">
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        
	<?php 
	require 'adminHeaderClass.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sqldeactive = "UPDATE steps_login_master SET status = 'Inactive' where  username ='".$id."'";
$stmt = $conn->prepare($sqldeactive);
$stmt ->execute();
?>			        
                    <ol class="breadcrumb">
					<li><a href="dmUser/dmDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li><a href="#">User Control</a></li>
					<li class="active">Deactivate Users</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel">
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                
					                
					                <div class="fluid">
					                    <!-- COMPOSE EMAIL -->
					                    <!--===================================================-->
                                        
                                        <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
					                            <div class="btn-group">
                                               
					                            </div>
					                        </div>
					                    </div>
 <table id="demo-dt-basic" class="table table-striped table-bordered"  style="font-size:12px" cellspacing="0" width="100%">
					            <thead>
					                <tr>
                                            <th>Sl. No.</th>
                                            <th>Dept. Code</th>
<th>Department Name </th>
<th>Mobile </th>
<th>Email Address </th>
<th>Last Login </th>
<th>#</th>
					                </tr>
					            </thead>
					            <tbody>
                               <?php
$sqldeact =  "SELECT * FROM  steps_userdetails,steps_login_master WHERE steps_userdetails.details_id = steps_login_master.username AND steps_login_master.username!='VIH001' and steps_login_master.status = 'Active'";
$stmt = $conn->prepare($sqldeact);
$stmt->execute();
$resultdeact = $stmt->get_result();
$counter = 0;
while( $rowdeact = $resultdeact->fetch_assoc()){
?>
					                <tr>
					                         <td><?php echo ++ $counter; ?></td>
                                             <td><?php echo $rowdeact['details_id'] ; ?></td>
                                             <td><?php echo $rowdeact['user_name'];?></td>
                                             <td><?php echo $rowdeact['contact_no'];?></td>
                                             <td><?php echo $rowdeact['user_email'];?></td>
                                             <td><?php echo $rowdeact['last_log'];?></td>
                                             <td><div align="center"><a href="adminUser/deactivateUser.php?id=<?php echo $rowdeact['username']; ?>" onClick="return confirm('Are You sure to Deactivate User !');  "class="" title="Delete"><button id="dz-remove-btn " class="btn btn-danger cancel btn-circle" type="reset">
					                    <i class="demo-psi-trash"></i>
					                </button></a></div></td>
                                             
					                </tr>
					            <?php
}
?>
					            </tbody>
					        </table>
					                    <!--===================================================-->
					                    <!-- END COMPOSE EMAIL -->
					                </div>
					            </div>

					        </div>
					    </div>
					

                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
            <!--ASIDE-->
            <!--===================================================-->
            <!--===================================================-->
            <!--END ASIDE-->

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
<?php 
	require 'adminHeader.php';
?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<?php 
	require 'adminFooter.php';
?>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!-- END OF CONTAINER -->


    
    
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
