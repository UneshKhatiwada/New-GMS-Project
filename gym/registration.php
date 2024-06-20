<?php
error_reporting(0);
require_once('include/config.php');

if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$address = $_POST['address'];
	$Password = $_POST['password'];
	$pass = md5($Password);
	$RepeatPassword = $_POST['RepeatPassword'];

	// Email id Already Exit

	$usermatch = $dbh->prepare("SELECT mobile,email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
	$usermatch->execute(array(':usreml' => $email, ':mblenmbr' => $mobile));
	while ($row = $usermatch->fetch(PDO::FETCH_ASSOC)) {
		$usrdbeml = $row['email'];
		$usrdbmble = $row['mobile'];
	}


	if (empty($fname)) {
		$nameerror = "Please Enter First Name";
	} else if (empty($mobile)) {
		$mobileerror = "Please Enter Mobile No";
	} else if (empty($email)) {
		$emailerror = "Please Enter Email";
	} else if ($email == $usrdbeml || $mobile == $usrdbmble) {
		$error = "Email Id or Mobile Number Already Exists!";
	} else if ($Password == "" || $RepeatPassword == "") {

		$error = "Password And Confirm Password Not Empty!";
	} else if ($_POST['password'] != $_POST['RepeatPassword']) {

		$error = "Password And Confirm Password Not Matched";
	} else {
		$sql = "INSERT INTO tbluser (fname,lname,email,mobile,state,city,password) Values(:fname,:lname,:email,:mobile,:state,:city,:Password)";

		$query = $dbh->prepare($sql);
		$query->bindParam(':fname', $fname, PDO::PARAM_STR);
		$query->bindParam(':lname', $lname, PDO::PARAM_STR);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$query->bindParam(':state', $state, PDO::PARAM_STR);
		$query->bindParam(':city', $city, PDO::PARAM_STR);
		$query->bindParam(':Password', $pass, PDO::PARAM_STR);

		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId > 0) {
			echo "<script>alert('Registration successfull. Please login');</script>";
			echo "<script> window.location.href='login.php';</script>";
		} else {
			$error = "Registration Not successfully";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Vyayamlaya</title>
	<meta charset="UTF-8">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/nice-select.css" />
	<link rel="stylesheet" href="css/slicknav.min.css" />

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css" />


</head>

<body>
	<!-- Page Preloder -->


	<!-- Header Section -->
	<?php include 'include/header.php'; ?>
	<!-- Header Section end -->

	<!-- Page top Section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto text-white">
					<h2>Registration</h2>
				</div>
			</div>
		</div>
	</section>
	<!-- Page top Section end -->

	<!-- Contact Section -->
	<section class="contact-page-section spad overflow-hidden">
		<div class="container">

			<div class="row">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8">
					<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($succmsg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($succmsg); ?> </div><?php } ?><br><br>
					<form class="singup-form contact-form" method="post" onsubmit="return validateForm();">
						<div class="row">
							<div class="col-md-6">
								<input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $fname; ?>" required>
								<div id="fnameError" style="color:red;"></div>
							</div>
							<div class="col-md-6">
								<input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo $lname; ?>" required>
								<div id="lnameError" style="color:red;"></div>
							</div>
							<div class="col-md-6">
								<input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo $email; ?>" required>
								<div id="emailError" style="color:red;"></div>
							</div>
							<div class="col-md-6">
								<input type="text" name="mobile" id="mobile" maxlength="10" placeholder="Mobile Number" autocomplete="off" value="<?php echo $mobile; ?>" required>
								<div id="mobileError" style="color:red;"></div>
							</div>
							<div class="col-md-6">
								<input type="text" name="state" id="state" placeholder="Your State" autocomplete="off" value="<?php echo $state; ?>" required>
								<div id="stateError" style="color:red;"></div>
							</div>
							<div class="col-md-6">
								<input type="text" name="city" id="city" placeholder="Your City" autocomplete="off" value="<?php echo $city; ?>" required>
								<div id="cityError" style="color:red;"></div>
							</div>
							<!--<div class="col-md-6">
								<input type="text" name="address" id="city" placeholder="Your Address" autocomplete="off" value="<?php echo $address; ?>" required>
								<div id="addressError" style="color:red;"></div>
							</div> -->
							<div class="col-md-6">
								<input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
								<div id="passwordError" style="color:red;"></div>
							</div>
							<div class="col-md-6">
								<input type="password" name="RepeatPassword" id="RepeatPassword" placeholder="Confirm Password" autocomplete="off" required>
								<div id="repeatPasswordError" style="color:red;"></div>
							</div>
							<div class="col-md-4">
								<input type="submit" id="submit" name="submit" value="Register Now" class="site-btn sb-gradient">
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</div>
	</section>
	<!-- Trainers Section end -->

	<!-- Footer Section -->
	<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->

	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	<!-- Custom JavaScript -->
	<script>
		function validateForm() {
			var fname = document.getElementById('fname').value;
			var lname = document.getElementById('lname').value;
			var email = document.getElementById('email').value;
			var mobile = document.getElementById('mobile').value;
			var state = document.getElementById('state').value;
			var city = document.getElementById('city').value;
			var password = document.getElementById('password').value;
			var repeatPassword = document.getElementById('RepeatPassword').value;
			var error = false;

			clearErrors();

			if (fname == "") {
				document.getElementById('fnameError').innerHTML = "Please enter your first name.";
				error = true;
			}
			if (lname == "") {
				document.getElementById('lnameError').innerHTML = "Please enter your last name.";
				error = true;
			}
			if (email == "") {
				document.getElementById('emailError').innerHTML = "Please enter your email.";
				error = true;
			} else if (!validateEmail(email)) {
				document.getElementById('emailError').innerHTML = "Please enter a valid email.";
				error = true;
			}
			if (mobile == "") {
				document.getElementById('mobileError').innerHTML = "Please enter your mobile number.";
				error = true;
			} else if (mobile.length != 10 || isNaN(mobile)) {
				document.getElementById('mobileError').innerHTML = "Please enter a valid 10-digit mobile number.";
				error = true;
			}
			if (state == "") {
				document.getElementById('stateError').innerHTML = "Please enter your state.";
				error = true;
			}
			if (city == "") {
				document.getElementById('cityError').innerHTML = "Please enter your city.";
				error = true;
			}
			if (password == "") {
				document.getElementById('passwordError').innerHTML = "Please enter your password.";
				error = true;
			}
			if (repeatPassword == "") {
				document.getElementById('repeatPasswordError').innerHTML = "Please confirm your password.";
				error = true;
			} else if (password != repeatPassword) {
				document.getElementById('repeatPasswordError').innerHTML = "Passwords do not match.";
				error = true;
			}

			return !error;
		}

		function validateEmail(email) {
			var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
			return re.test(email);
		}

		function clearErrors() {
			document.getElementById('fnameError').innerHTML = "";
			document.getElementById('lnameError').innerHTML = "";
			document.getElementById('emailError').innerHTML = "";
			document.getElementById('mobileError').innerHTML = "";
			document.getElementById('stateError').innerHTML = "";
			document.getElementById('cityError').innerHTML = "";
			document.getElementById('passwordError').innerHTML = "";
			document.getElementById('repeatPasswordError').innerHTML = "";
		}
	</script>

</body>

</html>
<style>
	.errorWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #dd3d36;
		color: #fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
	}

	.succWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #5cb85c;
		color: #fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
	}
</style>