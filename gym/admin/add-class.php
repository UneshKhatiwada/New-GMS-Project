<?php
session_start();
error_reporting(E_ALL); // Enable error reporting for debugging
ini_set('display_errors', 1);

include 'include/config.php'; 

$msg = ''; // Initialize $msg variable
$errormsg = ''; // Initialize $errormsg variable

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit; // Make sure the script stops executing after redirect
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'insert') {
      $title = $_POST['title'];
      $description = $_POST['description'];

      // Handle file upload
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
          $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
          $uploadFileDir = './uploads/';
          $dest_path = $uploadFileDir . $newFileName;

          if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $msg = "File is successfully uploaded.";
          } else {
            $errormsg = "There was an error moving the file to the upload directory.";
          }
        } else {
          $errormsg = "Upload failed. Allowed file types: jpg, jpeg, png, gif.";
        }
      } else {
        $errormsg = "No file uploaded or there was an upload error.";
      }

      // Insert data into the database
      $sql = "INSERT INTO tblclasses (title, description, image) 
              VALUES (:title, :description, :image)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':title', $title, PDO::PARAM_STR);
      $query->bindParam(':description', $description, PDO::PARAM_STR);
      $query->bindParam(':image', $newFileName, PDO::PARAM_STR);

      if ($query->execute()) {
        $msg = "Class Added Successfully";
      } else {
        $errormsg = "Error adding class.";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Classes</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
  <?php include 'include/header.php'; ?>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">
    <h3>Classes</h3>
    <hr />
    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <?php if ($msg) { ?>
          <div class="alert alert-success" role="alert">
            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
          </div>
          <?php } ?>

          <?php if ($errormsg) { ?>
          <div class="alert alert-danger" role="alert">
            <strong>Oh snap!</strong> <?php echo htmlentities($errormsg); ?>
          </div>
          <?php } ?>

          <div class="tile-body">
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="action" value="insert">
              <div class="form-group col-md-12">
                <label class="control-label">Title</label>
                <input class="form-control" name="title" type="text" placeholder="Enter Title" required>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Image</label>
                <input class="form-control" name="image" type="file" required>
              </div>
              <div class="form-group col-md-4 align-self-end">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
<?php } ?>
