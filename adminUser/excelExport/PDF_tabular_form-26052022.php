<?php
//include("../../connect.php"); 
//print_r($_POST);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> </title>
        <style>
            table, th, td {
                border: 1px solid black;
                font-size: 10px;
            } 
            table {
                border-collapse: collapse;
                width: 100%;
            }

            td {
                height: 10px;
                vertical-align: bottom;
                text-align: center;

            }
            .text1{
                font-size: 25px;
            }
            .text2{
                font-size: 20px;
            }
            .text_right {
                text-align: right;
                font-size: 10px; 
            }
            .text_left {
                text-align: left;
                font-size: 10px;
            }
        </style>
    </head>
    <body>
<?php 
function fetch_data(){  
	include("../../connect.php"); 
	 $output = '';  
	$yr = explode("-",$_POST['semester_session']);	
	$yr1 = substr($yr[1],2);
	if($_POST['semester_list'] == 1){ 
		$semp = '1<sup>st</sup>';
		$rollp = 'PG/VUWPP03/NUD-IS';
		$quali = '2<sup>nd</sup>';
	}else if($_POST['semester_list'] == 2){
		$semp = '2<sup>nd</sup>';
		$rollp = 'PG/VUWPP03/NUD-IIS';
		$quali = '3<sup>rd</sup>';
	}else{
		$semp = '3<sup>rd</sup>';
		$rollp = 'PG/VUWPP03/NUD-IIIS';
		$quali = '4<sup>th</sup>';
	}
	$output .= '
		<CENTER>
			<div class="text1" align="center"><b>Vidyasagar Institute of Health<BR>
					Rangamati Midnapore-721102</b></div> 
			<div class="text2" align="center"><b>M.SC. '.$semp.' SEMESTER EXAMINATION '.$yr[1].' IN NUTRITION AND DIETETICS</b>
			</div>
			<br>
		</CENTER>
		<table border="1" align="center" style="font-size:8px;">
			<tr>
				<th rowspan="4" style="width:2%"></th>
				<th colspan="5" style="width:22%" valign="middle"><BR>ROLL NO.<BR></th>
				<th colspan="5" style="width:22%" valign="middle"><BR>STUDENT\'S NAME<BR></th>
				<th valign="middle" style="width:10%">REGISTRATION<BR> NO.</th>
				<th valign="middle" style="width:10%">REGISTRATION<BR> YEAR</th>
				<th valign="middle" style="width:10%"><BR>GENDER<BR></th>
				<th colspan="6" valign="middle" style="width:17%"><BR>CATEGORY<BR></th>
				<th rowspan="4" align="center" style="width:4%"><BR><BR>B<BR>A<BR>C<BR>K<BR> <BR> I<BR>N<BR><BR> C<BR>O<BR>U<BR>R<BR>S<BR>E<BR>(S)</th>
				<th rowspan="4" align="center" style="width:3%"><BR><BR><BR><BR><BR><BR>R<BR>E<BR>S<BR>U<BR>L<BR>T<BR></th>
			</tr>
			<tr>
				<th colspan="10">THEORETICAL</th>
				<th colspan="3" rowspan="3"></th>
				<th colspan="6"> TOTAL</th>
			</tr>
			<tr>
				<th rowspan="2"><BR><BR>P<BR>A<BR>P<BR>E<BR>R</th>
				<th rowspan="2"><BR><BR><BR>U<BR>N<BR>I<BR>T</th>
				<th colspan="4">MARKS</th>
				<th rowspan="2"><BR>L<BR>E<BR>T<BR>T<BR>E<BR>R<BR><BR> G<BR>R<BR>A<BR>D<BR>E</th>
				<th rowspan="2"><BR>G<BR>R<BR>A<BR>D<BR>E<BR><BR> P<BR>O<BR>I<BR>N<BR>T</th>
				<th rowspan="2"><BR>C<BR>R<BR>E<BR>D<BR>I<BR>T</th>
				<th rowspan="2"><BR>C<BR>R<BR>E<BR>D<BR>I<BR>T<BR><BR> P<BR>O<BR>I<BR>N<BR>T</th>
				<th rowspan="2"><BR>T<BR>O<BR>T<BR>A<BR>L<BR><BR> M<BR>A<BR>R<BR>K<BR>S</th>
				<th rowspan="2"><BR>M<BR>A<BR>R<BR>K<BR>S<BR><BR> O<BR>B<BR>T<BR>A<BR>I<BR>N<BR>E<BR>D</th>
				<th rowspan="2"><BR><BR>C<BR>R<BR>E<BR>D<BR>I<BR>T</th>
				<th rowspan="2"><BR>C<BR>R<BR>E<BR>D<BR>I<BR>T<BR><BR> P<BR>O<BR>I<BR>N<BR>T</th>
				<th rowspan="2">S<BR>G<BR>P<BR>A</th>
				<th rowspan="2">%<BR>O<BR>F<BR><BR> M<BR>A<BR>R<BR>K<BR>S</th>
			</tr>
			<tr>
				<th ><BR><BR>F<BR>U<BR>L<BR>L<BR><BR> M<BR>A<BR>R<BR>K<BR>S</th>
				<th><BR><BR>I<BR>A<BR>(5<BR>/10)<BR></th>
				<th><BR><BR>W<BR>R<BR>(20<BR>/40)<BR></th>
				<th><BR><BR>T<BR>O<BR>T<BR>A<BR>L</th>
	
			</tr>';
	
	
	$sqlPrint = "SELECT * FROM steps_student_master WHERE stud_sub_id 	= '".$_POST['sem_sub_id']."' and 
				stud_present_semester = '".$_POST['semester_list']."' and stud_session_admission = '".$_POST['admission_session']."' and 
				stud_status = 'Active' limit 0,8";
	$stmt = $conn->prepare($sqlPrint);
	$stmt->execute();
	$resultPrint = $stmt->get_result();
	$studcount = 0;
	if($resultPrint->num_rows > 0){
		while($rowPrint = $resultPrint->fetch_assoc()){
			$studcount++;
			$output .= '<tr>
							<td valign="middle">'.$studcount.'</td>
							<td colspan="5" valign="middle">'.$rollp.' NO. '.$rowPrint['stud_id'].'</td>
							<td colspan="5" valign="middle">'.strtoupper($rowPrint['stud_name']).'</td>
							<td valign="middle">'.$rowPrint['stud_reg_no'].'</td>
							<td valign="middle">'.$rowPrint['stud_reg_year'].'</td>
							<td valign="middle">'.$rowPrint['stud_category'].'</td>
							<td valign="middle">300</td>
							<td valign="middle">209</td>
							<td valign="middle">24</td>
							<td valign="middle">184</td>
							<td valign="middle">7.83</td>
							<td valign="middle">69.67</td>
							<td valign="middle"></td>
							<td valign="middle">SQ</td>
						</tr>';
			//$coursethcount=1;
			$sqlcourseData = "SELECT * FROM steps_course WHERE course_sub_id = '".$_POST['sem_sub_id']."' and 
				course_sem = '".$_POST['semester_list']."' and course_paper_type = 'Theory'";
			$stmtcoursedata = $conn->prepare($sqlcourseData);
			$stmtcoursedata->execute();
			$resultPrintcoursedata = $stmtcoursedata->get_result();
			$coursethfull = 0;
			$coursethtotal = 0;
			$coursethcredit = 0;
			$coursethcreditpoint = 0;
			while($rowPrintcoursedata = $resultPrintcoursedata->fetch_assoc()){
				//if($rowPrintcoursedata['course_paper_type'] == 'Theory'){
						//$coursethcount++;
						$coursethfull = $coursethfull + $rowPrintcoursedata['total_marks'];
						$coursethcredit = $coursethcredit + $rowPrintcoursedata['course_credit']; 
						
							if($rowPrintcoursedata['course_unit'] == 2){
									$sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, t2.course_unit_marks c3, t1.course_unit_marks c4,
											t2.course_unit_title c5,t1.course_unit_title c6,t2.course_unit_id c7,t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
											t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
											t1.course_id= '".$rowPrintcoursedata['course_id']."' and t1.status = 'Active' and t2.status = 'Active' limit 1";
											
								}else{
									$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, course_unit_id c7 FROM `steps_course_unit` WHERE t1.course_id= '".$rowPrintcoursedata['course_id']."' and status = 'Active'";
									
								}
								$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
								$stmtcourseunitdata->execute();
								$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
								$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
								
								if($rowPrintcoursedata['course_unit'] == 2){
									$sqlmarksData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
									f1.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
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
									rm_session =  '".$_POST['semester_session']."' and 
									rm_semester =  '".$_POST['semester_list']."' and
									rm_course_id = '".$rowPrintcoursedata['course_id']."' and 
									rm_stud_id =  ".$rowPrint['stud_id'];
								$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
								$stmtmarksdatamaster->execute();
								$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
								$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
								
								$coursethtotal = $coursethtotal + $resultPrintmarksdatamaster['rm_total_marks'];
								$coursethcreditpoint = $coursethcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];
				$output .= '<tr>
								<td></td>
								<td>'.$rowPrintcoursedata['course_no'].'</td>
								<td>'.$resultPrintcourseunitdata['c1'].'<br/>'.$resultPrintcourseunitdata['c2'].'</td>
								<td>'.$resultPrintcourseunitdata['c3'].'<BR>'.$resultPrintcourseunitdata['c4'].'</td>
								<td>'.$resultPrintmarksdata['md1'].'<BR>'.$resultPrintmarksdata['md2'].'</td>
								<td>'.$resultPrintmarksdata['md3'].'<BR>'.$resultPrintmarksdata['md4'].'</td>
								<td>'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
								<td>'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
								<td>'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
								<td>'.$rowPrintcoursedata['course_credit'].'</td>
								<td>'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
								<td colspan="9"></td>
								<td></td>
								<td></td>
							</tr>';
				//}
		}
		$output .= '<tr>
						<td></td>
						<th colspan="10">PRACTICAL</th>
						<td colspan="21"></td>
					</tr>';
		
				$sqlcourseData1 = "SELECT * FROM steps_course WHERE course_sub_id = '".$_POST['sem_sub_id']."' and 
				course_sem = '".$_POST['semester_list']."' and course_paper_type = 'Practical'";
				$stmtcoursedata1 = $conn->prepare($sqlcourseData1);
				$stmtcoursedata1->execute();
				$resultPrintcoursedata1 = $stmtcoursedata1->get_result();
				$courseprcount=1;
				$courseprfull = 0;
				$courseprtotal = 0;
				$courseprcredit = 0;
				$courseprcreditpoint = 0;
				while($rowPrintcoursedata1 = $resultPrintcoursedata1->fetch_assoc()){
					//if($courseprcount == 1 && $rowPrintcoursedata['course_paper_type'] == 'Practical'){
						$courseprcount++;
						$courseprfull = $courseprfull + $rowPrintcoursedata1['total_marks'];
						$courseprcredit = $courseprcredit + $rowPrintcoursedata1['course_credit']; 
	
							if($rowPrintcoursedata1['course_unit'] == 2){
									$sqlcourseunitData = "SELECT t2.course_unit_no c1, t1.course_unit_no c2, t2.course_unit_marks c3, t1.course_unit_marks c4,
											t2.course_unit_title c5,t1.course_unit_title c6,t2.course_unit_id c7,t1.course_unit_id c8 FROM `steps_course_unit` t1,`steps_course_unit` t2 WHERE		
											t1.course_unit_id != t2.course_unit_id and t1.course_id = t2.course_id and 
											t1.course_id= '".$rowPrintcoursedata1['course_id']."' limit 1";
											
								}else{
									$sqlcourseunitData = "SELECT course_unit_no c1, course_unit_marks c3, course_unit_title c5, course_unit_id c7 FROM `steps_course_unit` WHERE
											course_id= '".$rowPrintcoursedata1['course_id']."'";
									
								}
								$stmtcourseunitdata = $conn->prepare($sqlcourseunitData);
								$stmtcourseunitdata->execute();
								$resultPrintcourseunitdata = $stmtcourseunitdata->get_result();
								$resultPrintcourseunitdata = $resultPrintcourseunitdata->fetch_assoc();
								
								if($rowPrintcoursedata1['course_unit'] == 2){
									$sqlmarksData = "SELECT f1.first_marks_IA md1,f2.first_marks_IA md2, f1.first_marks_ESE md3, 
									f1.first_marks_ESE md4 FROM `steps_first_sem` f1,`steps_first_sem` f2 WHERE 
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
									rm_session =  '".$_POST['semester_session']."' and 
									rm_semester =  '".$_POST['semester_list']."' and
									rm_course_id = '".$rowPrintcoursedata1['course_id']."' and 
									rm_stud_id =  ".$rowPrint['stud_id'];
								$stmtmarksdatamaster = $conn->prepare($sqlmarksDatamaster);
								$stmtmarksdatamaster->execute();
								$resultPrintmarksdatamaster = $stmtmarksdatamaster->get_result();
								$resultPrintmarksdatamaster = $resultPrintmarksdatamaster->fetch_assoc();
								
								$courseprtotal = $courseprtotal + $resultPrintmarksdatamaster['rm_total_marks'];
								$courseprcreditpoint = $courseprcreditpoint + $resultPrintmarksdatamaster['rm_credit_points'];
								$output .= '<tr>
												<td></td>
												<td>'.$rowPrintcoursedata1['course_no'].'</td>
												<td>'.$resultPrintcourseunitdata['c1'].'<br/>'.$resultPrintcourseunitdata['c2'].'</td>
												<td>'.$resultPrintcourseunitdata['c3'].'<br/>'.$resultPrintcourseunitdata['c4'].'</td>
												<td>'.$resultPrintmarksdata['md1'].'<br/>'.$resultPrintmarksdata['md2'].'</td>
												<td>'.$resultPrintmarksdata['md3'].'<br/>'.$resultPrintmarksdata['md4'].'</td>
												<td>'.$resultPrintmarksdatamaster['rm_total_marks'].'</td>
												<td>'.$resultPrintmarksdatamaster['rm_letter_grade'].'</td>
												<td>'.$resultPrintmarksdatamaster['rm_grade_points'].'</td>
												<td>'.$rowPrintcoursedata1['course_credit'].'</td>
												<td>'.$resultPrintmarksdatamaster['rm_credit_points'].'</td>
												<td colspan="11"></td>
											</tr>';
					//}
				}
		}
	}else{
		echo '<div class="alert alert-info"><button class="close" data-dismiss="alert">
				<i class="pci-cross pci-circle"></i></button>Please check your inputs. No such students exist.</div>';
	}
	$output .= '</TABLE>';
	return $output;
	//echo $output;
}


if(isset($_POST["action"]) && $_POST["action"] == 'tabdwnload')  
 { 
		/*$admissionsession = $_POST['admission_session'];
		$semestersession = $_POST['semester_session'];
		$subject = $_POST['sem_sub_id'];
		$semesterid = $_POST['semester_list'];
		$studentid = $_POST['studentID'];*/
		require_once('../../webMaster/assets/TCPDF/tcpdf.php'); 
		$custom_layout = array(330.2, 215.9);
		//$pdf = new TCPDF('P', PDF_UNIT, $custom_layout, true, 'UTF-8', false);  
		
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
		$pdf->SetMargins(1, 3, 1, true);
		
		//$pdf->AddPage(); 
		$pdf->AddPage('L', 'A4');
		//$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');

		$content = '';  
		$content .= '';  
		$content .= fetch_data(); 
		$pdf->writeHTML($content);  
		ob_end_clean();
		$pdf->Output('Tabulation.pdf', 'D'); 
        
 }  
?>
</body>
</html>