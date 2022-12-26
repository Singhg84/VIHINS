<?php
ob_start();
?>
<form  method="post" enctype="multipart/form-data" action="adminUser/modalEditViewPannel/subjectEdited.php" class="form-horizontal">
                                          <?php
require ("../../connect.php");									
$rowid = $_POST['rowid'];
$sqledited = "SELECT * FROM steps_subject WHERE sub_id = '".$rowid."' ";
$stmt = $conn->prepare($sqledited);
$stmt->execute();
$resultedited = $stmt->get_result();
while($rowedited = $resultedited->fetch_assoc()){
?>

<input type="hidden" name="id" value= <?php echo $rowedited['sub_id'];?> />



										<div class="form-group">
					                            <label class="col-lg-3 control-label text-left">Subject Code:</label>
					                            <div class="col-lg-8">
					             <input value= "<?php echo $rowedited['sub_code'];?>" class="form-control" name="sub_code"  required>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-3 control-label text-left">Subject Name:</label>
					                            <div class="col-lg-8">
					             <input class="form-control"  name="sub_name" required  value= "<?php echo $rowedited['sub_name'];?>">
					                            </div>
					                        </div>
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-3 control-label text-left">Semester:</label>
					                            <div class="col-lg-3">
					                                <input class="form-control" name="sub_semester" required value= "<?php echo $rowedited['sub_semester'];?>"> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Full Marks:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" name="sub_full_marks" required value= "<?php echo $rowedited['sub_full_marks'];?>">
					                            </div>
                                                
					                        </div>
                                            
                                            
                                            
                                             <div class="form-group">
					                            <label class="col-lg-3 control-label text-left">Theory Marks:</label>
					                            <div class="col-lg-3">
					                                <input class="form-control" name="sub_theory_marks" required value= "<?php echo $rowedited['sub_theory_marks'];?>"> 
					                            </div>
                                                
                                                 <label class="col-lg-2 control-label text-left">Practical Marks:</label>
					                            <div class="col-lg-3">
					                              <input class="form-control" name="sub_practical_marks" required value= "<?php echo $rowedited['sub_practical_marks'];?>"> 
					                            </div>
                                                
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-3 control-label text-left">Subject Credit:</label>
					                            <div class="col-lg-8">
					             <input class="form-control" name="sub_credit" required value= "<?php echo $rowedited['sub_credit'];?>">
					                            </div>
					                        </div>
                                            
                                            
					                    <div class="pad-ver">
					                        <button type="submit" name="btnEditSubject" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-file icon-fw"></i> Save Changes
					                        </button>
					                    </div>

                                     <?php
}
?>
</form>
                     <?php
if(isset($_POST['btnEditSubject'])){
	
$sqldataEdited  = "UPDATE   steps_subject SET sub_code =?,sub_name =?,sub_semester =?,sub_full_marks =?,sub_theory_marks =?,sub_practical_marks =?,sub_credit =? where sub_id  =?";

$stmt = $conn->prepare($sqldataEdited);
$stmt->bind_param("ssssssss",$_POST['sub_code'], $_POST['sub_name'],$_POST['sub_semester'],$_POST['sub_full_marks'],$_POST['sub_theory_marks'],$_POST['sub_practical_marks'],$_POST['sub_credit'],$_POST['id']);
if($stmt->execute()){
$Message = urlencode("Modified successfully");	
header("location:../viewEditData/viewEditSubjects.php?Message=".$Message);
}
}
$conn->close();
?>
        
