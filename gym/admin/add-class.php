<?php 
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
} else {
  $msg = "";
  $errormsg = "";

  if (isset($_POST['submit'])) {
    $addPackage = $_POST['addPackage'];
    $category = $_POST['category'];
    $packageId = $_POST['packageId'];

    if ($packageId) {
      // Update existing package
      $sql = "UPDATE tblpackage SET PackageName = :Package, cate_id = :category WHERE id = :packageId";
      $query = $dbh->prepare($sql);
      $query->bindParam(':Package', $addPackage, PDO::PARAM_STR);
      $query->bindParam(':category', $category, PDO::PARAM_STR);
      $query->bindParam(':packageId', $packageId, PDO::PARAM_STR);
      $query->execute();
      header("location: add-class.php");
      
    } else {
      // Insert new package
      $sql = "INSERT INTO tblpackage (PackageName, cate_id) VALUES (:Package, :category)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':Package', $addPackage, PDO::PARAM_STR);
      $query->bindParam(':category', $category, PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if ($lastInsertId > 0) {
        header("location: add-class.php");
      } else {
        $errormsg = "Data not inserted successfully";
      }
    }
  }

  // Delete Record Data
  if (isset($_REQUEST['del'])) {
    $uid = intval($_GET['del']);
    $sql = "DELETE FROM tblpackage WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $uid, PDO::PARAM_STR);
    $query->execute();
    header("location: add-class.php");
  }

  // Fetch all packages for display
  $sql = "SELECT tblpackage.*, tblcategory.category_name FROM tblpackage 
          JOIN tblcategory ON tblpackage.cate_id = tblcategory.id";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="Vali is a">
  <title>Admin | Add Package Type</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript">
    function confirmDelete(delUrl) {
      if (confirm("Are you sure you want to delete this package?")) {
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
    <h3>Manage Package</h3>
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

          <?php 
            $packageId = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
            if ($packageId) {
              // Fetch package details for editing
              $sql = "SELECT * FROM tblpackage WHERE id = :id";
              $query = $dbh->prepare($sql);
              $query->bindParam(':id', $packageId, PDO::PARAM_INT);
              $query->execute();
              $result = $query->fetch(PDO::FETCH_OBJ);
              $addPackage = $result ? $result->PackageName : '';
              $category = $result ? $result->cate_id : '';
            } else {
              $addPackage = '';
              $category = '';
            }
          ?>

          <form class="row" method="post">
            <div class="form-group col-md-12">
              <label class="control-label">Classes</label>
              <select class="form-control" name="category" id="category" placeholder="Enter Class">
                <option value="NA">--select--</option>
                <?php 
                  $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                  $stmt->execute();
                  $countriesList = $stmt->fetchAll();
                  foreach($countriesList as $country){
                    $selected = ($country['id'] == $category) ? 'selected' : '';
                    echo "<option value='".$country['id']."' $selected>".$country['category_name']."</option>";
                  }
                ?>
              </select>
            </div>

            <div class="form-group col-md-12">
              <label class="control-label">Package</label>
              <input class="form-control" name="addPackage" id="addPackage" type="text" placeholder="Enter Package Type" value="<?php echo htmlentities($addPackage); ?>">
              <input type="hidden" name="packageId" value="<?php echo $packageId; ?>">
            </div>
            <div class="form-group col-md-4 align-self-end">
              <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
            </div>
          </form>
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
                  <th>Category</th>
                  <th>Class Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $cnt = 1;
                  foreach ($results as $result) {
                ?>
                <tr>
                  <td><?php echo $cnt++; ?></td>
                  <td><?php echo htmlentities($result->category_name); ?></td>
                  <td><?php echo htmlentities($result->PackageName); ?></td>
                  <td>
                    <a href="add-class.php?cid=<?php echo htmlentities($result->id); ?>"><button class="btn btn-primary" type="button">Edit</button></a> 
                    <a href="javascript:confirmDelete('add-class.php?del=<?php echo htmlentities($result->id); ?>')"><button class="btn btn-danger" type="button">Delete</button></a>
                  </td>
                </tr>
                <?php } ?>
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
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
</body>
</html>
<?php } ?>
