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
        <?php require '../adminHeaderClass.php'  ?>

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Result</a></li>
					<li class="active">Process Result</li>
                    </ol>
                    </div>
                     
            <?php
			if(isset($_POST['btnProcessResult']) && $_POST['randcheck']==$_SESSION['rand']){
				 $sqlresultcheck = "SELECT rm_stud_id FROM steps_result_master WHERE rm_session = '".$_POST['semester_session']."' and 
										rm_sub_id 			= '".$_POST['sem_sub_id']."' and 
										rm_semester 		= '".$_POST['semester_list']."'";
	
				$stmtcheck = $conn->prepare($sqlresultcheck);
				$stmtcheck->execute();
				$resultcheck = $stmtcheck->get_result();
				if($resultcheck->num_rows > 0){
					$conn->query("DELETE FROM steps_result_master WHERE rm_session = '".$_POST['semester_session']."' and 
											rm_sub_id 			= '".$_POST['sem_sub_id']."' and 
											rm_semester 		= '".$_POST['semester_list']."'");
					
					$conn->query("DELETE FROM steps_result_total WHERE rt_session = '".$_POST['semester_session']."' and 
											rt_sub_id 			= '".$_POST['sem_sub_id']."' and 
											rt_semester 		= '".$_POST['semester_list']."'");
											
					$MessegeDataInserted = "Result is successfully reverted.";
					
					
					$sqlstudlist = "SELECT stud_id FROM steps_student_master where stud_session_admission = '".$_POST['admission_session']."' and 
					stud_present_semester = '".($_POST['semester_list']+1)."' and stud_status = 'Active'";	
					
					$stmtstudlist = $conn->prepare($sqlstudlist);
					$stmtstudlist->execute();
					$resultstudlist = $stmtstudlist->get_result();
					while($rowstudlist = $resultstudlist->fetch_assoc()){
						
							$conn->query("UPDATE steps_student_master SET 
											stud_present_semester 	= '".$_POST['semester_list']."',
											stud_previous_semester 	= '".($_POST['semester_list']-1)."',
											stud_cid_sem".$_POST['semester_list']."	 = '0' 
											WHERE stud_id = ".$rowstudlist['stud_id']);
											
								 $MessegeDataInserted = "Result is successfully Reverted.";
						}
				}else{
					$MessegeDataInserted = "Nothing to be reverted.";
				}
					
			}
?>                     
     
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Process Result (UNDO)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"><strong>Undo the result of all semesters for a session.</strong></font></h3>
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
             if(!empty($error)){
            echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>' . $error . '</div>';
		}
		if(!empty($MessegeDataInserted)){
            echo '<div class="alert alert-info"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>' . $MessegeDataInserted . '</div>';
           
        }
        ?>
					                            </div>
					                        </div>
					                    </div>
                                        
					                    <!--Input form-->
					           <form  method="post" enctype="multipart/form-data" class="form-horizontal" id="form_submit">
                               <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" /> 
                                       <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Student Admission Session:</label>
					                            <div class="col-lg-7">
					                                <select name="admission_session" class="form-control" required id="admission_session">
                                               <option value="">Student Admission Session</option>
												 <?php for($i=2020;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                
											</select>
					                            </div>
					                        </div>
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Session:</label>
					                            <div class="col-lg-7">
					                                <select name="semester_session" class="form-control" required>
                                               			<option value="">Select Semester Session</option>
												 		<?php for($i=2021;$i<=date('Y');$i++){?>
                                             				<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 		<?php }?>
													</select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Subject:</label>
					                            <div class="col-lg-7">
					                                  <?php $country_result = $conn->query('select * from  steps_subject where status=\'Active\''); ?>
                                                    <select name="sem_sub_id" id="subject"  class="form-control" required>
                                                    <option value="">Select Subject</option>
                                                    <?php if ($country_result->num_rows > 0) {
                                                    while($row = $country_result->fetch_assoc()) {?>
                             							<option value="<?php echo $row['sub_id']; ?>"><?php echo $row['sub_name']; ?></option>
                                                    <?php }} ?>
                                                    </select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Semester:</label>
					                            <div class="col-lg-7">
					                                 <?php $country_result = $conn->query('select sub_semester from  steps_subject');?>
                                           <select name="semester_list" id="semester_list" class="form-control" required>
												<option value="">Select Semester</option>
												<?php if ($country_result->num_rows > 0) {
												$row = $country_result->fetch_assoc();
												for($i=1;$i<=$row['sub_semester'];$i++) {
												?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php }}?>
												</select>
					                            </div>
					                        </div>
                                            
                                            <div class="pad-ver">
					                        <button type="submit" name="btnProcessResult" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-Upload-To-Cloud icon-fw"></i>Process Result
					                        </button>
					                    </div>
                                            
					 </form>
                     
        
					                </div>
                                     <script>
            $('#form_submit').submit(function(){
       $.ajax({  
          type:'POST',  
          success: function() {
              //Hide the submit button upon successful submission
              $('#submit-btn').attr("disabled", true);
			  $('#submit-btn').attr('value', 'Sending please wait...');
              event.preventDefault();
          }
       });
    });
        </script>
                                    
					            </div>
					        </div>
					    </div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
 <?php require '../adminHeader.php' ?>
        </div>
<?php require '../adminFooter.php' ?>
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--=================================================-->
<script src="webMaster/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    
 <script src="webMaster/assets/js/demo/form-component.js"></script>   
    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
