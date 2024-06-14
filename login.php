<?php

require_once ('classes/database.php');
$con = new database();
session_start();

// // If the user is already logged in, check their account type and redirect accordingly
// if (isset($_SESSION['cust_user']) && isset($_SESSION['account_type'])) {
//   if ($_SESSION['account_type'] == 0) {
//     header('location:index3.php');
//   } else if ($_SESSION['account_type'] == 1) {
//     header('location:index.php');
//   }
//   exit();
// }

$error = ""; // Initialize error variable

if (isset($_POST['login'])) {
  $accounttype = $_POST['account_type'];
  $username = $_POST['cust_user'];
  $password = $_POST['cust_pass'];
  $result = $con->check($accounttype, $username, $password);


  if ($result) {
    $_SESSION['cust_user'] = $result['cust_user'];
    $_SESSION['account_type'] = $result['account_type'];
    $_SESSION['cust_ID'] = $result['cust_ID'];
    if ($result['account_type'] == 0) {
      header('location:index2.php');
    } else if ($result['account_type'] == 1) {
      header('location:index.php');
    }
  } else {
    $error = "Incorrect username or password. Please try again.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login Page</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-8 col-lg-10 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome to Lafhang House!</h1>
                  </div>
                  <form method="post">
                    <div class="form-group">
                      <input type="text" class="form-control" name="cust_user" placeholder="Enter Username...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="cust_pass" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div> -->
                    <div class="container">
                      <div class="row gx-1">
                        <div class="col"><input type="submit" value="Login" name="login"
                            class="btn btn-primary btn-block"></div>
                      </div>
                    </div>
                    

                  </form>
                
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>





<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!Bootstrap CSS  -->  
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>  -->

<!-- <body>

  <div class="mw login-container">
    <h2 class="text-center mb-4">Log In</h2>
    <form method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="cust_user" placeholder="Enter username">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="cust_pass" placeholder="Enter password">
      </div>
      <div class="container">
        <div class="row gx-1">
          <div class="col"><input type="submit" value="Login" name="login" class="btn btn-primary btn-block"></div>
          <div class="col"> <a href="register.php" class="btn btn-danger btn-block" name="register">Register</a></div>
        </div>
      </div>
    </form>
  </div> -->

<!-- Bootstrap JS and dependencies -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>

 </html> -->