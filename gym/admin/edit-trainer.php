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

    if (isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $specialization = $_POST['specialization'];
        $imageUpdate = false;
        $newImageName = '';

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileType = $_FILES['image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Define allowed file extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Set the new file name
                $newImageName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $newImageName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $imageUpdate = true;
                } else {
                    $errormsg = "Error moving the file to the upload directory.";
                }
            } else {
                $errormsg = "Upload failed. Allowed file types: jpg, jpeg, png, gif.";
            }
        }

        // Prepare SQL update statement
        if ($imageUpdate) {
            $sql = "UPDATE trainers SET name=:name, specialization=:specialization, image=:image WHERE id=:id";
        } else {
            $sql = "UPDATE trainers SET name=:name, specialization=:specialization WHERE id=:id";
        }
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        if ($imageUpdate) {
            $query->bindParam(':image', $newImageName, PDO::PARAM_STR);
        }
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if ($query->execute()) {
            $msg = "Trainer record updated successfully";
        } else {
            $errormsg = "Failed to update trainer";
        }

        // Redirect to manage-trainers.php after update
        header('location: manage-trainers.php');
        exit();
    }

    // Fetch data for the selected trainer
    $sql_select = "SELECT * FROM trainers WHERE id = :id";
    $query_select = $dbh->prepare($sql_select);
    $query_select->bindParam(':id', $id, PDO::PARAM_INT);
    $query_select->execute();
    $result = $query_select->fetch(PDO::FETCH_OBJ);
} else {
    // If 'id' is not provided in the URL, redirect to manage-trainers.php
    header('location: manage-trainers.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Edit Trainer</title>
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar -->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h3 class="tile-title">Update Trainer</h3>

                        <?php if (isset($msg)) { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> <?php echo htmlentities($msg); ?>
                        </div>
                        <?php } ?>

                        <?php if (isset($errormsg)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error!</strong> <?php echo htmlentities($errormsg); ?>
                        </div>
                        <?php } ?>

                        <form class="row" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter name"
                                    value="<?php echo htmlentities($result->name); ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Specialization</label>
                                <input class="form-control" name="specialization" type="text"
                                    placeholder="Enter specialization"
                                    value="<?php echo htmlentities($result->specialization); ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Current Image</label>
                                <br>
                                <?php if ($result->image) { ?>
                                    <img src="./uploads/<?php echo htmlentities($result->image); ?>" alt="Trainer Image" style="width: 150px; height: auto;">
                                <?php } else { ?>
                                    <p>No image available</p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Upload New Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>

                            <div class="form-group col-md-4 align-self-end">
                                <input type="submit" name="Submit" id="Submit" class="btn btn-primary" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential JavaScript for application to work -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
</body>

</html>
