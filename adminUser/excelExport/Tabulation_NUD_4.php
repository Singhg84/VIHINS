<?php
ob_start();
ini_set('memory_limit', '-1');
set_time_limit(500);

include("../../connect.php"); 
 $output = '';  
$yr = explode("-",$_POST['semester_session']);	
//$yr1 = substr($yr[1],2);
if($_POST['semester_list'] == 4){
	$semp = '4<sup>th</sup>';
	$rollp = 'PG/VUWPP03/NUD-IVS';
	$quali = '4<sup>th</sup>';
	$yrf = $yr[1];
	$yr1 = substr($yr[0],2);
}else{
	$yrf = $yr[1];
	$yr1 = substr($yr[1],2);
}
$theoryId  = array();
$practicalId  = array();
$sqlcourseTheory = "SELECT * FROM steps_course WHERE course_sub_id = '".$_POST['sem_sub_id']."' and 
					course_sem = '".$_POST['semester_list']."' and course_paper_type = 'Theory'";
$stmtcourseTheory = $conn->prepare($sqlcourseTheory);
$stmtcourseTheory->execute();
$resultPrintcourseTheory = $stmtcourseTheory->get_result();
/*$coursethfull = 0;
$coursethtotal = 0;
$coursethcredit = 0;
$coursethcreditpoint = 0;*/
$totalcredit = 0;
$totalcreditpoint = 0;

while($rowPrintcourseTheory = $resultPrintcourseTheory->fetch_assoc()){
	array_push($theoryId,$rowPrintcourseTheory);
	$totalcredit = $totalcredit + $rowPrintcourseTheory['course_credit'];
}
$sqlcoursePractical = "SELECT * FROM steps_course WHERE course_sub_id = '".$_POST['sem_sub_id']."' and 
					course_sem = '".$_POST['semester_list']."' and course_paper_type = 'Practical'";
$stmtcoursePractical = $conn->prepare($sqlcoursePractical);
$stmtcoursePractical->execute();
$resultPrintcoursePractical = $stmtcoursePractical->get_result();
/*$coursethfull = 0;
$coursethtotal = 0;
$coursethcredit = 0;
$coursethcreditpoint = 0;*/
while($rowPrintcoursePractical = $resultPrintcoursePractical->fetch_assoc()){
	array_push($practicalId, $rowPrintcoursePractical);
	$totalcredit = $totalcredit + $rowPrintcoursePractical['course_credit'];
}
$maxsubject = max(sizeof($theoryId),sizeof($practicalId));
/*echo '<pre>';
print_r($theoryId);
echo '</pre>';
echo '<pre>';
print_r($practicalId);
echo '</pre>';
exit;*/

$output = '<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NUD 4th Semester :: Tabulation</title>
        <link rel="stylesheet" type="text/css" href="printA4.css"/>
    </head>
    <body>';
		
		$sqlPrint = "SELECT stud_id,stud_roll_no,stud_name,stud_reg_no,stud_reg_year,stud_category,SUM(rm_total_marks) rt,SUM(rm_credit_points) rc FROM 
				steps_student_master ssm, steps_result_master srm WHERE 
				ssm.stud_id = srm.rm_stud_id and 
				ssm.stud_sub_id 	= '".$_POST['sem_sub_id']."' and 
				ssm.stud_previous_semester = '".$_POST['semester_list']."' and 
				ssm.stud_session_admission = '".$_POST['admission_session']."' and 
				ssm.stud_status = 'Active'  group by `rm_stud_id`";
				
	
			$stmt = $conn->prepare($sqlPrint);
			$stmt->execute();
			$resultPrint = $stmt->get_result();
			$studcount = 0;
			if($resultPrint->num_rows > 0){
				while($rowPrint = $resultPrint->fetch_assoc()){
					if(($studcount % 3) == 0){
			$output .= '<div class="printpage" id="page-1">
						<CENTER>
							<div class="text1"><b>Vidyasagar Institute of Health<BR>
									Rangamati Midnapore-721102</b></div> 
							<div class="text2"><b>M.SC. 4<sup>th</sup> SEMESTER EXAMINATION '.$yrf.' IN NUTRITION AND DIETETICS</b>
							</div>
							<br>
						</CENTER>
						<table cellspacing="0">
							<tr>
								<th colspan="4">ROLL NO</th>
								<th colspan="6">STUDENT NAME</th>
								<th colspan="2">REGISTRATION NO</th>
								<th colspan="2">REGISTRATION YEAR</th>
								<th>GENDER</th>
								<th colspan="5">CATEGORY</th>
								<th colspan="4">SEMESTER WISE TOTAL</th>
								<th>SERIAL NO</th>
								<th rowspan="6">GRACE <BR> MARKS<BR>IN<BR>4TH<BR>SEM</th>
							</tr>
						
							<tr>
								<th colspan="8">THEORETICAL</th>
								<th colspan="7">PRACTICAL</th>
								<th colspan="5">TOTAL OF 4TH SEMESTER</th>
								<th>1ST</th>
								<th>2ND</th>
								<th>3RD</th>
								<th>4TH</th>
								<th rowspan="2">GRAND <BR> TOTAL</th>
							</tr>
							
							<tr>
								<th rowspan="4">PAPER<BR>CODE</th>
								<th colspan="3">MARKS</th>
								<th rowspan="4">LETTER<BR>GRADE</th>
								<th rowspan="4">GRADE<BR>POINT</th>
								<th rowspan="4">CREDIT</th>
								<th rowspan="4">CREDIT<BR>POINT</th>
								<th rowspan="4">PAPER<BR>CODE</th>
								<th colspan="2">MARKS</th>
								<th rowspan="4">LETTER<BR>GRADE</th>
								<th rowspan="4">GRADE<BR>POINT</th>
								<th rowspan="4">CREDIT</th>
								<th rowspan="4">CREDIT<BR>POINT</th>
								<th rowspan="3">MARKS</th>
								<th rowspan="3">CREDIT</th>
								<th rowspan="3">CREDIT<BR>POINT</th>
								<th  rowspan="3">SGPA</th>
								<th rowspan="2">RESULT</th>
								<th>SGPA</th>
								<th>SGPA</th>
								<th>SGPA</th>
								<th>SGPA</th>
							</tr>
							<tr>
								<th rowspan="3">IA</th>
								<th rowspan="3">WR</th> 
								<th rowspan="3">TOTAL</th>
								<th rowspan="3">PR</th>
								<th rowspan="3">TOTAL</th>
								<th>RESULT</th>
								<th>RESULT</th>
								<th>RESULT</th>
								<th>RESULT</th>
								<th rowspan="2">CGPA</th>
							</tr>
							 <tr>
								<th>%</th>
								<th>%</th>
								<th>%</th>
								<th>%</th>
								<th>%</th>
							</tr>
							  <tr>
								<th colspan="5">BACK IN COURSE</th>
								<th colspan="3">FINAL RESULT</th>
								<th colspan="2">%</th>
							</tr>';
					}
          $output .= '<tr>
                        <th colspan="26">&nbsp;</th>
                    </tr>
                    <tr>
                        <td colspan="4">'.$rollp.' NO. '.$rowPrint['stud_roll_no'].'</td>
                        <td colspan="6">'.strtoupper($rowPrint['stud_name']).'</td>
                        <td colspan="2">'.$rowPrint['stud_reg_no'].'</td>
                        <td colspan="2">'.$rowPrint['stud_reg_year'].'</td>
                        <td>'.$rowPrint['stud_category'].'</td>
                        <td colspan="5">GEN</td>
                        <td colspan="4"></td>
                        <td>'.str_pad(($studcount+1), 4, '0', STR_PAD_LEFT).'</td>
                        <td>&nbsp;</td>
                    </tr>';
					$sqlstudentTotalmarks1 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$_POST['admission_session']."' and 
								rt_semester =  '1' and
								rt_sub_id = '".$_POST['sem_sub_id']."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks1 = $conn->prepare($sqlstudentTotalmarks1);
					$stmtstudentTotalmarks1->execute();
					$stmtstudentTotalmarks1 = $stmtstudentTotalmarks1->get_result();
					$stmtstudentTotalmarks1 = $stmtstudentTotalmarks1->fetch_assoc();

					$sqlstudentTotalmarks2 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$_POST['admission_session']."' and 
								rt_semester =  '2' and
								rt_sub_id = '".$_POST['sem_sub_id']."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks2 = $conn->prepare($sqlstudentTotalmarks2);
					$stmtstudentTotalmarks2->execute();
					$stmtstudentTotalmarks2 = $stmtstudentTotalmarks2->get_result();
					$stmtstudentTotalmarks2 = $stmtstudentTotalmarks2->fetch_assoc();

					$sqlstudentTotalmarks3 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$_POST['semester_session']."' and 
								rt_semester =  '3' and
								rt_sub_id = '".$_POST['sem_sub_id']."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks3 = $conn->prepare($sqlstudentTotalmarks3);
					$stmtstudentTotalmarks3->execute();
					$stmtstudentTotalmarks3 = $stmtstudentTotalmarks3->get_result();
					$stmtstudentTotalmarks3 = $stmtstudentTotalmarks3->fetch_assoc();


					$sqlstudentTotalmarks4 = "SELECT rt_full_marks, rt_marks_obtain, rt_percent, rt_result, rt_sgpa 
								FROM steps_result_total WHERE 
								rt_session =  '".$_POST['semester_session']."' and 
								rt_semester =  '4' and
								rt_sub_id = '".$_POST['sem_sub_id']."' and 
								rt_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalmarks4 = $conn->prepare($sqlstudentTotalmarks4);
					$stmtstudentTotalmarks4->execute();
					$stmtstudentTotalmarks4 = $stmtstudentTotalmarks4->get_result();
					$stmtstudentTotalmarks4 = $stmtstudentTotalmarks4->fetch_assoc();
	
					$sqlstudentTotalcreditPoint = "SELECT sum(rm_credit_points) as CP FROM steps_result_master WHERE 
							rm_session =  '".$_POST['semester_session']."' and 
							rm_semester =  '".$_POST['semester_list']."' and
							rm_sub_id = '".$_POST['sem_sub_id']."' and 
							rm_stud_id =  ".$rowPrint['stud_id'];
					$stmtstudentTotalcreditPoint = $conn->prepare($sqlstudentTotalcreditPoint);
					$stmtstudentTotalcreditPoint->execute();
					$stmtstudentTotalcreditPoint = $stmtstudentTotalcreditPoint->get_result();
					$stmtstudentTotalcreditPoint = $stmtstudentTotalcreditPoint->fetch_assoc();
						
					for($it=0;$it<$maxsubject;$it++){
						//echo "sssss".$it;
						if(isset($theoryId[$it]) && $theoryId[$it] != ''){
										if($theoryId[$it]['course_unit'] == 2){
											$sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, t2.course_unit_marks c3, t1.course_unit_marks c4,
													t2.course_unit_title c5,t1.course_unit_title c6,t2.course_unit_id c7,t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
													t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
													t1.course_id= '".$theoryId[$it]['course_id']."' and t1.status = 'Active' and t2.status = 'Active' limit 1";
										}else{
											$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, 
											course_unit_id c7 FROM `steps_course_unit` WHERE course_id= '".$theoryId[$it]['course_id']."' 
											and status = 'Active'";
										}
										//echo $sqlcourseunitData;
										$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
										$stmtcourseunitdata->execute();
										$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
										$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
										
										if($theoryId[$it]['course_unit'] == 2){
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
											rm_session 		=  '".$_POST['semester_session']."' and 
											rm_semester 	=  '".$_POST['semester_list']."' and
											rm_course_id 	= '".$theoryId[$it]['course_id']."' and 
											rm_stud_id 		=  ".$rowPrint['stud_id'];
										$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
										$stmtmarksdatamaster->execute();
										$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
										$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
										
										//$coursethtotal = $coursethtotal + $resultPrintmarksdatamaster['rm_total_marks'];
										//$coursethcreditpoint = $coursethcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];
						}
						if(isset($practicalId[$it]) && $practicalId[$it] != ''){
							if($practicalId[$it]['course_unit'] == 2){
								 $sqlcourseunitPracData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, t2.course_unit_marks c3, t1.course_unit_marks c4,
										t2.course_unit_title c5,t1.course_unit_title c6,t2.course_unit_id c7,t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
										t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
										t1.course_id= '".$practicalId[$it]['course_id']."' limit 1";
										
							}else{
								$sqlcourseunitPracData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, 
								course_unit_id c7 FROM `steps_course_unit` WHERE
										course_id= '".$practicalId[$it]['course_id']."'";
							}
							$stmtcourseunitPracdata = $conn->prepare($sqlcourseunitPracData);
							$stmtcourseunitPracdata->execute();
							$resultPrintcourseunitPracdata = $stmtcourseunitPracdata->get_result();
							$resultPrintcourseunitPracdata = $resultPrintcourseunitPracdata->fetch_assoc();
							
							if($practicalId[$it]['course_unit'] == 2){
								$sqlmarksPracData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
								f2.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
								f1.course_id = f2.course_id and 
								f1.first_stud_id = f2.first_stud_id and  
								f1.first_course_unit_id = ".$resultPrintcourseunitPracdata['c7']." and 
								f2.first_course_unit_id = ".$resultPrintcourseunitPracdata['c8']." and 
								f1.first_stud_id = ".$rowPrint['stud_id'];
							}else{
								$sqlmarksPracData = "SELECT first_marks_IA md1, first_marks_ESE md3 FROM `steps_first_sem` WHERE
								first_course_unit_id = ".$resultPrintcourseunitPracdata['c7']." and 
								first_stud_id = ".$rowPrint['stud_id'];
							}
							
							$stmtmarksPracdata = $conn->prepare($sqlmarksPracData);
							$stmtmarksPracdata->execute();
							$resultPrintmarksPracdata = $stmtmarksPracdata->get_result();
							$resultPrintmarksPracdata = $resultPrintmarksPracdata->fetch_assoc();
							
							
							$sqlmarksPracDatamaster = "SELECT rm_total_marks, rm_letter_grade, rm_grade_points, rm_credit_points 
								FROM steps_result_master WHERE 
								rm_session =  '".$_POST['semester_session']."' and 
								rm_semester =  '".$_POST['semester_list']."' and
								rm_course_id = '".$practicalId[$it]['course_id']."' and 
								rm_stud_id =  ".$rowPrint['stud_id'];
							$stmtmarksPracdatamaster = $conn->prepare($sqlmarksPracDatamaster);
							$stmtmarksPracdatamaster->execute();
							$resultPrintmarksPracdatamaster = $stmtmarksPracdatamaster->get_result();
							$resultPrintmarksPracdatamaster = $resultPrintmarksPracdatamaster->fetch_assoc();
							
							//$courseprtotal = $courseprtotal + $resultPrintmarksdatamaster['rm_total_marks'];
							//$courseprcreditpoint = $courseprcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];
		
						}

						if((isset($theoryId[$it]) && $theoryId[$it] != '') && (isset($practicalId[$it]) && $practicalId[$it] != '')){
							if($practicalId[$it]['course_unit'] == 2){

							$output	.=   '<tr>
											<th rowspan="2">'.$theoryId[$it]['course_no'].'</th>
											<td>'.$resultPrintmarksdata['md1'].'</td>
											<td>'.$resultPrintmarksdata['md3'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
											<td rowspan="2">'.$theoryId[$it]['course_credit'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
											<th rowspan="2">'.$practicalId[$it]['course_no'].'</th>
											<td>'.$resultPrintmarksPracdata['md3'].'</td>
											<td rowspan="2">'.$resultPrintmarksPracdatamaster['rm_total_marks'].'</td>
											<td rowspan="2">'.$resultPrintmarksPracdatamaster['rm_letter_grade'].'</td>
											<td rowspan="2">'.$resultPrintmarksPracdatamaster['rm_grade_points'].'</td>
											<td rowspan="2">'.$practicalId[$it]['course_credit'].'</td>
											<td rowspan="2">'.$resultPrintmarksPracdatamaster['rm_credit_points'].'</td>
											<th rowspan="8">'.$stmtstudentTotalmarks4['rt_marks_obtain'].'</th>
											<th rowspan="8">'.$totalcredit.'</th>
											<th rowspan="8">'.$stmtstudentTotalcreditPoint['CP'].'</th>
											<th rowspan="8">'.$stmtstudentTotalmarks4['rt_sgpa'].'</th>
											<th rowspan="4">'.$stmtstudentTotalmarks4['rt_result'].'</th>
											<th rowspan="2">'.$stmtstudentTotalmarks1['rt_marks_obtain'].'</th>
											<th rowspan="2">'.$stmtstudentTotalmarks2['rt_marks_obtain'].'</th>
											<th rowspan="2">'.$stmtstudentTotalmarks3['rt_marks_obtain'].'</th>
											<th rowspan="2">'.$stmtstudentTotalmarks4['rt_marks_obtain'].'</th>
											<td rowspan="4">'.($stmtstudentTotalmarks1['rt_marks_obtain']+$stmtstudentTotalmarks2['rt_marks_obtain']+$stmtstudentTotalmarks3['rt_marks_obtain']+$stmtstudentTotalmarks4['rt_marks_obtain']).'&nbsp;</td>
											<th rowspan="8">&nbsp;</th>
										</tr>
										<tr>
											<td>'.$resultPrintmarksdata['md2'].'</td>
											<td>'.$resultPrintmarksdata['md4'].'</td>
											<td>'.$resultPrintmarksPracdata['md4'].'</td>
										</tr>';
							}
							if($practicalId[$it]['course_unit'] != 2){

							$output	.= 	'<tr>
											<th rowspan="2">'.$theoryId[$it]['course_no'].'</th>
											<td>'.$resultPrintmarksdata['md1'].'</td>
											<td>'.$resultPrintmarksdata['md3'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
											<td rowspan="2">'.$theoryId[$it]['course_credit'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
											<th>'.$practicalId[$it]['course_no'].'</th>
											<td>'.$resultPrintmarksPracdata['md3'].'</td>
											<td>'.$resultPrintmarksPracdatamaster['rm_total_marks'].'</td>
											<td>'.$resultPrintmarksPracdatamaster['rm_letter_grade'].'</td>
											<td>'.$resultPrintmarksPracdatamaster['rm_grade_points'].'</td>
											<td>'.$practicalId[$it]['course_credit'].'</td>
											<td>'.$resultPrintmarksPracdatamaster['rm_credit_points'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks1['rt_sgpa'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks2['rt_sgpa'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks3['rt_sgpa'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks4['rt_sgpa'].'</td>
										</tr>
										<tr>
											<td>'.$resultPrintmarksdata['md2'].'</td>
											<td>'.$resultPrintmarksdata['md4'].'</td>
											<td colspan="7" rowspan="5">&nbsp;</td>
										</tr> ';    
							}
						}elseif((isset($theoryId[$it]) && $theoryId[$it] != '') && empty($practicalId[$it])){
							if($it == 2){
								$output	.= 	'<tr>
											<th rowspan="2">'.$theoryId[$it]['course_no'].'</th>
											<td>'.$resultPrintmarksdata['md1'].'</td>
											<td>'.$resultPrintmarksdata['md3'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
											<td rowspan="2">'.$theoryId[$it]['course_credit'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>';
								$output	.= 	'<th rowspan="4">'.$stmtstudentTotalmarks4['rt_percent'].'</th>';
								$output	.= 	'<td rowspan="2">'.$stmtstudentTotalmarks1['rt_result'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks2['rt_result'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks3['rt_result'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks4['rt_result'].'</td>';
								$output	.= 	'<td rowspan="4">'.number_format((float)round(($stmtstudentTotalmarks1['rt_sgpa']+$stmtstudentTotalmarks2['rt_sgpa']+$stmtstudentTotalmarks3['rt_sgpa']+$stmtstudentTotalmarks4['rt_sgpa'])/4,2),2,'.',',').'</td>';
								$output	.= 	'</tr>
										<tr>
											<td>'.$resultPrintmarksdata['md2'].'</td>
											<td>'.$resultPrintmarksdata['md4'].'</td>
										</tr>';
							}
							if($it == 3){
								$output	.= 	'<tr>
											<th rowspan="2">'.$theoryId[$it]['course_no'].'</th>
											<td>'.$resultPrintmarksdata['md1'].'</td>
											<td>'.$resultPrintmarksdata['md3'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
											<td rowspan="2">'.$theoryId[$it]['course_credit'].'</td>
											<td rowspan="2">'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>';
								$output	.= 	'<td rowspan="2">'.$stmtstudentTotalmarks1['rt_percent'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks2['rt_percent'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks3['rt_percent'].'</td>
											<td rowspan="2">'.$stmtstudentTotalmarks4['rt_percent'].'</td>';
								$output	.= 	'</tr>
										<tr>
											<td>'.$resultPrintmarksdata['md2'].'</td>
											<td>'.$resultPrintmarksdata['md4'].'</td>
										</tr>';

							}
						}
					}
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

						$output	.= 	'	<tr>
											<td colspan="16">&nbsp;</td>
											<td colspan="4">&nbsp;</td>
											<td colspan="3">'.$class.'</td>
											<th colspan="2">'.number_format((float)round($totpercent,2),2,'.',',').'</th>
											<th>&nbsp;</th>
										</tr>';
					$studcount++;
					if(($studcount % 3) == 0 || ($studcount == $resultPrint->num_rows)){
				 		$output	.=    '</table>
									 <div id="rcorners2">
											<p style="position: fixed; bottom: 0; width:100%; text-align: center">
												<table style="width: 100%;" border="0">
													<tr>
														<td style="text-align: center;">...............................</td>
														<td style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td style="text-align: center;">.................................................</td>
													</tr>
													<tr>
														<td style="text-align: center;"><strong>Prepared by</strong></td>
														<td style="text-align: center;">&nbsp;</td>
														<td style="text-align: center;"><strong>Controller of Examinations</strong></td>
													</tr>
												</table>
											</p>
										</div>';
					}
				}
			}


$output	.='</div>
</body>
</html>';
echo $output;
?>