<?php 
ob_start();
date_default_timezone_set('Asia/Kolkata');
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
if($rows['usertype']=='1'){
	require '../adminUser/adminHeaderClass.php';
}
if($rows['usertype']=='2'){
	require '../departmentUser/departmentHeaderClass.php';
}
?>

<?php
$login_err = "";
if(isset($_POST['btnupdateProfile'])){
$sql1 = "UPDATE  steps_userdetails SET user_name =? , user_email=? , contact_no=? WHERE details_id = ? ";
         $stmt = $conn->prepare($sql1);
		$stmt->bind_param("ssss", $_POST['user_name'],$_POST['user_email'],$_POST['contact_no'],$_SESSION['username']);
$stmt->execute();
if ($stmt->error) {
  echo "An error occured!!! " . $stmt->error;
}
else 
$update_msg = "Profile updated successfully.";

$stmt->close();
		}
?>  
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Profile</a></li>
					<li class="active">Update Profile</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Update Profile</h3>
					                </div>
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                <div class="fixed-sm-200 pull-sm-left">
                                    <div class="pad-btm">
					                    </div>
					                    
					                </div>
					                
					                <div class="fluid">
					                    <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
					                            <div class="btn-group">
                                               <?php if(!empty($update_msg)){echo '<div class="alert alert-success"><button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>' . $update_msg . '</div>';}?> 
					                               
					                            </div>
					                        </div>
					                    </div>
					                    <!--Input form-->
					           <form  method="post" enctype="multipart/form-data" id="form_submit" class="form-horizontal">
					                      <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" /> 
                                      
                                      
                                      
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">User Name:</label>
					                            <div class="col-lg-7">
					                                <input type="text" name="user_name"  required class="form-control" value="<?php echo $rows['user_name'] ; ?>">
					                            </div>
					                        </div>
                                            
                                             <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Email Address:</label>
					                            <div class="col-lg-7">
					                                <input type="text" name="user_email" required class="form-control" value="<?php echo $rows['user_email']; ?>">
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Contact No.:</label>
					                            <div class="col-lg-7">
					                                 <input type="text" name="contact_no" required class="form-control" value="<?php echo $rows['contact_no'] ; ?>">
					                            </div>
					                        </div>
					                        
                                            
                                            
					                         
					                    <div class="pad-ver">
					                        <button type="submit" name="btnupdateProfile" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-file icon-fw"></i> Save Changes
					                        </button>
					                    </div>
					 </form>
                     
        
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
if($rows['usertype']=='1'){
	require '../adminUser/adminHeader.php';
}
if($rows['usertype']=='2'){
	require '../departmentUser/departmentHeader.php';
}
?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<?php 
if($rows['usertype']=='1'){
	require '../adminUser/adminFooter.php';
}
if($rows['usertype']=='2'){
	require '../departmentUser/departmentFooter.php';
}
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
<script src="webMaster/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    
 <script src="webMaster/assets/js/demo/form-component.js"></script>   
    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
