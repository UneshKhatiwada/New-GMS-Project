<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login if admin session not set
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

// Fetch all products
$sql = "SELECT id, title, description, amount, image FROM products";
$query = $dbh->prepare($sql);
$query->execute();
$products = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Manage Products</title>
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
                <h3>Manage Packages</h3>
                <hr>
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo htmlentities($product->id); ?></td>
                                <td><?php echo htmlentities($product->title); ?></td>
                                <td><?php echo htmlentities($product->description); ?></td>
                                <td><?php echo htmlentities($product->amount); ?></td>
                                <td><img src="<?php echo htmlentities($product->image); ?>" alt="<?php echo htmlentities($product->title); ?>" style="width: 100px; height: auto;"></td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="edit-product.php?update_id=<?php echo $product->id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <!-- Delete Button -->
                                    <a href="delete-product.php?delete_id=<?php echo $product->id; ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    <!-- Data table plugin-->
    <script src="js/plugins/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
</body>
</html>
