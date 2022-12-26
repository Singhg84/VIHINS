<?php 
require 'Load.php';
?>
<html lang="en">
<head>
<style>
 .invalid-feedback{ color:#F00;}
 </style> 
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
<?php 
	require '../dmUser/dmHeaderClass.php';
?>

<?php 
$delid = isset($_GET['id']) ? $_GET['id'] : '';
$sql4 = "SELECT * FROM steps_notice WHERE refid='".$delid."'";
$stmt = $conn->prepare($sql4);
$stmt->execute();
$result4 = $stmt->get_result();
while($row4 = $result4->fetch_assoc()){
	
$rmvFile = "../webMaster/Upload/noticeServices/".$row4['file'];

$sql5= "UPDATE steps_notice SET chkbit = '1' WHERE refid = '".$delid."'";
$stmt = $conn->prepare($sql5);
if($stmt->execute()){
unlink($rmvFile);
$delsuccessMessge = "Deleted successfully";
}
else{
    $delerrorMessege = "Problem";
}
}
?>



<?php
$noticeDetails = $target_file = "";
$noticedetailserr = $targetfileerr =  "";

if(isset($_REQUEST['btnUpload'])){
$noticeDetails= $_REQUEST['details'];
$pubdate= date("d/m/Y");
$target_file = basename($_FILES["filepdf"]["name"]);

if(empty($noticeDetails)){
$noticedetailserr = "Required!";
}
elseif(empty($target_file)){
$targetfileerr = "Required!";
}else{
$sql = "INSERT INTO `steps_notice` (`subject`,`pubdate`,`file`) SELECT '".$noticeDetails."', '".$pubdate."' ,'".$target_file."' FROM DUAL 
WHERE NOT EXISTS (SELECT * FROM `steps_notice`  WHERE `subject`= '".$noticeDetails."' AND `pubdate`= '".$pubdate."' LIMIT 1) ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$insert_id = $conn->insert_id;
if($insert_id!=''){
	if(move_uploaded_file($_FILES["filepdf"]["tmp_name"],
"../webMaster/Upload/noticeServices/" . $_FILES["filepdf"]["name"])){ 
    $successMessge = "File uploaded successfully";
      }
      else{
		$errorMessege = "Problem";
	}
}
		}
}
?>       
                    <ol class="breadcrumb">
					<li><a href="dmUser/dmDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li><a href="#">Notification</a></li>
					<li class="active">Upload Notification</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel">
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                
					                <div class="fixed-sm-200 pull-sm-left fixed-right-border">
                                    <div class="pad-btm bord-btm">
					                        
					                    </div>
					                    
					                </div>
					                <div class="fluid">
					                    <!-- COMPOSE EMAIL -->
					                    <!--===================================================-->
					
					                    <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
                                            <?php
        if(!empty($errorMessege)){
            echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>' . $errorMessege . '</div>';
           
        }
        else if (!empty($successMessge)){
            echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">
        <i class="pci-cross pci-circle"></i></button>' .$successMessge . '</div>';
          
        }

        if(!empty($delerrorMessege)){
            echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">
            <i class="pci-cross pci-circle"></i></button>' . $delerrorMessege . '</div>';
           
        }
        else if (!empty($delsuccessMessge)){
            echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">
        <i class="pci-cross pci-circle"></i></button>' .$delsuccessMessge . '</div>';
          
        }
        ?>

					                        </div>
					                    </div>
                                        
                                        
					                    <!--Input form-->
					                     <form  method="post" onSubmit="return Validate(this);" enctype="multipart/form-data" id="form_submit" class="form-horizontal">
					                        <div class="form-group">
					                            <label class="col-lg-1 control-label text-left" for="inputSubject">Subject:</label>
					                            <div class="col-lg-11">
                                                
                                                <textarea cols="10" id="inputSubject"  name="details" class="form-control" placeholder="Your content here.." style="height:100px"></textarea>
                                                
					                                <i class="demo-pli-male form-control-feedback"></i>
                                                    </div>
                                                    <span class="invalid-feedback pull-right"><?php echo $noticedetailserr; ?></span>
					                            </div>
                                            
                                            <div class="pad-ver">
                                            
                                             <div class="form-group">
					                    <label class="col-md-3 control-label">Attach File:</label>
					                    <div class="col-md-9">
					                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div><input type="file" name="filepdf"   /></div>
                       </div>
					                    </div>
                                         <span class="invalid-feedback pull-right"><?php echo $targetfileerr; ?></span>
					                </div>
                                            
                                        </div>    
                                            
                                           
					                    <div class="pad-ver">
                                        
                                        
					
					                        <!--Send button-->
					                        <button type="submit" name="btnUpload" class="btn btn-primary" id="submit-btn">
					                            <i class="demo-psi-mail-send icon-lg icon-fw"></i> Save Changes
					                        </button>
					
					                        <!--Save draft button-->
					                       
					                    </div>
					 </form>
                     
               
        
        <script>
var _validFileExtensions = [".pdf"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}
</script>  
                                        
                                        <table id="demo-dt-basic" class="table table-striped table-bordered"  style="font-size:12px" cellspacing="0" width="100%">
					            <thead>
					                <tr>  
                                            <th>Sl.No.</th>
                                            <th>Subject of the Notification</th>
                                            <th>Pub.Date</th>
                                            <th class="min-tablet">#</th>
					                </tr>
					            </thead>
					            <tbody>
                                 <?php
$sql1 =  "SELECT * FROM steps_notice WHERE chkbit!='1' order by refid DESC";
$stmt = $conn->prepare($sql1);
$stmt->execute();
$result1 = $stmt->get_result();
$counter = 0;
while( $rows = $result1->fetch_assoc()){
?>
					                <tr>
					                         <td><?php echo $rows['refid'];?></td>
                                             <td><?php echo $rows['subject'];?></td>
                                             <td><?php echo $rows['pubdate'];?></td>
                                             
                                             <td><div align="center"><a href="dmUser/uploadNotification.php?id=<?php echo $rows['refid']; ?>" onClick="return confirm('Are You sure to Delete !');  "class="" title="Delete"><button id="dz-remove-btn" class="btn btn-danger cancel" type="reset">
					                    <i class="demo-psi-trash"></i>
					                </button></a></div></td>
                                             
					                </tr>
					            <?php
}
?>
					            </tbody>
					        </table>
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
<?php 
	require '../dmUser/dmHeader.php';
?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<?php 
	require '../dmUser/dmFooter.php';
?>
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
