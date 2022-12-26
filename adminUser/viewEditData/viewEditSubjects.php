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
					<li><a href="#">Subjects</a></li>
					<li class="active">View &nbsp;/ &nbsp; Edit Subjects</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					   
				<?php 
$delid = isset($_GET['id']) ? $_GET['id'] : '';
$sqldelete = "UPDATE steps_subject SET status = 'Inactive' where  sub_id ='".$delid."'";
$stmt = $conn->prepare($sqldelete);
if($stmt->execute()){
	$deleteSuccess = "Deteted";
}else{
	$deleteError = "Problem";
}
?>					
					    
					
					    
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel panel-bordered panel-success">
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
                                    
    
    
    <div id="demo-lg-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Subjects</h4>
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
                                                <?php
												if(isset($_GET['Message'])){
            echo '<div class="alert alert-info"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>' . $_GET['Message'] . '</div>';
           
        }?>

					                                
					                            </div>
					                        </div>
					                    </div>
                                        
					                    <!--Input form-->
                                         
					                         <table id="demo-dt-basic" class="table table-striped rs-table-bordered"  style="font-size:12px" cellspacing="0" width="100%">
					             <thead style="background:#bde9ba;">
					                <tr>
                                           <th>Sl.</th>
                                           <th>Subject Code</th>
<th>Subject Name </th>
<th>Semester</th>
<th>Full Marks</th>
<th>Theory Marks</th>
<th>Practical Marks</th>
<th>Credit Point</th>
                                            <th class="min-tablet">#</th>
                                            <th class="min-tablet">#</th>
					                </tr>
					            </thead>
					            <tbody>
                               <?php
$sqlsub =  "SELECT  * from steps_subject where status = 'Active'";
$stmt = $conn->prepare($sqlsub);
$stmt->execute();
$resultsub = $stmt->get_result();
$counter = 0;
while( $rowsub = $resultsub->fetch_assoc()){
?>
                                              <tr>
                                              <td><?php echo ++ $counter; ?></td>
                                             <td><?php echo $rowsub['sub_code'] ; ?></td>
                                             <td><?php echo $rowsub['sub_name'];?></td>
                                             <td><?php echo $rowsub['sub_semester'];?></td>
                                             <td><?php echo $rowsub['sub_full_marks'];?></td>
                                             <td><?php echo $rowsub['sub_theory_marks'];?></td>
                                             <td><?php echo $rowsub['sub_practical_marks'];?></td>
                                             <td><?php echo $rowsub['sub_credit'];?></td>
                                             
                                             <td><?php  echo '<a href="#demo-lg-modal"  id="custId" data-toggle="modal" data-id="'.$rowsub['sub_id'].'"><button class="btn btn-mint btn-icon btn-circle"><i class="demo-psi-pen-5"></i></button></a>';?></td>
                                             
                                             <td><div align="center"><a href="adminUser/viewEditData/viewEditSubjects.php?id=<?php echo $rowsub['sub_id']; ?>" onClick="return confirm('Are You sure to Delete !');  "class="" title="Delete"><button id="dz-remove-btn " class="btn btn-danger cancel btn-circle" type="reset">
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
            url: "adminUser/modalEditViewPannel/subjectEdited.php", //Here you will fetch records 
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
