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
?>

<?php
$username = $password = $dept_name = "";
$username_err = $password_err =  $dept_err =  "";
if(isset($_POST['btnNewuser']) && $_POST['randcheck']== $_SESSION['rand']){
if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }  
	
if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
 } else{
        $password = trim($_POST["password"]);
}


if(empty($username_err) && empty($password_err)){
		
$param_password = password_hash($password, PASSWORD_DEFAULT);
$sqlusername  = "INSERT INTO steps_login_master values('',?,?,?,'','Active')";
$stmt = $conn->prepare($sqlusername);
$stmt->bind_param("sss",$_POST["username"],$param_password,$_POST["user_type"]);
$stmt->execute();
}
if(empty(trim($_POST["dept_name"]))){
        $dept_err = "Please enter a Department Name.";
 }  
else{
$sqldept  = "INSERT INTO steps_userdetails values('',?,?,'','')";
$stmt = $conn->prepare($sqldept);
$stmt->bind_param("ss",$_POST["username"],$_POST["dept_name"]);
if($stmt->execute()){
	$successMessge = "user created";
  }else{
$errorMessege = "Problem";
}
}
}
?>


<ol class="breadcrumb">
					<li><a href="dmUser/dmDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li><a>User Control</a></li>
					<li class="active">Create New User</li>
                    </ol>
                    </div>
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel">
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                
					                <div class="fixed-sm-200 pull-sm-left fixed-right-border">
                                    <div class="pad-btm bord-btm">
					                        
					                    </div>
					                    
					                </div>
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
                                        
					                    <!--Input form-->
                                         
					                        <form  method="post" enctype="multipart/form-data" id="form_submit" class="form-horizontal">
                                            <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" /> 
					                        <div class="form-group">
					                            <label class="col-lg-2 control-label text-left" for="inputSubject">User type:</label>
					                            <div class="col-lg-6">
					                              
					                    <select name="user_type" id="user_type"  class="form-control" required>
                                            <option value="" selected>Select User Type</option>
 <option value="2">B.Sc Department</option>
 <option value="3">M.Sc Department</option>
</select>   
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left" for="inputSubject">User Name:</label>
					                            <div class="col-lg-6">
					                   <input type="text" name="username" required  class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" autofocus>
					                            </div>
                                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left" for="inputSubject">User Name:</label>
					                            <div class="col-lg-6">
					                   <input type="password" required name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Password">
                
					                            </div>
                                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left" for="inputSubject">Department name:</label>
					                            <div class="col-lg-6">
					                   <input type="text" class="form-control"  name="dept_name" />
					                            </div>
                                                <span class="invalid-feedback pull-right"><?php echo $dept_err; ?></span>
					                        </div>
                                            
					                    <div class="pad-ver">
					                        <button type="submit"  class="btn btn-primary" name ="btnNewuser">
					                            <i class="demo-psi-mail-send icon-lg icon-fw"></i>Save Changes
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
