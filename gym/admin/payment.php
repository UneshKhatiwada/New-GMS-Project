<?php
include "settingpayment.php";
?>
<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{ 
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height viewport */
        }
        .card {
            width: 400px;
        }
    </style>
</head>

<body class="app sidebar-mini rtl">
<?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <div class="center-container">
        <div class="card">
            <div class="card-body">
                <div class="card-title text-center fw-bold fs-2" >
                    <h1>Payment</h1>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="package_id">Package</label>
                        <select id="package_id" name="package_id" class="form-control" required>
                            <?php foreach ($packages as $package) { ?>
                                <option value="<?php echo $package['id']; ?>"><?php echo $package['package_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userid">User</label>
                        <select id="userid" name="userid" class="form-control" required>
                            <?php foreach ($users as $user) { ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment">Payment Amount</label>
                        <input type="number" id="payment" name="payment" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentType">Payment Type</label>
                        <input type="text" id="paymentType" name="paymentType" class="form-control" required>
                    </div>
                </form>
                <form action="<?php echo $epay_url ?>" method="POST">
                    <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>" required>
                    <input type="hidden" id="tax_amount" name="tax_amount" value="<?php echo $tax_amount; ?>" required>
                    <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total_amount; ?>" required>
                    <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>" required>
                    <input type="hidden" id="product_code" name="product_code" value="<?php echo $product_code; ?>" required>
                    <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                    <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                    <input type="hidden" id="success_url" name="success_url" value="<?php echo $success_url; ?>" required>
                    <input type="hidden" id="failure_url" name="failure_url" value="<?php echo $failure_url; ?>" required>
                    <input type="hidden" id="signed_field_names" name="signed_field_names" value="<?php echo $signed_field_names; ?>" required>
                    <input type="hidden" id="signature" name="signature" value="<?php echo $signature; ?>" required>
                    <input value="Pay with esewa" type="submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
<?php } ?>
