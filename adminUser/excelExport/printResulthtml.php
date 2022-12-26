<?php 
require 'Load.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>VIH</title>
<base href="http://localhost/ssm/">

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
    
        
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">
                    
<div class="pad-all text-center">
</div>  


                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					<div class="panel">
					    <div class="panel-body">
					        <div class="invoice-masthead">
					            <div class="invoice-text">
					                <h3 class="h6 text-uppercase text-thin mar-no text-primary">Mark Sheet</h3>
					            </div>
					            <div class="invoice-brand" style="white-space:nowrap">
					                <div class="invoice-logo">
					                    M.Sc. 1st SEMESTER EXAMINATION 2022
IN
NUTRITION AND DIETETICS
					                </div>
					            </div>
					        </div>
					
                    
                     <?php
if(isset($_POST['btnCreatePDF']) && $_POST['randcheck']==$_SESSION['rand']){
	
$sqlPrint = "SELECT * from steps_first_sem p inner join steps_student_master q on p.first_stud_id = q.stud_id and p.semester_session = '".$_POST['semester_session']."' and p.first_sub_id = '".$_POST['sem_sub_id']."' and p.semester_id =  '".$_POST['semester_list']."'
" ;
 
$stmt = $conn->prepare($sqlPrint);
$stmt->execute();
$resultPrint = $stmt->get_result();
while($rowPrint = $resultPrint->fetch_assoc()){
?>
   
   
   
                    
					        <div class="invoice-bill row">
					            <div class="col-sm-6 text-xs-center">
					                <address>
					                    <strong class="text-bold h4"><?php echo strtoupper($rowPrint['stud_name']); ?></strong><br>
					                    <?php echo $rowPrint['stud_enroll_no']; ?><br>
					                    
					               </address>
					            </div>
					            <div class="col-sm-6 text-xs-center">
					                <table class="invoice-details" style="font-size:10px;">
					                   
					                </table>
					            </div>
					        </div>
					
				
					        <div class="row">
					            <div class="col-lg-12 table-responsive">
					                
                                    <table class="table table-bordered invoice-summary" style="font-size:10px;">
                                          <tr>
            <th rowspan="2">COURSE NO.</th>
            <th rowspan="2">Group/Unit</th>
            <th rowspan="2">COURSE TITLE     </th>
            <th rowspan="2">FULL MARKS</th>
            <th colspan="3">MARKS OBTAINED</th>
            <th rowspan="2">LETTER GRADE</th>
            <th rowspan="2">GRADE POINT</th>
            <th rowspan="2">CREDIT</th>
            <th rowspan="2">CREDIT POINTS</th>

        </tr>  
        <tr>

            <th >INTERNAL ASSESSMENT(05/10)</th>
            <th>END SEMESTER EXAMINATION(20/10/10)</th>
            <th>TOTAL</th>


        </tr> 

        <tr>
            <td rowspan="2"></td>
            
            <td rowspan="2">1<BR>2</td>
            <th>THEORY PAPERS</th>
            <td rowspan="2">25 <BR> 25</td>
            <td rowspan="2">4 <BR> 4</td>
            <td rowspan="2">13 <BR> 14</td>
            <td rowspan="2">35</td>
            <td rowspan="2">A</td>
            <td rowspan="2">8</td>
            <td rowspan="2">4</td>
            <td rowspan="2">32</td>
        </tr>
        <tr>

            <td> </td>

        </tr>



        <tr>
            <td></td>
            <td></td>
            <th>
                TOTAL OF THEORY PAPERS  
            </th>
            <th>200</th>
            <td colspan="2"></td>
            <th>150</th>
            <td></td>
            <td></td>
            <th>16</th>
            <th>132</th>

        </tr>
        <tr>
            <td rowspan="2">NUD 101</td>
            <td rowspan="2">1<BR>2</td>
            <th>PRACTICAL PAPERS</th>
            <td rowspan="2">25 <BR> 25</td>
            <td rowspan="2">4 <BR>4</td>
            <td rowspan="2">13 <BR> 14</td>
            <td rowspan="2">35</td>
            <td rowspan="2">A</td>
            <td rowspan="2">8</td>
            <td rowspan="2">4</td>
            <td rowspan="2">32</td>
        </tr>
        <tr>

            <td>
                EXPERIMENTS ON NUTRITIONAL BIOCHEMISTRY-I<BR>
                EXPERIMENTS ON NUTRITIONAL BIOCHEMISTRY-II

            </td>

        </tr>

        <tr>
            <td>NUD 196</td>
            <td>11<BR>12</td>
            <td>
                EXPERIMENTS ON PHYSIOLOGY<BR> 
                NUTRITIONAL ANTHROPOMETRY

            </td>
            <td>25 <BR> 25</td>
            <td></td>
            <td>12 <BR> 15</td>
            <td>35</td>
            <td>A</td>
            <td>8</td>
            <td>4</td>
            <td>32</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <th>
                TOTAL OF PRACTICAL PAPERS 

            </th>
            <th>100</th>
            <td colspan="2"></td>
            <th>59</th>
            <td></td>
            <td></td>
            <th>8</th>
            <th>52</th>

        </tr>
        <tr>
            <th colspan="3">TOTAL</th>
            <th>300</th>
            <td></td>
            <td></td>
            <th>209</th>
            <td></td>
            <td></td>
            <th>24</th>
            <th>184</th>
        </tr>
        <tr>
            <th colspan="2">SGPA OF 1<SUP>st</SUP> SEMESTER</th>
            <th>TOAL PERCENTAGE(%) OF MARKS</th>
            <th colspan="3">RESULT</th>
            <th colspan="5">REMARKS</th>

        </tr>
        <tr>
            <td colspan="2">7.67</td>
            <td>69.67</td>
            <td colspan="3">SQ</td>
            <td colspan="5">ABABAUUKEUKHDEKUDHEKUDFGHKEDFKQW</td>

        </tr>
</table>

 <?php }} ?>	                                   
                                    
					            </div>
                                
                                
					        </div>
					
					        <div class="clearfix">
					            
					        </div>
					
					        <div class="text-right no-print">
					            <a href="javascript:window.print()" class="btn btn-primary"><i class="demo-pli-printer icon-lg"></i></a>
					        </div>
					
					        <hr class="new-section-sm bord-no">
					
					        
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
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<script src="webMaster/assets/js/jquery.min.js"></script>




<script src="webMaster/assets/plugins/noUiSlider/nouislider.min.js"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
<script src="webMaster/assets/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
<script src="webMaster/assets/js/nifty.min.js"></script>

<script src="webMaster/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>


<script src="webMaster/assets/plugins/chosen/chosen.jquery.min.js"></script>

    <!--=================================================-->
    
    <!--Demo script [ DEMONSTRATION ]-->
    <script src="webMaster/assets/js/demo/nifty-demo.min.js"></script>

        <script src="webMaster/assets/plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="webMaster/assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="webMaster/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


    <!--DataTables Sample [ SAMPLE ]-->
    <script src="webMaster/assets/js/demo/tables-datatables.js"></script>
    
    
    <script src="webMaster/assets/js/demo/form-component.js"></script>
    
    
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        
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
