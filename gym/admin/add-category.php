<?php 
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $categoryId = $_POST['categoryId'];

    if ($categoryId) {
      // Update existing category
      $sql = "UPDATE tblcategory SET category_name = :category WHERE id = :categoryId";
      $query = $dbh->prepare($sql);
      $query->bindParam(':category', $category, PDO::PARAM_STR);
      $query->bindParam(':categoryId', $categoryId, PDO::PARAM_STR);
      $query->execute();
      $msg = "Category Updated Successfully";
    } else {
      // Insert new category
      $sql = "INSERT INTO tblcategory (category_name) VALUES (:category)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':category', $category, PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if ($lastInsertId > 0) {
        $msg = "Category Added Successfully";
      } else {
        $errormsg = "Data not inserted successfully";
      }
    }
  }

  // Delete Record Data
  if (isset($_REQUEST['del'])) {
    $uid = intval($_GET['del']);
    $sql = "DELETE FROM tblcategory WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $uid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Record deleted successfully');</script>";
    echo "<script>window.location.href='add-category.php'</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="">
  <title>Admin | Categories</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript">
    function confirmDelete(delUrl) {
      if (confirm("Are you sure you want to delete this category?")) {
        document.location = delUrl;
      }
    }
  </script>
</head>
<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <?php include 'include/header.php'; ?>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">
    <h3>Manage Classes</h3>
    <hr />
    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <!---Success Message--->
          <?php if ($msg) { ?>
          <div class="alert alert-success" role="alert">
            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
          </div>
          <?php } ?>

          <!---Error Message--->
          <?php if ($errormsg) { ?>
          <div class="alert alert-danger" role="alert">
            <strong>Oh snap!</strong> <?php echo htmlentities($errormsg); ?>
          </div>
          <?php } ?>

          <div class="tile-body">
            <?php 
              $categoryId = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
              if ($categoryId) {
                $sql = "SELECT * FROM tblcategory WHERE id = :id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':id', $categoryId, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_OBJ);
                $categoryName = $result ? $result->category_name : '';
              } else {
                $categoryName = '';
              }
            ?>
            <form method="post">
              <div class="form-group col-md-12">
                <label class="control-label">Class Name</label>
                <input class="form-control" name="category" id="category" type="text" placeholder="Enter Class" value="<?php echo htmlentities($categoryName); ?>">
                <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>">
              </div>
              <div class="form-group col-md-4 align-self-end">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
                $sql = "SELECT * FROM tblcategory";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
              ?>
              <tbody>
                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><?php echo htmlentities($result->category_name); ?></td>
                  <td>
                    <a href="add-category.php?cid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-primary" type="button">Update</button></a>
                    <a href="javascript:confirmDelete('add-category.php?del=<?php echo htmlentities($result->id); ?>')"><button class="btn btn-danger" type="button">Delete</button></a>
                  </td>
                </tr>
                <?php $cnt++; } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
</body>
</html>
<?php } ?>
