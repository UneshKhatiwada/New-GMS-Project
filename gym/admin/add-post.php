<?php 
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit();
}

$msg = "";
$errormsg = "";

if (isset($_POST['Submit'])) {
  $category = $_POST['category'];
  $titlename = $_POST['titlename'];
  $package = $_POST['package'];
  $Packageduration = $_POST['Packageduration'];
  $Price = $_POST['Price'];
  // Handle file upload if needed
  // $photo = $_FILES['photo']['name'];
  // move_uploaded_file($_FILES['photo']['tmp_name'],"photos/".$photo);
  $photo = ''; // Update this with file handling logic if needed
  $description = $_POST['description'];

  $sql = "INSERT INTO tbladdpackage (category, titlename, PackageType, PackageDuration, Price, Description) 
          VALUES (:category, :titlename, :package, :Packageduration, :Price, :description)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':category', $category, PDO::PARAM_STR);
  $query->bindParam(':titlename', $titlename, PDO::PARAM_STR);
  $query->bindParam(':package', $package, PDO::PARAM_STR);
  $query->bindParam(':Packageduration', $Packageduration, PDO::PARAM_STR);
  $query->bindParam(':Price', $Price, PDO::PARAM_STR);
  $query->bindParam(':description', $description, PDO::PARAM_STR);

  if ($query->execute()) {
    $msg = "Package Added Successfully";
    echo "<script>alert('Package Added successfully.');</script>";
    echo "<script> window.location.href='manage-post.php';</script>";
    exit();
  } else {
    $errormsg = "Failed to add package";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="Vali is a">
  <title>Admin | Add Package</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <?php include 'include/header.php'; ?>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">
    <h3>Add Package</h3>
    <hr/>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <!-- Success and Error Messages -->
          <?php if ($msg) { ?>
          <div class="alert alert-success" role="alert">
            <strong>Success!</strong> <?php echo htmlentities($msg); ?>
          </div>
          <?php } ?>
          <?php if ($errormsg) { ?>
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?php echo htmlentities($errormsg); ?>
          </div>
          <?php } ?>

          <div class="tile-body">
            <form class="row" method="post">
              <div class="form-group col-md-6">
                <label class="control-label">Category</label>
                <select name="category" id="category" class="form-control" onchange="getdistrict(this.value);">
                  <option value="NA">--select--</option>
                  <?php 
                  $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                  $stmt->execute();
                  $countriesList = $stmt->fetchAll();
                  foreach($countriesList as $country) {
                    echo "<option value='".$country['id']."'>".$country['category_name']."</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Package Type</label>
                <select name="package" id="package" class="form-control">
                  <option value="NA">--select--</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Title Name</label>
                <input class="form-control" name="titlename" id="titlename" type="text" placeholder="Enter your Title Name">
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Package Duration</label>
                <input class="form-control" type="text" name="Packageduration" placeholder="Enter Package Duration">
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Price</label>
                <input class="form-control" type="text" name="Price" id="Price" placeholder="Enter your Price">
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Description</label>
                <textarea name="description" id="description" class="form-control" cols="5" rows="10"></textarea> 
              </div>

              <div class="form-group col-md-4 align-self-end">
                <input type="submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
              </div>
            </form>
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
  <!-- NicEdit Editor -->
  <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
  <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
  <!-- jQuery for AJAX -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- AJAX Script to Fetch Package Types -->
  <script>
    function getdistrict(val) {
      $.ajax({
        type: "POST",
        url: "ajaxfile.php",
        data: 'category='+val,
        success: function(data) {
          $("#package").html(data);
        }
      });
    }
  </script>
</body>
</html>
