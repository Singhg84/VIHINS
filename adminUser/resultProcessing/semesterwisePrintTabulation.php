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
					<li><a href="#">Result Processing</a></li>
					<li class="active">Tabulation Sheet</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-success">
					                <div class="panel-heading">
					                    <h1 class="panel-title"><strong>TABULATION DOWNLOAD</strong></h1>
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
                                  <script>
function showSort(str) {
	//alert("aa");
var adm_sess = document.getElementById("admission_session").value;
var sem_sess = document.getElementById("semester_session").value;
var subj = document.getElementById("subject").value;

    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
		return;
		
    } else { 
		
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
				$('#loadingmessage').hide();
            }
        };
		//alert("adminUser/modalEditViewPannel/semesterWiseStudentsList.php?adm="+adm_sess+"&sem="+sem_sess+"&sub="+subj+"&semesterid="+str)
        xmlhttp.open("GET","adminUser/modalEditViewPannel/semesterWiseStudentsList.php?adm="+adm_sess+"&sem="+sem_sess+"&sub="+subj+"&semesterid="+str,true);
		$('#loadingmessage').show();
        xmlhttp.send();
    }
}
</script>                        
                                        
					                    <!--Input form-->
					           <form action="adminUser/excelExport/PDF_tabular_form.php" method="post"  target="_blank" enctype="multipart/form-data" class="form-horizontal" id="form-tabulation">
                               
                               <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                                      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" /> 
                                      <input type="hidden" value="tabdwnload" name="action" /> 
                              
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Student Admission Session:</label>
					                            <div class="col-lg-7">
					                                <select name="admission_session" class="form-control" required id="admission_session">
                                               <option value="">Student Admission Session</option>
												 <?php for($i=2020;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                
											</select>
					                            </div>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Semester Session:</label>
					                            <div class="col-lg-7">
					                                <select name="semester_session" class="form-control" required id="semester_session">
                                               <option value="">Select Semester Session</option>
												 <?php for($i=2021;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                
											</select>
					                            </div>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 col-form-label form-control-label required">Subject:</label>
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
					                            <label class="col-lg-2 col-form-label form-control-label required">Semester:</label>
					                            <div class="col-lg-7">
					                                 <?php $country_result = $conn->query('select sub_semester from  steps_subject');?>
                                           <select name="semester_list" id="semester_list" class="form-control">
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
                                            
                                           <div class="pad-ver">
					                        <button type="button"  class="btn btn-primary" id="abc">
					                            <i class="demo-psi-Download-From-Cloud icon-fw"></i>Download
					                        </button>
					                    </div>
							 </form>
					                </div>
                                    <div id="txtHint"></div>
					            </div>
					        </div>
					    </div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

 <?php require '../adminHeader.php' ?>
            <!--===================================================-->
        </div>
        <!--===================================================-->
<?php require '../adminFooter.php' ?>
        <!--===================================================-->
        <!-- END FOOTER -->

<script type="text/javascript">
  $(document).ready(function(){
    // Country dependent ajax
    $("#semester_list").on("change",function(){
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
	
	$("#abc").click(function(){
		var sem = $('#semester_list').val();
		//alert(sem);
		if(sem == 4)
			$("#form-tabulation").attr('action', 'adminUser/excelExport/Tabulation_NUD_4.php');
		else if (sem == 2)
			$("#form-tabulation").attr('action', 'adminUser/excelExport/Tabulation_NUD_2.php');
		else
			$("#form-tabulation").attr('action', 'adminUser/excelExport/PDF_tabular_form.php');
		$("#form-tabulation").submit();
 		/*alert("The paragraph was clicked.");*/
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
