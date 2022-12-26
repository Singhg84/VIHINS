<?php
require 'Load.php';
$id = $_POST['id'];
if($id!=''){
$sqlstud = $conn->query('select * from steps_student_master where stud_present_semester ='.$id.' AND  stud_status= \'Active\'');
$options = "<option value=''>Select Students Name</option>";
while($rowstud = $sqlstud->fetch_assoc()) {

$options .= '<option value="'.$rowstud['stud_id'].'">'.$rowstud['stud_id'].':'.$rowstud['stud_name'].'</option>';

}
echo $options;
}?>