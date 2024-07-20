<?php  session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Admin | Dashboard</title>
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
    <?php include './include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include './include/sidebar.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
          
        <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totaluser FROM tbluser;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                       <a href="manage-users.php">  
          <div class="widget-small info coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Registered Users</h4>
              <p><b><?php echo $result->totaluser;?></b></p>
            </div>
          </div></a>
            <?php  } ?>
        </div>

  <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalorder FROM orders;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                       <a href="manage-order.php">  
                       <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x "></i>
            <div class="info">
              <h4>Total Membership</h4>
              <p><b><?php echo $result->totalorder;?></b></p>
            </div>
          </div></a>
            <?php  } ?>
        </div>


        <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totaltrainer FROM trainers;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>

                   <a href="manage-trainers.php">  
                   <div class="widget-small danger coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>Total Trainer</h4>
              <p><b><?php echo $result->totaltrainer;?></b></p>
            </div>
          </div>
        </a>
            <?php  $cnt=$cnt+1; } } ?>
        </div>
      

        <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalclass FROM tblclasses;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                  <a href="manage-class.php"> 
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file fa-3x"></i>
            <div class="info">
              <h4>Total Classes</h4>
              <p><b><?php echo $result->totalclass;?></b></p>
            </div>
          </div>
        </a>
            <?php  } ?>
        </div>

    <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalproduct FROM products";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                  <a href="manage-product.php"> 
                  <div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Total Packages</h4>
              <p><b><?php echo $result->totalproduct;?></b></p>
            </div>
          </div>
        </a>
            <?php  } ?>
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