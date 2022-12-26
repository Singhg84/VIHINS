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
    	
    if(isset($_POST['btnRest']) && $_POST['randcheck']==$_SESSION['rand']){
	$chkRadio = $_REQUEST['user_name'];
	$restPassword = 'user1234';
	$sql3 = "UPDATE steps_login_master SET password = ? WHERE username = ?";
	$stmt = $conn->prepare($sql3);
	$stmt->bind_param("ss", $param_password, $chkRadio);
	$param_password = password_hash($restPassword, PASSWORD_DEFAULT);
	if($stmt ->execute()){
    $successMessge = "Password change to 'user1234'";
    }else{
    $errorMessege = "Problem";
   }
}
	
?>
                    <ol class="breadcrumb">
					<li><a href="dmUser/dmDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li><a href="#">User Control</a></li>
					<li class="active">Reset/Create Password</li>
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
                                                <?php
        if(!empty($errorMessege)){
            echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>' . $errorMessege . '</div>';
           
        }
        else if (!empty($successMessge)){
            echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">
        <i class="pci-cross pci-circle"></i></button>' .$successMessge . '</div>';
          
        }
        ?>
        
        
					                            </div>
					                        </div>
					                    </div>
                                        <form  method="post" enctype="multipart/form-data" id="form_submit" class="form-horizontal">
                                         <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                                         
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
$sqlreset =  "SELECT * FROM  steps_userdetails,steps_login_master WHERE steps_userdetails.details_id = steps_login_master.username AND steps_login_master.username!='VIH001' and steps_login_master.status = 'Active'";
$stmt = $conn->prepare($sqlreset);
$stmt->execute();
$resultreset = $stmt->get_result();
$counter = 0;
while( $rowreset = $resultreset->fetch_assoc()){
?>
					                <tr>
					                         <td><?php echo ++ $counter; ?></td>
                                             <td><?php echo $rowreset['details_id'] ; ?></td>
                                             <td><?php echo $rowreset['user_name'];?></td>
                                             <td><?php echo $rowreset['contact_no'];?></td>
                                             <td><?php echo $rowreset['user_email'];?></td>
                                             <td><?php echo $rowreset['last_log'];?></td>
                                             <td><?php if($rowreset['password']!=''){ ?><input  name="user_name" type="radio" required  value="<?php echo $rowreset['username'];?>"><?php }?></td>
                                             
					                </tr>
					            <?php
}
?>
					            </tbody>
					        </table>
                                           <div class="pad-ver">
                                <button type="submit" name="btnRest" class="btn btn-success pull-right" id="submit-btn">
					                            <i class="demo-psi-gear icon-fw"></i> Reset Password
					                        </button>                   
                                            </div>
 
                                        </form>                   

                    
					
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
