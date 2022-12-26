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
if(isset($_POST['btnBulkupload']) && $_POST['randcheck']==$_SESSION['rand']){
		
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
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
                // Get row data
				$stud_enroll_no = $line[0];
                $stud_session_admission  = $line[1];
                $stud_class_no  = $line[2];
                $stud_name = $line[3];
				$stud_reg_no = $line[4];
				$stud_reg_year = $line[5];
				$stud_category = $line[6];
				
                
                // Check whether member already exists in the database with the same email
                $sqlstudent = "SELECT * FROM steps_student_master WHERE stud_enroll_no = '".$stud_enroll_no."'";
                $sturesult = $conn->query($sqlstudent);
                
                if($sturesult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE steps_student_master SET  stud_session_admission = '".$stud_session_admission."', stud_name = '".$stud_name."',stud_reg_no = '".$stud_reg_no."',stud_reg_year = '".$stud_reg_year."',stud_category = '".$stud_category."' WHERE stud_enroll_no = '".$stud_enroll_no."'");
					
					$MessegeDataUpdated = "Data updated";
					
                }else{
					$prev = $_POST['stud_present_semester'] - 1;
               		//echo "INSERT INTO  steps_student_master  VALUES ('','".$_POST['stud_present_semester']."', '".$_POST['stud_sub_id']."', '".$stud_enroll_no."','".$stud_session_admission."','".$stud_class_no."','".$stud_name."','".$stud_reg_no."','".$stud_reg_year."','".$stud_category."','Active',0,0,0,0,".$prev.")";
                    // Insert member data in the database
                  	$conn->query("INSERT INTO  steps_student_master  VALUES ('','".$_POST['stud_present_semester']."', '".$_POST['stud_sub_id']."', '".$stud_enroll_no."','".$stud_session_admission."','".$stud_class_no."','".$stud_name."','".$stud_reg_no."','".$stud_reg_year."','".$stud_category."','Active',0,0,0,0,'".$prev."')");
					
					$MessegeDataInserted = "Data Inserted";
                }
			}
            // Close opened CSV file
            fclose($csvFile);
            
        }else{
           $MessegeCelleError = "Error occured";
        }
    }else{
        $qstring = 'Invalid file';
    }
	
}
?>             
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Students</a></li>
					<li class="active">Bulk Upload Students</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Bulk Upload Students</h3>
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
		?>
					                               <a href="webMaster/BulkExampleStudents.csv">Download</a>(.csv) template
					                            </div>
					                        </div>
					                    </div>
					                    <!--Input form-->
					           <form  method="post" enctype="multipart/form-data" id="frmCSVImport" class="form-horizontal">
                                <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                                      
                                      
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Semester:</label>
					                            <div class="col-lg-7">
					                                <?php
												$country_result = $conn->query('select sub_semester from  steps_subject');
												?><select name="stud_present_semester" id="stud_present_semester" class="form-control" required>
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
                                                    <select name="stud_sub_id" id="sub_id" class="form-control" required>
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
					                    <label class="col-md-3 control-label">Attach (.csv) File</label>
					                    <div class="col-md-9">
					                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
       <div><input type="file" name="file" id="file" accept=".csv" required></div>
                       </div>
                       
					                    </div>
					                </div>
					                    <div class="pad-ver">
					                        <button type="submit" name="btnBulkupload" class="btn btn-primary" id="submit">
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
