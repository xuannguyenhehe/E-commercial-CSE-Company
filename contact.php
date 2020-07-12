<?php
session_start();

require_once("auth.php");
require_once("util.php");

$auth = new Auth();
$db_handle = new DBController();
$util = new AuthUtils();

$isLoginUser = false;
$permission = "MEMBER";
if (!empty($_SESSION["user_id"])){
    $isLoginUser = true;
    $user = $auth->getUserByUsername($_SESSION["user_id"]);
    if ($_COOKIE["permission"] != $user[0]["Permit"]){
        $util -> redirect('logout.php');
        $isLoginUser = false;
    }
    $permission = $_COOKIE["permission"] ;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact | CSE Corporation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="stylesheet" href="./css/common.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
</head>
<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php">
            <img src="image/logo-BK.png" alt="logoBK">
            <img src="image/logo-CSE.png" alt="logoCSE">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            WHAT YOU NEED
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="T-shirt.php">The Associated Organ of Vietnamese Students’ Association T-shirt</a>
                            <a class="dropdown-item" href="shirt.php">Ho Chi Minh Communist Youth Union Shirt</a>
                            <a class="dropdown-item" href="#">CSE Neck Strap</a>
                            <a class="dropdown-item" href="#">CSE Job Fair Teddy Bear</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="store.php">STORE</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            FAMILY TREE
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="about.php">About</a>
                        <a class="dropdown-item" href="#">Leadership</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.php">INFO</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php 
                              if (isset($_COOKIE["user_login"])){
                                $user = $_COOKIE['user_login'];
                                echo $user;
                              }
                              else {
                                echo "ACCOUNT";
                              }
                            ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                                if($permission != "MEMBER"){
                                    ?>
                                   <a class="dropdown-item" href="product.php" target="_self">Administrator</a>
                                    <?php
                                }
                            ?>
                            <?php
                                if($isLoginUser){
                                    ?>
                                    <a class="dropdown-item" href="logout.php" target="_self">Logout</a>
                                    <?php
                                }
                            ?>
                            <?php
                                if(! $isLoginUser){
                                    ?>
                                   <a class="dropdown-item" href="login.php" target="_self">Sign In/Sign Up</a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item" id="mycart">
                <?php 
                        $servername = "localhost";
                        $username = "xuannguyenhehe";
                        $password = "nguyen2808";
                        $dbhandle = mysqli_connect($servername, $username, $password)
                        or die("Unable to connect to MySQL<br>");
                        echo "";
                        $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
                        or die("Could not select cse_corporation_1");
                        $user = $_COOKIE["user_login"];

                        $sqlCID = "SELECT CID FROM cart WHERE Username = '$user'";
                        $resultCID = mysqli_query($dbhandle, $sqlCID);
                        $rowCID = mysqli_fetch_assoc($resultCID);
                        $CID = $rowCID["CID"]; 

                        $sql = "SELECT PID FROM owning_pid_cart";
                        $result = mysqli_query($dbhandle, $sql);
                        $quantity = mysqli_num_rows($result);
                        echo "<a class='nav-link' href='cart.php'>MY CART <span id='quantityCart'>$quantity</span></a>";
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron">
        <class class="display-4" style="font-weight: 600;">CONTACT</class>
        <hr class="my-4" style="background-color: white">
        <p>CSE is Home<br>
            Best Friends Forever</p>
    </div>
    
    <div id="contact-content">
        <div id=contact-information>
            <h2>Happiness of customers <br> is also our blissfully happiness.</h2>
            <button>Our Office Location</button>
            <h1>Get in <em>Touch</em></h1>
            <h3>
                For Media & PR: <br>
                <a class="fa fa-envelope-square"></a>
                Email: <span>nguyen.phamcnttk17@hcmut.edu.vn</span><br>
                <a class="fa fa-address-book"></a>
                Address: <span>Ho Chi Minh City University of Technology</span>
            </h3>
        </div>
        <div id="contact-form">
            <p>Please fill out the form below and we will get in touch with you shortly.</p>
            <div id="container-form">
                <form>
                    <label><span>*</span></label>
                    <input type="text" id="fname" name="firstname" placeholder="First Name" pattern="[a-zA-Z]" required>
                    <label><span>*</span></label>
                    <input type="text" id="lname" name="lastname" placeholder="Last Name" pattern="[a-zA-Z]" required><br>
                    <label><span>*</span></label>
                    <input type="text" id="email" name="email" placeholder="Company/Personal Email" pattern="[a-zA-Z]+[a-zA-Z0-9]*@[a-z]+[.]com" required><br>
                    <label><span>*</span></label>
                    <input type="text" id="pnumber" name="phonenumber" placeholder="Phone Number" pattern="[0-9]+" required><br>
                    <label><span>*</span></label>
                    <input type="text" id="place" name="place" placeholder="Company/University" required><br>
                    <div id="interest">
                        <label><span>*</span> What are you interested in?</label><br>
                        <div class="checkbox-interest">
                            <input type="checkbox" id="tshirt" name="tshirt" value="White T-Shirt">
                            <label for="tshirt"> White T-shirt</label><br>
                            <input type="checkbox" id="shirt" name="shirt" value="Blue Shirt">
                            <label for="shirt"> Blue Shirt</label><br>
                        </div>
                        <div class="checkbox-interest">
                            <input type="checkbox" id="strap" name="strap" value="CSE Neck Strap">
                            <label for="strap"> CSE Neck Strap</label><br>
                            <input type="checkbox" id="teddy" name="teddy" value="CSE JF Teddy Bear">
                            <label for="teddy"> CSE JF Teddy Bear</label><br>
                        </div>
                    </div>
                    <label><span>*</span></label>
                    <textarea cols="50" rows="10" placeholder="How can we help you?" required></textarea><br>
                    <label><span>*</span> Required Fields</label><br>
                    <input type="checkbox" id="agree" name="agree" value="agree" required>
                    <label for="agree"><span>*</span> I agree to the Privacy Policy</label><br>
                    <input class="btn btn-warning" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
      <!-- Site footer -->
      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <h6>About</h6>
              <p class="text-justify">CSE Coporation provide the best product experience you've ever owned.<br> Contact us if you have any problem with our product. </p>
            </div>
  
            <div class="col-xs-6 col-md-3">
              <h6>CSE's Product</h6>
              <ul class="footer-links">
                <li><a href="T-shirt.php">Association T-shirt</a></li>
                <li><a href="#">HCM Communist Shirt</a></li>
                <li><a href="#">CSE Neck Strap</a></li>
                <li><a href="#">CSE Job Fair Bear</a></li>
              </ul>
            </div>
  
            <div class="col-xs-6 col-md-3">
              <h6>Quick Links</h6>
              <ul class="footer-links">
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="store.php">Store</a></li>
                <li><a href="T-shirt.php">Product</a></li>
              </ul>
            </div>
          </div>
          <hr>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
              <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by 
           <a href="home.php">CSECoporation</a>.
              </p>
            </div>
  
            <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="social-icons">
                <li><a class="facebook" href="https://www.facebook.com/BKCSE.Multimedia" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="https://www.youtube.com/channel/UCRdt580Yp-P3Abj7JauVnoQ" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li><a class="dribbble" href="http://doanhoi.cse.hcmut.edu.vn/" target="_blank"><i class="fa fa-dribbble"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
  </footer>
  <script src="./js/goToTop.js"></script>
</body>
</html>
