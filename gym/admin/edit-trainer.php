<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Use $id instead of $pid
    if (isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $specialization = $_POST['specialization'];
        $experience = $_POST['experience'];

        $sql = "UPDATE trainers SET name=:name, email=:email, phone=:phone, specialization=:specialization, experience=:experience WHERE id=:id";

        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':experience', $experience, PDO::PARAM_INT);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        // Message after update
        $msg = "Trainer record updated successfully";

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
    // If no id is provided in GET, redirect to manage-trainers.php
    header('location: manage-trainers.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a">
    <title>Admin | Edit Trainer</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
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

                        <form class="row" method="post">
                            <div class="form-group col-md-6">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" type="text" placeholder=""
                                    value="<?php echo htmlentities($result->name); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Email</label>
                                <input class="form-control" name="email" type="email"
                                    placeholder="" value="<?php echo htmlentities($result->email); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Phone</label>
                                <input class="form-control" name="phone" type="text" placeholder=""
                                    value="<?php echo htmlentities($result->phone); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Specialization</label>
                                <input class="form-control" name="specialization" type="text"
                                    placeholder=""
                                    value="<?php echo htmlentities($result->specialization); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Experience (years)</label>
                                <input class="form-control" name="experience" type="text"
                                    placeholder="" value="<?php echo htmlentities($result->experience); ?>">
                            </div>

                            <div class="form-group col-md-4 align-self-end">
                                <input type="submit" name="Submit" id="Submit" class="btn btn-primary"
                                    value="Update">
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
</body>

</html>
