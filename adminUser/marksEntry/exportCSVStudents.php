<?php 
ob_start();
require 'Load.php';
?>
<html lang="en">

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require '../adminHeaderClass.php'  ?>
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Marks Upload</a></li>
					<li class="active">Export (.csv) File of Students</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                       <div class="panel panel-bordered panel-info">
					                
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                <div class="fixed-sm-200 pull-sm-left">
                                    <div class="pad-btm">
                                     <a  href="adminUser/marksEntry/addDBSemesterMarks.php" class="btn btn-block btn-success">Upload Marks</a>
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
					           <form  class="form-horizontal" action="adminUser/excelExport/exportStudentsData.php" method="post">
 
                                <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Subject:</label>
					                            <div class="col-lg-7">
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
					                            <label class="col-lg-2 control-label text-left">Semester:</label>
					                            <div class="col-lg-7">
					                                 <?php $country_result = $conn->query('select sub_semester from  steps_subject');?>
                                           <select name="course_sem" id="steps_semester" class="form-control" required>
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
					                            <label class="col-lg-2 control-label text-left">Course:</label>
					                            <div class="col-lg-7">
					                                 <select name="course_id" id="course" class="form-control">
                                                        <option value=''>Select Course Title</option>
                                                        </select>
					                            </div>
					                        </div>
                                            
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Unit:</label>
					                            <div class="col-lg-7">
					                                  <select name="first_course_unit_id" id="courseunit" class="form-control">
                                                        	<option value=''>Select Course Unit Title</option>
                                                        </select>
					                            </div>
					                        </div>
                                            
					
					                    <div class="pad-ver">
					                        <button type="submit"  class="btn btn-primary" id="abc">
					                            <i class="demo-psi-Download-From-Cloud icon-fw"></i>Export(.csv)
					                        </button>
					
					                        <!--Save draft button-->
					                       
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
    
    <script type="text/javascript">
  $(document).ready(function(){
    // Country dependent ajax
    $("#steps_semester").on("change",function(){
      var semid = $(this).val();
      $.ajax({
        url :"adminUser/marksEntry/getCouseList.php",
        type:"POST",
        cache:false,
        data:{semid:semid},
        success:function(data){
          $("#course").html(data);
          $('#courseunit').html('<option value="">Select Course Unit</option>');
        }
      });
    });

    // state dependent ajax
    $("#course").on("change", function(){
      var courseid = $(this).val();
      $.ajax({
        url :"adminUser/marksEntry/getCouseList.php",
        type:"POST",
        cache:false,
        data:{courseid:courseid},
        success:function(data){
          $("#courseunit").html(data);
        }
      });
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
