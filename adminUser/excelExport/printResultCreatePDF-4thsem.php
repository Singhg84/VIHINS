<?php
ob_start();
ini_set('memory_limit', '-1');
session_start();
//include("../../connect.php"); 
function fetch_data($studentId,$admissionsession,$semestersession,$subject,$semesterid){  
include("../../connect.php"); 
 $output = '';  
 /*$sqlPrint = "SELECT * FROM steps_student_master WHERE stud_sub_id = '".$subject."' and 
			stud_previous_semester = '".$semesterid."' and stud_session_admission = '".$admissionsession."' 
			and stud_status = 'Active' and stud_id = ".$studentId;*/
			
$sqlPrint = "SELECT * FROM steps_student_master WHERE stud_sub_id = '".$subject."' and stud_session_admission = '".$admissionsession."' 
			and stud_status = 'Active' and stud_id = ".$studentId;
$stmt = $conn->prepare($sqlPrint);
$stmt->execute();
$resultPrint = $stmt->get_result();
//print_r($resultPrint);
//exit;
if($resultPrint->num_rows > 0){
while($rowPrint = $resultPrint->fetch_assoc()){
	$yr = explode("-",$semestersession);
if($semesterid == 4){
	$semp = '4<sup>th</sup>';
	$rollp = 'PG/VUWPP03/NUD-IVS';
	//$quali = 'Passed in4<sup>th</sup>';
	$certNo = $rowPrint['stud_cid_sem4'];
	$yrf = $yr[1];
	$yr1 = substr($yr[1],2);
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
								<td colspan="9" >The following is the statement of marks and grades obtained by: <b>'.strtoupper($rowPrint['stud_name']).'</b> <br/>Roll:<b>'.$rollp.' NO. '.str_pad($rowPrint['stud_roll_no'], 4, '0', STR_PAD_LEFT).' </b>Registration No.:<b>'.str_pad($rowPrint['stud_reg_no'], 7, '0', STR_PAD_LEFT).'</b> of <b>'.$rowPrint['stud_reg_year'].'</b> in  <b>M.Sc. '.$semp.'</b> SEMESTER EXAMINATION, '.$yrf.'.<BR></td>
							</tr>
							</table>
							<table style="width:100%;" border="1" align="center">
								<tr style="font-size:9px;">
									<th rowspan="2" style="width:7%;" valign="middle"><div style="vertical-align: middle;">
									<p><b>COURSE NO.</b></p></div></th>
									<th rowspan="2" style="width:6%"  valign="middle"><div style="vertical-align: middle;">
									<p><b>Group<br/>/Unit</b></p></div></th>
									<th rowspan="2" style="width:25%" valign="middle"><div style="vertical-align: middle;">
									<p><b>COURSE TITLE</b></p></div></th>
									<th rowspan="2" style="width:6%" valign="middle"><div style="vertical-align: middle;">
									<p><b>FULL<br/>MARKS</b></p></div></th>
									<th colspan="3" style="width:31%" valign="middle"><b>MARKS OBTAINED</b><br/></th>
									<th rowspan="2" style="width:7%" valign="middle"><div style="vertical-align: middle;">
									<p><b>LETTER<br/>GRADE</b></p></div></th>
									<th rowspan="2" style="width:6%" valign="middle"><div style="vertical-align: middle;">
									<p><b>GRADE POINT</b></p></div></th>
									<th rowspan="2" style="width:6%" valign="middle"><div style="vertical-align: middle;">
									<p><b>CREDIT</b></p></div></th>
									<th rowspan="2" style="width:6%" valign="middle"><div style="vertical-align: middle;">
									<p><b>CREDIT<br/>POINTS</b></p></div></th>
								</tr>  
								<tr>
									<th valign="middle"><b>INTERNAL<br/>ASSESSMENT<br/>(05)</b></th>
									<th valign="middle"><b>END<br/>SEMESTER<br/>EXAMINATION<br/>(20/25)</b></th>
									<th valign="middle"><b>TOTAL</b></th>
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
					$output .='<tr style="font-size:10px;">
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><div style="vertical-align: middle;">
									<p>'.$rowPrintcoursedata['course_no'].'</p></div></td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c1'].'<br/><br/><br/>'.$resultPrintcourseunitdata['c2'].'</td>
						<th><strong>THEORY PAPERS</strong></th>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/><br/>'.$resultPrintcourseunitdata['c4'].'</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md1'].'<br/><br/><br/>'.$resultPrintmarksdata['md2'].'</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/><br/>'.$resultPrintmarksdata['md4'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$rowPrintcoursedata['course_credit'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
					</tr>
					<tr style="font-size:10px;">
						<td rowspan="2"><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/></td>
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
					$output .='<tr style="font-size:10px;">
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$rowPrintcoursedata['course_no'].'<br/><br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;">'.($resultPrintcourseunitdata['c1']==0?'':$resultPrintcourseunitdata['c1']).'<br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/><br/>':'<br/>').($resultPrintcourseunitdata['c2']==0?'':$resultPrintcourseunitdata['c2']).'<br/></td>
						<td rowspan="2" style="vertical-align:middle;">'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;">'.$resultPrintcourseunitdata['c3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintcourseunitdata['c4'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;">'.$resultPrintmarksdata['md1'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintmarksdata['md2'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;">'.$resultPrintmarksdata['md3'].'<br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintmarksdata['md4'].'<br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintmarksdatamaster['rm_total_marks'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintmarksdatamaster['rm_letter_grade'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintmarksdatamaster['rm_grade_points'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$rowPrintcoursedata['course_credit'].'<br/><br/></td>
						<td rowspan="2"  style="vertical-align:middle;text-align:center;"><br/><br/>'.(strlen($resultPrintcourseunitdata['c5'])>30?'<br/>':'').$resultPrintmarksdatamaster['rm_credit_points'].'<br/><br/></td>
					</tr>
					<tr>&nbsp;</tr>';
					
				}
				
}
				$output .='<tr style="font-size:10px;">
					<td></td>
					<td></td>
					<th><strong>TOTAL OF THEORY PAPERS</strong></th>
					<th><strong>'.$coursethfull.'</strong></th>
					<td colspan="2"></td>
					<th><strong>'.$coursethtotal.'</strong></th>
					<td></td>
					<td></td>
					<th><strong>'.$coursethcredit.'</strong></th>
					<th><strong>'.$coursethcreditpoint.'</strong></th>
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

					$output .='<tr style="font-size:10px;">
						<td rowspan="3" style="vertical-align : middle;text-align:center;"><div style="vertical-align: middle;">
									<p>'.$rowPrintcoursedata['course_no'].'</p></div></td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c1'].'<br/><br/>'.$resultPrintcourseunitdata['c2'].'</td>
						<th><strong>PRACTICAL PAPERS</strong></th>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/><br/>'.$resultPrintcourseunitdata['c4'].'</td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/><br/><br/><br/></td>
						<td rowspan="3" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md3'].'<br/><br/>'.$resultPrintmarksdata['md4'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$rowPrintcoursedata['course_credit'].'</td>
						<td rowspan="3"  style="vertical-align : middle;text-align:center;"><br/><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
					</tr>
					<tr>
						<td rowspan="2" style="font-size:10px;"><br/>'.$resultPrintcourseunitdata['c5'].'<br/><br/>'.$resultPrintcourseunitdata['c6'].'<br/></td>
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
										course_id= '".$rowPrintcoursedata['course_id']."'  and status = 'Active'";
								
							}
							//echo  $sqlcourseunitData;exit;
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

					$output .='<tr style="font-size:10px;">
						<td rowspan="2" style="vertical-align: middle;text-align:center;"><br/><br/>'.$rowPrintcoursedata['course_no'].'<br/></td>
						<td rowspan="2" style="vertical-align:middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c1'].'<br/></td>
						<td rowspan="2" style="vertical-align: middle;"><br/><br/>'.$resultPrintcourseunitdata['c5'].'<br/></td>
						<td rowspan="2" style="vertical-align: middle;text-align:center;"><br/><br/>'.$resultPrintcourseunitdata['c3'].'<br/></td>
						<td rowspan="2" style="vertical-align: middle;text-align:center;"><br/><br/><br/></td>
						<td rowspan="2" style="vertical-align: middle;text-align:center;"><br/><br/>'.$resultPrintmarksdata['md3'].'<br/></td>
						<td rowspan="2"  style="vertical-align: middle;text-align:center;"><br/><br/>'.$resultPrintmarksdatamaster['rm_total_marks'].'<br/></td>
						<td rowspan="2"  style="vertical-align: middle;text-align:center;"><br/><br/>'.$resultPrintmarksdatamaster['rm_letter_grade'].'<br/></td>
						<td rowspan="2"  style="vertical-align: middle;text-align:center;"><br/><br/>'.$resultPrintmarksdatamaster['rm_grade_points'].'<br/></td>
						<td rowspan="2"  style="vertical-align: middle;text-align:center;"><br/><br/>'.$rowPrintcoursedata['course_credit'].'<br/></td>
						<td rowspan="2"  style="vertical-align: middle;text-align:center;"><br/><br/>'.$resultPrintmarksdatamaster['rm_credit_points'].'<br/></td>
					</tr>
					<tr>&nbsp;</tr>';
				}
}
				$output .='<tr style="font-size:10px;">
					<td></td>
					<td></td>
					<th><strong>TOTAL OF PRACTICAL PAPERS</strong></th>
					<th><strong>'.$courseprfull.'</strong></th>
					<td colspan="2"></td>
					<th><strong>'.$courseprtotal.'</strong></th>
					<td></td>
					<td></td>
					<th><strong>'.$courseprcredit.'</strong></th>
					<th><strong>'.$courseprcreditpoint.'</strong></th>
				</tr>
				<tr style="font-size:10px;">
					<th colspan="3"><strong>TOTAL</strong></th>
					<th><strong>'.($courseprfull + $coursethfull).'</strong></th>
					<td></td>
					<td></td>
					<th><strong>'.($coursethtotal + $courseprtotal).'</strong></th>
					<td></td>
					<td></td>
					<th><strong>'.($coursethcredit + $courseprcredit).'</strong></th>
					<th><strong>'.($coursethcreditpoint + $courseprcreditpoint).'</strong></th>
		        </tr>
			</table>';
		$output .='<table style="width:100%;font-size:10px;" border="1" align="center">
		<tr style="font-size:10px;">
				<th colspan="2" width="26%"><strong>SEMESTER IV</strong></th>
				<td rowspan="2" width="9%"><br/><br/><strong>SEMESTER</strong></td>
				<td rowspan="2" width="8%"><br/><strong>FULL<br>MARKS</strong></td>
				<td rowspan="2" width="8%"><br/><strong>MARKS<br>OBTAINED</strong></td>
				<td rowspan="2" width="8%"><br/><strong>% OF<br>MARKS</strong></td>
				<td rowspan="2" width="8%"><br/><br/><strong>RESULT</strong></td>
				<td rowspan="2" width="8%"><br/><br/><strong>SGPA</strong></td>
				<td rowspan="2" width="25%"><br/><br/><strong>REMARKS</strong></td>
        </tr>
		<tr style="font-size:10px;">
				<td width="17%">TOTAL PERCENTAGE(%)<br/>OF MARKS</td>
				<td width="9%">RESULT</td>
        </tr>'; 
		 $sqlstudentTotalmarks1 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$admissionsession."' and 
								rt_semester =  '1' and
								rt_sub_id = '".$subject."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
								//exit;
					$stmtstudentTotalmarks1 = $conn->prepare($sqlstudentTotalmarks1);
					$stmtstudentTotalmarks1->execute();
					$stmtstudentTotalmarks1 = $stmtstudentTotalmarks1->get_result();
					$stmtstudentTotalmarks1 = $stmtstudentTotalmarks1->fetch_assoc();

					$sqlstudentTotalmarks2 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$admissionsession."' and 
								rt_semester =  '2' and
								rt_sub_id = '".$subject."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks2 = $conn->prepare($sqlstudentTotalmarks2);
					$stmtstudentTotalmarks2->execute();
					$stmtstudentTotalmarks2 = $stmtstudentTotalmarks2->get_result();
					$stmtstudentTotalmarks2 = $stmtstudentTotalmarks2->fetch_assoc();

					$sqlstudentTotalmarks3 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$semestersession."' and 
								rt_semester =  '3' and
								rt_sub_id = '".$subject."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks3 = $conn->prepare($sqlstudentTotalmarks3);
					$stmtstudentTotalmarks3->execute();
					$stmtstudentTotalmarks3 = $stmtstudentTotalmarks3->get_result();
					$stmtstudentTotalmarks3 = $stmtstudentTotalmarks3->fetch_assoc();


					$sqlstudentTotalmarks4 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$semestersession."' and 
								rt_semester =  '4' and
								rt_sub_id = '".$subject."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks4 = $conn->prepare($sqlstudentTotalmarks4);
					$stmtstudentTotalmarks4->execute();
					$stmtstudentTotalmarks4 = $stmtstudentTotalmarks4->get_result();
					$stmtstudentTotalmarks4 = $stmtstudentTotalmarks4->fetch_assoc();
	
					$totmarks = $stmtstudentTotalmarks4['rt_full_marks']+$stmtstudentTotalmarks3['rt_full_marks']+$stmtstudentTotalmarks2['rt_full_marks']+$stmtstudentTotalmarks1['rt_full_marks'];
					$totobtmarks = $stmtstudentTotalmarks4['rt_marks_obtain']+$stmtstudentTotalmarks3['rt_marks_obtain']+$stmtstudentTotalmarks2['rt_marks_obtain']+$stmtstudentTotalmarks1['rt_marks_obtain'];
					$totpercent = ($totobtmarks/$totmarks)*100;
					if($totpercent > 60){ 
						$class = 'I';
						$classl = 'Passed in First Class'; 
					}elseif($totpercent > 30){ 
						$class = 'II'; 
						$classl = 'Passed in Second Class';
					}else{ 
						$class = 'Fail';
						$classl = 'Fail';
					}
						
		$output .='<tr style="font-size:10px;">
				<td rowspan="4"><br/><br/>'.$stmtstudentTotalmarks4['rt_percent'].'</td>
				<td rowspan="4"><br/><br/>'.$stmtstudentTotalmarks4['rt_result'].'</td>
				<td>4<sup>th</sup></td>
				<td>'.$stmtstudentTotalmarks4['rt_full_marks'].'</td>
				<td>'.$stmtstudentTotalmarks4['rt_marks_obtain'].'</td>
				<td>'.$stmtstudentTotalmarks4['rt_percent'].'</td>
				<td>'.$stmtstudentTotalmarks4['rt_result'].'</td>
				<td>'.$stmtstudentTotalmarks4['rt_sgpa'].'</td>
				<td rowspan="4"><br/><br/>'.$classl.'</td>
        </tr>
		<tr style="font-size:10px;">
				<td>3<sup>rd</sup></td>
				<td>'.$stmtstudentTotalmarks3['rt_full_marks'].'</td>
				<td>'.$stmtstudentTotalmarks3['rt_marks_obtain'].'</td>
				<td>'.$stmtstudentTotalmarks3['rt_percent'].'</td>
				<td>'.$stmtstudentTotalmarks3['rt_result'].'</td>
				<td>'.$stmtstudentTotalmarks3['rt_sgpa'].'</td>
        </tr>
		<tr style="font-size:10px;">
				<td>2<sup>nd</sup></td>
				<td>'.$stmtstudentTotalmarks2['rt_full_marks'].'</td>
				<td>'.$stmtstudentTotalmarks2['rt_marks_obtain'].'</td>
				<td>'.$stmtstudentTotalmarks2['rt_percent'].'</td>
				<td>'.$stmtstudentTotalmarks2['rt_result'].'</td>
				<td>'.$stmtstudentTotalmarks2['rt_sgpa'].'</td>
        </tr>
		<tr style="font-size:10px;">
				<td>1<sup>st</sup></td>
				<td>'.$stmtstudentTotalmarks1['rt_full_marks'].'</td>
				<td>'.$stmtstudentTotalmarks1['rt_marks_obtain'].'</td>
				<td>'.$stmtstudentTotalmarks1['rt_percent'].'</td>
				<td>'.$stmtstudentTotalmarks1['rt_result'].'</td>
				<td>'.$stmtstudentTotalmarks1['rt_sgpa'].'</td>
        </tr>';
		
		$output .='<tr style="font-size:10px;">
				<td colspan="3">Final Result - (1<sup>st</sup>-4<sup>th</sup> Semester)</td>
				<td>'.$totmarks.'</td>
				<td>'.$totobtmarks.'</td>
				<td>'.number_format((float)round($totpercent,2),2,'.',',').'</td>
				<td>'.$class.'</td>
				<td>&nbsp;</td>
				<td>CGPA - '.number_format((float)round(($stmtstudentTotalmarks1['rt_sgpa']+$stmtstudentTotalmarks2['rt_sgpa']+$stmtstudentTotalmarks3['rt_sgpa']+$stmtstudentTotalmarks4['rt_sgpa'])/4,2),2,'.',',').'</td>
        </tr>
		';
		$output .='</table>';
		
					    
		$output .='<div class="clearfix">&nbsp;</div>';  
return $output;
/*echo $output;
exit;
*/ }  
 
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