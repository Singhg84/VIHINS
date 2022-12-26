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
if(isset($_POST['btnSaveStudent']) && $_POST['randcheck']==$_SESSION['rand']){
	
$stmt = $conn->prepare("INSERT INTO  steps_student_master VALUES ('',?,?,?,?,?,?,?,?,?,'Active')");
$stmt->bind_param("sssssssss",$_POST['stud_present_semester'],$_POST['stud_sub_id'], $_POST['stud_enroll_no'], $_POST['stud_session_admission'],$_POST['stud_class_no'],$_POST['stud_name'],$_POST['stud_reg_no'],$_POST['stud_reg_year'],$_POST['stud_category']);

if($stmt->execute()){
	$successMessge = "Student added successfully";
}else{
	$errorMessege = "Problem";
}
}

?>             
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Students</a></li>
					<li class="active">Add Students</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Add Students</h3>
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
					                            <label class="col-lg-2 control-label text-left">Semester:</label>
					                            <div class="col-lg-7">
					                                <?php
												$country_result = $conn->query('select sub_semester from  steps_subject');
												?><select name="stud_present_semester" id="stud_present_semester" class="form-control">
												<option value="">Select Present Semester</option>
												<?php
												if ($country_result->num_rows > 0) {
												// output data of each row
												$row = $country_result->fetch_assoc();
												for($i=1;$i<=$row['sub_semester'];$i++) {
												?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php
												}
												}
												?>
												</select>
					                            </div>
					                        </div>
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Subject Name:</label>
					                            <div class="col-lg-7">
					        <?php $country_result = $conn->query('select sub_id,sub_name from  steps_subject where status=\'Active\''); ?>
                                                    <select name="stud_sub_id" id="sub_id" class="form-control">
                                                    <option value="">Select Subject</option>
                                                    <?php if ($country_result->num_rows > 0) {
                                                    while($row = $country_result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['sub_id']; ?>"><?php echo $row['sub_name']; ?></option>
                                                    <?php }}?>
                                                   
                                                    </select>
					                            </div>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Enrollment No.:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" placeholder="Enrollment No" name="stud_enroll_no" type="text" required> 
					                            </div>
                                                
                                                 <label class="col-lg-1 control-label text-left">Session:</label>
					                            <div class="col-lg-3">
					                              <select name="stud_session_admission" class="form-control" required>
                                            <option value="" selected="selected">--Admission Session--</option>
                                             <?php for($i=2018;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Student Name:</label>
					                            <div class="col-lg-7">
					                                 <input class="form-control" name="stud_name" placeholder="Enter name" type="text" required> 
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Class No.:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" placeholder="Class No"  min="1" name="stud_class_no" type="number" required> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Reg. No.:</label>
					                            <div class="col-lg-2">
					                              <input class="form-control" placeholder="Reg. No" min="1" name="stud_reg_no" type="number" required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Reg. Year:</label>
					                            <div class="col-lg-3">
					                               <select name="stud_reg_year" class="form-control" required>
                                            <option value="" selected="selected">--Registration Year--</option>
                                             <?php for($i=2015;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
                                                 <label class="col-lg-1 control-label text-left">Category:</label>
					                            <div class="col-lg-3">
					                             <select name="stud_category" class="form-control" required>
                                                    <option value="" selected="selected">--Category--</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
					                            </div>
                                                
					                        </div>
                                           
					                    <div class="pad-ver">
					                        <button type="submit" name="btnSaveStudent" class="btn btn-primary" id="submit-btn">
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
