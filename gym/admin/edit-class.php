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
        $image = $_FILES['image']['name'];
        
        // Handle image upload
        if ($image) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                $errormsg = "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                $errormsg = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $errormsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $errormsg = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // File is uploaded successfully
                } else {
                    $errormsg = "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Perform update
        $sql = "UPDATE tblclasses SET title = :title, description = :description" . ($image ? ", image = :image" : "") . " WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        if ($image) {
            $query->bindParam(':image', $image, PDO::PARAM_STR);
        }
        $query->bindParam(':id', $update_id, PDO::PARAM_INT);
        $query->execute();

        // Check if update was successful
        if ($query->rowCount() > 0) {
            $msg = "Class updated successfully";
            header('location: manage-class.php');
            exit();
        } else {
            $errormsg = "Failed to update class";
        }
    }
}

// Fetch class details if update_id is provided
$update_id = isset($_GET['update_id']) ? $_GET['update_id'] : '';
if (!empty($update_id)) {
    $sql = "SELECT id, title, description, image FROM tblclasses WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $update_id, PDO::PARAM_INT);
    $query->execute();
    $class = $query->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Edit Class</title>
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
                <h3>Edit Class</h3>
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
                <?php if (!empty($class)): ?>
                    <!-- Update Class Form -->
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="update_id" value="<?php echo $class->id; ?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlentities($class->title); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" required><?php echo htmlentities($class->description); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image (Current: <img src="uploads/<?php echo htmlentities($class->image); ?>" alt="<?php echo htmlentities($class->title); ?>" style="width: 100px; height: auto;">)</label>
                            <input type="file" name="image" class="form-control">
                            <input type="hidden" name="existing_image" value="<?php echo htmlentities($class->image); ?>">
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update Class</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">
                        Class not found
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
