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
    <title>Store | CSE Corporation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/store.css">
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
                    <a class="nav-link" href="cart.php">MY CART</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron">
        <class class="display-4" style="font-weight: 600;">CSE Coporation</class>
        <p class="lead" style="font-weight: bold; padding-top: 25px;">A place where you can buy everything from CSE STORE.</p>
        <hr class="my-4" style="background-color: white">
        <p>CSE is Home<br>
            Best Friends Forever</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="contact.php" role="button">GET IN TOUCH</a>
        </p>
    </div>
    
    <div id="store-content">
      <div id="boxLeft">
          <a class="closebtn" onclick="closeBoxLeft()">&times;</a>
          <div class="category">
              <div class="titleCategory">
                  <h4>CATEGORY</h4>
              </div>
              <div class="listGroup">
                  <div class="listGroupItem">
                      <a href="#">Clothes<span>(2)</span></a>
                  </div>
                  <div class="listGroupItemChild">
                      <a href="T-shirt.php">T-Shirts<span>(1)</span></a>
                  </div>
                  <div class="listGroupItemChild">
                      <a href="#">Shirts<span>(1)</span></a>
                  </div>
                  <div class="listGroupItem">
                      <a href="#">NeckStrap<span>(1)</span></a>
                  </div>
                  <div class="listGroupItem">
                      <a href="#">Toys<span>(1)</span></a>
                  </div>
              </div>
          </div>
          <div class="category">
              <div class="titleCategory">
                  <h4>PRICE</h4>
              </div>
              <div id="chooseRange">
                  <p>Choose range</p>
                  <div id="inputRange">
                      <input type="text" id="inputFrom">
                      <span>-</span>
                      <input type="text" id="inputTo">
                  </div>
                  <button onclick="filterPID()">OK</button>
              </div>
          </div>
      </div>
      <div id="boxRight">
          <div id="optionBox">
              <div id="optionChoose">
                  <a class="closebtn" onclick="closeOptionBox()">&times;</a>
                  <span>Priority:</span>
                  <a>NEW PRODUCTS</a>
                  <a>FLASH SALE</a>
                  <a>SALE OFF</a>
                  <a onclick="sortPID(1)">LOW PRICE</a>
                  <a onclick="sortPID(0)">HIGH PRICE</a>
              </div>
              <div id="searchBox">
                  <input id="searchbox" type="text" name="searchBox" placeholder="Find in store" onkeyup="searchPID()" >
                  <button onclick=""><i class="fa fa-search"></i></button>
              </div>
          </div>
          <div id="handleMobile">
              <div id="sorting">
                  <button onclick="openOptionBox()">Sorting <i class="fa fa-caret-down"></i></button>
              </div>
              <div id="filter">
                  <button onclick="openBoxLeft()"><i class="fa fa-filter"></i> Filter</button>
              </div>
          </div>
          <div id="productBox">
              <div id="smallBox">
              <?php 
                    $servername = "localhost";
                    $username = "xuannguyenhehe";
                    $password = "nguyen2808";
                    $dbhandle = mysqli_connect($servername, $username, $password)
                    or die("Unable to connect to MySQL<br>");
                    echo "";
                    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
                    or die("Could not select cse_corporation_1");

                    $sql = "SELECT PID, Name, Material, Color, OtherDesign, OtherFeature, Note, Price, Image, Status FROM ord";
                    $result = mysqli_query($dbhandle, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $PID = $row['PID'];
                        $Name = $row["Name"];
                        $Material = $row["Material"];
                        $Color = $row["Color"];
                        $OtherDesign = $row["OtherDesign"];
                        $OtherFeature = $row["OtherFeature"];
                        $Note = $row["Note"];
                        $Price = $row["Price"];
                        $Image = $row["Image"];
                        echo "
                        <div class='productSmallBox'>
                            <a href='T-shirt.php' class='linkProduct'>
                                <img src='image/aohoi.jpg' alt='aoHoi'>
                                <div class='smallImg'>
                                    <img src='image/aohoi.jpg' alt='aoHoi'>
                                    <img src='image/aodoan.jpg' alt='aoDoan'>
                                </div>
                                <p class='titleProduct'>$Name</p>
                                <p class='priceProduct'>$Price đ</p>
                            </a>
                        </div>
                        
                        ";
                    }
                }
                ?>

              </div>
              <nav aria-label="Page navigation example" style="margin-top: 1rem;">
                <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
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
  <script src="./js/searchStore.js"></script>
  <!-- <script src="mobile.js"></script> -->
</body>
</html>
