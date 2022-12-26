<?php 
ob_start();
require 'Load.php';
?>
<html lang="en">
<link href="webMaster/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require '../adminHeaderClass.php'  ?>
        
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Result Processing</a></li>
					<li class="active">Print Result</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-success">
					                <div class="panel-heading">
					                    <h1 class="panel-title"><strong>PRINT MARKSHEET</strong></h1>
					                </div>
                                    
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                <div class="fixed-sm-200 pull-sm-left">
                                    <div class="pad-btm">
					                        
					                    </div>
					                </div>
					                
					                <div class="fluid">
					                    <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
					                            <div class="btn-group">
					                               
					                            </div>
					                        </div>
					                    </div>
                                        
                                        
					                    <!--Input form-->
					           <form  method="post" action="adminUser/excelExport/printResultCreatePDF.php" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                               
                               <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" /> 
                              
                                      <div class="form-group">
					                            <label class="col-lg-3 col-form-label form-control-label required">Session:</label>
					                            <div class="col-lg-6">
					                                <select name="admission_session" class="form-control" required>
                                               <option value="">Select Semester Session</option>
												 <?php for($i=2021;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                
											</select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-3 col-form-label form-control-label required">Subject:</label>
					                            <div class="col-lg-6">
					                                  <?php $country_result = $conn->query('select * from  steps_subject where status=\'Active\''); ?>
                                                    <select name="sem_sub_id" id="subject"  class="form-control" required>
                                                    <option value="">Select Subject</option>
                                                    <?php if ($country_result->num_rows > 0) {
                                                    while($row = $country_result->fetch_assoc()) {?>
                             <option value="<?php echo $row['sub_id']; ?>"><?php echo $row['sub_name']; ?></option>
                                                    <?php }} ?>
                                                    </select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-3 col-form-label form-control-label required">Semester:</label>
					                            <div class="col-lg-6">
					                                 <?php $country_result = $conn->query('select sub_semester from  steps_subject');?>
                                           <select name="semester_list" id="semester_list"  class="form-control">
												<option value="">Select Semester</option>
												<?php if ($country_result->num_rows > 0) {
												$row = $country_result->fetch_assoc();
												for($i=1;$i<=$row['sub_semester'];$i++) {
												?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php }}?>
												</select>
					                            </div>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-3 col-form-label form-control-label required">Students Name:</label>
					                            <div class="col-lg-6">
					                                 <select name="students_list" id="demo-chosen-select" class="form-control" required>
<option value=''>Select Student Name</option>
</select>
					                            </div>
					                        </div>
                                            
                                            <div class="form-group">
                                    <label class="col-lg-2 col-form-label form-control-label"></label>
                                    <div class="col-lg-6">
                                    <button type="submit" name="btnCreatePDF" class="btn btn-primary" >
					                            <i class="fa fa-floppy-o  icon-fw"></i> Print Marksheet
					                        </button>
                                            
                                  <input type="reset" name="submit" class="btn btn-danger" value="Cancel">
                                         
                                 </div>
                                </div>  
                                                         
					 </form>
                     
        
					                </div>
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
 <?php require '../adminHeader.php' ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<?php require '../adminFooter.php' ?>
        <!--===================================================-->
        <!-- END FOOTER -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
$('#semester_list').on('change', function(){
var id = this.value;
$.ajax({
type: "POST",
url: "adminUser/resultProcessing/getStudentsList.php",
data:'id='+id,
success: function(result){
$("#demo-chosen-select").html(result);
}
});
});
</script>

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
<script src="webMaster/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    
 <script src="webMaster/assets/js/demo/form-component.js"></script>   
    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
