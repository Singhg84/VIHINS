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
				$prevQuery = "SELECT * FROM steps_result_master WHERE  rm_session = '".$_POST['semester_session']."' and 
					rm_sub_id = '".$_POST['sem_sub_id']."' and rm_semester = '".$_POST['semester_list']."'";
                $prevResult = $conn->query($prevQuery);
                if($prevResult->num_rows > 0){
					echo $error = "Already Generated";
				}else{

					$sqlcourse = "SELECT course_id,total_marks,course_credit FROM steps_course WHERE course_sub_id = '".$_POST['sem_sub_id']."' and 
								course_sem = '".$_POST['semester_list']."' and status = 'Active'";	
								
					$stmt = $conn->prepare($sqlcourse);
					$stmt->execute();
					$resultcourse = $stmt->get_result();
					while($rowcourse = $resultcourse->fetch_assoc()){
						//echo $rowcourse['course_id']; echo '</br>';
					$sqlcoursemarks = "SELECT sum(first_marks_total) as totalmarks , 
						CASE WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 90
						THEN 'O'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 90 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 80
						THEN 'A+'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 79 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >=70
						THEN 'A'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 69 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >=60
						THEN 'B+'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 59 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 50
						THEN 'B'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 49 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 40
						THEN 'C'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 39 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 30
						THEN 'P'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 30
						THEN 'F'
						ELSE 'Ab'
						END as LetterGrade,
						CASE WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 90
						THEN '10'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 90 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 80
						THEN '9'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 79 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >=70
						THEN '8'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 69 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >=60
						THEN '7'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 59 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 50
						THEN '6'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 49 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 40
						THEN '5'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 39 AND ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") >= 30
						THEN '4'
						WHEN ((sum(first_marks_total) *100)/".$rowcourse['total_marks'].") < 30
						THEN '0'
						ELSE '0'
						END as gradepoints, first_stud_id
						FROM steps_first_sem WHERE course_id = '".$rowcourse['course_id']."' and 
						semester_session = '".$_POST['semester_session']."' and first_status = 'Active' group by first_stud_id"; 
						
						$stmtmarks = $conn->prepare($sqlcoursemarks);
						$stmtmarks->execute();
						$resultcoursemarks = $stmtmarks->get_result();
							
						//$flagresult = 'SQ';		
						//$resultcount=0;
						while($rowcoursemarks = $resultcoursemarks->fetch_assoc()){
							
							$conn->query("INSERT INTO steps_result_master SET 
										rm_session 			= '".$_POST['semester_session']."',
										rm_sub_id 			= '".$_POST['sem_sub_id']."',
										rm_semester 		= '".$_POST['semester_list']."',
										rm_course_id 		= '".$rowcourse['course_id']."',
										rm_stud_id  		= '".$rowcoursemarks['first_stud_id']."',
										rm_total_marks  	= '".$rowcoursemarks['totalmarks']."',
										rm_letter_grade 	= '".$rowcoursemarks['LetterGrade']."',
										rm_grade_points 	= '".$rowcoursemarks['gradepoints']."',
										rm_credit_points 	= '".$rowcoursemarks['gradepoints'] * $rowcourse['course_credit']."',
										rm_last_modified  	= NOW()");
										
							 $MessegeDataInserted = "Result is successfully processed.";
							 /*if($rowcoursemarks['LetterGrade'] == 'F' || $rowcoursemarks['LetterGrade'] == 'Ab'){
								// $flagresult = 'SNC';
								 $resultcount++;
							 }*/
							 
						}
						
					}
					
			   $sqlcertid = "SELECT max(`stud_cid_sem1`) s1,max(`stud_cid_sem2`) s2,max(`stud_cid_sem3`) s3,max(`stud_cid_sem4`) s4 FROM 
				steps_student_master where `stud_status` = 'Active'";	
				$stmtcertid = $conn->prepare($sqlcertid);
				$stmtcertid->execute();
				$resultcertid = $stmtcertid->get_result();
				$rowcertid = $resultcertid->fetch_assoc();
				$s = max($rowcertid['s1'], $rowcertid['s2'], $rowcertid['s3'],$rowcertid['s4']);
				if($s == 0)
					$cid = 498;
				else
					$cid = $s;
					
				
				$sqltotalsemmarks = "SELECT sum(total_marks) as semmarks, SUM(`course_credit`) as cc FROM steps_course where 
				course_sub_id = '".$_POST['sem_sub_id']."' and course_Sem = '".$_POST['semester_list']."'";	
				
				$stmttotalmarks = $conn->prepare($sqltotalsemmarks);
				$stmttotalmarks->execute();
				$resulttotalmarks = $stmttotalmarks->get_result();
				$rowtotalmarks = $resulttotalmarks->fetch_assoc();
				
				$sqlstudlist = "SELECT stud_id FROM steps_student_master where stud_session_admission = '".$_POST['admission_session']."' and 
				stud_present_semester = '".$_POST['semester_list']."' and stud_status = 'Active'";	
				$presentsem = $_POST['semester_list'] + 1;
				$stmtstudlist = $conn->prepare($sqlstudlist);
				$stmtstudlist->execute();
				$resultstudlist = $stmtstudlist->get_result();
				
				while($rowstudlist = $resultstudlist->fetch_assoc()){
					
					$sqltoalstudletgrd = "SELECT count(*) as gradecount FROM steps_result_master where 
					rm_stud_id = '".$rowstudlist['stud_id']."' and rm_sub_id = '".$_POST['sem_sub_id']."' and rm_semester = '".$_POST['semester_list']."' and (rm_letter_grade = 'F' OR rm_letter_grade = 'Ab')";	
					$stmtstudletgrd = $conn->prepare($sqltoalstudletgrd);
					$stmtstudletgrd->execute();
					$resultstudletgrd = $stmtstudletgrd->get_result();
					$rowstudletgrd = $resultstudletgrd->fetch_assoc();
					
					
					$sqltoalstudmarks1 = "SELECT sum(rm_total_marks) as studmarks,SUM(`rm_credit_points`) as cp FROM steps_result_master where 
					rm_stud_id = '".$rowstudlist['stud_id']."' and rm_sub_id = '".$_POST['sem_sub_id']."' and rm_semester = '".$_POST['semester_list']."'";	
					$stmtstudmarks1 = $conn->prepare($sqltoalstudmarks1);
					$stmtstudmarks1->execute();
					$resultstudmarks1 = $stmtstudmarks1->get_result();
					$rowstudmarks1 = $resultstudmarks1->fetch_assoc();
					$studresultpercent = number_format((float)round((($rowstudmarks1['studmarks']/$rowtotalmarks['semmarks'])*100),2),2,'.',',');
					$studresultsgpa = number_format((float)round(($rowstudmarks1['cp']/ $rowtotalmarks['cc']),2),2,'.',',');
					if($rowstudletgrd['gradecount'] > 2){
						$flagresult = 'X';	
					}else{
						if($studresultpercent >= 40){
							$flagresult = 'SQ';
							if($rowstudletgrd['gradecount'] == 1 || $rowstudletgrd['gradecount'] == 2)
								$flagresult = 'SNC';
						}else{
							$flagresult = 'X';
							$sqltoalstudsupplemarks = "SELECT sum(rm_total_marks) as markstop4 FROM (SELECT * FROM steps_result_master where 
					rm_stud_id = '".$rowstudlist['stud_id']."' and rm_sub_id = '".$_POST['sem_sub_id']."' and rm_semester = '".$_POST['semester_list']."' order by rm_total_marks desc limit 0,4) as innertable";	
					$stmtstudsupplemarks = $conn->prepare($sqltoalstudsupplemarks);
					$stmtstudsupplemarks->execute();
					$resultstudsupplemarks = $stmtstudsupplemarks->get_result();
					$rowstudsupplemarks = $resultstudsupplemarks->fetch_assoc();
					$studsuppleresultpercent = number_format((float)round((($rowstudsupplemarks['markstop4']/200)*100),2),2,'.',',');
							if($studsuppleresultpercent > 40)
								$flagresult = 'SNC';	
						}
					}
					$conn->query("INSERT INTO steps_result_total SET 
									rt_stud_id  		= '".$rowstudlist['stud_id']."',
									rt_session 			= '".$_POST['semester_session']."',
									rt_sub_id 			= '".$_POST['sem_sub_id']."',
									rt_semester 		= '".$_POST['semester_list']."',
									rt_full_marks  		= '".$rowtotalmarks['semmarks']."',
									rt_marks_obtain  	= '".$rowstudmarks1['studmarks']."',
									rt_percent 			= '".$studresultpercent."',
									rt_result 			= '".$flagresult."',
									rt_sgpa 			= '".$studresultsgpa."'");
						/*			
						echo "UPDATE steps_student_master SET 
										stud_present_semester 	= '".$presentsem."',
										stud_previous_semester 	= '".$_POST['semester_list']."',
										stud_cid_sem".$_POST['semester_list']."	 = '".$cid."' 
										WHERE stud_id = ".$rowstudlist['stud_id'];
						exit();*/
						$cid = $cid + 1;
						$conn->query("UPDATE steps_student_master SET 
										stud_present_semester 	= '".$presentsem."',
										stud_previous_semester 	= '".$_POST['semester_list']."',
										stud_cid_sem".$_POST['semester_list']."	 = '".$cid."' 
										WHERE stud_id = ".$rowstudlist['stud_id']);
										
						$MessegeDataInserted = "Result is successfully processed.";
					}
					
				}	
				
						
			}

?>                     
     
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Process Result</h3>
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
