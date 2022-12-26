<?php
ob_start();
require ("../../connect.php");									
$rowid = $_POST['rowid'];
$sqledited = "SELECT * FROM steps_course_unit scu, steps_course sc WHERE 
scu.course_id = sc.course_id and course_unit_id = '".$rowid."' ";
$stmt = $conn->prepare($sqledited);
$stmt->execute();
$resultedited = $stmt->get_result();
$rowedited = $resultedited->fetch_assoc();
?>
                                <form  method="post" enctype="multipart/form-data" action="adminUser/modalEditViewPannel/courseUnitEdited.php" class="form-horizontal">
                                <input type="hidden" name="rowid" value= <?php echo $rowedited['course_unit_id'];?> />
                 
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
														<option value="<?php echo $i; ?>" <?php if($rowedited['course_sem'] == $i) echo 'selected';?>><?php echo $i; ?></option>
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
                                                 <?php
												 
														$states_result = $conn->query('select course_id, course_paper_type, course_no, course_title from steps_course where course_sem ='.$rowedited['course_sem'].' AND course_unit !=0 and status= \'Active\'');
														?>
                                                        <select name="course_id" id="course_list" class="form-control">
														<option value="">Select Course Title</option>
														<?php
															while($row = $states_result->fetch_assoc()) {?>
																	<option value="<?php echo $row['course_id'];?>" <?php if($rowedited['course_id'] == $row['course_id']) echo 'selected';?>><?php echo $row['course_no'].':'.$row['course_title'];?></option>
														<?php 
															}
														?>
														</select>
					                            </div>
					                        </div>
                                            
                                           
					                        <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course  Unit No.:</label>
					                            <div class="col-lg-9">
					                                <input type="number" class="form-control" value="<?php echo $rowedited['course_unit_no'];?>" name="course_unit_no">
					                            </div>
					                        </div>
                                      
                                      
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Unit  Title:</label>
					                            <div class="col-lg-9">
					                                <input class="form-control" required value="<?php echo $rowedited['course_unit_title'];?>" name="course_unit_title" type="text" >
					                            </div>
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                 <label class="col-lg-2 control-label text-left">Unit Paper Type:</label>
					                            <div class="col-lg-7">
					                              <select name="course_paper_type" id="ddlModels" class="form-control" required>
                                                    <option value="" selected="selected">--Course Unit Paper Type--</option>
                                                    <option value="Theory" <?php if($rowedited['course_paper_type'] == 'Theory') echo 'selected';?>>Theory</option>
                                                    <option value="Practical" <?php if($rowedited['course_paper_type'] == 'Practical') echo 'selected';?>>Practical</option>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">IA:</label>
					                            <div class="col-lg-7">
					                               <input class="form-control" placeholder ="Unit IA" name="course_unit_IA" id="txt1" type="number" onKeyUp="sum();" <?php if($rowedited['course_paper_type'] == 'Practical') echo 'disabled="disabled"';?>  required value="<?php echo $rowedited['course_unit_IA'];?>" onKeyUp="sum();">
					                            </div>
                                                </div>
                                                
                                                 <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">ESE:</label>
					                            <div class="col-lg-7">
					                              <input class="form-control" placeholder ="Unit ESE" name="course_unit_ESE" id="txt2" onKeyUp="sum();"  type="number" min="0" required value="<?php echo $rowedited['course_unit_ESE'];?>"> 
					                            </div>
					                        </div>
                                            <div class="form-group">
					                            <div class="col-lg-7">
					                             <input class="form-control"  name="course_unit_marks" readonly placeholder = "Total" id="txt3"  required value="<?php echo $rowedited['course_unit_IA']+$rowedited['course_unit_ESE'];?>"> 
					                            </div>
					                        </div>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Pass Marks:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" name="course_unit_pass_marks" value="<?php echo $rowedited['course_unit_pass_marks'];?>" required> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Credit Point:</label>
					                            <div class="col-lg-4">
					                              <input class="form-control" name="course_unit_credit" value="<?php echo $rowedited['course_unit_credit'];?>" required> 
					                            </div>
                                                
					                        </div>
					                    <div class="pad-ver">
					                        <button type="submit" name="btnEditCourseUnit" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-file icon-fw"></i> Save Changes
					                        </button>
					                    </div>

</form>
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
<?php

	if(isset($_POST['btnEditCourseUnit'])){
		//echo $sqldataEdited  = "UPDATE steps_course_unit SET course_id ='".$_POST['course_id']."',course_unit_no ='".$_POST['course_unit_no']."',course_unit_title ='".$_POST['course_unit_title']."', course_unit_credit ='".$_POST['course_unit_credit']."', course_unit_IA ='".$_POST['course_unit_IA']."', course_unit_ESE ='".$_POST['course_unit_ESE']."', course_unit_marks ='".$_POST['course_unit_marks']."', course_unit_pass_marks ='".$_POST['course_unit_pass_marks']."'	where course_unit_id ='".$_POST['rowid']."'";exit;
		$sqldataEdited  = "UPDATE steps_course_unit SET course_id =?,course_unit_no =?,course_unit_title =?, course_unit_credit =?, course_unit_IA =?, course_unit_ESE =?, course_unit_marks =?, course_unit_pass_marks =?	where course_unit_id =?";
		$stmt = $conn->prepare($sqldataEdited);
		$stmt->bind_param("sssssssss",$_POST['course_id'],$_POST['course_unit_no'], $_POST['course_unit_title'],
		$_POST['course_unit_credit'],$_POST['course_unit_IA'],$_POST['course_unit_ESE'],$_POST['course_unit_marks'],$_POST['course_unit_pass_marks'],$_POST['rowid']);
		
	if($stmt->execute()){
			header("location:../viewEditData/viewEditCourseUnits.php");
		}else{
			header("location:../viewEditData/viewEditCourseUnits.php");
		}
	}
	$conn->close();
?>
        
