<?php
ob_start();
ini_set('memory_limit', '-1');
session_start();
//echo "aa";exit;
//include("../../connect.php"); 
function fetch_data($studentId,$admissionsession,$semestersession,$subject,$semesterid){  
include("../../connect.php"); 
require("../../webMaster/vendor/autoload.php");
 $output = '';  
 $sqlPrint = "SELECT * FROM steps_student_master WHERE stud_sub_id = '".$subject."' and 
			stud_previous_semester = '".$semesterid."' and stud_session_admission = '".$admissionsession."' and stud_status = 'Active' and stud_id = ".$studentId;
			

$stmt = $conn->prepare($sqlPrint);
$stmt->execute();
$resultPrint = $stmt->get_result();
//print_r($resultPrint);
//exit;
if($resultPrint->num_rows > 0){
while($rowPrint = $resultPrint->fetch_assoc()){
	$yr = explode("-",$semestersession);
		

if($semesterid == 1){ 
	$semp = '1<sup>st</sup>';
	$rollp = 'PG/VUWPP03/NUD-IS';
	$quali = '2<sup>nd</sup>';
	$certNo = $rowPrint['stud_cid_sem1'];
	$yrf = $yr[0];
	$yr1 = substr($yr[0],2);
}else if($semesterid == 2){
	$semp = '2<sup>nd</sup>';
	$rollp = 'PG/VUWPP03/NUD-IIS';
	$quali = '3<sup>rd</sup>';
	$certNo = $rowPrint['stud_cid_sem2'];
	$yrf = $yr[1];
	$yr1 = substr($yr[1],2);
}else if($semesterid == 3){
	$semp = '3<sup>rd</sup>';
	$rollp = 'PG/VUWPP03/NUD-IIIS';
	$quali = '4<sup>th</sup>';
	$certNo = $rowPrint['stud_cid_sem3'];
	$yrf = $yr[0];
	$yr1 = substr($yr[0],2);
}else{
	$certNo = $rowPrint['stud_cid_sem4'];
	$yrf = $yr[1];
	$yr1 = substr($yr[1],2);
}
      $output .= ' <table style="width:100%;">
	  				<tr style="font-size:10px;">
						<th>NUD'.$semesterid.'/'.$yr1.'/'.str_pad($rowPrint['stud_roll_no'], 4, '0', STR_PAD_LEFT).'</th>
						<td colspan="7">&nbsp;</td>
						<th>154/'.$certNo.'</th>
					</tr>
					<tr style="font-size:14px;" align="center">
						<th colspan="9" style="line-height:150px;"><strong>M.Sc. '.$semp.' SEMESTER EXAMINATION '.$yrf.'</strong></th>
					</tr>
					<tr style="font-size:14px;" align="center">
						<th colspan="9" style="padding-bottom:50px;"><strong>IN <br/> NUTRITION AND DIETETICS</strong></th>
					</tr>
					<tr>
						<td colspan="9">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="9">&nbsp;</td>
					</tr>
							<tr style="font-size:14px;">
								<td colspan="9" >The following is the statement of marks and grades obtained by: <b>'.strtoupper($rowPrint['stud_name']).'</b> <br/>Roll:<b>'.$rollp.' NO. '.str_pad($rowPrint['stud_roll_no'], 4, '0', STR_PAD_LEFT).' </b>Registration No.:<b>'.$rowPrint['stud_reg_no'].'</b> of <b>'.$rowPrint['stud_reg_year'].'</b> in  <b>M.Sc. '.$semp.'</b> SEMESTER EXAMINATION, '.$yrf.'.<BR></td>
							</tr>
							</table>
							<table style="width:100%;font-size:8.5px;" border="1" align="center">
								<tr style="font-size:10px;">
									<th rowspan="2" style="width:7%" valign="middle"><br/><br/><br/>COURSE NO.</th>
									<th rowspan="2" style="width:8%"  valign="middle"><br/><br/><br/>Group/Unit</th>
									<th rowspan="2" style="width:25%" valign="middle"><br/><br/><br/>COURSE TITLE </th>
									<th rowspan="2" style="width:8%" valign="middle"><br/><br/><br/>FULL<br/>MARKS</th>
									<th colspan="3" style="width:27%" valign="middle"><br/><br/>MARKS OBTAINED<br/></th>
									<th rowspan="2" style="width:7%" valign="middle"><br/><br/><br/>LETTER<br/>GRADE</th>
									<th rowspan="2" style="width:6%" valign="middle"><br/><br/><br/>GRADE POINT</th>
									<th rowspan="2" style="width:6%" valign="middle"><br/><br/><br/>CREDIT</th>
									<th rowspan="2" style="width:6%" valign="middle"><br/><br/><br/>CREDIT<br/>POINTS</th>
								</tr>  
								<tr>
									<th valign="middle"><br/><br/>INTERNAL<br/>ASSESSMENT<br/>(05/10)</th>
									<th valign="middle"><br/><br/>END<br/>SEMESTER<br/>EXAMINATION<br/>(20/25/40)</th>
									<th valign="middle"><br/><br/>TOTAL</th>
								</tr>'; 
		   	$sqlcourseData = "SELECT * FROM steps_course WHERE course_sub_id = '".$subject."' and 
						course_sem = '".$semesterid."' and course_paper_type = 'Theory'";
			$stmtcoursedata = $conn->prepare($sqlcourseData);
			$stmtcoursedata->execute();
			$resultPrintcoursedata = $stmtcoursedata->get_result();
			$coursethcount=1;
			$coursethfull = 0;
			$coursethtotal = 0;
			$coursethcredit = 0;
			$coursethcreditpoint = 0;
			while($rowPrintcoursedata = $resultPrintcoursedata->fetch_assoc()){
				if($coursethcount == 1 && $rowPrintcoursedata['course_paper_type'] == 'Theory'){
					$coursethcount++;
					$coursethfull = $coursethfull + $rowPrintcoursedata['total_marks'];
					$coursethcredit = $coursethcredit + $rowPrintcoursedata['course_credit']; 
					
						if($rowPrintcoursedata['course_unit'] == 2){
								$sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, t2.course_unit_marks c3, t1.course_unit_marks c4,
										t2.course_unit_title c5,t1.course_unit_title c6,t2.course_unit_id c7,t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
										t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
										t1.course_id= '".$rowPrintcoursedata['course_id']."' and t1.status = 'Active' and t2.status = 'Active' limit 1";
										
							}else{
								$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, 
								course_unit_id c7 FROM `steps_course_unit` WHERE 
								course_id= '".$rowPrintcoursedata['course_id']."' and status = 'Active'";
								
							}
							$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
							$stmtcourseunitdata->execute();
							$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
							$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
							
							if($rowPrintcoursedata['course_unit'] == 2){
								$sqlmarksData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
								f2.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
								f1.course_id = f2.course_id and 
								f1.first_stud_id = f2.first_stud_id and  
								f1.first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								f2.first_course_unit_id = ".$resultPrintcourseunitdata['c8']." and 
								f1.first_stud_id = ".$rowPrint['stud_id'];
							}else{
								$sqlmarksData = "SELECT first_marks_IA md1, first_marks_ESE md3 FROM `steps_first_sem` WHERE
								first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								first_stud_id = ".$rowPrint['stud_id'];

							}
							
							$stmtmarksdata = $conn->prepare($sqlmarksData);
							$stmtmarksdata->execute();
							$resultPrintmarksdata = $stmtmarksdata->get_result();
							$resultPrintmarksdata = $resultPrintmarksdata->fetch_assoc();
							//echo "aaa<br/>";
							$sqlmarksDatamaster = "SELECT rm_total_marks, rm_letter_grade, rm_grade_points, rm_credit_points 
								FROM steps_result_master WHERE 
								rm_session =  '".$semestersession."' and 
								rm_semester =  '".$semesterid."' and
								rm_course_id = '".$rowPrintcoursedata['course_id']."' and 
								rm_stud_id =  ".$rowPrint['stud_id'];
							$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
							$stmtmarksdatamaster->execute();
							$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
							$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
							
							$coursethtotal = $coursethtotal + $resultPrintmarksdatamaster['rm_total_marks'];
							$coursethcreditpoint = $coursethcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];
					$output .='<tr>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/><br/>'.$rowPrintcoursedata['course_no'].'&nbsp;</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.($resultPrintcourseunitdata['c1']==0?'':$resultPrintcourseunitdata['c1']).'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').($resultPrintcourseunitdata['c2']==0?'':$resultPrintcourseunitdata['c2']).'</td>
						<th><strong>THEORY PAPERS</strong></th>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintcourseunitdata['c4'].'</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdata['md1'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintmarksdata['md2'].'</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintmarksdata['md4'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$rowPrintcoursedata['course_credit'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
					</tr>
					<tr>
						<td rowspan="2"><br/><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/></td>
					</tr>
					<tr>&nbsp;</tr>';
				}elseif($coursethcount > 1 && $rowPrintcoursedata['course_paper_type'] == 'Theory'){
					$coursethcount++;
					$coursethfull = $coursethfull + $rowPrintcoursedata['total_marks'];
					$coursethcredit = $coursethcredit + $rowPrintcoursedata['course_credit']; 

						if($rowPrintcoursedata['course_unit'] == 2){
							
								// echo '<br/>';
								 $sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, 
									t2.course_unit_marks c3, t1.course_unit_marks c4,
									t2.course_unit_title c5, t1.course_unit_title c6, t2.course_unit_id c7, 
									t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
									t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
									t1.course_id= '".$rowPrintcoursedata['course_id']."' and t1.status = 'Active' and t2.status = 'Active' limit 1";
										
							}else{
								// for theory paper after 1st course
								$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, 
								course_unit_id c7 FROM `steps_course_unit` WHERE
										course_id= '".$rowPrintcoursedata['course_id']."' and status = 'Active'";
								
							}
							$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
							$stmtcourseunitdata->execute();
							$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
							$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
							
							if($rowPrintcoursedata['course_unit'] == 2){
								//echo '<br/>';
								$sqlmarksData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
								f2.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
								f1.course_id = f2.course_id and 
								f1.first_stud_id = f2.first_stud_id and  
								f1.first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								f2.first_course_unit_id = ".$resultPrintcourseunitdata['c8']." and 
								f1.first_stud_id = ".$rowPrint['stud_id'];
							}else{
								$sqlmarksData = "SELECT first_marks_IA md1, first_marks_ESE md3 FROM `steps_first_sem` WHERE
								first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								first_stud_id = ".$rowPrint['stud_id'];

							}
							
							$stmtmarksdata = $conn->prepare($sqlmarksData);
							$stmtmarksdata->execute();
							$resultPrintmarksdata = $stmtmarksdata->get_result();
							$resultPrintmarksdata = $resultPrintmarksdata->fetch_assoc();
							
							$sqlmarksDatamaster = "SELECT rm_total_marks, rm_letter_grade, rm_grade_points, rm_credit_points 
								FROM steps_result_master WHERE 
								rm_session =  '".$semestersession."' and 
								rm_semester =  '".$semesterid."' and
								rm_course_id = '".$rowPrintcoursedata['course_id']."' and 
								rm_stud_id =  ".$rowPrint['stud_id'];
							$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
							$stmtmarksdatamaster->execute();
							$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
							$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
							
							$coursethtotal = $coursethtotal + $resultPrintmarksdatamaster['rm_total_marks'];
							$coursethcreditpoint = $coursethcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];
					$output .='<tr>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$rowPrintcoursedata['course_no'].'<br/>&nbsp;</td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.($resultPrintcourseunitdata['c1']==0?'':$resultPrintcourseunitdata['c1']).'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').(isset($resultPrintcourseunitdata['c2']) && $resultPrintcourseunitdata['c2']==0?'':(isset($resultPrintcourseunitdata['c2'])?$resultPrintcourseunitdata['c2']:'')).'<br/></td>';
						if($rowPrintcoursedata['course_unit'] == 2){
						$output .='<td rowspan="2" style="vertical-align:middle;"><br/><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintcourseunitdata['c4'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md1'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintmarksdata['md2'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintmarksdata['md4'].'<br/></td>';

						}else{
						$output .='<td rowspan="2" style="vertical-align:middle;"><br/><br/><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/><br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/><br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdata['md1'].'<br/><br/><br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/><br/></td>';

						}
						$output .='<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$rowPrintcoursedata['course_credit'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'<br/><br/></td>
					</tr>
					<tr>&nbsp;</tr>';
					
				}
				
}
				$output .='<tr>
							<td></td>
							<td></td>
							<th><br/><br/><strong>TOTAL OF THEORY PAPERS</strong><br/></th>
							<th><br/><br/><strong>'.$coursethfull.'</strong><br/></th>
							<td colspan="2"></td>
							<th><br/><br/><strong>'.$coursethtotal.'</strong><br/></th>
							<td></td>
							<td></td>
							<th><br/><br/><strong>'.$coursethcredit.'</strong><br/></th>
							<th><br/><br/><strong>'.$coursethcreditpoint.'</strong><br/></th>
						</tr>';
		
		 $sqlcourseData = "SELECT * FROM steps_course WHERE course_sub_id = '".$subject."' and 
						course_sem = '".$semesterid."' and course_paper_type = 'Practical'";
			$stmtcoursedata = $conn->prepare($sqlcourseData);
			$stmtcoursedata->execute();
			$resultPrintcoursedata = $stmtcoursedata->get_result();
			$courseprcount=1;
			$courseprfull = 0;
			$courseprtotal = 0;
			$courseprcredit = 0;
			$courseprcreditpoint = 0;
			while($rowPrintcoursedata = $resultPrintcoursedata->fetch_assoc()){
				if($courseprcount == 1 && $rowPrintcoursedata['course_paper_type'] == 'Practical'){
					$courseprcount++;
					$courseprfull = $courseprfull + $rowPrintcoursedata['total_marks'];
					$courseprcredit = $courseprcredit + $rowPrintcoursedata['course_credit']; 

						if($rowPrintcoursedata['course_unit'] == 2){
								$sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, t2.course_unit_marks c3, t1.course_unit_marks c4,
										t2.course_unit_title c5,t1.course_unit_title c6,t2.course_unit_id c7,t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
										t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
										t1.course_id= '".$rowPrintcoursedata['course_id']."' limit 1"; 
										
							}else{
								$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, course_unit_id c7 FROM `steps_course_unit` WHERE
										course_id= '".$rowPrintcoursedata['course_id']."'";
								
							}
							$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
							$stmtcourseunitdata->execute();
							$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
							$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
							
							if($rowPrintcoursedata['course_unit'] == 2){
								$sqlmarksData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
								f2.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
								f1.course_id = f2.course_id and 
								f1.first_stud_id = f2.first_stud_id and  
								f1.first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								f2.first_course_unit_id = ".$resultPrintcourseunitdata['c8']." and 
								f1.first_stud_id = ".$rowPrint['stud_id'];
							}else{
								$sqlmarksData = "SELECT first_marks_IA md1, first_marks_ESE md3 FROM `steps_first_sem` WHERE
								first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								first_stud_id = ".$rowPrint['stud_id'];

							}
							
							$stmtmarksdata = $conn->prepare($sqlmarksData);
							$stmtmarksdata->execute();
							$resultPrintmarksdata = $stmtmarksdata->get_result();
							$resultPrintmarksdata = $resultPrintmarksdata->fetch_assoc();
							
							
							$sqlmarksDatamaster = "SELECT rm_total_marks, rm_letter_grade, rm_grade_points, rm_credit_points 
								FROM steps_result_master WHERE 
								rm_session =  '".$semestersession."' and 
								rm_semester =  '".$semesterid."' and
								rm_course_id = '".$rowPrintcoursedata['course_id']."' and 
								rm_stud_id =  ".$rowPrint['stud_id'];
							$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
							$stmtmarksdatamaster->execute();
							$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
							$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
							
							$courseprtotal = $courseprtotal + $resultPrintmarksdatamaster['rm_total_marks'];
							$courseprcreditpoint = $courseprcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];

					$output .='<tr>
						<td rowspan="3" style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$rowPrintcoursedata['course_no'].'&nbsp;</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintcourseunitdata['c1'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintcourseunitdata['c2'].'</td>
						<th><strong>PRACTICAL PAPERS</strong></th>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintcourseunitdata['c4'].'<br/><br/></td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/><br/><br/></td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintmarksdata['md4'].'<br/><br/></td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'<br/><br/></td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'<br/><br/></td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'<br/><br/></td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$rowPrintcoursedata['course_credit'].'<br/><br/></td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'<br/><br/></td>
					</tr>
					<tr>
						<td rowspan="2"><br/><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/></td>
					</tr>
					<tr>&nbsp;</tr>';
				}elseif($courseprcount > 1 && $rowPrintcoursedata['course_paper_type'] == 'Practical'){
					$courseprcount++;
					$courseprfull = $courseprfull + $rowPrintcoursedata['total_marks'];
					$courseprcredit = $courseprcredit + $rowPrintcoursedata['course_credit']; 

						if($rowPrintcoursedata['course_unit'] == 2){
								$sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, 
									t2.course_unit_marks c3, t1.course_unit_marks c4,
									t2.course_unit_title c5, t1.course_unit_title c6, t2.course_unit_id c7, 
									t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
									t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
									t1.course_id= '".$rowPrintcoursedata['course_id']."'  and t1.status = 'Active' and t2.status = 'Active' limit 1";
										
							}else{
								// for theory paper after 1st course
								$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, 
								course_unit_id c7 FROM `steps_course_unit` WHERE
										t1.course_id= '".$rowPrintcoursedata['course_id']."'  and status = 'Active'";
								
							}
							$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
							$stmtcourseunitdata->execute();
							$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
							$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
							
							if($rowPrintcoursedata['course_unit'] == 2){
								$sqlmarksData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
								f2.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
								f1.course_id = f2.course_id and 
								f1.first_stud_id = f2.first_stud_id and  
								f1.first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								f2.first_course_unit_id = ".$resultPrintcourseunitdata['c8']." and 
								f1.first_stud_id = ".$rowPrint['stud_id'];
							}else{
								$sqlmarksData = "SELECT first_marks_IA md1, first_marks_ESE md3 FROM `steps_first_sem` WHERE
								first_course_unit_id = ".$resultPrintcourseunitdata['c7']." and 
								first_stud_id = ".$rowPrint['stud_id'];

							}
							
							$stmtmarksdata = $conn->prepare($sqlmarksData);
							$stmtmarksdata->execute();
							$resultPrintmarksdata = $stmtmarksdata->get_result();
							$resultPrintmarksdata = $resultPrintmarksdata->fetch_assoc();
							
							$sqlmarksDatamaster = "SELECT rm_total_marks, rm_letter_grade, rm_grade_points, rm_credit_points 
								FROM steps_result_master WHERE 
								rm_session =  '".$semestersession."' and 
								rm_semester =  '".$semesterid."' and
								rm_course_id = '".$rowPrintcoursedata['course_id']."' and 
								rm_stud_id =  ".$rowPrint['stud_id'];
							$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
							$stmtmarksdatamaster->execute();
							$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
							$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
							
							$courseprtotal = $courseprtotal + $resultPrintmarksdatamaster['rm_total_marks'];
							$courseprcreditpoint = $courseprcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];

					$output .='<tr>
						<td rowspan="2" style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$rowPrintcoursedata['course_no'].'<br/>&nbsp;</td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c1'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintcourseunitdata['c2'].'<br/></td>
						<td rowspan="2" style="vertical-align : middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/><br/></td>
						<td rowspan="2" style="vertical-align : middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintcourseunitdata['c4'].'<br/><br/></td>
						<td rowspan="2" style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/></td>
						<td rowspan="2" style="vertical-align : middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>34?'<br/>':'').$resultPrintmarksdata['md4'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
						<td rowspan="2"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
						<td rowspan="2"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
						<td rowspan="2"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$rowPrintcoursedata['course_credit'].'</td>
						<td rowspan="2"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
					</tr>
					<tr>&nbsp;</tr>';
				}
}
				$output .='<tr>
					<td></td>
					<td></td>
					<th><br/><br/><strong>TOTAL OF PRACTICAL PAPERS</strong><br/></th>
					<th><br/><br/><strong>'.$courseprfull.'</strong><br/></th>
					<td colspan="2"></td>
					<th><br/><br/><strong>'.$courseprtotal.'</strong><br/></th>
					<td></td>
					<td></td>
					<th><br/><br/><strong>'.$courseprcredit.'</strong><br/></th>
					<th><br/><br/><strong>'.$courseprcreditpoint.'</strong><br/></th>
				</tr>';
				
		$output .='<tr>
				<th colspan="3"><br/><br/><strong>TOTAL</strong><br/></th>
				<th><br/><br/><strong>'.($courseprfull + $coursethfull).'</strong><br/></th>
				<td></td>
				<td></td>
				<th><br/><br/><strong>'.($coursethtotal + $courseprtotal).'</strong><br/></th>
				<td></td>
				<td></td>
				<th><br/><br/><strong>'.($coursethcredit + $courseprcredit).'</strong><br/></th>
				<th><br/><br/><strong>'.($coursethcreditpoint + $courseprcreditpoint).'</strong><br/></th>
        </tr>
        <tr>
            <th colspan="2" style="vertical-align:middle;text-align:center;"><br/><br/><strong>SGPA OF '.$semp.' SEMESTER</strong><br/></th>
            <th style="vertical-align:middle;text-align:center;"><br/><br/><strong>TOAL PERCENTAGE(%) OF MARKS</strong><br/></th>
            <th colspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><strong>RESULT</strong><br/></th>
            <th colspan="5" style="vertical-align:middle;text-align:center;"><br/><br/><strong>REMARKS</strong><br/></th>

        </tr>';
			
		$sqlmarksresulttotal = "SELECT * FROM steps_result_total WHERE 
			rt_session =  '".$semestersession."' and 
			rt_semester =  '".$semesterid."' and
			rt_sub_id = '".$subject."' and 
			rt_stud_id =  ".$rowPrint['stud_id'];
		$stmtmarksresulttotal = $conn->prepare($sqlmarksresulttotal);
		$stmtmarksresulttotal->execute();
		$resultPrintmarksresulttotal = $stmtmarksresulttotal->get_result();
		$resultPrintmarksresulttotal = $resultPrintmarksresulttotal->fetch_assoc();
		//$tpercent = number_format((float)round((($coursethtotal + $courseprtotal)/($courseprfull + $coursethfull))*100,2, PHP_ROUND_HALF_DOWN),2,'.',',');
		if($resultPrintmarksresulttotal['rt_result'] == 'SQ'){
			$remark = 'QUALIFIED FOR '.$quali.' SEMESTER EXAMINATION';
		}elseif($resultPrintmarksresulttotal['rt_result'] == 'SNC'){
			$remark = 'SEMESTER NOT CLEAR. PROVISIONAlLY PROMOTED TO NEXT SEMESTER';
		}else{
			$remark = 'FAILED';
		}
$output .='<tr>
            <td colspan="2" style="vertical-align:middle;text-align:center;"><br/><br/><strong>'.$resultPrintmarksresulttotal['rt_sgpa'].'</strong><br/></td>
            <td style="vertical-align:middle;text-align:center;"><br/><br/><strong>'.$resultPrintmarksresulttotal['rt_percent'].'</strong><br/></td>
            <td colspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><strong>'.$resultPrintmarksresulttotal['rt_result'].'</strong><br/></td>
            <td colspan="5" style="vertical-align:middle;text-align:center;"><br/><br/><strong>'.$remark.'</strong><br/></td>

        </tr>';
		//echo "aaaaaaa";exit;
		$qrdata = 'M/s:154/'.$certNo.', SGPA:'.$resultPrintmarksresulttotal['rt_sgpa'];
		
		$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
		file_put_contents('../../webMaster/vendor/barcode.jpg', $generator->getBarcode($qrdata, $generator::TYPE_CODE_128_B));
		//$generator->useGd();
		//echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
		//exit;
		
    $output .='</table> 
	<div class="clearfix">&nbsp;</div> 
		<div align="left"><img src="../../webMaster/vendor/barcode.jpg" width="350"></div> 		    
		<div class="clearfix">&nbsp;</div>';  
		
		//echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128_B);
		//exit;
return $output;
 }  
 
}else{
	
            echo '<div class="alert alert-info"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>Please check your inputs. No such students exist.</div>';
 
	}
 
}
 if(isset($_GET["btnCreatePDF"]) && $_GET["btnCreatePDF"] == 1)  
 { 
		$admissionsession = $_GET['admission_session'];
		$semestersession = $_GET['semester_session'];
		$subject = $_GET['sem_sub_id'];
		$semesterid = $_GET['semester_list'];
		$studentid = $_GET['studentID'];
		require_once('../../webMaster/assets/TCPDF/tcpdf.php'); 
		$custom_layout = array(215.9, 330.2);
		$pdf = new TCPDF('P', PDF_UNIT, $custom_layout, true, 'UTF-8', false);  
		
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->SetFont('helvetica', '', 8);  
		$pdf->SetMargins(1, 35, 1, true);
		
		$pdf->AddPage(); 
		$content = '';  
		$content .= '';  
		$content .= fetch_data($studentid,$admissionsession,$semestersession,$subject,$semesterid); 
		$pdf->writeHTML($content);  
		ob_end_clean();
		$pdf->Output($studentid.'-Result.pdf', 'D'); 
        
 }  
?>  