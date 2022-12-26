<?php 
require 'Load.php';
date_default_timezone_set('Asia/Kolkata');
?>
<html lang="en">
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require 'departmentHeaderClass.php'  ?>
        <!--===================================================-->
        <!--END NAVBAR-->

                   <ol class="breadcrumb">
					<li><a href="dmUser/dmDashboard.php"><i class="demo-pli-home"></i></a></li>
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
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i>Messeges</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">//</span> Total Sent.
					                            </p>
					                            
					                        </div>
					                        <div class="pad-top text-center">
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-area" class="sparklines-full-content"></div>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline Line Chart-->
					                    <div class="panel panel-info panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i>Feedback</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">//</span> Total No.
					                            </p>
					                            
					                        </div>
					                        <div class="pad-top text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-line" class="sparklines-full-content"></div>
					
					                        </div>
					                    </div>
					                </div>
					            </div>
					            <div class="row">
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline bar chart -->
					                    <div class="panel panel-purple panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-basket-coins icon-fw"></i> Notification</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">//</span> Total No.
					                            </p>
					                           
					                        </div>
					                        <div class="text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-bar" class="box-inline"></div>
					
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
					                        <div class="text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-bar" class="box-inline"></div>
					
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
            <?php require 'departmentHeader.php' ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        <?php require 'departmentFooter.php' ?>
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
