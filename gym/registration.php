<?php
error_reporting(0);
require_once('include/config.php');

if(isset($_POST['submit']))
{ 
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$state=$_POST['state'];
$city=$_POST['city'];
$Password=$_POST['password'];
$pass=md5($Password);
$RepeatPassword = $_POST['RepeatPassword'];

// Email id Already Exit

$usermatch=$dbh->prepare("SELECT mobile,email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
$usermatch->execute(array(':usreml'=>$email,':mblenmbr'=>$mobile)); 
while($row=$usermatch->fetch(PDO::FETCH_ASSOC))
{
$usrdbeml= $row['email'];
$usrdbmble=$row['mobile'];
}


if(empty($fname))
{
  $nameerror="Please Enter First Name";
}

 else if(empty($mobile))
 {
 $mobileerror="Please Enter Mobile No";
 }

 else if(empty($email))
 {
 $emailerror="Please Enter Email";
 }

else if($email==$usrdbeml || $mobile==$usrdbmble)
 {
  $error="Email Id or Mobile Number Already Exists!";
 }
  else if($Password=="" || $RepeatPassword=="")
 {
    
   $error="Password And Confirm Password Not Empty!";
 
 }
 else if($_POST['password'] != $_POST['RepeatPassword'])
 {
  
   $error="Password And Confirm Password Not Matched";
 }

 
else{
$sql="INSERT INTO tbluser (fname,lname,email,mobile,state,city,password) Values(:fname,:lname,:email,:mobile,:state,:city,:Password)";

$query = $dbh -> prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':Password',$pass,PDO::PARAM_STR);

$query -> execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId>0)
{
echo "<script>alert('Registration successfull. Please login');</script>";
header("location: login.php");
}
else 
{
$error ="Registration Not successfully";
 }
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
        height: 500px;
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
	#inpt{
		padding-bottom:10px;
	}
	#In{
		margin-bottom:52px;
	}
    </style>
</head>

<body>

    <!-- Header Section -->
    <?php include 'include/header.php';?>

    <!-- register Section -->
    <div id="container">
        <div id="Box">
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
            </div><?php } 
                else if($succmsg){?><div class="succWrap">
                <strong>SUCCESS</strong>:<?php echo htmlentities($succmsg); ?>
            </div><?php }?><br><br>
			<div>
                <h3>User</h3>
                <p>Registration</p>
            </div>
            <form method="post">
                <div id="In">
                    <div id="inpt">
                        <input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off"
                            value="<?php echo $fname;?>" required>
                    </div>
                    <div id="inpt">
                        <input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off"
                            value="<?php echo $lname;?>" required>
                    </div>
                    <div id="inpt">
                        <input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off"
                            value="<?php echo $email;?>" required>
                    </div>
                    <div id="inpt">
                        <input type="text" name="mobile" id="mobile" maxlength="10" placeholder="Mobile Number"
                            autocomplete="off" value="<?php echo $mobile;?>" required>
                    </div>
                    <div id="inpt">
                        <input type="text" name="state" id="state" placeholder="Your State" autocomplete="off"
                            value="<?php echo $state;?>" required>
                    </div>
                    <div id="inpt">
                        <input type="text" name="city" id="city" placeholder="Your City" autocomplete="off"
                            value="<?php echo $city;?>" required>
                    </div>
                    <div id="inpt">
                        <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                    </div>
                    <div id="inpt">
                        <input type="password" name="RepeatPassword" id="RepeatPassword" placeholder="Confirm Password"
                            autocomplete="off" required>
                    </div>
                    <div id="inpt">
                        <input type="submit" id="submit" name="submit" value="Register Now" class="mt-2">
                    </div>
                    <p class="pb-4" >Already have an account? <a href="login.php" style="text-decoration:none;" >Login</a></p>
                </div>
            </form>
        </div>
    </div>

<!-- Footer Section -->
<?php include 'include/footer.php'; ?>
</body>
</html>