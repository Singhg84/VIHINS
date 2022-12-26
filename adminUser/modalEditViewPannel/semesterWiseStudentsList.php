          <div style='overflow:scroll; width:100%;height:350px;'>
                               <table id="myTable" class="table table-striped rs-table-bordered" style="font-size:10px;">
					                     <thead style="background:#bde9ba;">
					                        <tr>
                                            <th>Roll No.</th>
                                            <th>Enrollment No.</th>
                                            <th>Reg. No.</th>
                                            <th>Reg. Year</th>
                                            <th>Admission Session</th>
                                            <th>Semester Session</th>
                                            <th>Student Name</th>
                                            <th>#</th>
                                            
                                      </tr>
                                      </thead>
                                     
                                    
									<?php
                                    require "../../connect.php"; 
                                    $admissionsession = $_GET['adm'];
                                    $semestersession = $_GET['sem'];
                                    $subject = $_GET['sub'];
                                    $semesterid = $_GET['semesterid'];
                                    $sqllist = "SELECT * FROM steps_student_master,steps_result_master where
                                    steps_student_master.stud_id = steps_result_master.rm_stud_id and
                                    steps_result_master.rm_semester = '".$semesterid."' and 
                                    steps_student_master.stud_session_admission	 = '".$admissionsession."' and 
                                    steps_result_master.rm_session	 = '".$semestersession."' and 
                                    steps_result_master.rm_sub_id	 = '".$subject."' and 
                                    steps_student_master.stud_status = 'Active'  
                                    group by steps_result_master.rm_stud_id";
                                    $stmt =  $conn->prepare($sqllist);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
									if($result->num_rows > 0){
											while($rowData = $result->fetch_assoc()){
									?>
											<tbody>
												<tr>
													 <td><?php echo $rowData['stud_roll_no'] ; ?></td>
													 <td><?php echo $rowData['stud_enroll_no'] ; ?></td>
													 <td><?php echo $rowData['stud_reg_no'] ; ?></td>
													 <td><?php echo $rowData['stud_reg_year'] ; ?></td>
													 <td><?php echo $rowData['stud_session_admission'] ; ?></td>
													 <td><?php echo $rowData['rm_session'] ; ?></td>
													 <td><?php echo $rowData['stud_name'] ; ?></td>
													 <?php if($semesterid == 1){?>
													  <td><?php echo "<button class='btn btn-mint btn-icon btn-circle' name='btnCreatePDF' onclick='window.open(\"adminUser/excelExport/printResultCreatePDF.php?btnCreatePDF=1&sem_sub_id=".$subject."&semester_list=".$semesterid."&admission_session=".$admissionsession."&semester_session=".$semestersession."&studentID=".$rowData['stud_id']."\");'><i class='glyphicon glyphicon-download-alt'></i></button><br>";?></td>
													  <?php }else if($semesterid == 2){?>
													  <td><?php echo "<button class='btn btn-mint btn-icon btn-circle' name='btnCreatePDF' onclick='window.open(\"adminUser/excelExport/printResultCreatePDF2.php?btnCreatePDF=1&sem_sub_id=".$subject."&semester_list=".$semesterid."&admission_session=".$admissionsession."&semester_session=".$semestersession."&studentID=".$rowData['stud_id']."\");'><i class='glyphicon glyphicon-download-alt'></i></button><br>";?></td>
													  <?php }else if($semesterid == 3){?>
													  <td><?php echo "<button class='btn btn-mint btn-icon btn-circle' name='btnCreatePDF' onclick='window.open(\"adminUser/excelExport/printResultCreatePDF3.php?btnCreatePDF=1&sem_sub_id=".$subject."&semester_list=".$semesterid."&admission_session=".$admissionsession."&semester_session=".$semestersession."&studentID=".$rowData['stud_id']."\");'><i class='glyphicon glyphicon-download-alt'></i></button><br>";?></td>
													  <?php }else if($semesterid == 4){ ?>
														<td><?php echo "<button class='btn btn-mint btn-icon btn-circle' name='btnCreatePDF' onclick='window.open(\"adminUser/excelExport/printResultCreatePDF-4thsem.php?btnCreatePDF=1&sem_sub_id=".$subject."&semester_list=".$semesterid."&admission_session=".$admissionsession."&semester_session=".$semestersession."&studentID=".$rowData['stud_id']."\");'><i class='glyphicon glyphicon-download-alt'></i></button><br>";?></td>
													  <?php } ?>
													
													 </tr>
													
										<?php
											}
									}else{
										?>
											<tr>
												 <td colspan="8"><font color="red">Data not present.</font></td>
                                            </tr>
                                   <?php
									}
	                                    ?>
                                     </tbody>
                                </table>  
                                </div>
                
   