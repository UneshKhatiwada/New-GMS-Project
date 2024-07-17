<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

$error = '';
$msg = '';

try {
    // Fetch orders with user information using LEFT JOIN
    $sql = "SELECT o.id, o.invoice_no, o.product_id, o.total, o.status, o.created_at, u.fname, u.lname
            FROM orders o
            LEFT JOIN tbluser u ON o.user_id = u.id";

    $query = $dbh->prepare($sql);
    $query->execute();
    $orders = $query->fetchAll(PDO::FETCH_OBJ);

    // Handle delete operation
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        // Perform deletion
        $deleteSql = "DELETE FROM orders WHERE id = :id";
        $deleteQuery = $dbh->prepare($deleteSql);
        $deleteQuery->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $deleteQuery->execute();

        // Check if deletion was successful
        if ($deleteQuery->rowCount() > 0) {
            $msg = "Order deleted successfully";
        } else {
            $error = "Failed to delete order";
        }
    }
} catch (PDOException $e) {
    $error = "Error fetching orders: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Manage Orders</title>
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
                <h3>Manage Orders</h3>
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlentities($error); ?>
                    </div>
                <?php endif; ?>
                <?php if ($msg): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlentities($msg); ?>
                    </div>
                <?php endif; ?>
                <hr>
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Invoice No</th>
                            <th>Product ID</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>User Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlentities($order->id); ?></td>
                                <td><?php echo htmlentities($order->invoice_no); ?></td>
                                <td><?php echo htmlentities($order->product_id); ?></td>
                                <td><?php echo htmlentities($order->total); ?></td>
                                <td><?php echo htmlentities($order->status); ?></td>
                                <td><?php echo htmlentities($order->created_at); ?></td>
                                <td><?php echo htmlentities($order->fname . ' ' . $order->lname); ?></td>
                                <td>
                                    <a href="manage-orders.php?delete_id=<?php echo $order->id; ?>" onclick="return confirm('Are you sure you want to delete this order?');" class="btn btn-danger btn-sm">Delete</a>
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
        $(document).ready(function() {
            $('#sampleTable').DataTable();
        });
    </script>
</body>
</html>
