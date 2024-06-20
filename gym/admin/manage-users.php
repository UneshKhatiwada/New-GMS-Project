<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Perform deletion
    $sql = "DELETE FROM tbluser WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $delete_id, PDO::PARAM_INT);
    $query->execute();

    // Check if deletion was successful
    if ($query->rowCount() > 0) {
        $msg = "User deleted successfully";
    } else {
        $errormsg = "Failed to delete user";
    }
}

// Fetch required user details
$sql = "SELECT id, fname, lname, mobile, state, city, create_date FROM tbluser";
$query = $dbh->prepare($sql);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Manage Users</title>
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
                <h3>Manage Users</h3>
                <?php if (isset($msg)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlentities($msg); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($errormsg)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlentities($errormsg); ?>
                    </div>
                <?php endif; ?>
                <hr>
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlentities($user->id); ?></td>
                                <td><?php echo htmlentities($user->fname); ?></td>
                                <td><?php echo htmlentities($user->lname); ?></td>
                                <td><?php echo htmlentities($user->mobile); ?></td>
                                <td><?php echo htmlentities($user->state); ?></td>
                                <td><?php echo htmlentities($user->city); ?></td>
                                <td><?php echo htmlentities($user->create_date); ?></td>
                                <td>
                                    <a href="manage-users.php?delete_id=<?php echo $user->id; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
  <!-- Data table plugin-->
  <script src="js/plugins/jquery.dataTables.min.js"></script>
  <script src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>
</body>
</html>
