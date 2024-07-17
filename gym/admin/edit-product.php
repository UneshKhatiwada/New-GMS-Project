<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login if admin session not set
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

$msg = ''; // Initialize message variable
$errormsg = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $update_id = $_POST['update_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $image = $_POST['image'];

        // Perform update
        $sql = "UPDATE products SET title = :title, description = :description, amount = :amount, image = :image WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':amount', $amount, PDO::PARAM_INT);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':id', $update_id, PDO::PARAM_INT);
        $query->execute();

        // Check if update was successful
        if ($query->rowCount() > 0) {
            $msg = "Product updated successfully";
            header('location: manage-product.php');
        } else {
            $errormsg = "Failed to update product";
        }
    }
}

// Fetch product details if update_id is provided
$update_id = isset($_GET['update_id']) ? $_GET['update_id'] : '';
if (!empty($update_id)) {
    $sql = "SELECT id, title, description, amount, image FROM products WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $update_id, PDO::PARAM_INT);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Edit Product</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/sidebar.php'; ?>

    <div class="app-content">
        <div class="tile">
            <div class="tile-body">
                <h3>Edit Product</h3>
                <?php if ($msg): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlentities($msg); ?>
                    </div>
                <?php endif; ?>
                <?php if ($errormsg): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlentities($errormsg); ?>
                    </div>
                <?php endif; ?>
                <hr>
                <?php if (!empty($product)): ?>
                    <!-- Update Product Form -->
                    <form method="post" action="">
                        <input type="hidden" name="update_id" value="<?php echo $product->id; ?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlentities($product->title); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" required><?php echo htmlentities($product->description); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control" value="<?php echo htmlentities($product->amount); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Image URL</label>
                            <input type="file" name="image" class="form-control" value="<?php echo htmlentities($product->image); ?>" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">
                        Product not found
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
</body>
</html>
