<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Register</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="action.php" method="POST">
          <div class="form-group">
            <label for="exampleInputDeviceMac">Device MAC</label>
            <input class="form-control" id="exampleInputDeviceMac" type="device_mac" aria-describedby="nameHelp" placeholder="Enter device MAC address" name="device_mac">
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
                <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" name="first_name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" name="last_name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
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
          <button type="submit" class="btn btn-primary btn-block" name="action" value="register">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Login Page</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
