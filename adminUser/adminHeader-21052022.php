<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>VIH&nbsp;|&nbsp;Paschim Medinipur</title>
<base href="http://localhost/VIHINS/">

    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="webMaster/assets/css/bootstrap.min.css" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="webMaster/assets/css/nifty.min.css" rel="stylesheet">


<link href="webMaster/assets/plugins/noUiSlider/nouislider.min.css" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="webMaster/assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">

<link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <!--=================================================-->

    <link href="webMaster/assets/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="webMaster/assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">


    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="webMaster/assets/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="webMaster/assets/plugins/pace/pace.min.js"></script>


    <!--Demo [ DEMONSTRATION ]-->
    <link href="webMaster/assets/css/demo/nifty-demo.min.css" rel="stylesheet">

    <link href="webMaster/assets/plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="webMaster/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
        
</head>

<nav id="mainnav-container">
                <div id="mainnav">
                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
                                            <img class="img-circle img-md" src="webMaster/assets/img/profile-photos/1.png" alt="Profile Picture">
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                            </span>
                                            <p class="mnp-name"><?php if( htmlspecialchars($_SESSION['username'])!='') { ?>  <?php echo "".$rows['user_name'];?><?php } ?></p>
                                            <span class="mnp-desc"><?php if( htmlspecialchars($_SESSION['username'])!='') { ?>  <?php echo "".$rows['user_email'];?><?php } ?></span>
                                        </a>
                                    </div>
                                    
                                </div>


                                <!--Shortcut buttons-->
                                <!--================================-->
                                <div id="mainnav-shortcut" class="hidden">
                                    <ul class="list-unstyled shortcut-wrap">
                                        <li class="col-xs-3" data-content="My Profile">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                                <i class="demo-pli-male"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Messages">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                                <i class="demo-pli-speech-bubble-3"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Activity">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                                <i class="demo-pli-thunder"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Lock Screen">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                                <i class="demo-pli-lock-2"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--================================-->
                                <!--End shortcut buttons-->


                                <ul id="mainnav-menu" class="list-group">
						

						            <!--Category name-->
						
						            <!--Menu list item-->
						            <li class="active-sub">
						                <a href="adminUser/adminDashboard.php">
						                    <i class="demo-pli-home"></i>
						                    <span class="menu-title">Dashboard</span>
						                </a>
						
						                <!--Submenu-->
						                
						            </li>
						
						
						            <li class="list-divider"></li>
						
						            <!--Category name-->
						            <li class="list-header">//</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-psi-bell"></i>
						                    <span class="menu-title">//</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
                                     <li><a href="#">//</a></li>
											
						                </ul>
						            </li>
                                    
						
						
						            <li class="list-divider"></li>
						
						            <!--Category name-->
						            <li class="list-header">Manage Services</li>
						
						            <!--Menu list item-->
                                    
                                    <li>
						                <a href="#">
						                    <i class="demo-psi-File"></i>
						                    <span class="menu-title">Subjects</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="adminUser/addData/addDbSujects.php"> Add Subjects</a></li>
                                            <li><a href="adminUser/viewEditData/viewEditSubjects.php">View &nbsp;/ &nbsp; Edit Subjects</a></li>
											
						                </ul>
						            </li>
                                    
                                    
						            <li>
						                <a href="#">
						                    <i class="demo-psi-computer-secure"></i>
						                    <span class="menu-title">Courses</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="adminUser/addData/addDbCourse.php"> Add Courses</a></li>
                                            <li><a href="adminUser/viewEditData/viewEditCourse.php">View &nbsp;/ &nbsp; Edit Courses</a></li>
											
						                </ul>
						            </li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-psi-Laptop"></i>
						                    <span class="menu-title"> Course Units</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="adminUser/addData/addDbCourseUnit.php"> Add Course Units</a></li>
                                            <li><a href="adminUser/viewEditData/viewEditCourseUnits.php">View &nbsp;/ &nbsp; Edit Course Units</a></li>
											
						                </ul>
						            </li>
                                    
                                    
                                    
                                    
                                    <li>
						                <a href="#">
						                    <i class="demo-psi-male"></i>
						                    <span class="menu-title">Students</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="adminUser/addData/addDbStudents.php"> Add Students</a></li>
                                            <li><a href="adminUser/addData/bulkStudentUpload.php">Bulk Upload</a></li>
                                            <li><a href="adminUser/viewEditData/viewEditStudents.php">View &nbsp;/ &nbsp; Edit Students</a></li>
											
						                </ul>
						            </li>
                                    
                                    
                                    <li>
						                <a href="#">
						                    <i class="fa fa-cloud-upload"></i>
						                    <span class="menu-title">Marks Upload</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="adminUser/marksEntry/exportCSVStudents.php">Export File for Marks Upload</a></li>
                                            <li><a href="adminUser/marksEntry/addDBSemesterMarks.php">Upload Marks</a></li>
                                            <li><a href="adminUser/marksEntry/viewUploadedMarks.php">View Uploaded Marks</a></li>
											
						                </ul>
						            </li>
                                    
                                    
                                    <li>
						                <a href="#">
						                    <i class="fa fa-list-alt"></i>
						                    <span class="menu-title">Result Processing</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                <li><a href="adminUser/resultProcessing/processResult.php">Process Result</a></li>
                                        <li><a href="adminUser/resultProcessing/semesterwisePrintResult.php">Download Result</a></li>
											
						                </ul>
						            </li>
						
                                    
                                    <li class="list-divider"></li>
                                    <li class="list-header">Settings</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                   <i class="demo-psi-gear"></i>
						                    <span class="menu-title">User Control</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
		         <li><a href="./userControl/userchangePassword.php">Change Password</a></li>
                <li><a href="adminUser/userresetPassword.php">Reset / Create Password</a></li>
                <li><a href="adminUser/createNewuser.php">Create New Users</a></li>
                 <li><a href="adminUser/deactivateUser.php">Deactivate Users</a></li>
											
						                </ul>
						            </li>
						            <li>
						               
						            </li>                                </ul>


                                <!--Widget-->
                                <!--================================-->
                                
                                <!--================================-->
                                <!--End widget-->

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>