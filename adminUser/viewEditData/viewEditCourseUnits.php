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
					<li><a href="#">Course Unit</a></li>
					<li class="active">View &nbsp;/ &nbsp; Edit Course Unit</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					   
	<?php 
		$delid = isset($_GET['id']) ? $_GET['id'] : '';
		$sqldelete = "UPDATE steps_course_unit SET status = 'Inactive' where  course_unit_id  ='".$delid."'";
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
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Course Units</h4>
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
                                         
					                         <table id="demo-dt-basic" class="table table-striped rs-table-bordered"  style="font-size:12px" cellspacing="0" width="100%">
					             <thead style="background:#bde9ba;">
					                <tr>
                                            <th>Course No.</th>
                                            <th>Unit No.</th>
                                            <th>Unit Title </th>
                                            <th>Unit IA</th>
                                            <th>Unit ESE</th>
                                            <th>Total Marks</th>
                                            <th>Pass Marks</th>
                                            <th>Credit Points</th>
                                            <th>#</th>
                                            <th class="min-tablet">#</th>
					                </tr>
					            </thead>
					            <tbody>
                               <?php
								$sqlunit =  "SELECT  * from steps_course_unit scu,steps_course sc where scu.course_id = sc.course_id and 
								scu.status = 'Active' group by course_unit_id order by sc.course_sem, sc.course_code";
								$stmt = $conn->prepare($sqlunit);
								$stmt->execute();
								$resultunit = $stmt->get_result();
								$counter = 0;
								while( $rowunit = $resultunit->fetch_assoc()){
								?>
                                              <tr>
                                              <td><?php echo $rowunit['course_no']; ?></td>
                                             <td><?php echo $rowunit['course_unit_no'] ; ?></td>
                                             <td><?php echo $rowunit['course_unit_title'];?></td>
                                             <td><?php echo $rowunit['course_unit_IA'];?></td>
                                             <td><?php echo $rowunit['course_unit_ESE'];?></td>
                                             <td><?php echo $rowunit['course_unit_marks'];?></td>
                                             <td><?php echo $rowunit['course_unit_pass_marks'];?></td>
                                             <td><?php echo $rowunit['course_unit_credit'];?></td>
                                             
                                             <td><?php  echo '<a href="#demo-lg-modal"  id="custId" data-toggle="modal" data-id="'.$rowunit['course_unit_id'].'"><button class="btn btn-mint btn-icon btn-circle"><i class="demo-psi-pen-5"></i></button></a>';?></td>
                                             
                                            <td><div align="center"><a href="adminUser/viewEditData/viewEditCourseUnits.php?id=<?php echo $rowunit['course_unit_id']; ?>" onClick="return confirm('Are You sure to Delete !');  "class="" title="Delete"><button id="dz-remove-btn " class="btn btn-danger cancel btn-circle" type="reset">
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
            url: "adminUser/modalEditViewPannel/courseUnitEdited.php", //Here you will fetch records 
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
