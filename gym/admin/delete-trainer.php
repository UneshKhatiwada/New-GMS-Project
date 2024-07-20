<?php
session_start();
error_reporting(E_ALL); // Enable error reporting for debugging
ini_set('display_errors', 1);

include 'include/config.php';

// Check if admin is logged in
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

// Check if 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute deletion query
    $sql = "DELETE FROM trainers WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        if ($query->rowCount() > 0) {
            // Record deleted successfully
            $msg = "Trainer deleted successfully";
        } else {
            // No record found with the provided ID
            $errormsg = "Trainer not found";
        }
    } else {
        // Query execution failed
        $errormsg = "Failed to delete trainer";
    }

    // Redirect to manage-trainers.php after deletion
    header('location: manage-trainers.php');
    exit();
} else {
    // If 'id' is not provided in the URL, redirect to manage-trainers.php
    header('location: manage-trainers.php');
    exit();
}
?>
