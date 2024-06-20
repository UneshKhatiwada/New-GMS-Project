<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Delete record from tbladdpackage table
    $sql = "DELETE FROM tbladdpackage WHERE id = :pid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pid', $pid, PDO::PARAM_INT);
    $query->execute();

    // Check if deletion was successful
    if ($query->rowCount() > 0) {
        // Record deleted successfully
        $msg = "Record deleted successfully";
    } else {
        // Failed to delete record
        $errormsg = "Failed to delete record";
    }

    // Redirect to manage-post.php after deletion
    header('location: manage-post.php');
    exit();
} else {
    // If no pid is provided in GET, redirect to manage-post.php
    header('location: manage-post.php');
    exit();
}
?>
