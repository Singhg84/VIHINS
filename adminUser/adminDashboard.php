<?php 
require 'Load.php';
require 'dashboardData.php';
date_default_timezone_set('Asia/Kolkata');
?>
<html lang="en">
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require 'adminHeaderClass.php'  ?>
        <!--===================================================-->
        <!--END NAVBAR-->

                   <ol class="breadcrumb">
					<li><a href="adminUser/adminDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li>Admin User</li>
					<li class="active">Dashboard</li>
                    </ol>
                    </div>
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="row">
					        <div class="col-lg-7">
					
					            <!--Network Line Chart-->
					            <!--===================================================-->
					            <div id="demo-panel-network" class="panel">
					                <!--chart placeholder-->
					                <div class="pad-all">
                                    <div style='overflow:scroll; width:100%;height:230px;'>
                                     //
                                   </div> 
					                </div>
					            </div>
					            <!--===================================================-->
					            <!--End network line chart-->
					
					        </div>
					        <div class="col-lg-5">
					            <div class="row">
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline Area Chart-->
					                    <div class="panel panel-success panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i>Courses</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?php echo $rowcourse->Core;?></span> Core
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?php echo $rowcourse->Elective;?></span> Elective
					                            </p>
					                            
					                        </div>
					                       <div class="pad-all">
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 45%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">45%</span>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 89%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">89%</span>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline Line Chart-->
					                    <div class="panel panel-info panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i>Course Paper</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?php echo $rowcourse->Theory;?></span> Theory
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?php echo $rowcourse->Practical;?></span> Practical
					                            </p>
					                            
					                        </div>
					                        <div class="pad-all">
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 45%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">45%</span>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 89%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">89%</span>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					            <div class="row">
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline bar chart -->
					                    <div class="panel panel-purple panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-basket-coins icon-fw"></i> Students</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?php echo $rowstu->Male;?></span> Male
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?php echo $rowstu->Female;?></span> Female
					                            </p>
                                               
					                        </div>
					                        <div class="pad-all">
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 45%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">45%</span>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 89%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">89%</span>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline pie chart -->
					                   <div class="panel panel-warning panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-basket-coins icon-fw"></i> Users</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">//</span> Total No.
					                            </p>
					                            
					                        </div>
					                        <div class="pad-all">
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 45%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">45%</span>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 89%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">89%</span>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					
					
					            <!--Extra Small Weather Widget-->
					            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					            
					
					            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					            <!--End Extra Small Weather Widget-->
					
					
					        </div>
					    </div>
					
					    
					
					    
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Communication Details</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
                                    
                                   //
					                    <hr class="new-section-xs">
					                    
					                </div>
					                <!--===================================================-->
					                <!--End Data Table-->
					
					            </div>
					        </div>
					    </div>
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
            <!--ASIDE-->
            <!--===================================================-->
            <!--===================================================-->
            <!--END ASIDE-->

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <?php require 'adminHeader.php' ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        <?php require 'adminFooter.php' ?>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!-- END OF CONTAINER -->

    
    
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
