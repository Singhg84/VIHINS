<?php 
ob_start();
require 'Load.php';
?>
<html lang="en">
<style type="text/css">

.overlay 
{
    width:100%;
    height: 100%;        
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);    
    transition: 0.5s;
    text-align:center;
    color:White;
   
}

.overlay img
{
    max-width:150px;
    margin-top:50px;
}

	</style> 
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php require '../adminHeaderClass.php'  ?>
        
        

                    <ol class="breadcrumb">
					<li><a><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Marks Entry</a></li>
					<li class="active">View Marks</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">View Uploaded Marks</h3>
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
function showSort(str){
if (str==""){
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)  {
  xmlhttp=new XMLHttpRequest();
  }
else  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function(){  
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	$('#loadingmessage').hide();
    }
  }
$('#loadingmessage').show();
xmlhttp.open("GET","adminUser/modalEditViewPannel/uploadedMarks.php?courseID="+str +"&courseUnitID="+str,true);
xmlhttp.send();            
} 
</script>                                                  
					                    <!--Input form-->
					           <form  method="post" enctype="multipart/form-data" class="form-horizontal">
                                      <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Session:</label>
					                            <div class="col-lg-7">
					                                <select name="semester_session" class="form-control" required>
                                               <option value="">Select Semester Session</option>
												 <?php for($i=2021;$i<=date('Y');$i++){?>
                                             	<option value="<?php echo $i.'-'.($i+1);?>" ><?php echo $i.'-'.($i+1);?></option>
                                                 <?php }?>
                                                
											</select>
					                            </div>
					                        </div>
                                            
                                            
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
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course  Title:</label>
					                            <div class="col-lg-7">
					                                 <select name="course_id" id="course" class="form-control" required>
<option value=''>Select Course Title</option>
</select>
					                            </div>
					                        </div>
                                            
                                            <div class="form-group">
					                            <label class="col-lg-2 control-label text-left">Course Unit  Title:</label>
					                            <div class="col-lg-7">
					                                 <select name="first_course_unit_id" onChange="showSort(this.value)" id="courseunit" class="form-control" required>
<option value=''>Select Course Unit Title</option>
</select>
					                            </div>
					                        </div>
                                      		  
                                                         
					 </form>
                     
        
					                </div>
					            </div>
					        </div>
					    </div>
					
					  <div id="txtHint"></div>  
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
