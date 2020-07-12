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
    <title>Shirt | CSE Corporation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/T-shirt.css">
    <link rel="stylesheet" href="./css/common.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <script src="./js/imageProduct.js"></script>
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
        <class class="display-4" style="font-weight: 600;">CSE Coporation</class>
        <p class="lead" style="font-weight: bold; padding-top: 25px;">Provide your product experience for us to perfect T-shirts more.</p>
        <hr class="my-4" style="background-color: white">
        <p>Including error about size, color or stiches of T-shirts.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="contact.php" role="button">LEARN MORE</a>
        </p>
    </div>
    <div id="T-shirt-content">
        <h1 class="header-content">
            The Associated Organ of Vietnamese Students’ Association T-shirt
        </h1>
        <span>&#95;&#95;&#95;</span>
        <div class="header-content-detail">
            <a class="fa fa-bullseye"></a>
            <div>
                <h2>Goal</h2>
                <h2>Increasing your confidence to your day be full of energy and more active</h2>
            </div>
        </div>
        <div class="header-content-detail">
            <a class="fa fa-cogs"></a>
            <div>
                <h2>Technical Production</h2>
                <h2>Sewing in closed chain of high technology to have eye-catching details.</h2>
            </div>
        </div>
        <div class="header-content-detail">
            <a class="fa fa-star"></a>
            <div>
                <h2>Standard</h2>
                <h2>T-shirts is sewed according the standard of the Associated Organ of Vietnamese Students’ Association.</h2>
            </div>
        </div>

        <h1 class="header-content">
            Meaning of this Sshirt
        </h1>
        <span>&#95;&#95;&#95;</span>
        <h2 class="descriptionHeader">
            Like a red scraf, the Associated Organ of Vietnamese Students’ Association T-shirt
            becomes a integral part of students's life at Universities. This shirts is
            representing the Associated Organ of Vietnamese Students’ Association which is 
            an organization is putting students's interest firsts and is connected directly to
            them. Goal of this organization is unity with students to race together in learning
            and practice. 
        </h2>

        <h1 class="header-content">
            General description
        </h1>
        <span>&#95;&#95;&#95;</span>
        <h2 class="descriptionHeader">
            This T-shirt is designated for students to feel comfortable when studying or joining
            outdoor activities as shown below: 
        </h2>
        <div id=containerTshirt>
            <div id="imageTshirt">
                <div id="originalImage">
                    <div id="miniImage">
                        <img src="image/aohoi.jpg" alt='aoHoi' onClick="clickImage(this);">
                        <img src="image/aodoan.jpg" alt='aoHoi' onClick="clickImage(this);">
                        <img src="image/aohoi.jpg" alt='aoHoi' onClick="clickImage(this);">
                        <img src="image/aodoan.jpg" alt='aoHoi' onClick="clickImage(this);">
                        <div id="transparentImageText">
                            <img src="image/aohoi.jpg" alt='aoHoi' onclick="openModal();currentSlide(1)" class="hover-shadow">      
                            <div id="contentImageText" onclick="openModal();currentSlide(1)" class="hover-shadow">
                                <p>See more images</p>
                            </div>
                        </div> 
                    </div>
                    <div id="moreImage">
                        <div id="myModal" class="modal">
                            <span class="close cursor" onclick="closeModal()">&times;</span>
                            <div class="modal-content">
                                <div class="mySlides">
                                    <div class="numbertext">1 / 4</div>
                                    <img src="image/aohoi.jpg" alt="aoHoi">
                                </div>
                          
                                <div class="mySlides">
                                    <div class="numbertext">2 / 4</div>
                                    <img src="image/aodoan.jpg" alt="aoDoan">
                                </div>
                          
                                <div class="mySlides">
                                    <div class="numbertext">3 / 4</div>
                                    <img src="image/aohoi.jpg" alt="aoHoi">
                                </div>
                          
                                <div class="mySlides">
                                    <div class="numbertext">4 / 4</div>
                                    <img src="image/aodoan.jpg" alt="aoDoan">
                                </div>
                          
                                <!-- Next/previous controls -->
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                          
                                <!-- Caption text -->
                                <div class="caption-container">
                                    <p id="caption">Original Image</p>
                                </div>
                          
                                <!-- Thumbnail image controls -->
                                <div id="cluster">
                                    <div class="column">
                                        <img class="demo" src="image/aohoi.jpg" onclick="currentSlide(1)" alt="aoHoi">
                                    </div>
                              
                                    <div class="column">
                                        <img class="demo" src="image/aodoan.jpg" onclick="currentSlide(2)" alt="aoDoan">
                                    </div>
                              
                                    <div class="column">
                                        <img class="demo" src="image/aohoi.jpg" onclick="currentSlide(3)" alt="aoHoi">
                                    </div>
                              
                                    <div class="column">
                                        <img class="demo" src="image/aodoan.jpg" onclick="currentSlide(4)" alt="aoDoan">
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div id="bigImage">
                        <img id="myImage" src="image/aodoan.jpg" alt="aoDoan">
                    </div>
                </div>
            </div>
            <div id="descriptionTshirt">
                <form action="saveCart.php" method="POST">
                <div id="descriptionTitle">
                    <h2>Ho Chi Minh Communist Youth Union Shirt</h2>
                </div>
                <div id="price">ID: 2 <br> 110.000đ</div>
                <div id="descriptionContent">
                    <h2>Clothing materials:</h2>
                    <h2>Materials of KATE SILK, smooth and soft, sweatin well.</h2>
                    <h2>Color:</h2>
                    <h2>Usuallly white or blue if you request.</h2>
                    <h2>Other design:</h2>
                    <h2>Have strong collar, be short-sleeved.</h2>
                    <h2>Other feature:</h2>
                    <h2>Not faded, not shaggy.</h2>
                </div>
                <div id="buying">
                    <div id="buyButton">
                        <button name="choose" class="btn btn-primary submit" type="submit" value="2">CHOOSE</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div id="sizeOfTshirts">
            <h1 class="header-content">Size of Shirts</h1>
            <span>&#95;&#95;&#95;</span>
            <table>
                <tr>
                    <th>SIZE</th>
                    <th>Tall</th>
                    <th>Weigh</th>
                </tr>
                <tr>
                    <td>80-84</td>
                    <td>1m57-1m65</td>
                    <td>52-60kg</td>
                </tr>
                <tr>
                    <td>84-89</td>
                    <td>1m66-1m70</td>
                    <td>60-67kg</td>
                </tr>
                <tr>
                    <td>90-94</td>
                    <td>1m71-1m75</td>
                    <td>68-72kg</td>
                </tr>
                <tr>
                    <td>95-99</td>
                    <td>1m76-1m80</td>
                    <td>73-80kg</td>
                </tr>
            </table>
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
    <script src="./js/increaseNum.js"></script>
    <script src="./js/lightbox.js"></script>
    <script src="./js/mobile.js"></script>
</body>
</html>
