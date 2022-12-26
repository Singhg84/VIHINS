<?php 
require 'Load.php';
?>
<html lang="en">
<style>
.disabled {
display: none;
}</style>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require '../adminHeaderClass.php'  ?>
        
  <?php
if(isset($_POST['btnSaveCourse']) && $_POST['randcheck']==$_SESSION['rand']){

$sqlcourse = "INSERT INTO steps_course VALUES ('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'Active')";

$stmt = $conn->prepare($sqlcourse);

$stmt->bind_param("sssssssssssssss",$_POST['course_sem'],$_POST['course_sub_id'],$_POST['course_code'],$_POST['course_no'],$_POST['course_type'],$_POST['course_unit'],$_POST['course_title'],$_POST['course_credit'],$_POST['course_paper_type'],$_POST['course_wef'],$_POST['course_close'],$_POST['course_IA'],$_POST['course_ESE'],$_POST['total_marks'],$_POST['pass_marks']);

if($stmt->execute()){
	$successMessge = "Course added successfully";
}else{
	$errorMessege = "Error occured";
}
}

?>             
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Courses</a></li>
					<li class="active">Add Courses</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Add Courses</h3>
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
		 else if (!empty($errorClose)){
            echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">
        <i class="pci-cross pci-circle"></i></button>' .$errorClose . '</div>';
          
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
												?><select name="course_sem" id="semister_list" class="form-control">
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
					                            <label class="col-lg-2 control-label text-left">Subject Name:</label>
					                            <div class="col-lg-7">
					        <?php $country_result = $conn->query('select sub_id,sub_name from  steps_subject where status=\'Active\''); ?>
                                                    <select name="course_sub_id" id="sub_id" class="form-control">
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
					                            <label class="col-lg-2 control-label text-left">Course Code:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" placeholder = "Course Code"  name="course_code" min="1" type="number" required>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Course No.:</label>
					                            <div class="col-lg-2">
					                              <input class="form-control" placeholder = "Course No" name="course_no" type="text"  required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Type:</label>
					                            <div class="col-lg-3">
					                               <select name="course_type" class="form-control" required>
                                                    <option value="" selected="selected">--Course Type--</option>
                                                    <option value="Core">Core</option>
                                                    <option value="Elective">Elective</option>
                                                </select>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Course Unit:</label>
					                            <div class="col-lg-2">
					                              <input class="form-control" placeholder = "Course Unit" name="course_unit" type="number" min="0"  required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Title:</label>
					                            <div class="col-lg-7">
					                                <input class="form-control" placeholder = "Course Title" name="course_title" type="text" required>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Credit:</label>
					                            <div class="col-lg-2">
					                               <input class="form-control" placeholder = "Course Credit"  name="course_credit" min="1" type="number" required>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Paper Type:</label>
					                            <div class="col-lg-3">
					                              <select name="course_paper_type" id="ddlModels" class="form-control" required>
                                                    <option value="" selected="selected">--Course Paper Type--</option>
                                                    <option value="Theory">Theory</option>
                                                    <option value="Practical">Practical</option>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course WEF :</label>
					                            <div class="col-lg-3">
					                               <select name="course_wef" id="select_one" class="form-control" required>
                                            <option value="">Course WEF</option>
                                             <?php for($i=2018;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
                                                 <label class="col-lg-1 control-label text-left">Close :</label>
					                            <div class="col-lg-3">
					                              <select name="course_close" id="select_two" class="form-control">
                                            <option value="">Course close</option>
                                             <?php for($i=2018;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>"><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">IA:</label>
					                            <div class="col-lg-2">
					                               <input class="form-control" placeholder ="IA" name="course_IA" id="txt1" type="number" onKeyUp="sum();" disabled="disabled" required>
                                                   <input hidden name="course_IA"/>
					                            </div>
                                                
                                                 <label class="col-lg-1 control-label text-left">ESE:</label>
					                            <div class="col-lg-2">
					                              <input class="form-control" placeholder ="ESE" name="course_ESE" id="txt2" onKeyUp="sum();"  type="number" required> 
					                            </div>
                                                
					                            <div class="col-lg-2">
					                             <input class="form-control"  name="total_marks" readonly placeholder = "Total" id="txt3"  required> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Pass Marks:</label>
					                            <div class="col-lg-7">
					                                <input class="form-control" min="1" placeholder ="Pass Marks" name="pass_marks" type="number" required> 
					                            </div>
					                        </div>
                                           
					                    <div class="pad-ver">
					                  <button type="submit" name="btnSaveCourse" class="btn btn-primary" onClick="return ValidateTextBox()">
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
  
  
  <script type="text/javascript">
    function ValidateTextBox() {
      var coursewef = document.getElementById("select_one").value.trim();
	  var courseclose = document.getElementById("select_two").value.trim();
	  if(courseclose ==''){
		   return true;
	  }
	  else if(courseclose <= coursewef){
            alert("course close is no less than course wef");
            return false;
	  }
    };
</script>
  
  
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
