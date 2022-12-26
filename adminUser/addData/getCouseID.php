<?php
require 'Load.php';
$id = $_POST['id'];
if($id!=''){
$states_result = $conn->query('select course_id,course_paper_type, course_no, course_title from steps_course where course_sem ='.$id.' AND course_unit!=0 and status= \'Active\'');
$options = "<option value=''>Select Course Title</option>";
while($row = $states_result->fetch_assoc()) {

$options .= '<option value="'.$row['course_id'].'">'.$row['course_no'].':'.$row['course_title'].'</option>';

}
echo $options;
}?>