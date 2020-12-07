<?PHP 
include "db_connection.php";
session_start();
        if(!isset($_SESSION['code']))
        {header('location:index.php');}
        $mail=$_SESSION['mail'];
        $code=$_SESSION['code'];
        $user_id=$_SESSION['user_id'];
        $error="";
        $msg="";       
        
        $expireAfter =5;
        if(isset($_SESSION['last_action'])){
    
            //Figure out how many seconds have passed
            //since the user was last active.
            $secondsInactive = time() - $_SESSION['last_action'];
            
            //Convert our minutes into seconds.
            $expireAfterSeconds = $expireAfter * 60;
            
            //Check to see if they have been inactive for too long.
            if($secondsInactive >= $expireAfterSeconds){
                //User has been inactive for too long.
                //Kill their session.
                session_unset();
                session_destroy();
            }
            
        }
         
        //Assign the current timestamp as the user's
        //latest activity
        $_SESSION['last_action'] = time();

if (isset($_POST['submit'])) {
    $vcode=$_POST['Verification_Code'];
    $New_Password=$_POST['New_Password'];
    $Confirm_Password=$_POST['Confirm_Password'];
    if ($vcode != $code) {
        //echo "<script>alert('Invalid Verification Code .')</script>";
        $error ='Invalid Verification Code.';
    }elseif ($New_Password != $Confirm_Password) {
        //echo "<script>alert('New Password and Confirm Password must be same .')</script>";
        $error ='New Password and Confirm Password must be same .';
    }else {
        $update=" UPDATE `users` SET `Password`='$Confirm_Password'  WHERE  `EmpId` = '$user_id' ";
        $update_sql=mysqli_query($connect,$update);
        if ($update_sql) {
            echo "<script>alert(' Password changed successfully.')</script>";
            echo "<script>window.location='index.php';</script>";
        }else {
            echo "<script>alert(' Password change faild Try again.')</script>";
            echo "<script>window.location='index.php';</script>";
        }
    }
    
}/* else {
    # code...
}*/




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--===========================================================================-->
    <link rel="shortcut icon" href="assets/images/logo.jpg" />
    <!--===========================================================================-->
    <title>Register</title>
    <!--=============================Font Icon ==================================-->
    <link rel="stylesheet" href="assets/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="assets/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="assets/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/iconfonts/font-awesome/css/font-awesome.min.css" />
    <!--===========================================================================-->
    <link rel="stylesheet" href="assets/css/login_style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--===========================================================================-->
     <script src="assets/js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
    <!--===========================================================================-->
</head>
<body style="background-image: linear-gradient(to right, #1A2980 0%, #26D0CE 51%, #1A2980 100%)">
<!--===========================================================================-->
    <div class="main" style="background-image: linear-gradient(to right, #1A2980 0%, #26D0CE 51%, #1A2980 100%)">
        <!--==================================== Register =====================================-->
        <section class="signup" style="" >
            <div class="container">
                <div class="signup-content" >
                    <div class="signup-form" style="margin-top:-8%;">
                        <h2 class="form-title">FOrgot Password</h2>
                        <h5><i class="fa fa-dot-circle-o"></i> &nbsp <?PHP echo $mail;?>: Your Id Number is Your User Name</h5>
                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>" class="register-form" id="register-form">
                            <div class="form-group"><?PHP echo $code;?>
                                <label for="name"><i class="fa fa-user-circle"></i></label>
                                <input type="text" name="Verification_Code" id="name" placeholder="Verification Code" required/>
                            </div>
                            <div class="form-group">
                                <label for="user_name"><i class="fa fa-lock"></i></label>
                                <input type="password" name="New_Password" id="password" placeholder="New Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="fa fa-lock"></i></label>
                                <input type="password" id="Confirm_Password" name="Confirm_Password"placeholder="Confirm Password"  required/>
                            </div>
                            <div class="form-group form-button">
                            <?php if($error!=""){?><div class="text-danger"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                else if($msg !=""){?><div class="text-success"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                        
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Submit"/>
                            </div>
                        </form>
                        
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/images/logo.jpg" alt="sing up image"></figure>
                       <!-- <a href="#" class="signup-image-link" id="login" style="color:#1565c0;text-decoration:none;">
                            <b><u>I am already member</u></b>
                        </a>-->
                    </div>
                </div>
            </div>
        </section>
        <!--===========================================================================-->
    </div>
<!--===========================================================================-->

<script>
//-------------confirm_password-----------------
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
//------------------------------
</script>
<!--===========================================================================-->   
</body>
</html>