<?PHP
  include "db_connection.php";
  session_start();
  error_reporting(0);
  if(!isset($_SESSION['user']))
  {
    if ($_SESSION['user_type'] != "employee") {
      header('location:index.php');
    }
  }
  $user_type = $_SESSION['user_type'];
  $user_id = $_SESSION['user'];
  $user_select="SELECT *  FROM `users` WHERE  `EmpId` = '$user_id' ";
  $select_result = mysqli_query($connect,$user_select);
  $user_row = mysqli_fetch_array($select_result);
  $error="";
  $msg="";

  if (isset($_POST['Profile_update'])){

    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];
    $EmailId=$_POST['EmailId'];
    $Gender=$_POST['Gender'];
    $Dob=$_POST['Dob'];
    $Department=$_POST['Department'];
    $Address=$_POST['Address'];
    $City=$_POST['City'];
    $Phonenumber=$_POST['Phonenumber'];
  
    $profile_update="UPDATE `users` SET `FirstName`='$FirstName',`LastName`='$LastName',`EmailId`='$EmailId',`Gender`='$Gender',`Dob`='$Dob',`Department`='$Department',`Address`='$Address',`City`='$City',`Phonenumber`='$Phonenumber' WHERE `EmpId` = '$user_id'";
    $profile_update_result = mysqli_query($connect,$profile_update);
    if($profile_update_result){
      //echo "<script>alert(' Profile Updated successfully.')</script>";
      $msg ='Profile Updated successfully.';
    }else{
     // echo "<script>alert(' Profile Updated faild Try again.')</script>";
     $error =' Profile Updated faild Try again.';
    }

  }/* else {
    echo "<script>alert(' Profile Updated faild Try again.')</script>";
    $error =' Profile Updated faild Try again.';
  }*/
  

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--===========================================================================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--===========================================================================-->
    <link rel="shortcut icon" href="assets/images/logo.jpg" />
    <!--===========================================================================-->
    <title>Dashboard</title>
    <!--===========================================================================-->
    <link rel="stylesheet" href="assets/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="assets/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="assets/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/iconfonts/font-awesome/css/font-awesome.min.css" />
    <!--===========================================================================-->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--===========================================================================-->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <!--===========================================================================-->
<style>
.active{
  background-color:#1A2980;
}
</style>
  </head>
  <body>
    <div class="container-scroller" >
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="assets/images/aitam.png" alt="logo" style="height: 50px;" /> </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="assets/images/logo.jpg" alt="logo" style="width:50px;height: 50px;" alt="logo" /> </a>
        </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
              <a  href="logout.php" class="nav-link count-indicator" >
                Sign Out &nbsp<i class="fa fa-sign-out" style="font-size:15px;"></i>
              </a>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="assets/images/profile.png" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="assets/images/profile.png" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?PHP echo $user_row['FirstName']." ".$user_row['LastName'];?></p>
                  <p class="mb-1 mt-3 font-weight-semibold"><?PHP echo $user_row['Department']; ?></p>
                  <p class="mb-1 mt-3 font-weight-semibold"><?PHP echo $_SESSION['user'];?></p>
                </div>
                <a  href="logout.php" class="dropdown-item">Sign Out &nbsp<i class="fa fa-sign-out" style="font-size:15px;"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="assets/images/profile.png" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?PHP echo $_SESSION['user'];?></p>
                  <p class="designation"><?PHP echo  $user_row['Department'];?></p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Menu</li>
            <li class="nav-item active" id="Profile">
              <a class="nav-link " href="employee_dashboard.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title"> My Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Leaves</span>
                <i class="menu-arrow"></i>
              </a> 
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="employee_apply_leave.php">Apply Leave</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="employee_leave_history.php">Leave History</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item " id="Project_Proposal">
              <a class="nav-link " href="employee_change_password.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Change Password</span>
              </a>
            </li>
          </ul>
        </nav>
        <!--===========================================================================-->
        <div class="main-panel" >
          <div class="content-wrapper"> 
            <section id="main_section" >
             <div class="col-lg-12 grid-margin stretch-card" id="main_dashboard">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title">MY PROFILE</h1>
                    <div class="container">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="row">
                      <div class="col-sm">
                            <div class="form-group">
                            <label for="exampleInputPassword1">Id Number</label>
                              <div class="form-control border-bottom" style="border-style:none;"> <?PHP echo $user_row['EmpId']; ?></div>
                            </div>

                            <div class="row">
                            <div class="col">
                            <div class="form-group">
                              <label for="exampleInputPassword1">First Name</label>
                              <input type="text" name="FirstName" value="<?PHP echo $user_row['FirstName']; ?>" class="form-control border-bottom" style="border-style:none;">
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Last Name</label>
                              <input type="text" name="LastName" value="<?PHP echo $user_row['LastName']; ?>" class="form-control border-bottom" style="border-style:none;">
                            </div>
                            </div>
                          </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Email Id</label>
                              <input type="text" name="EmailId" value="<?PHP echo $user_row['EmailId']; ?>" class="form-control border-bottom" style="border-style:none;">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Phone Number</label>
                              <input type="tel" name="Phonenumber" value="<?PHP echo $user_row['Phonenumber']; ?>" class="form-control border-bottom" style="border-style:none;">
                            </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Gender :<b> <?PHP echo $user_row['Gender']; ?> </b></label>
                          <select  name="Gender" class="form-control border-bottom" style="border-style:none;">
                            <option value="Male">Male</option>
                            <option value="Female">Female </option>
                            <option value="Others">Others</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Department :<b> <?PHP echo $user_row['Department']; ?> </b></label>
                          <select  name="Department" class="form-control border-bottom" style="border-style:none;">
                            <option value="CSE">CSE</option>
                            <option value="ECE">ECE</option>
                            <option value="MECH">MECH</option>
                            <option value="CIVIL">CIVIL</option>
                            <option value="IT">IT</option>
                            <option value="EEE">EEE</option>
                            <option value="BSA">Basic science & Humanities </option>
                          </select>
                        </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Date of Birth :<b> <?PHP echo $user_row['Dob']; ?> </b></label>
                              <input type="date" name="Dob" paceholder="" value="<?PHP echo $user_row['Dob']; ?>" class="form-control border-bottom" style="border-style:none;">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Address</label>
                              <input type="text" name="Address" value="<?PHP echo $user_row['Address']; ?>" class="form-control border-bottom" style="border-style:none;">
                            </div>
                      </div>
                      <div class="col-sm">
                          <div class="form-group">
                                  <label for="exampleInputPassword1">City</label>
                                  <input type="text" name="City" value="<?PHP echo $user_row['City']; ?>" class="form-control border-bottom" style="border-style:none;">
                                </div>
                          </div>

                    </div>
                    <?php if($error !=""){?><div class="text-danger"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                             else if($msg !=""){?><div class="text-success"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                        <input  type="submit" class="btn btn-primary" name="Profile_update" value="Update">
                    </form>
                  </div>
                  </div>
                </div>
              </div>
            <!--===========================================================================-->     
     
            <!--===========================================================================-->
           </section>
        </div>
          <!-- content-wrapper ends -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                Design and developed by <a href="#" >AITAM</a> Web developers club.
              </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                <a href="#" >AITAM SAC</a> 
              </span>
            </div>
          </footer>
          <!-------------------/ partial --------------------------------------->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
<!--===========================================================================-->
<script>

</script>
<!--===========================================================================-->
    <script src="assets/js/vendor.bundle.base.js"></script>
    <script src="assets/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/bootstrap.min.js" ></script>
    <!--===========================================================================-->
    <script src="assets/js/shared/off-canvas.js"></script>
<!--==========================================================================-->
  </body>
</html>