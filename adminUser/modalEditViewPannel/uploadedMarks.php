          <div style='overflow:scroll; width:100%;height:350px;'>
                               <table id="myTable" class="table table-striped rs-table-bordered" style="font-size:10px;">
					                     <thead style="background:#bde9ba;">
					                        <tr>
                                            <th>Roll No.</th>
                                            <th>Enrollment No.</th>
                                            <th>Reg. No.</th>
                                            <th>Reg. Year.</th>
                                            <th>Semester Session.</th>
                                            <th>Student Name</th>
                                            <th>Internal Assesment</th>
                                            <th>External Assesment</th>
                                            <th>Total Marks</th>
                                            <th>Last Updated</th>
                                      </tr>
                                      </thead>
                                     
                                    
                                  <?php
								  require "../../connect.php"; 
$courseUnitID = $_GET['courseUnitID'];
$sqlGetMarks = "SELECT * FROM steps_student_master,steps_first_sem where
steps_student_master.stud_id = steps_first_sem.first_stud_id and
steps_first_sem.first_course_unit_id = '".$courseUnitID."' and steps_student_master.stud_status = 'Active'";
$stmt =  $conn->prepare($sqlGetMarks);
$stmt->execute();
$result = $stmt->get_result();
while($rowData = $result->fetch_assoc()){
?>
<tbody>
                                              <tr>
                                             <td><?php echo $rowData['stud_roll_no'] ; ?></td>
                                             <td><?php echo $rowData['stud_enroll_no'] ; ?></td>
                                             <td><?php echo $rowData['stud_reg_no'] ; ?></td>
                                             <td><?php echo $rowData['stud_reg_year'] ; ?></td>
                                             <td><?php echo $rowData['semester_session'] ; ?></td>
                                             <td><?php echo $rowData['stud_name'] ; ?></td>
                                             <td><?php echo $rowData['first_marks_IA'] ; ?></td>
                                             <td><?php echo $rowData['first_marks_ESE'] ; ?></td>
                                             <td><?php echo $rowData['first_marks_total'] ; ?></td>
                                             <td><?php echo $rowData['first_last_modified'] ; ?></td>
                                            
                                             </tr>
                                             </tbody>
                                        <?php
}
	                                    ?>
                                    
                                </table>  
                                </div>
                
   