<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../include/config.php'; // Adjust the path if necessary
require '../../vendor/autoload.php'; // Adjust the path to correctly point to autoload.php

use Dompdf\Dompdf;

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

// Check if the export to PDF button was clicked
if (isset($_POST['export_pdf'])) {
    $html = '<h3>Orders List</h3>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>ID</th>';
    $html .= '<th>Invoice No</th>';
    $html .= '<th>Product ID</th>';
    $html .= '<th>Total</th>';
    $html .= '<th>Status</th>';
    $html .= '<th>Created At</th>';
    $html .= '<th>User Name</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($orders as $order) {
        $html .= '<tr>';
        $html .= '<td>' . htmlentities($order->id) . '</td>';
        $html .= '<td>' . htmlentities($order->invoice_no) . '</td>';
        $html .= '<td>' . htmlentities($order->product_id) . '</td>';
        $html .= '<td>' . htmlentities($order->total) . '</td>';
        $html .= '<td>' . htmlentities($order->status) . '</td>';
        $html .= '<td>' . htmlentities($order->created_at) . '</td>';
        $html .= '<td>' . htmlentities($order->fname . ' ' . $order->lname) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    // Initialize Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF (1 = download and 0 = preview)
    $dompdf->stream("orders.pdf", array("Attachment" => 0));
    exit();
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
                <form method="post">
                    <button type="submit" name="export_pdf" class="btn btn-primary">Export to PDF</button>
                </form>
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
