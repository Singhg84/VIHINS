<?php 
ob_start();
date_default_timezone_set('Asia/Kolkata');
require 'Load.php';
?>
<html lang="en">
<head>
<style type="text/css">

@keyframes click-wave {
  0% {
    height: 40px;
    width: 40px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 200px;
    width: 200px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}

.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 13.33333px;
  right: 0;
  bottom: 0;
  left: 0;
  height: 40px;
  width: 40px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #40e0d0;
}
.option-input:checked::before {
  height: 40px;
  width: 40px;
  position: absolute;
  content: '✔';
  display: inline-block;
  font-size: 26.66667px;
  text-align: center;
  line-height: 40px;
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #40e0d0;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
}
.option-input.radio {
  border-radius: 50%;
}
.option-input.radio::after {
  border-radius: 50%;
}

#divfordownload{
  background-color: #f8f8f9;
  border: 1px solid #3c8dbc;
  width: 93%;
  margin: 1% 0 0 3%;
  padding: 30px;
}





.strength1{
  padding: 2px;
  width:80px;
  background:#ff0000;
  color:#FFFFFF;
}

.strength2{
  padding: 2px;
  width:200px;  
  background:#ff5f5f;
  color:#FFFFFF;
}

.strength3{
  padding: 2px;
  width:350px;
  background:#56e500;
  color:#FFFFFF;
}

.strength4{
  padding: 2px;
  background:#4dcd00;
  width:460px;
  color:#FFFFFF;
}

.strength5{
  padding: 2px;
  background:#399800;
  width:550px;
  color:#FFFFFF;
}



</style>
<script>
var check = function() {
  if (document.getElementById('newpassword').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Passwords matching.';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'The new Password  do not match.';
  }
}
</script>
<script type="text/javascript">

  function checkForm(form)
  {
    if(form.newpassword.value != "" && form.newpassword.value == form.confirm_password.value) {
      if(form.newpassword.value.length < 8) {
        alert("Error: Password must contain at least eight characters!");
        form.newpassword.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.newpassword.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.newpassword.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.newpassword.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.newpassword.focus();
        return false;
      }
	  re = /(?=.*[!#$%&?@ "])/;
      if(!re.test(form.newpassword.value)) {
        alert("Error: password must contain at least one special charecter!");
        form.newpassword.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.newpassword.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.newpassword.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.newpassword.focus();
      return false;
    }

    alert("You entered a valid password: " + form.newpassword.value);
    return true;
  }

</script>
</head>



<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <?php 
if($rows['usertype']=='1'){
	require '../adminUser/adminHeaderClass.php';
}
if($rows['usertype']=='2'){
	require '../departmentUser/departmentHeaderClass.php';
}
?>

<?php
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE steps_login_master SET password = ? WHERE id = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
				$successMessage = urlencode("Password change");
                header("Location:../userLogin.php?Message=".$successMessage);
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
}
?>       

<ol class="breadcrumb">
					<li><a href="dmUser/dmDashboard.php"><i class="demo-pli-home"></i></a></li>
					<li><a href="#">User Control</a></li>
					<li class="active">Change Password</li>
                    </ol>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                        <div class="panel panel-bordered panel-info">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Change Password</h3>
					                </div>
					        <div class="panel-body">
					            <div class="fixed-fluid">
                                
					                <div class="fixed-sm-200 pull-sm-left fixed-right-border">
                                    <div class="pad-btm bord-btm">
					                        <a  class="btn btn-block btn-success">Password Policy</a>
					                    </div>
                                        
                                        <div class="list-group bg-trans pad-btm bord-btm">
					                        <div class="card-body">
                                            
                      <p><i class="demo-psi-Close icon-lg" style="color: red;" id="mincheckright"></i> <i class="demo-psi-Yes icon-lg" style="color: green;display: none;" id="mincheckwrong"></i> Password minimum length 8.</p>
                       
                    <p><i class="demo-psi-Close icon-lg" style="color: red;" id="uppercheckright"></i> <i class="demo-psi-Yes icon-lg" style="color: green;display: none;" id="uppercheckwrong"></i> Minimum one Uppercase letter (A-Z). </p>
                    
                    <p><i class="demo-psi-Close icon-lg" style="color: red;" id="lowercheckright"></i> <i class="demo-psi-Yes icon-lg" style="color: green;display: none;" id="lowercheckwrong"></i> Minimum one Lowercase letter (a-z) </p> 
                    
                    <p><i class="demo-psi-Close icon-lg" style="color: red;" id="digitcheckright"></i> <i class="demo-psi-Yes icon-lg" style="color: green;display: none;" id="digitcheckwrong"></i> Minimum one Digit (0-9) </p>
                    
                    <p><i class="demo-psi-Close icon-lg" style="color: red;" id="specialcheckright"></i> <i class="demo-psi-Yes icon-lg" style="color: green;display: none;" id="specialcheckwrong"></i> Minimum one Special character (e.g. @ #  ~&). </p>
                    
                    </div>
					                    </div>
					                    
					                </div>
					                <div class="fluid">
					                    <!-- COMPOSE EMAIL -->
					                    <!--===================================================-->
					
					                    <div class="pad-btm clearfix">
					                        <!--Cc & bcc toggle buttons-->
					                        <div class="pull-right pad-btm">
					                            <div class="btn-group">
					                                
					                            </div>
					                        </div>
					                    </div>
                                        
					                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onSubmit="return checkForm(this);" class="form-horizontal">
					                        <div class="form-group">
					                            <label class="col-lg-2 control-label text-left" for="inputEmail">New Password:</label>
					                            <div class="col-lg-6">
                                                <input type="password" name="new_password" required id="newpassword" onKeyUp="return checkPassword(this.value);" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>" placeholder="New Password">
                                                </div>
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
					                            </div>
					                       
					                        
					                        <div class="form-group">
					                            <label class="col-lg-2 control-label text-left" for="inputSubject">Confirm Password:</label>
					                            <div class="col-lg-6">
					                               <input type="password" name="confirm_password" placeholder="Confirm Password" required id="confirm_password" onkeyup='check();' class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                                                   </div>
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
					                            </div>
                                            
                                            
                                            
                                            <div id="confirm"><span id='message'></span></div>
                        <div id="passwordDescription"></div>
                        <div id="passwordStrength" class=""></div>
					
					                    <div class="pad-ver">
					                        <!--Send button-->
					                        <button type="submit"  class="btn btn-primary">
					                            <i class="demo-psi-file icon-fw"></i> Save Changes
					                        </button>
					
					                        <!--Save draft button-->
					                       
					                    </div>
					 </form>
                     
                     <script>
function checkPassword(password){
  var desc = new Array();
  desc[0] = "Very Weak";
  desc[1] = "Weak";
  desc[2] = "Better";
  desc[3] = "Medium";
  desc[4] = "Strong";
  desc[5] = "Strongest";
  var score   = 0;
  //if password bigger than 6 give 1 point
  if (password.length >= 8){
    $("#mincheckright").hide('slow');
    $("#mincheckwrong").show('slow');

  }else{
    $("#mincheckright").show('slow');
    $("#mincheckwrong").hide('slow');
  }
  //if password has both lower and uppercase characters give 1 point  
  if((password.match(/[A-Z]/))){
    score ++;
    $("#uppercheckright").hide('slow');
    $("#uppercheckwrong").show('slow');
  }else{
    $("#uppercheckright").show('slow');
    $("#uppercheckwrong").hide('slow');
  }
  if((password.match(/[a-z]/))) {
    score ++;
    $("#lowercheckright").hide('slow');
    $("#lowercheckwrong").show('slow');
  }else{
    $("#lowercheckright").show('slow');
    $("#lowercheckwrong").hide('slow');
  }
  //if password has at least one number give 1 point
  if(password.match(/\d+/)){
    score ++;
    $("#digitcheckright").hide('slow');
    $("#digitcheckwrong").show('slow');
  }else{
    $("#digitcheckright").show('slow');
    $("#digitcheckwrong").hide('slow');
  }
  //if password has at least one special caracther give 1 point
  if(password.match(/.[!,@,#,$,%,&,*,?,_]/)){
    score ++;
    $("#specialcheckright").hide('slow');
    $("#specialcheckwrong").show('slow');
  }else{
    $("#specialcheckright").show('slow');
    $("#specialcheckwrong").hide('slow');
  }

  //if password bigger than 12 give another 1 point
  if (password.length > 12){ 
    score++; 
  }

  document.getElementById("passwordStrength").innerHTML = desc[score];
  document.getElementById("passwordStrength").className = "strength" + score;
  document.pass.scores.value=score;
}
</script>

					
					                    <!--===================================================-->
					                    <!-- END COMPOSE EMAIL -->
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
if($rows['usertype']=='1'){
	require '../adminUser/adminHeader.php';
}
if($rows['usertype']=='2'){
	require '../departmentUser/departmentHeader.php';
}
?>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
<?php 
if($rows['usertype']=='1'){
	require '../adminUser/adminFooter.php';
}
if($rows['usertype']=='2'){
	require '../departmentUser/departmentFooter.php';
}
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
