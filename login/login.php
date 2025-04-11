<?php
include_once "../common-functions.php";
connectDB();
include_once "../functions-manager.php";

// Check if the user is already logged in
if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') {
	// Redirect the user to the home page or any other desired page
	header('Location: ../dashboard/dashboard.php');
	exit; // Make sure to exit after redirecting to prevent further execution
}


// Check if form is submitted
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Validate input fields
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$option = trim($_POST["options"]);

	if (isset($_POST['rememberMe'])) {
		setcookie("username", $username, time() + 60 * 60 * 24 * 7);
	} else {
		setcookie("username", "", time() - 60 * 60);
	}

	if ($option == 'admin') {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Validate input fields
			$username = trim($_POST["username"]);
			$password = trim($_POST["password"]);

			if (empty($username) || empty($password)) {
				// Handle empty fields error
				echo "Both username and password are required.";
				$msg = "Both username and password are required.";
			} else {
				// Validate credentials from the database
				$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
				$result = mysqli_query($con, $query);

				if (mysqli_num_rows($result) == 1) {
					// Valid credentials, start sessionyg
					$_SESSION['login'] = 'yes';
					$_SESSION['usertype'] = 'admin';
					$_SESSION['username'] = $username;
					// Redirect to the dashboard or any desired page
					header("Location: ../dashboard/dashboard.php");
					exit();
				} else {
					$msg = "Please enter correct login details";
				}
			}
		}
	} elseif ($option == 'manager') {
		if (empty($username) || empty($password)) {
			// Handle empty fields error
			echo "<script>alert(`Both username and password are required.`)</script>";
		} else {
			// Validate credentials from the database
			//$query = "SELECT * FROM manager WHERE mgr_emailid = '$username' AND mgr_password = '$password'";
			$query = "SELECT * FROM manager WHERE mgr_emailid = '$username'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);

			//$name=$row['fullname'];


			if (mysqli_num_rows($result) == 1) {
				// Valid credentials, start session

				$pass = $row['mgr_password'];
				$fname = $row['mgr_firstname'];
				$lname = $row['mgr_lastname'];
				if (md5($password) == $pass) {
					//$_SESSION['name'] = $name;
					// Redirect to the dashboard or any desired page
					$status = $row['mgr_status'];
					// echo "$status";
					if ($status == 1) {
						$_SESSION['login'] = 'yes';
						$_SESSION['usertype'] = 'manager';
						$_SESSION['username'] = $username;
						$_SESSION['fname'] = $fname;
						$_SESSION['lname'] = $lname;
						echo '<script type="text/javascript">';
						echo 'alert("Login Success")';
						echo '</script>';
						header("Location: ../dashboard/dashboard.php");
						exit();
					} elseif ($status == 0) {
						echo "<script>alert('Your account is disabled.');</script>";

					} elseif ($status == null) {
						// echo "<h2>empty</h2>";
						echo "<script>alert('Your registration request is not approved yet.');</script>";
						//header("Location: manager-login.php");
						//exit();

					}
				} else {
					// Invalid credentials
					$msg = "Please enter correct login details";
				}
			} else {
				// Invalid credentials
				$msg = "Please enter correct login details";
			}
		}
	}
}
?>

<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DineWise RMS Login</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
		rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-NXZMQSS"></script>
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<!-- End Google Tag Manager -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
	<!-- style for modal -->

	<!-- script for modal is  -->



</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="admin-login.php">
					<h2>DineWise RMS</h2>
				</a>
			</div>
			<div class="login-menu">

			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="../vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login Form</h2>
						</div>
						<form method="post">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn">
										<input type="radio" name="options" id="admin" value="admin">
										<div class="icon">
											<img src="../vendors/images/briefcase.svg" class="svg" alt="">
										</div>
										<span>I'm</span>
										Admin
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user" value="manager" checked>
										<div class="icon">
											<img src="../vendors/images/person.svg" class="svg" alt="">
										</div>
										<span>I'm</span>
										Manager
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Username"
									name="username"
									value="<?= (isset($_COOKIE['username'])) ? $_COOKIE['username'] : '' ?>">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********"
									name="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div id="Error" class="error-message" style="color: #E43915; font-size: 14px;">
								<?php echo $msg ?>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="mb-5 px-2">
										<input type="checkbox" class="form-control-check py-1" checked name="rememberMe"
											id="remember-me">
										<label class="form-check-label" for="remember-me">Remember me</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password">
										<!-- <a href="forgot-password.html">Forgot Password</a> -->
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign In">
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
										OR
									</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block"
											href="../registration/registration.php">Create Account</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- welcome modal start -->
	<div id="myModal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<p id="modalMessage">
				<?php echo $msg; ?>
			</p>
		</div>
	</div>
	<!-- welcome modal end -->


	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
			style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


</body>

</html>