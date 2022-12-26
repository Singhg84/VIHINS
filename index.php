<?php
ob_start();
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
// Initialize the session
//$param_password = password_hash('admin123', PASSWORD_DEFAULT);

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$username = $password = $captcha = "";
$username_err = $password_err = $login_err = $captcha_err = $wrong = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
	
	if(empty($_POST["captchacode"])){
        $captcha_err = "Please enter captcha.";
	}
    
    // Validate credentials
    if(empty($username_err) && empty($password_err) && empty($captcha_err)){
		
		if($_POST['captchacode'] != $_SESSION['digit'])	{  
		$login_err = "Invalid captcha.";	
	}
	else
	{
        // Prepare a select statement
        $sql = "SELECT * FROM steps_login_master WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $_POST['username']);
            
            // Set parameters
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id,$username, $hashed_password,$usertype,$last_log,$status);
                    if($stmt->fetch()){
						
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
							
							$sql1 = "UPDATE steps_login_master SET last_log = '".$timestamp."' where username = '".$_POST['username']."'";
                            $stmt = $conn->prepare($sql1);
							$stmt->execute();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;  
                             
							 if($usertype == '1'){
							header("location: adminUser/adminDashboard.php");
							 }
							 if($usertype == '2'){
							header("location: departmentUser/departmentDashboard.php");
							 }
							 
                        } 
						
						else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
					
                } 
				else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } 
			else{
                $wrong =  "something wrong.";
            }

            // Close statement
            $stmt->close();
			
        }
	}
    }
    
    // Close connection
   $conn->close();
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>VIH</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="webMaster/assets/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="webMaster/assets/css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="webMaster/assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="webMaster/assets/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="webMaster/assets/plugins/pace/pace.min.js"></script>


        
    <!--Demo [ DEMONSTRATION ]-->
    <link href="webMaster/assets/css/demo/nifty-demo.min.css" rel="stylesheet">

 <style>
 .invalid-feedback{ color:#F00;}
 </style>   
        
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="container" class="cls-container">
        
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
            <div class="panel panel-success">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
                    <?php if(isset($_GET['Message'])){echo '<div class="alert alert-success">'. $_GET['Message']. '</div>' ;}?>
		                <h1 class="h3">VIDYASAGAR INSTITUTE OF HEALTH</h1>
                        <p><img src="http://vihmid.org.in/wp-content/uploads/2018/05/ulogo.jpg" alt="" width="50" height="50" class="img-circle" /></p>
		            </div>
                    <?php if(!empty($login_err)){echo '<div class="alert alert-danger">' . $login_err . '</div>';}?>
                    
                    
		            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		                <div class="form-group">
		                    <input type="text" name="username"   class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" autofocus>
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
		                </div>
		                <div class="form-group">
		                    <input type="password" name="password"    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Password">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
		                </div>
		                <div align="center"><img src="captcha.php" id="captcha"><br>
      
      <div class="form-group">
           <label>Enter the code above here :</label>
                 <input size="6" maxlength="5" type="number"  name="captchacode" class="form-control <?php echo (!empty($captcha_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $captcha_err; ?></span>
            </div>
        Refresh
        <a href="#" onClick="
  document.getElementById('captcha').src = 'captcha.php?' + Math.random();
  document.getElementById('captcha_code_input').value = '';
  return false;
"><span class="glyphicon glyphicon-refresh"></span></a></div>


<div class="pad-ver">
<button type="submit"  class="btn btn-primary btn-lg btn-block" id="submit-btn" ><i class="demo-psi-Unlock icon-lg icon-fw"></i> Sign In</button>
</div>
		           
 </form>
		        </div>
		
		        <div class="pad-all">
		            Don't have an account?<a href="registerNewuser.php" class="btn-link mar-lft">Sign up now</a>
		
		            <div class="media pad-top bord-top">
		                <div class="pull-right">
		                    
		                </div>
		                <div class="media-body text-left text-bold text-main">
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
        </div>
		<!--===================================================-->
		
		
		<!-- DEMO PURPOSE ONLY -->
        <div class="demo-bg">
		    <div id="demo-bg-list">
		        <div class="demo-loading"><i class="psi-repeat-2"></i></div>
                <img class="demo-chg-bg" src="webMaster/assets/img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
		        
		    </div>
		</div>
		<!--===================================================-->
		<!--===================================================-->
		
		
		
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


        
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="webMaster/assets/js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="webMaster/assets/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="webMaster/assets/js/nifty.min.js"></script>




    <!--=================================================-->
    
    <!--Background Image [ DEMONSTRATION ]-->
    <script src="webMaster/assets/js/demo/bg-images.js"></script>

</body>
</html>
