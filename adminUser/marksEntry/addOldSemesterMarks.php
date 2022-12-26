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
        
  <?php
if(isset($_POST['btnFirstSem']) && $_POST['randcheck']==$_SESSION['rand']){
		
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
   // print_r($_POST);
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data.
				//print_r($line);
//				exit;
				$rt_stud_id 		= $line[0];
                //$rt_session  = $line[1];
                $rt_full_marks      = $line[6];
                $rt_marks_obtain    = $line[7];
				$rt_percent         = $line[8];
				$rt_result          = $line[9];
				$rt_sgpa            = $line[10];
				
                
                // Check whether member already exists in the database with the same email
                $sqlstudent = "SELECT * FROM steps_result_total WHERE rt_stud_id = '".$rt_stud_id."' and rt_semester = ".$_POST['semester_list'];
                $sturesult = $conn->query($sqlstudent);
                
                if($sturesult->num_rows > 0){
                    // Update member data in the database
                   /* $conn->query("UPDATE steps_result_total SET 
					rt_stud_id = '".$rt_stud_id."', rt_session = '".$_POST['semester_session']."',rt_sub_id = '".$_POST['sem_sub_id']."',
					rt_semester = '".$_POST['semester_list']."', rt_full_marks = '".$rt_full_marks."',
					rt_marks_obtain = '".$rt_marks_obtain."',rt_percent = '".$rt_percent."',rt_result = '".$rt_result."',
					rt_sgpa = '".$rt_sgpa."' WHERE stud_enroll_no = '".$stud_enroll_no."'");*/
					$stmtqry = "UPDATE steps_result_total SET 
									rt_session 		= '".$_POST['semester_session']."',
									rt_sub_id 		= '".$_POST['sem_sub_id']."',
									rt_full_marks 	= '".$rt_full_marks."',
									rt_marks_obtain = '".$rt_marks_obtain."',
									rt_percent 		= '".$rt_percent."',
									rt_result 		= '".$rt_result."',
									rt_sgpa 		= '".$rt_sgpa."' WHERE rt_stud_id = '".$rt_stud_id."' and rt_semester = ".$_POST['semester_list'];
			
						$stmt = $conn->prepare($stmtqry);

						if($stmt->execute()){
							$MessegeDataUpdated = "Student data updated successfully";
						}else{
							$MessegeDataUpdated = "Problem";
						}
					//$MessegeDataUpdated = "Data updated";
					
                }else{
					
                  	$stmtqry = "INSERT INTO  steps_result_total SET 
									rt_stud_id 		= '".$rt_stud_id."',
									rt_session 		= '".$_POST['semester_session']."',
									rt_sub_id 		= '".$_POST['sem_sub_id']."',
									rt_semester 	= '".$_POST['semester_list']."',
									rt_full_marks 	= '".$rt_full_marks."',
									rt_marks_obtain = '".$rt_marks_obtain."',
									rt_percent 		= '".$rt_percent."',
									rt_result 		= '".$rt_result."',
									rt_sgpa 		= '".$rt_sgpa."'";
			
						$stmt = $conn->prepare($stmtqry);

						if($stmt->execute()){
							$MessegeDataInserted = "Student added successfully";
						}else{
							$MessegeDataInserted = "Problem";
						}
					/*$conn->query("INSERT INTO steps_result_total  VALUES ('','".$rt_stud_id."', '".$_POST['semester_session']."',
					'".$_POST['sem_sub_id']."', '".$_POST['semester_list']."','".$rt_full_marks."','".$rt_marks_obtain."',
					'".$rt_percent."','".$rt_result."','".$rt_sgpa."')");
					
					$MessegeDataInserted = "Data Inserted";*/
                }
			}
            // Close opened CSV file
            fclose($csvFile);
            
        }else{
           $MessegeCelleError = "Error occured";
        }
	}
}
?>             
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Marks Entry</a></li>
					<li class="active">Upload Marks</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Upload Old Marks</h3>
					                </div>
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                <div class="fixed-sm-200 pull-sm-left">
                                    <div class="pad-btm">
					                        <a  href="adminUser/marksEntry/viewUploadedMarks.php" class="btn btn-block btn-success">View Uploaded Marks</a>
					                    </div>
					                </div>
					                
					                <div class="fluid">
					                    <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
					                            <div class="btn-group">
                                                
                                               <?php
													if(!empty($MessegeDataUpdated)){
														echo '<div class="alert alert-info"><button class="close" data-dismiss="alert">
														<i class="pci-cross pci-circle"></i></button>' . $MessegeDataUpdated . '</div>';
													   
													}
													else if (!empty($MessegeDataInserted)){
														echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">
													<i class="pci-cross pci-circle"></i></button>' .$MessegeDataInserted . '</div>';
													  
													}
													 else if (!empty($MessegeCelleError)){
														echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">
													<i class="pci-cross pci-circle"></i></button>' .$MessegeCelleError . '</div>';
													  
													}
													 else if (!empty($MsgMismatch)){
														echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">
													<i class="pci-cross pci-circle"></i></button>' .$MsgMismatch . '</div>';
													  
													}
        										?>
					                               
					                            </div>
					                        </div>
					                    </div>
					                    <!--Input form-->
					           <form  method="post" enctype="multipart/form-data" id="frmCSVImport" class="form-horizontal" >
                                <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" /> 
                                
                                      
                                      
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Session:</label>
					                            <div class="col-lg-7">
					                                <select name="semester_session" class="form-control" required>
                                               <option value="">Select Semester Session</option>
												 <?php for($i=2020;$i<=date('Y');$i++){?>
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
					                                 <?php $country_result = $conn->query('select sub_semester from steps_subject');?>
                                           <select name="semester_list" id="semester_list" class="form-control">
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
                                            
                                                                           		  
                                     <div class="form-group">
					                    <label class="col-md-3 control-label">Attach (.csv) File</label>
					                    <div class="col-md-9">
					                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
       											<div><input type="file" name="file" id="file" accept=".csv" required></div>
                       						</div>
                                        </div>
					                </div>
                                    <div class="pad-ver">
                                        <button type="submit" name="btnFirstSem" class="btn btn-primary" id="submit-btn">
                                            <i class="demo-psi-Upload-To-Cloud icon-fw"></i>Upload
                                        </button>
                                    </div>
					 </form>
					                </div>
                                    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
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

<script>
            $('#frmCSVImport').submit(function() {
  $(this).find("button[type='submit']").prop('disabled',true);
});
        </script>
            
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
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>


<script type="text/javascript">
  $(document).ready(function(){
    // Country dependent ajax
    $("#semester_list").on("change",function(){
      var semid = $(this).val();
      $.ajax({
        url :"adminUser/marksEntry/getCouseList.php",
        type:"POST",
        cache:false,
        data:{semid:semid},
        success:function(data){
          $("#course").html(data);
          $('#courseunit').html('<option value="">Select Course Unit</option>');
        }
      });
    });

    // state dependent ajax
    $("#course").on("change", function(){
      var courseid = $(this).val();
      $.ajax({
        url :"adminUser/marksEntry/getCouseList.php",
        type:"POST",
        cache:false,
        data:{courseid:courseid},
        success:function(data){
          $("#courseunit").html(data);
        }
      });
    });
  });
</script>

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
