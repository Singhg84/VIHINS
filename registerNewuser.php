<?php
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = $user_exist =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }  
	
if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
       $confirm_password_err = "Password did not match.";
  }
 }	
	
$sql = "SELECT * FROM steps_login_master WHERE username = ?";	
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST['username']);
$stmt->execute();
                // store result
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
					
                if($row['username'] != $_POST["username"]){
                $user_exist = "This username is not valid.";
                } 
				
				elseif($row['password']!=''){
					 $username_err = "This username is already taken.";
				}
				
				else{
				
				
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
		
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        // Prepare an insert statement
        $sql1 = "UPDATE  steps_login_master SET password = ? WHERE username = ? ";
		 
        if($stmt = $conn->prepare($sql1)){
			
		$stmt->bind_param("si", $param_password, $row['username']);
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
				$Message = urlencode("Registered successfully...");
                header("Location:userLogin.php?Message=".$Message);
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
		}
		}
            // Close statement
            $stmt->close();
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

   <title>&nbsp;সমন্বয়&nbsp;|&nbsp;&nbsp;&nbsp;পূর্ব মেদিনীপুর</title>


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
		                <h1 class="h3">VHI</h1>
                        <p><img src="webMaster/assets/img/glogo.gif" alt="" width="40" height="50" class="img-circle" /></p>
		            </div>
                    <?php 
        if(!empty($user_exist)){ echo '<div class="alert alert-danger">' . $user_exist . '</div>';} 
		if(!empty($username_err)){ echo '<div class="alert alert-danger">' . $username_err . '</div>';}        
        ?>
		           <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                   
                   
                   
                   
		                <div class="form-group">
                        
                        <input type="text" name="username" required  class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" autofocus>
		                    
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
		                </div>
                        
                        
                     <div class="form-group">
                         <input type="password" required name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
		                </div>
                        
                        
                   <div class="form-group">
                        <input type="password" required placeholder="Confirm Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
		      </div>   
                        
                        
                                     <div class="pad-ver">
					                        <button type="submit"  class="btn btn-info btn-lg btn-block" id="submit-btn" >
					                            <i class="demo-psi-Unlock icon-lg icon-fw"></i> Register
					                        </button>
					                    </div>

		            </form>
                    
                    
                    
                    
		        </div>
		
		        <div class="pad-all">
		            <p>Already have an account? <a href="index.php">Login here</a>.</p>
		
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
