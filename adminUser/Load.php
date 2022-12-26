<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
require "../connect.php";

$sql = "SELECT * FROM steps_login_master,steps_userdetails
WHERE steps_login_master.username = steps_userdetails.details_id 
and steps_login_master.username = '".$_SESSION["username"]."' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_assoc();
?>
