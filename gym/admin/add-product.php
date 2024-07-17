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
      $image = $_POST['image'];
      $amount = $_POST['amount'];

      $sql = "INSERT INTO products (title, description, image, amount) 
              VALUES (:title, :description, :image, :amount)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':title', $title, PDO::PARAM_STR);
      $query->bindParam(':description', $description, PDO::PARAM_STR);
      $query->bindParam(':image', $image, PDO::PARAM_STR);
      $query->bindParam(':amount', $amount, PDO::PARAM_STR);
      
      if ($query->execute()) {
        $msg = "Product Added Successfully";
      } else {
        $errormsg = "Error adding product.";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Products</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
  <?php include 'include/header.php'; ?>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">
    <h3>Products</h3>
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
            <form method="post">
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
                <label class="control-label">Image URL</label>
                <input class="form-control" name="image" type="file" placeholder="Enter Image URL" required>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Amount</label>
                <input class="form-control" name="amount" type="number" placeholder="Enter Amount" required>
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
