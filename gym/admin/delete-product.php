<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login if admin session not set
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Perform deletion
    $sql = "DELETE FROM products WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $delete_id, PDO::PARAM_INT);
    $query->execute();

    // Check if deletion was successful
    if ($query->rowCount() > 0) {
        $msg = "Product deleted successfully";
    } else {
        $errormsg = "Failed to delete product";
    }
}

// Redirect back to manage-products.php after deletion
header("Location: manage-product.php");
exit();
?>
