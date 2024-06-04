<?php

require_once('classes/database.php');
$con = new database();
session_start();

// If the user is already logged in, check their account type and redirect accordingly
// if (isset($_SESSION['user_name']) && isset($_SESSION['account_type'])) {
//   if ($_SESSION['account_type'] == 0) {
//     header('location:index3.php');
//   } else if ($_SESSION['account_type'] == 1) {
//     header('location:user_account.php');
//   }
//   exit();
// }

$error = ""; // Initialize error variable

if (isset($_POST['login'])) {
  $email = $_POST['cust_email'];
  $password = $_POST['cust_pass'];

  if ($con->check($email, $password)) {
    header('location:index.php');
    exit();
  } else {
    $error = "Incorrect username or password. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="login.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid rounded shadow login-container">
    <h2 class="text-center mb-4">Log In</h2>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="cust_email" placeholder="Enter username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="cust_pass" placeholder="Enter password" required>
      </div>
      <div class="container">
        <div class="row gx-1">
          <div class="col"><input type="submit" value="Login" name="login" class="btn btn-primary btn-block"></div>
          <div class="col"> <a href="index.php" class="btn btn-danger btn-block" name="register">Register</a></div>
        </div>
      </div>
    </form>
  </div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>
