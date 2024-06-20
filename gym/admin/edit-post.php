<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    if (isset($_POST['Submit'])) {
        $category = $_POST['category'];
        $titlename = $_POST['titlename'];
        $package = $_POST['package'];
        $packageduration = $_POST['packageduration'];
        $Price = $_POST['Price'];
        $description = $_POST['description'];

        $sql = "UPDATE tbladdpackage SET category=:category, titlename=:titlename, PackageType=:package, 
                packageduration=:packageduration, Price=:Price, Description=:description WHERE id=:pid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_INT);
        $query->bindParam(':titlename', $titlename, PDO::PARAM_STR);
        $query->bindParam(':package', $package, PDO::PARAM_INT);
        $query->bindParam(':packageduration', $packageduration, PDO::PARAM_STR);
        $query->bindParam(':Price', $Price, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':pid', $pid, PDO::PARAM_INT);
        $query->execute();

        // Message after update
        $msg = "Record updated successfully";

        // Redirect to manage-post.php after update
        header('location: manage-post.php');
        exit();
    }

    // Fetch data for the selected package
    $sql_select = "SELECT t1.*, t2.category_name, t3.PackageName FROM tbladdpackage as t1
                    JOIN tblcategory as t2 ON t1.category = t2.id
                    JOIN tblpackage as t3 ON t1.PackageType = t3.id
                    WHERE t1.id = :pid";
    $query_select = $dbh->prepare($sql_select);
    $query_select->bindParam(':pid', $pid, PDO::PARAM_INT);
    $query_select->execute();
    $result = $query_select->fetch(PDO::FETCH_OBJ);
} else {
    // If no pid is provided in GET, redirect to manage-post.php
    header('location: manage-post.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a">
    <title>Vyayamlaya</title>
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
                        <h3 class="tile-title">Update Post</h3>

                        <?php if (isset($msg)) { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> <?php echo htmlentities($msg); ?>
                        </div>
                        <?php } ?>

                        <form class="row" method="post">
                            <div class="form-group col-md-6">
                                <label class="control-label">Category</label>
                                <select name="category" id="category" class="form-control"
                                    onChange="getPackages(this.value);">
                                    <option value="<?php echo $result->category; ?>"><?php echo $result->category_name; ?>
                                    </option>
                                    <option value="NA">--select--</option>
                                    <?php
                                    $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                                    $stmt->execute();
                                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($categories as $category) {
                                        echo "<option value='" . $category['id'] . "'>" . $category['category_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Package Type</label>
                                <select name="package" id="package" class="form-control">
                                    <option value="<?php echo $result->PackageType; ?>"><?php echo $result->PackageName; ?></option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Title Name</label>
                                <input class="form-control" name="titlename" id="titlename" type="text"
                                    placeholder="Enter your Title Name" value="<?php echo $result->titlename; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Package Duration</label>
                                <input class="form-control" type="text" name="packageduration"
                                    placeholder="Enter Package Duration"
                                    value="<?php echo $result->packageduration; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Price</label>
                                <input class="form-control" type="text" name="Price" id="Price"
                                    placeholder="Enter your Price" value="<?php echo $result->Price; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Description</label>
                                <textarea name="description" id="description" class="form-control"
                                    cols="5"><?php echo $result->Description; ?></textarea>
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
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);

    function getPackages(val) {
        $.ajax({
            type: "POST",
            url: "ajaxfile.php",
            data: 'category=' + val,
            success: function(data) {
                $("#package").html(data);
            }
        });
    }
    </script>
</body>

</html>
