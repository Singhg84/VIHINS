<?php
require("connect.php");
$tab_query = "SELECT * FROM steps_notice_type ORDER BY id ";
$stmt = $conn->prepare($tab_query);
$stmt->execute();
$tab_result = $stmt->get_result();
$tab_menu = '';
$tab_content = '';
$i = 0;
while($row = $tab_result->fetch_assoc()){
 if($i == 0){
  $tab_menu .= '
   <li class="active"><a href="#'.$row["id"].'" data-toggle="tab"><i class="fa fa-tablet"></i>'.$row["type"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["id"].'" class="tab-pane fade in active">
  ';
 }
 else {
  $tab_menu .= '
   <li><a href="#'.$row["id"].'" data-toggle="tab"><i class="fa fa-indent"></i>'.$row["type"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["id"].'" class="tab-pane fade">
  ';
 }
 $product_query = "SELECT * FROM steps_notification WHERE typeid = '".$row["id"]."'";
 $stmt = $conn->prepare($product_query);
 $stmt->execute();
 $product_result = $stmt->get_result();
 if(!$product_result->num_rows){
	 $tab_content .='<div class="blog-posts single-post"><div class="author-details media-post"><i class="fa fa-tags text-white"></i>&nbsp;&nbsp;<a class = "text-white">No post Display</a></div></div>';
 }
 
 while($sub_row = $product_result->fetch_assoc()){
	  $date2= $sub_row['expdate'];
	  $dt = DateTime::createFromFormat('!d/m/Y', $sub_row['pubdate']);
	  if (($sub_row['typeid']!='1') || ( (strtotime(date("m/d/Y"))<   strtotime($date2)))) {
  $tab_content .= '    
		<div class="blog-posts single-post">             
              <div class="author-details media-post"><i class="fa fa-tags text-white"></i>&nbsp;&nbsp;<a  class = "text-white" href="AllNotificationPDF.php?ref_id= '.$sub_row['refid'].' download= '.$sub_row['refid'].'">&nbsp;&nbsp;&nbsp;'.$sub_row['subject'].'</a>&nbsp;&nbsp;&nbsp;<img src="webMaster/images/new.gif" width="30" height="13"></div></div>';
                              

	  }
 }
 $tab_content .= '<div style="clear:both"></div></div>';
 $i++;
}
?>