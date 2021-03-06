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
    <title>My Cart | CSE Corporation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/cart.css">
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
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACCOUNT
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
        <class class="display-4" style="font-weight: 600;">CSE Coporation</class>
        <p class="lead" style="font-weight: bold; padding-top: 25px;">You are a Part of CSE - Shoulder to Shoulder - We are One</p>
        <hr class="my-4" style="background-color: white">
        <p>CSE is Home<br>
            Best Friends Forever</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="contact.php" role="button">GET IN TOUCH</a>
        </p>
    </div>
    
    <div id="cart-content">
        <form class="" method="POST" action="processCart.php">
            <h1>ORDER CONFIRMATION</h1>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip01">Full name</label>
                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Full name" required name="fullname">
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip02">Telephone</label>
                    <input type="tel" class="form-control" id="validationTooltip02" placeholder="Telephone" required name="tel">
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip03">Address</label>
                    <input type="text" class="form-control" id="validationTooltip03" placeholder="Address" required name="address">
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <h1>MY CART</h1>
            <div class="row">
                <div class="col-sm-9" id="information">
                    <?php 
                        $user = $_COOKIE["user_login"];
                        $servername = "localhost";
                        $username = "xuannguyenhehe";
                        $password = "nguyen2808";
                        $dbhandle = mysqli_connect($servername, $username, $password)
                        or die("Unable to connect to MySQL<br>");
                        echo "";
                        $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
                        or die("Could not select cse_corporation_1");
                        $sqlSelect = "SELECT CID FROM cart WHERE Username = '$user'";
                        $resultSelect = mysqli_query($dbhandle, $sqlSelect);
                        $rowSelect = mysqli_fetch_assoc($resultSelect);
                        $CID = $rowSelect["CID"];
                        $sql = "SELECT PID FROM owning_pid_cart";
                        $result = mysqli_query($dbhandle, $sql);
                        $TotalName = '';
                        if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $PID = $row['PID'];
                            $sqlName = "SELECT Name, Price FROM ord WHERE PID='$PID'";
                            $resultName = mysqli_query($dbhandle, $sqlName);
                            $rowName = mysqli_fetch_assoc($resultName);
                            $Name = $rowName["Name"];
                            $Price = $rowName["Price"];
                            $TotalName = $TotalName.' '.$Name;

                            echo "
                            <div class='row pid'>
                                <div class='col-3'>
                                    <img class='myImage' src='image/aohoi.jpg' alt='aoHoi'>
                                </div>
                                <div class='col-9'>
                                    <div class='row'>
                                        <div class='col-7' class='titlename'>
                                            $Name
                                        </div>
                                        <div class='col-2' class='price'>
                                            $Price đ
                                        </div>
                                        <div class='col-sm-3'>
                                            <div class='quantity'>
                                                <label>Quantities:</label>
                                                <input class='numQuantity' type='text' name='quantity[]' required value='0'>
                                            </div>
                                        </div>
                                        <div class='col-sm-12'>
                                            <input type='text' class='noteProduct' placeholder='Please note important information of products like size, quantities,...'>
                                        </div>
                                        <div class='col-sm-12'>
                                            <a id='$PID' class='btn btn-primary remove' onclick='removePID($PID)'>Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            ";
                        }
                    }
                    
                    
                echo "    
                </div>
                <div class='col-sm-3' id='money'>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <p>
                                <span onclick='totalCart()' class='btn btn-info total'>Temporary: </span>
                                <span class='resultCart' id='totalCart'>0</span>
                            </p>
                        </div>
                        <div class='col-sm-12'>
                            <p>
                                <span class='btn btn-info total'>Total: </span>
                                <span class='resultCart'>0</span>
                            </p>
                        </div>
                        <div class='col-sm-12'>
                            
                            <button name='order' type='submit' class='btn btn-danger' style='width: 100%' value='$TotalName'>Order</button>
                        </div>
                    </div>
                </div>";
                    
                ?>
            </div>
        </form>
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
  <script src="./js/increaseNum.js"></script>
  <script src="./js/totalCart.js"></script>
</body>
</html>
