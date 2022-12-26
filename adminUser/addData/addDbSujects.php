<?php 
require 'Load.php';
?>
<html lang="en">

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require '../adminHeaderClass.php'  ?>
        
  <?php
if(isset($_POST['btnSaveSubject']) && $_POST['randcheck']==$_SESSION['rand']){
		
$sqlsubject = "INSERT INTO steps_subject VALUES ('',?,?,?,?,?,?,?,'Active')";

$stmt = $conn->prepare($sqlsubject);

$stmt->bind_param("sssssss",$_POST['sub_code'], $_POST['sub_name'],$_POST['sub_semester'],$_POST['sub_full_marks'],$_POST['sub_theory_marks'],$_POST['sub_practical_marks'],$_POST['sub_credit']);

if($stmt->execute()){
	$successMessge = "Suject details added successfully";
}else{
	$errorMessege = "Problem";
}
}

?>             
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Subjects</a></li>
					<li class="active">Add Subjects</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Add Subjects</h3>
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
					                            <label class="col-lg-2 control-label text-left">Subject Code:</label>
					                            <div class="col-lg-4">
					                                <input type="text" placeholder = "Enter Code" class="form-control" name="sub_code" required>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Subject Name:</label>
					                            <div class="col-lg-7">
					                                <input class="form-control" placeholder = "Enter Subject Name " name="sub_name" type="text" required>
					                            </div>
					                        </div>
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-1 control-label text-left">Semester:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" placeholder = " Total Semester"  name="sub_semester" min="1" type="number" required>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Full Marks:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" placeholder = "Full Marks" name="sub_full_marks" type="number" min="1" required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-1 control-label text-left">Theory:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" placeholder = "Enter Marks"  name="sub_theory_marks" min="1" type="number" required>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Practical:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" placeholder = "Enter Marks" name="sub_practical_marks" type="number" min="1" required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Subject Credit:</label>
					                            <div class="col-lg-7">
					                                 <input class="form-control" placeholder = "Credit Point" min="1" name="sub_credit" type="number" required> 
					                            </div>
					                        </div>
                                            
                                            
                                           
					                    <div class="pad-ver">
					                        <button type="submit" name="btnSaveSubject" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-file icon-lg icon-fw"></i> Save Changes
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
 <?php require '../adminHeader.php' ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<?php require '../adminFooter.php' ?>
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
