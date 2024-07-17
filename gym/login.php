<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = md5(($_POST['password']));
  if($email != "" && $password != "") {
    try {
      $query = "select id, fname, lname, email, mobile, password, address, create_date from tbluser where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['uid']   = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['fname'];
       header("location: pricing.php");
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Vyayamlaya</title>
    <meta charset="UTF-8">
    <style>
    #container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 87vh;
    }

    #Box {
        width: 300px;
        height: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 120px;
        margin-top: 121px;
        border: 1px solid black;
        border-radius: 9px;
    }

    #forms {
        padding-bottom: 15px;
		
    }

    #inpt {
        padding-bottom: 20px;
        
    }

    #submit {
        background-color: #428f9d;
        color: white;
        border: none;
        border-radius: 3px;
    }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include 'include/header.php';?>

    <!-- Login Section -->
    
    <div id="container">
        <div id="Box">
            <div>
                <h3>User</h3>
                <p>Login</p>
            </div>
            <?php if($error){?><div class="errorWrap" style="color:red;">
                <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
            </div><?php } 
                           else if($msg){?><div class="succWrap" style="color:red;">
                <strong>Error</strong>:<?php echo htmlentities($msg); ?>
            </div><?php }?>
            <div>
                <form method="post">
                    <div id="forms">
                        <div id="inpt">
                            <input type="text" name="email" id="email" placeholder="Enter Your Email" autocomplete="off"
                                required>
                        </div>
                        <div id=inpt>
                            <input type="password" name="password" id="password" placeholder="Enter Your Password"
                                autocomplete="off" required>
                        </div>
                    
                    <div>
                        <input type="submit" id="submit" name="submit" value="Login">
                    </div>
                    </div>
                    <p>Create an account <a href="registration.php" style="text-decoration:none;" >Register</a></p>

                </form>
            </div>
        </div>
    </div>

<?php include 'include/footer.php'; ?>

</body>
</html>