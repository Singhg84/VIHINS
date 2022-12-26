<?php 
ob_start();
require_once "connect.php";
session_start();
if(isset($_POST['action']) && $_POST['action'] == 'result-test'){
	$sqlresult = "select rv_marks_obtain,rv_full_marks,rv_percent,rv_result from steps_result_view srv, steps_student_master ssm where 
	srv.rv_stud_id = ssm.stud_id and srv.rv_stud_rollno = '".$_POST['rollno']."'";
	
	//echo $sqlresult = "select * from steps_student_master ssm where ssm.stud_enroll_no = '".$_POST['enroll']."'";
	
	$qryresult = mysqli_query($conn,$sqlresult); 
	$datacount = mysqli_num_rows($qryresult);
	if($datacount > 0){
		$rowdata = mysqli_fetch_assoc($qryresult);
	}else{
		$_SESSION['message'] = 'Cannot find your result. Please contact your college.';
	}
}
?>
<!doctype html>
<html class="no-js" lang="en-US"> <!--<![endif]-->
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="http://vihmid.org.in/xmlrpc.php"/>
		<title>VIDYASAGAR INSTITUTE OF HEALTH</title>
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="VIDYASAGAR INSTITUTE OF HEALTH &raquo; Feed" href="http://vihmid.org.in/feed/" />
<link rel="alternate" type="application/rss+xml" title="VIDYASAGAR INSTITUTE OF HEALTH &raquo; Comments Feed" href="http://vihmid.org.in/comments/feed/" />
	
	
	
<!-- We need this for debugging -->
<!--   -->
<!--   -->
<link rel="icon" href="http://vihmid.org.in/wp-content/uploads/2018/05/ulogo.jpg" sizes="32x32" />
<link rel="icon" href="http://vihmid.org.in/wp-content/uploads/2018/05/ulogo.jpg" sizes="192x192" />

<link rel="apple-touch-icon-precomposed" href="http://vihmid.org.in/wp-content/uploads/2018/05/ulogo.jpg" />
<meta name="msapplication-TileImage" content="http://vihmid.org.in/wp-content/uploads/2018/05/ulogo.jpg" />
		<style type="text/css" id="wp-custom-css">
			111		</style>
		</head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<body class="home page-template-default page page-id-4 default-layout">

<div id="header_section">

	<div id="header" role="banner">
		<div id="logo">
				<a href="http://vihmid.org.in/"><img src="http://vihmid.org.in/wp-content/uploads/2018/05/ulogo.jpg" width="84" height="80" alt="VIDYASAGAR INSTITUTE OF HEALTH"/></a><p style="color:#C3533D;font-size:13.5px;font-weight:bold;margin-left:5px;display:inline-block;">VIDYASAGAR INSTITUTE OF HEALTH</p>
		</div><!-- end of #logo -->
	</div><!-- end of #header -->

</div>

</div>
<div class="contactbar">
	<div class="container" style="font-size:24px; color:white;">View Result</div>
</div>

<div class="welcomeSection" align="center">
	<p align="center" style="padding-left:150px;"><h3>View M.Sc. in Nutrition and Dietetics 4th Semester Examination Result - 2022</h3></p>
	<div class="container">
                <form class="form-inline" action="." method="post">
                <input type="hidden" name="action" value="result-test">
              <div class="form-group">
                <label for="email">Roll Number:<font color="#0B93D5">(For ex:PG/VUWPP03/NUDIVS75)</font></label>
                <input type="text" class="form-control" id="rollno" name="rollno" maxlength="19" placeholder="Roll No." required>
              </div>
            
              <button type="submit" class="btn btn-default">Submit</button>
</form>
    	
		<div class="grid col-540" align="center" style="padding-top:50px;">
           <?php if($datacount > 0){ ?>
			<p style="color:red; font-size:24px;"><?php echo "Marks Obtained: ".$rowdata['rv_marks_obtain'];?> &nbsp;&nbsp;&nbsp;<?php echo "Full Marks: ".$rowdata['rv_full_marks'];?> <br/>
           <?php echo "Percentage: ".$rowdata['rv_percent'];?>&nbsp;&nbsp;&nbsp;<?php echo "Result: ".$rowdata['rv_result'];?>  <br/></p>
            <?php }else{
				echo 	"<p style=\"color:red; font-size:24px;\">".$_SESSION['message']."</p>";
				$_SESSION['message'] = '';
			}?>
		</div>
       
							</div>
</div>


<div class="bottomfooter">
	<div class="container">
		<p>
			<font color="white">Copyright © 2018 Vidyasagar Institute of Health</font>
		</p>
	</div>
</div>

<!-- End of Chaport Live Chat code -->
</body>
</html>