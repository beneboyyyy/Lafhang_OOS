<?php
require_once('classes/database.php');
session_start();

$con = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productStock = $_POST['product_stock'];

    // Ensure the uploads directory exists
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $uploadOk = 1;
    $product_image_profile = ''; // Default value if no image is uploaded

    // Check if file is uploaded
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == UPLOAD_ERR_OK) {
        $original_file_name = basename($_FILES["product_image"]["name"]);
        $new_file_name = $original_file_name;
        $target_file = $target_dir . $original_file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists and rename if necessary
        if (file_exists($target_file)) {
            // Generate a unique file name by appending a timestamp
            $new_file_name = pathinfo($original_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType;
            $target_file = $target_dir . $new_file_name;
        }

        // Check if file is an actual image or fake image
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["product_image"]["size"] > 500000) {
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
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars($new_file_name) . " has been uploaded.";
                $product_image_profile = 'uploads/' . $new_file_name;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Add product to the database
    if ($con->addProduct(null, $productName, $productDescription, $productPrice, $product_image_profile, $productStock)) {
        header('location: product.php?status=success');
        exit();
    } else {
        header('location: product.php?status=error');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="include/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body id="page-top">

<?php include('include/sidebar.php'); ?>
<?php include('include/topbar.php'); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addProductModal">
            <i class="fas fa-plus-square fa-sm text-white-50"></i> Add Product
        </a>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" enctype="multipart/form-data" method="POST" action="">
                        <div class="form-group">
                            <label for="product_image">Product Image</label>
                            <input type="file" class="form-control" name="product_image" id="product_image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Product Price</label>
                            <input type="number" class="form-control" name="product_price" id="product_price" placeholder="Enter product price" required>
                        </div>
                        <div class="form-group">
                            <label for="product_description">Product Description</label>
                            <textarea class="form-control" name="product_description" id="product_description" rows="3" placeholder="Enter product description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_stock">Stock Quantity</label>
                            <input type="number" class="form-control" name="product_stock" id="product_stock" placeholder="Enter stock quantity" required>
                        </div>
                        <button type="submit" name="addproduct" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your existing table and card display code here -->
    <div class="container user-info rounded shadow p-3 my-5">
      <h2 class="text-center mb-2">Product Table</h2>
      <div class="table-responsive text-center">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Picture</th>
              <th>Product Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $counter = 1;
            $data = $con->viewProduct();
            foreach ($data as $rows) {
              ?>

              <tr>
                <td><?php echo $counter++ ?></td>
                <td>
                  <?php if (!empty($rows['product_image'])): ?>
                    <img src="<?php echo htmlspecialchars($rows['product_image']); ?>" alt="Product Image "
                      style="width: 50px; height: 50px; border-radius: 50%;">
                  <?php else: ?>
                    <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture"
                      style="width: 50px; height: 50px; border-radius: 50%;">
                  <?php endif; ?>
                </td>
                <td><?php echo $rows['product_name']; ?></td>
                <td><?php echo $rows['product_descrip']; ?></td>
                <td><?php echo $rows['product_price']; ?></td>
                <td><?php echo $rows['product_stock']; ?></td>

                <td>
                  <div class="btn-group" role="group">
                    <form action="update.php" method="post" class="d-inline">
                      <input type="hidden" name="id" value="<?php echo $rows['productID']; ?>">
                      <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                      </button>
                    </form>
                    <form method="POST" class="d-inline">
                      <input type="hidden" name="id" value="<?php echo $rows['productID']; ?>">
                      <button type="submit" name="delete" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this user?')">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              <?php
            }
            ?>

            <!-- Add more rows for additional users -->
          </tbody>
        </table>
      </div>

      <div class="container my-5">
        <h2 class="text-center">Products</h2>
        <div class="card-container">
          <?php
          $data = $con->viewProduct();
          foreach ($data as $rows) {
            ?>
            <div class="card">
              <div class="card-body text-center">
                <?php if (!empty($rows['product_image'])): ?>
                  <img src="<?php echo htmlspecialchars($rows['product_image']); ?>" alt="Profile Picture"
                    class="profile-img">
                <?php else: ?>
                  <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" class="profile-img">
                <?php endif; ?>
                <h5 class="card-title"><?php echo htmlspecialchars($rows['product_name']); ?></h5>
                <p class="card-text"><strong>Description:</strong>
                  <?php echo htmlspecialchars($rows['product_descrip']); ?></p>
                <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($rows['product_price']); ?></p>
                <p class="card-text"><strong>Stocks:</strong> <?php echo htmlspecialchars($rows['product_stock']); ?>
                </p>
                <form action="update.php" method="post" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                  <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                </form>
                  <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                    <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete"
                      onclick="return confirm('Are you sure you want to delete this user?')">
                  </form>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- <script>
$(document).ready(function () {
    $('#addProductForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '', // Same page handling form submission
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert(response);
                // Reload the page after adding the product
                location.reload();
            },
            error: function () {
                alert('Error adding product.');
            }
        });
    });
});
</script> -->

</body>
</html>
