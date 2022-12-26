<?php
ob_start();
?>
<form  method="post" enctype="multipart/form-data" action="adminUser/modalEditViewPannel/studentsDetailsEdited.php" class="form-horizontal">
                                          <?php
require ("../../connect.php");									
$rowid = $_POST['rowid'];
$sqledited = "SELECT * FROM steps_student_master WHERE stud_id = '".$rowid."' ";
$stmt = $conn->prepare($sqledited);
$stmt->execute();
$resultedited = $stmt->get_result();
while($rowedited = $resultedited->fetch_assoc()){
?>

<input type="hidden" name="id" value= <?php echo $rowedited['stud_id'];?> />

                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Enrollment No.:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" name="stud_enroll_no" value="<?php echo $rowedited['stud_enroll_no'] ?> " required> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Session:</label>
					                            <div class="col-lg-4">
					                              <select name="stud_session_admission" class="form-control" required>
                                                    <option value="<?php echo $rowedited['stud_session_admission'] ?>" selected="selected"><?php echo $rowedited['stud_session_admission'] ?></option>
                                                    <?php for($i=2018;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Name:</label>
					                            <div class="col-lg-9">
					                                 <input class="form-control" name="stud_name" type="text" value="<?php echo $rowedited['stud_name'] ?> " required> 
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Class No.:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" name="stud_class_no" value="<?php echo $rowedited['stud_roll_no'] ?> " required> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Reg. No.:</label>
					                            <div class="col-lg-4">
					                             <input class="form-control" required name="stud_reg_no" value="<?php echo $rowedited['stud_reg_no'] ?> "> 
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Reg. Year:</label>
					                            <div class="col-lg-3">
					                               <select name="stud_reg_year" class="form-control" required>
                                                    <option value="<?php echo $rowedited['stud_reg_year'] ?>" selected="selected"><?php echo $rowedited['stud_reg_year'] ?></option>
                                                     <?php for($i=2015;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                </select>
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Category:</label>
					                            <div class="col-lg-4">
					                             <select name="stud_category" class="form-control" required>
                                                   <option value="<?php echo $rowedited['stud_category'] ?>" selected="selected"><?php echo $rowedited['stud_category'] ?></option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
					                            </div>
                                                
					                        </div>
                                            
					                    <div class="pad-ver">
					                        <button type="submit" name="btnEditStudent" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-file icon-fw"></i> Save Changes
					                        </button>
					                    </div>

                                     <?php
}
?>
</form>
                     <?php
if(isset($_POST['btnEditStudent'])){
	
$sqldataEdited  = "UPDATE  steps_student_master SET stud_session_admission =?,stud_enroll_no=?,stud_roll_no=?,stud_name =?,stud_reg_no =?,stud_reg_year =?,stud_category =? where stud_id  =?";

$stmt = $conn->prepare($sqldataEdited);
$stmt->bind_param("ssssssss",$_POST['stud_session_admission'],$_POST['stud_enroll_no'],$_POST['stud_class_no'],$_POST['stud_name'],$_POST['stud_reg_no'],$_POST['stud_reg_year'],$_POST['stud_category'],$_POST['id']);
if($stmt->execute()){
	
header("location:../viewEditData/viewEditStudents.php");

}
}
$conn->close();
?>
        
