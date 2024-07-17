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
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $specialization = $_POST['specialization'];
  $experience = $_POST['experience'];

  $sql = "INSERT INTO trainers (name, email, phone, specialization, experience) 
          VALUES (:name, :email, :phone, :specialization, :experience)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':name', $name, PDO::PARAM_STR);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':phone', $phone, PDO::PARAM_STR);
  $query->bindParam(':specialization', $specialization, PDO::PARAM_INT);
  $query->bindParam(':experience', $experience, PDO::PARAM_INT);

  if ($query->execute()) {
    $msg = "Trainer Added Successfully";
    echo "<script>alert('Trainer Added successfully.');</script>";
    echo "<script> window.location.href='manage-trainers.php';</script>";
    exit();
  } else {
    $errormsg = "Failed to add trainer";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="Vali is a">
  <title>Admin | Add Trainer</title>
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
    <h3>Add Trainer</h3>
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
              <div class="form-group col-md-12">
                <label class="control-label">Name</label>
                <input class="form-control" name="name" id="name" type="text" placeholder="Enter Trainer Name" required>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label">Email</label>
                <input class="form-control" name="email" id="email" type="email" placeholder="Enter Trainer Email" required>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label">Phone</label>
                <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter Trainer Phone">
              </div>

              <div class="form-group col-md-12">
                <label class="control-label">Specialization</label>
                <select name="specialization" id="specialization" class="form-control" required>
                  <option value="">-- Select Specialization --</option>
                  <option value="1">Yoga</option>
                  <option value="2">Body Building</option>
                  <option value="3">Weight Lifting</option>
                  <option value="4">Cardio</option>
                  <option value="5">Fitness Bootcamp</option>
                  <option value="6">Zumba & Dance</option>
                  <!-- Add more options as needed -->
                </select>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label">Experience</label>
                <input class="form-control" name="experience" id="experience" type="number" placeholder="Enter Trainer Experience">
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
</body>
</html>
