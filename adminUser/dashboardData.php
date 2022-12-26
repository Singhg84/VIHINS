<?php
$sqlstudents ="SELECT SUM(CASE 
             WHEN stud_category IN('M') THEN 1
             ELSE 0
           END) AS Male,
       SUM(CASE 
             WHEN stud_category IN('F') THEN 1
             ELSE 0
           END) AS Female
  FROM  steps_student_master where stud_status!='Inactive'";
$stmt = $conn->prepare($sqlstudents);
$stmt->execute();
$resultstu = $stmt->get_result();
$rowstu = $resultstu->fetch_object();

$sqlcourse ="SELECT SUM(CASE 
             WHEN course_type IN('Core') THEN 1
             ELSE 0
           END) AS Core,
       SUM(CASE 
             WHEN course_type IN('Elective') THEN 1
             ELSE 0
           END) AS Elective,
		   
		   SUM(CASE 
             WHEN course_paper_type IN('Theory') THEN 1
             ELSE 0
           END) AS Theory,
		   SUM(CASE 
             WHEN course_paper_type IN('Practical') THEN 1
             ELSE 0
           END) AS Practical
		   
  FROM  steps_course where status!='Inactive'";
$stmt = $conn->prepare($sqlcourse);
$stmt->execute();
$resultcourse = $stmt->get_result();
$rowcourse = $resultcourse->fetch_object();

?>
