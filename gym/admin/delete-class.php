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

    // Fetch the image for deletion
    $sql = "SELECT image FROM tblclasses WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $delete_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        // Delete the record
        $sql = "DELETE FROM tblclasses WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $query->execute();

        // Check if deletion was successful
        if ($query->rowCount() > 0) {
            // Delete the image file if it exists
            $image_path = 'uploads/' . $result->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $msg = "Class deleted successfully";
        } else {
            $errormsg = "Failed to delete class";
        }
    } else {
        $errormsg = "Class not found";
    }
}

// Redirect back to manage-class.php after deletion
header("Location: manage-class.php");
exit();
?>
