<?php

include('includes/config.php');

session_start();

if (empty($_SESSION['logged_in'])) {
  header("location: index.php");
}

$strDeviceMac = $_SESSION['logged_in']['device_mac'];
$strFirstName = $_SESSION['logged_in']['first_name'];
$strLastName = $_SESSION['logged_in']['last_name'];
$strEmail = $_SESSION['logged_in']['email'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>IntelliH - Account</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">IntelliH</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Statistics</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="contacts.php">
            <img src="images/contact.png">
            <span class="nav-link-text">Contacts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="account.php">
            <img src="images/account.png">
            <span class="nav-link-text">Account</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <h1>Account</h1>
          <form action="action.php" method="POST">
            <div class="form-group">
              <label for="exampleInputDeviceMac">Device MAC</label>
              <input class="form-control" id="exampleInputDeviceMac" type="device_mac" aria-describedby="nameHelp" placeholder="Enter device MAC address" name="device_mac" value="<?php echo $strDeviceMac;?>">
              <?php
              if (isset($_GET['response']) && $_GET['response'] == "device-invalid") {
                echo '<font color="red">Invalid device MAC address</font><br>';
              } else if (isset($_GET['response']) && $_GET['response'] == "device-registered") {
                echo '<font color="red">Device is already registered</font><br>';
              }
              ?>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputName">First name</label>
                  <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" name="first_name" value="<?php echo $strFirstName;?>">
                </div>
                <div class="col-md-6">
                  <label for="exampleInputLastName">Last name</label>
                  <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" name="last_name" value="<?php echo $strLastName;?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo $strEmail;?>">
              <?php
              if (isset($_GET['response']) && $_GET['response'] == "email-invalid") {
                echo '<font color="red">Invalid Email</font><br>';
              } else if (isset($_GET['response']) && $_GET['response'] == "email-existing") {
                echo '<font color="red">Existing Email</font><br>';
              }
              ?>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
                </div>
                <div class="col-md-6">
                  <label for="exampleConfirmPassword">Confirm password</label>
                  <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password" name="confirm_password">
                </div>
                <?php
                if (isset($_GET['response']) && $_GET['response'] == "password-mismatch") {
                  echo '<font color="red">Password did not match</font><br>';
                }
                ?>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="action" value="update_acct">Update</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Semicolon 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</body>

</html>
