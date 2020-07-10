<?php
session_start();

require_once("auth.php");
require_once("util.php");

$auth = new Auth();
$db_handle = new DBController();
$util = new AuthUtils();

require_once("authCookiesSesstionValidation.php");

if ($isLoggedIn) { // direct to previous page or home page
    $util->redirect("home.php");
}


if (isset($_POST['login'])) { 
	$isAuthenticated = false;
	
	$username = $_POST["username"];
	$password = md5($_POST['pass']);

	$response = array();
	$user = $auth->getUserByUsername($username);

	if (is_null($user)){
		$response = array(
            "type" => "error",
            "message" => "Sign in failed: user not found"
        );
	}
	else {
	
	if ($password == $user[0]["Pwd"]) {
		$isAuthenticated = true;
	}
	
	if ($isAuthenticated) {
		$_SESSION["user_id"] = $user[0]["Username"];
		echo $user[0]["Permit"];
		setcookie("permission", $user[0]["Permit"], $cookie_expiration_time); // role permission 
		setcookie("user_login", $username, $cookie_expiration_time);
		// Set Auth Cookies if 'Remember Me' checked
		if (! empty($_POST["remember"])) {	
			$random_password = $util->getToken(16);
			setcookie("random_password", $random_password, $cookie_expiration_time);
			
			$random_selector = $util->getToken(32);
			setcookie("random_selector", $random_selector, $cookie_expiration_time);

			$random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
			$random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);
			
			$expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);
			
			// mark existing token as expired
			$userToken = $auth->getTokenByUsername($username, 0);
			if (! empty($userToken[0]["id"])) {
				$auth->markAsExpired($userToken[0]["id"]);
			}
			// Insert new token
			$auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
		} else {
			$util->clearAuthCookie();
		}
		$util->redirect("home.php"); //here
	} else {
		$response = array(
            "type" => "error",
            "message" => "Sign in failed: incorrect password"
        );
	}	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | CSE Corporation</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">

		<!--log comment for debug-->
		<div class="demo-content">
			<?php
			if (! empty($response)) { ?>
			<div id="response" class="error_message" ><?php echo $response["message"]; ?></div>
			<script>
				var mes = document.getElementById("response").innerHTML;
				alert(mes);
			</script>
			<?php
			}
			?>
		</div>
		<div class="container-login100">
			<div class="wrap-login100">
				<form id = "login_form" class="login100-form validate-form" method="post" >
					<span id="state" class="login100-form-title p-b-34">
						Account Sign In
					</span>
					
					<div id="username" class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name"
						value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
						<input id="first-name" class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div id="pwd" class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password"
						value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<!-- check box to allow browser save cookies for the next visiting time -->
					<div>
					<input type="checkbox" name="remember" id="remember"
						<?php if(isset($_COOKIE["user_login"])) { ?> checked
						<?php } ?> /> <label for="remember-me">Remember me</label>
					</div>
					
					<div class="container-login100-form-btn">
						<button id="btnLogIn" class="login100-form-btn" name="login">
							Sign In
						</button>
					</div>

					<div class="w-full text-center">
						<a id="change" href='signup.php' class="txt3">Sign Up</a>
					</div>
					<div id="test"></div>
				</form>

				<div class="login100-more" style="background-image: url('image/login.jpg');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<script src="js/changeSignup.js"></script>
</body>
</html>

