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
    <title>Leave History</title>
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
                  <p class="mb-1 mt-3 font-weight-semibold"><?PHP echo $_SESSION['user']; ?></p>
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
            <li class="nav-item " id="Profile">
              <a class="nav-link " href="employee_dashboard.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title"> My Profile</span>
              </a>
            </li>
            <li class="nav-item active">
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
            <section id="main_section" style="display:flex;justify-content: center;">
             <div class="col-lg-12 grid-margin stretch-card" id="main_dashboard" >
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title">LEAVE HISTORY</h1>
                    <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="bg-primary">
                          <th scope="col">Sno</th>
                          <th scope="col">Leave type</th>
                          <th scope="col">Applied Date</th>
                          <th scope="col">From</th>
                          <th scope="col">To</th>
                          <th scope="col">Description</th>
                          <th scope="col">Admin Remark</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?PHP
                        $user_select2="SELECT *  FROM `employee_leaves` WHERE  `EmpId` = '$user_id' ";
                        $select_result2 = mysqli_query($connect,$user_select2);
                        $i=1;
                        while($user_row2 = mysqli_fetch_array($select_result2)){
                          echo "<tr><td>".$i."</td><td>".$user_row2['LeaveType']."</td><td>".$user_row2['PostingDate']."</td>
                          <td>".$user_row2['FromDate']."</td><td>".$user_row2['ToDate']."</td><td>".$user_row2['Description']."</td>
                          <td>".$user_row2['status']."</td><td class='text-warning'>".$user_row2['Status']."</td></tr>";
                          $i++;
                        }
                      ?>
                      </tbody>
                    </table>
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