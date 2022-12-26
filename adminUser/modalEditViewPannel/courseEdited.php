<?php
ob_start();
?>


<form  method="post" enctype="multipart/form-data" action="adminUser/modalEditViewPannel/courseEdited.php" class="form-horizontal">
                                          <?php
require ("../../connect.php");									
$rowid = $_POST['rowid'];
$sqledited = "SELECT * FROM steps_course WHERE course_id = '".$rowid."' ";
$stmt = $conn->prepare($sqledited);
$stmt->execute();
$resultedited = $stmt->get_result();
while($rowedited = $resultedited->fetch_assoc()){
?>

<input type="hidden" name="id" value= <?php echo $rowedited['course_id'];?> />



										<div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Semester:</label>
					                            <div class="col-lg-9">
					                               <?php
												$country_result = $conn->query('select sub_semester from  steps_subject');?>
                                                <select name="course_sem" id="semister_list" class="form-control">
													<option value="">Select Course Semester</option>
													<?php
														if ($country_result->num_rows > 0) {
														// output data of each row
														$row = $country_result->fetch_assoc();
														for($i=1;$i<=$row['sub_semester'];$i++) {
													?>
													<option value="<?php echo $i; ?>" <?php if ($rowedited['course_sem'] == $i) echo 'selected';?>><?php echo $i; ?></option>
												<?php
														}
													}
											?>
											</select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Code:</label>
					                            <div class="col-lg-3">
					                               <input value="<?php echo $rowedited['course_code'] ?> " class="form-control"  required  name="course_code">
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Course No.:</label>
					                            <div class="col-lg-4">
					                              <input class="form-control" name="course_no"  required value="<?php echo $rowedited['course_no'] ?> ">
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Type:</label>
					                            <div class="col-lg-3">
					                                <select name="course_type" class="form-control" required>
                                                    <option value="Core" <?php if ($rowedited['course_type'] == 'Core') echo 'selected';?>>Core</option>
                                                    <option value="Elective" <?php if ($rowedited['course_type'] == 'Elective') echo 'selected';?>>Elective</option>
                                                </select>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Course Unit:</label>
					                            <div class="col-lg-4">
					                              <input class="form-control" name="course_unit" required value="<?php echo $rowedited['course_unit'] ?> ">
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Title:</label>
					                            <div class="col-lg-9">
					                                <input class="form-control"  name="course_title" required value="<?php echo $rowedited['course_title'] ?> ">
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Credit:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control"  name="course_credit" required value="<?php echo $rowedited['course_credit'] ?> ">  
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Paper Type:</label>
					                            <div class="col-lg-4">
					                              <select name="course_paper_type" class="form-control" required>
                                                    <option value="Theory" <?php if ($rowedited['course_paper_type'] == 'Theory') echo 'selected';?>>Theory</option>
                                                    <option value="Practical" <?php if ($rowedited['course_paper_type'] == 'Practical') echo 'selected';?>>Practical</option>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course WEF :</label>
					                            <div class="col-lg-3">
					                               <select name="course_wef" id="select_one" class="form-control" required>
                                            
                                             <?php for($i=2018;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" <?php if($rowedited['course_wef'] == ($i.'-'.($i+1))) echo 'selected';?>><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left"> Course Close :</label>
					                            <div class="col-lg-4">
					                              <select name="course_close" id="select_two" class="form-control">
                                            <option value=" ">Course close</option>
                                             <?php for($i=2018;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" <?php if($rowedited['course_close'] == ($i.'-'.($i+1))) echo 'selected';?>><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Theory IA:</label>
					                            <div class="col-lg-3">
					                               <input class="form-control" name="course_IA" required value="<?php echo $rowedited['course_IA'] ?> "> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left"> Theory ESE:</label>
					                            <div class="col-lg-4">
					                              <input class="form-control"  name="course_ESE" value="<?php echo $rowedited['course_ESE'] ?> ">
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Pass Marks:</label>
					                            <div class="col-lg-9">
					                                 <input class="form-control" name="pass_marks" required value="<?php echo $rowedited['course_pass_marks'] ?> "> 
					                            </div>
					                        </div>
                                            
                                            
                                            
                                            

                                            
                
                                            
					                    <div class="pad-ver">
					                        <button type="submit" name="btnEditCourse" class="btn btn-primary" onclick="return ValidateTextBox()">
					                            <i class="demo-psi-file icon-fw"></i> Save Changes
					                        </button>
					                    </div>

                                     <?php
}
?>
</form>
                     <?php
if(isset($_POST['btnEditCourse'])){
	
$sqldataEdited  = "UPDATE  steps_course SET course_sem =?,course_code =?,course_no =?,course_type =?,course_title =?,course_unit =?,course_credit =?,course_paper_type =?,course_wef =?,course_close =?,course_IA =?,course_ESE =?,course_pass_marks =?
where course_id =?";

$stmt = $conn->prepare($sqldataEdited);
$stmt->bind_param("ssssssssssssss",$_POST['course_sem'], $_POST['course_code'],$_POST['course_no'],$_POST['course_type'],$_POST['course_title'],$_POST['course_unit'],$_POST['course_credit'],$_POST['course_paper_type'],$_POST['course_wef'],$_POST['course_close'],$_POST['course_IA'],$_POST['course_ESE'],$_POST['pass_marks'],$_POST['id']);
if($stmt->execute()){
	
header("location:../viewEditData/viewEditCourse.php");
}
}
$conn->close();
?>
        
