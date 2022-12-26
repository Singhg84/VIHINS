<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>VIH&nbsp;|&nbsp;Paschim Medinipur</title>
<base href="http://localhost/VIHINS/">

    <!--STYLESHEET-->
    <!--=================================================-->
<link href="webMaster/assets/plugins/unitegallery/css/unitegallery.min.css" rel="stylesheet">
    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="webMaster/assets/css/bootstrap.min.css" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="webMaster/assets/css/nifty.min.css" rel="stylesheet">



    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="webMaster/assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">




    <!--=================================================-->

    <link href="webMaster/assets/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="webMaster/assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">


    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="webMaster/assets/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="webMaster/assets/plugins/pace/pace.min.js"></script>


    <!--Demo [ DEMONSTRATION ]-->
    <link href="webMaster/assets/css/demo/nifty-demo.min.css" rel="stylesheet">

    <link href="webMaster/assets/plugins/chosen/chosen.min.css" rel="stylesheet">
    
        
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
                                                <i class="demo-psi-male"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Messages">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                                <i class="demo-psi-speech-bubble-3"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Activity">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                                <i class="demo-psi-thunder"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Lock Screen">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                                <i class="demo-psi-lock-2"></i>
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
						                <a href="departmentUser/departmentDashboard.php">
						                    <i class="demo-psi-home"></i>
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
						                    <i class="demo-psi-mail"></i>
						                    <span class="menu-title">//</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
				 //
											
						                </ul>
						            </li>
                                    
                                    
                                    <li>
						                <a href="#">
						                    <i class="demo-psi-receipt-4"></i>
						                    <span class="menu-title">//</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
               //
											
						                </ul>
						            </li>
						
						
						            <li class="list-divider"></li>
						
						            <!--Category name-->
						            <li class="list-header">//</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-psi-computer-secure"></i>
						                    <span class="menu-title">//</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                   //
						                </ul>
						            </li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-psi-speech-bubble-5"></i>
						                    <span class="menu-title">//</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                   //
											
						                </ul>
						            </li>
						
						
						            <li class="list-divider"></li>
						
						            <!--Category name-->
						            <li class="list-header">More</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-psi-happy"></i>
						                    <span class="menu-title">//</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    //
											
						                </ul>
						            </li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-psi-medal-2"></i>
						                    <span class="menu-title">
												//
											</span>
                                            <i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                   //
											
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