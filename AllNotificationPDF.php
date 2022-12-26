<?php
include("connect.php");
$id=$_REQUEST['ref_id'];
$sql="SELECT * from steps_notification where refid = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc())
                        {
$file = "webMaster/sites/Upload/CurrentNotification/".$row['file'];
$filename = "webMaster/sites/Upload/CurrentNotification/".$row['file'];
}

// Let the browser know that a PDF file is coming.
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));

// Send the file to the browser.
readfile($filename);
exit;
$conn->close();
?>