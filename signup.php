<?php

    require_once("auth.php");
    require_once("util.php");

    $auth = new Auth();
    $util = new AuthUtils();

if (isset($_POST['signup'])) {

    
    $name = $_POST['username'];
    $password = md5($_POST['pass']);
    $fullName = $_POST['fullname'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];


    
    $user = $auth->getUserByUsername($name);
    //$_SESSION['user_id'] = $user[0]['Username'];
   // echo $user[0]['Username'];
    if (empty($user)) {
        echo $auth->addNewUser($name,$password,$fullName,$sex,$tel,$email);
        

        $response = array(
            "type" => "success",
            "message" => "You have registered successfully."
        );

        $util->redirect('login.php');
    } else {
        $response = array(
            "type" => "error",
            "message" => "Username already in use."
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign up | CSE Corporation</title>
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
        <div class="demo-content">
			<?php
			if (! empty($response)) { ?>
			<div id="response" class="<?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
			<?php
			}
			?>
		</div>
		<div class="container-login100">
			<div class="wrap-login100">
				<form id = "signup_form"  class="login100-form validate-form" method="POST" onsubmit="return validateSignUp()">
					<span id="state" class="login100-form-title p-b-34">
						Account Sign Up
					</span>
					
					<div id="username" class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div id="pwd" class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div id="repwd" class="wrap-input100 rs3-wrap-input100 validate-input m-b-20" data-validate="Type re-password">
						<input class="input100" type="password" name="repass" placeholder="Re-Password">
						<span class="focus-input100"></span>
					</div>

					<div id="fullname" class="wrap-input100 rs4-wrap-input100 validate-input m-b-20" data-validate="Type fullname">
						<input class="input100" type="text" name="fullname" placeholder="Fullname">
						<span class="focus-input100"></span>
					</div>
					
					<div id="sex" class="wrap-input100 rs5-wrap-input100 validate-input m-b-20" data-validate="Choose sex">
						<select name="sex" class="input100">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						  </select>
						<!-- <input class="input100" type="text" name="text" placeholder="Fullname"> -->
						<span class="focus-input100"></span>
					</div>
					
					<div id="tel" class="wrap-input100 rs5-wrap-input100 validate-input m-b-20" data-validate="Type phone">
						<input class="input100" type="tel" name="tel" placeholder="Telephone">
						<span class="focus-input100"></span>
					</div>
					
					<div id="email" class="wrap-input100 rs6-wrap-input100 validate-input m-b-20" data-validate="Type email">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					<!-- check box to allow browser save cookies for the next visiting time -->
					<div>

					<div class="container-login100-form-btn">
						<button id="btnSignUp" class="login100-form-btn" name="signup">
							Sign Up
						</button>
					</div>

					<div class="w-full text-center">
						<a id="change" href='login.php'  class="txt3">Sign In</a>
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

	<script src="js/validateSignUp.js"></script>
</body>
</html>

