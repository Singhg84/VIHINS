<?php
require("../../connect.php");

$sem_sub_id = $_POST['sem_sub_id'];
$course_id = $_POST['course_id'];
$first_course_unit_id = $_POST['first_course_unit_id'];
$course_sem = $_POST['course_sem'];




if(isset($_POST['sem_sub_id'])){
$subqry = "SELECT * FROM steps_subject WHERE sub_id = '".$sem_sub_id."'";
$stmt = $conn->prepare($subqry);$stmt->execute();$resultsub = $stmt->get_result();$rowsub = $resultsub->fetch_assoc();
}

if(isset($_POST['course_id'])){
$courseqry = "SELECT * FROM steps_course WHERE course_id = '".$course_id."'";
$stmt = $conn->prepare($courseqry);$stmt->execute();$resultcourse = $stmt->get_result();$rowcourse = $resultcourse->fetch_assoc();
}

if(isset($_POST['first_course_unit_id'])){
$unitqry = "SELECT * FROM steps_course_unit WHERE course_unit_id = '".$first_course_unit_id."'";
$stmt = $conn->prepare($unitqry);$stmt->execute();$resultunit = $stmt->get_result();$rowunit = $resultunit->fetch_assoc();
}
 
 
if(isset($_POST['sem_sub_id']) && isset($_POST['course_sem'])){
$query = "SELECT stud_id,stud_enroll_no,stud_name,stud_roll_no,stud_reg_no,stud_reg_year FROM steps_student_master where
stud_sub_id ='".$sem_sub_id."' AND stud_present_semester = '".$course_sem."'";
}

if (!$result = mysqli_query($conn, $query)) {
    exit(mysqli_error($conn));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename = '.$rowunit['course_unit_title'].'_'.$rowunit['course_unit_id'].'_'.time().'.csv');
$output = fopen('php://output', 'w');

fputcsv($output, array('Subject Name -'.$rowsub['sub_name'].''));
fputcsv($output, array('Course Name -'.$rowcourse['course_title'].''));
fputcsv($output, array('Course Unit Name -'.$rowunit['course_unit_title'].''));

if($rowcourse['course_paper_type']=='Practical'){
fputcsv($output, array('Students ID.','Enrollment No.','Students Name','Roll No.','Reg. No.','Reg. Year','ESE(F.M-'.$rowunit['course_unit_ESE'].')'));
}else{
fputcsv($output, array('Students ID.','Enrollment No.','Students Name','Roll No.','Reg. No.','Reg. Year','IA(F.M-'.$rowunit['course_unit_IA'].')','ESE(F.M-'.$rowunit['course_unit_ESE'].')'));
}
	
if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
?>