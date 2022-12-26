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
if(isset($_POST['btnSaveCourseUnit']) && $_POST['randcheck']==$_SESSION['rand']){
	
$sqlcourseunit = "INSERT INTO steps_course_unit VALUES ('',?,?,?,?,?,?,?,?,'Active')";

$stmt = $conn->prepare($sqlcourseunit);

$stmt->bind_param("ssssssss",$_POST['course_id'],$_POST['course_unit_no'], $_POST['course_unit_title'],$_POST['course_unit_credit'],$_POST['course_unit_IA'],$_POST['course_unit_ESE'],$_POST['course_unit_marks'],$_POST['course_unit_pass_marks']);

if($stmt->execute()){
	$successMessge = "Course unit added successfully";
}else{
	$errorMessege = "Problem";
}
}

?>             
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Courses</a></li>
					<li class="active">Add Course Unit</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Add Courses Unit</h3>
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
														?><select name="country" id="semister_list" class="form-control">
														<option value="">Select Course Semester</option>
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
					                            <label class="col-lg-2 control-label text-left">Course  Title:</label>
					                            <div class="col-lg-7">
					                                <select name="course_id" id="course_list" class="form-control">
                                                    	<option value=''>Select Course Title</option>
                                                    </select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course  Unit No.:</label>
					                            <div class="col-lg-7">
					                                <input type="number" min="1" placeholder="Course  Unit No." class="form-control" 
                                                    name="course_unit_no">
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Unit Title:</label>
					                            <div class="col-lg-7">
					                                <input class="form-control" placeholder="Course  Unit Title."  name="course_unit_title" type="text" required>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
                                                 <label class="col-lg-2 control-label text-left">Unit Paper Type:</label>
					                            <div class="col-lg-7">
					                              <select name="course_paper_type" id="ddlModels" class="form-control" required>
                                                    <option value="" selected="selected">--Course Unit Paper Type--</option>
                                                    <option value="Theory">Theory</option>
                                                    <option value="Practical">Practical</option>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">IA:</label>
					                            <div class="col-lg-2">
					                               <input class="form-control" placeholder ="Unit IA" name="course_unit_IA" id="txt1" type="number" onKeyUp="sum();" disabled="disabled"  required>
                                                   <input hidden name="course_unit_IA"/>
					                            </div>
                                                
                                                 <label class="col-lg-1 control-label text-left">ESE:</label>
					                            <div class="col-lg-2">
					                              <input class="form-control" placeholder ="Unit ESE" name="course_unit_ESE" id="txt2" onKeyUp="sum();"  type="number" min="0" required> 
					                            </div>
                                                
					                            <div class="col-lg-2">
					                             <input class="form-control"  name="course_unit_marks" readonly placeholder = "Total" id="txt3"  required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Pass Marks:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" min="1" name="course_unit_pass_marks" placeholder ="Pass Marks" type="number" required> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Credit Point:</label>
					                            <div class="col-lg-2">
					                              <input class="form-control" min="1" name="course_unit_credit" placeholder ="Credit Point" type="number" required> 
					                            </div>
                                                
					                        </div>
                                            
                                           
					                    <div class="pad-ver">
					                        <button type="submit" name="btnSaveCourseUnit" class="btn btn-primary" id="submit-btn">
					                            <i class="fa fa-floppy-o  icon-fw"></i> Save Changes
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
$('#semister_list').on('change', function(){
var id = this.value;
$.ajax({
type: "POST",
url: "adminUser/addData/getCouseID.php",
data:'id='+id,
success: function(result){
$("#course_list").html(result);
}
});
});
</script>


<script>
function sum() {
       var txtFirstNumberValue = document.getElementById('txt1').value;
       var txtSecondNumberValue = document.getElementById('txt2').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;

       var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
       if (!isNaN(result)) {
           document.getElementById('txt3').value = result;
       }
   }
            
  </script>
  
  
  <script type="text/javascript">
    $(function () {
        $("#ddlModels").change(function () {
            if ($(this).val() == 'Theory') {
                $("#txt1").removeAttr("disabled");
                $("#txt1").focus();
            } else {
                $("#txt1").attr("disabled", "disabled");
            }
        });
    });
</script>

    <!--=================================================-->
    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
