<?php
require_once ('classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cust_FN = $_POST['first_name'];
    $cust_LN = $_POST['last_name'];
    $cust_user = $_POST['username'];
    $cust_email = $_POST['email'];
    $cust_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $cust_phone = $_POST['phone'];

    // Ensure the uploads directory exists
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $uploadOk = 1;
    $cust_image_profile = ''; // Default value if no image is uploaded

    // Check if file is uploaded
    if (isset($_FILES["cust_image"]) && $_FILES["cust_image"]["error"] == UPLOAD_ERR_OK) {
        $original_file_name = basename($_FILES["cust_image"]["name"]);

        // NEW CODE: Initialize $new_file_name with $original_file_name
        $new_file_name = $original_file_name;
        $target_file = $target_dir . $original_file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists and rename if necessary
        if (file_exists($target_file)) {
            // Generate a unique file name by appending a timestamp
            $new_file_name = pathinfo($original_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType;
            $target_file = $target_dir . $new_file_name;
        } else {
            // Update $target_file with the original file name
            $target_file = $target_dir . $original_file_name;
        }

        // Check if file is an actual image or fake image
        $check = getimagesize($_FILES["cust_image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["cust_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["cust_image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars($new_file_name) . " has been uploaded.";

                // Save the user data and the path to the profile picture in the database
                $cust_image_profile = 'uploads/' . $new_file_name; // Save the new file name (without directory)
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Register user even if the image is not uploaded
    $db = new Database();
    $db->register($cust_image_profile, $cust_FN, $cust_LN, $cust_user, $cust_email, $cust_pass, $cust_phone);
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

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body class="bg-gradient-primary">


    <!-- User Info1 -->
    <div class="container ">
        
        <form class="user" method="post" action="register.php" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="first_name" placeholder="First Name"
                        required>
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="last_name" placeholder="Last Name"
                        required>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" name="username" placeholder="Username"
                    required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address"
                    required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user" name="password" placeholder="Password"
                    required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" name="phone" placeholder="Phone Number"
                    required>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="cust_image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Register Account
            </button>
        </form>
        </form>
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