<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete record from trainers table
    $sql = "DELETE FROM trainers WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    // Check if deletion was successful
    if ($query->rowCount() > 0) {
        // Record deleted successfully
        $msg = "Trainer deleted successfully";
    } else {
        // Failed to delete record
        $errormsg = "Failed to delete trainer";
    }

    // Redirect to manage-trainers.php after deletion
    header('location: manage-trainers.php');
    exit();
} else {
    // If no pid is provided in GET, redirect to manage-trainers.php
    header('location: manage-trainers.php');
    exit();
}
?>
