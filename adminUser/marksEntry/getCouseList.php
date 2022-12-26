<?php
require 'Load.php';
if (isset($_POST['semid']) && !empty($_POST['semid'])) {
 
 // Fetch state name base on country id
 $query = "SELECT * FROM steps_course WHERE course_sem = ".$_POST['semid']." and status = 'Active'";
 $result = $conn->query($query);
 
 if ($result->num_rows > 0) {
 echo '<option value="">Select Course Title</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['course_id'].'">'.$row['course_title'].'</option>';
 }
 } else {
 echo '<option value="">Course not available</option>';
 }
} elseif(isset($_POST['courseid']) && !empty($_POST['courseid'])) {
 
 // Fetch city name base on state id
 $query = "SELECT * FROM steps_course_unit WHERE course_id = ".$_POST['courseid']." and status = 'Active'";
 $result = $conn->query($query);
 
 if ($result->num_rows > 0) {
 echo '<option value="">Select Course Unit Title</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['course_unit_id'].'">'.$row['course_unit_title'].'</option>';
 }
 } else {
 echo '<option value="0">Course Unit not available</option>';
 }
}
?>