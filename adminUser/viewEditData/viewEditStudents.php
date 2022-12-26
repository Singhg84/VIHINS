<?php 
require 'Load.php';
date_default_timezone_set('Asia/Kolkata');
?>
<html lang="en">
<head>
<style>
#excel-icon {
  background-image:url(../webMaster/sites/images/Excel.png);
  border: none;
  width: 40px;
  height: 40px;
  cursor: pointer;
  color: transparent;
}
</style>
</head>
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require '../adminHeaderClass.php'  ?>

                    <ol class="breadcrumb">
					<li><a href="adminUser/adminDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Students</a></li>
					<li class="active">View &nbsp;/ &nbsp; Edit Students</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					   
					
				<?php 
$delid = isset($_GET['id']) ? $_GET['id'] : '';
$sqldelete = "UPDATE  steps_student_master SET stud_status = 'Inactive' where  stud_id ='".$delid."'";
$stmt = $conn->prepare($sqldelete);
if($stmt->execute()){
	$deleteSuccess = "Deteted";
}else{
	$deleteError = "Problem";
}
?>					    
					
					    
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					               
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
                                    
    
    
    <div id="demo-lg-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Students</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div> 
                </div>
               
               
            </div>
        </div>
    </div>
    
    
                                          <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
					                            <div class="btn-group">
					                            </div>
					                        </div>
					                    </div>
                                        
					                    <!--Input form-->
                                         
					                         <table id="demo-dt-basic" class="table table-striped rs-table-bordered"  style="font-size:11px" cellspacing="0" width="100%">
					             <thead style="background:#bde9ba;">
					                <tr>
                                           <th>Sl.</th>
                                           <th>Present Semister</th>
                                           <th>Enrollment No. </th>
                                           <th>Admission Session </th>
                                           <th>Students Name</th>
                                           <th>Class Roll No. </th>
                                           

<th>Reg. No.</th>
<th>Reg. Year</th>
<th>Category</th>

<th>#</th>
                                            <th class="min-tablet">#</th>
					                </tr>
					            </thead>
					            <tbody>
                               <?php
$sqlstudent =  "SELECT  * from steps_student_master where stud_status = 'Active'";
$stmt = $conn->prepare($sqlstudent);
$stmt->execute();
$resultstudent = $stmt->get_result();
$counter = 0;
while( $rowstudent = $resultstudent->fetch_assoc()){
?>
                                              <tr>
                                              <td><?php echo ++ $counter; ?></td>
                                              <td><?php echo $rowstudent['stud_present_semester'];?><sup>st</td>
                                              <td><?php echo $rowstudent['stud_enroll_no'];?></td>
                                              <td><?php echo $rowstudent['stud_session_admission'];?></td>
                                              <td><?php echo $rowstudent['stud_name'] ; ?></td>
                                              <td><?php echo $rowstudent['stud_roll_no'];?></td>
                                              <td><?php echo $rowstudent['stud_reg_no'];?></td>
                                              <td><?php echo $rowstudent['stud_reg_year'];?></td>
                                              <td><?php echo $rowstudent['stud_category'];?></td>
                                             
                                             
                                             <td><?php  echo '<a href="#demo-lg-modal"  id="custId" data-toggle="modal" data-id="'.$rowstudent['stud_id'].'"><button class="btn btn-mint btn-icon btn-circle"><i class="demo-psi-pen-5"></i></button></a>';?></td>
                                             
                                             <td><div align="center"><a href="adminUser/viewEditData/viewEditStudents.php?id=<?php echo $rowstudent['stud_id']; ?>" onClick="return confirm('Are You sure to Delete !');  "class="" title="Delete"><button id="dz-remove-btn " class="btn btn-danger cancel btn-circle" type="reset">
					                    <i class="demo-psi-trash"></i>
					                </button></a></div></td>
                                             
                                             </tr>
                                        <?php
}
	                                    ?>
					            </tbody>
					        </table>
                            </form>
                     
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
            <?php require '../adminHeader.php' ?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        <?php require '../adminFooter.php' ?>
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


<script>
    $(document).ready(function(){
    $('#demo-lg-modal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url: "adminUser/modalEditViewPannel/studentsDetailsEdited.php", //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
</script>            
    
    
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <?php 
   $conn->close();
   ?>

    
</body>
</html>
