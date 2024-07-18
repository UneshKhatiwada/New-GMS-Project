<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = "";

// Process login form submission
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = md5($_POST['password']); // Note: Consider using more secure methods for password hashing and storage

    if ($email != "" && $password != "") {
        try {
            $query = "select id, fname, lname, email, mobile, password, address, create_date from tbluser where email=:email and password=:password";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($count == 1 && !empty($row)) {
                $_SESSION['uid']   = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name']  = $row['fname'];
                header("location: pricing.php");
            } else {
                $msg = "Invalid username and password!";
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
        $msg = "Both fields are required!";
    }
}

// Google OAuth setup
require_once '../vendor/autoload.php'; // Path to autoload.php

$client = new Google_Client();
$client->setClientId('666589304359-4t6mpj1cirtddgnfu5ogsjpct26omjue.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/GMS/gym/pricing.php'); // Adjust as per your setup
$client->addScope('email');
$client->addScope('profile');

$auth_url = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        /* Add your CSS styles here */
        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 87vh;
        }

        #Box {
            width: 300px;
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            margin-top: 41px;
            border: 1px solid black;
            border-radius: 9px;
        }

        #submit {
            background-color: #428f9d;
            color: white;
            border: none;
            border-radius: 3px;
        }

        #inpt {
            padding-bottom: 10px;
        }

        #In {
            margin-bottom: 52px;
        }

        /* Add other styles as needed */
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include 'include/header.php'; ?>

    <!-- Login Section -->
    <div id="container">
        <div id="Box">
            <div>
                <h3>User</h3>
                <p>Login</p>
            </div>
            <?php if ($msg) : ?>
                <div class="errorWrap" style="color: red;">
                    <strong>Error:</strong> <?php echo htmlentities($msg); ?>
                </div>
            <?php endif; ?>
            <div>
                <form method="post">
                    <div id="forms">
                        <div id="inpt" class="mb-2">
                            <input type="text" name="email" id="email" placeholder="Enter Your Email" autocomplete="off" required>
                        </div>
                        <div id="inpt" class="mb-2">
                            <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off" required>
                        </div>
                        <div class="mb-2">
                            <input type="submit" id="submit" name="submit" value="Login" class="btn btn-primary">
                        </div>
                    </div>
                    <p>Create an account <a href="registration.php" style="text-decoration:none;">Register</a></p>
                </form>

                <!-- Google Login Button -->

                <a href="<?php echo $auth_url; ?>" class="btn btn-outline-danger btn-block">
                    <i class="fab fa-google"></i> Login with Google
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
</body>

</html>