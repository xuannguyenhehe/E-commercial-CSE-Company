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
                            <a class="dropdown-item" href="#">Ho Chi Minh Communist Youth Union Shirt</a>
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
                        <a class="dropdown-item" href="login.php" target="_blank">Login/Signup</a>
                        <a class="dropdown-item" href="product.php" target="_blank">Administrator</a>
                        <a class="dropdown-item" href="#" target="_blank">Logout</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item" id="mycart">
                    <a class="nav-link" href="contact.php">MY CART</a>
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
        <form class="" method="POST" action="">
            <h1>ORDER CONFIRMATION</h1>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip01">Full name</label>
                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Full name" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip02">Telephone</label>
                    <input type="tel" class="form-control" id="validationTooltip02" placeholder="Telephone" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip03">Email</label>
                    <input type="email" class="form-control" id="validationTooltip03" placeholder="Email" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip04">Address</label>
                    <input type="text" class="form-control" id="validationTooltip04" placeholder="Address" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
            </div>
            <h1>MY CART</h1>
            <div class="row">
                <div class="col-sm-9" id="information">
                    <div class="row">
                        <div class="col-3">
                            <img id="myImage" src="image/aohoi.jpg" alt="aoHoi">
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-7" id="title">
                                    The Associated Organ of Vietnamese Students’ Association T-shirt
                                </div>
                                <div class="col-2" id="price">
                                    90.000đ
                                </div>
                                <div class="col-sm-3">
                                    <div id="quantity">
                                        <label>Quantities:</label>
                                        <input id="numQuantity" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" id="noteProduct" placeholder="Please note important information of products like size, quantities,...">
                                </div>
                                <div class="col-sm-12">
                                    <a href="#">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" id="money">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>
                                <span>Temporary</span>
                                <span>90.000đ</span>
                            </p>
                        </div>
                        <div class="col-sm-12">
                            <p>
                                <span>Total</span>
                                <span>90.000đ</span>
                            </p>
                        </div>
                        <div class="col-sm-12">
                            <!-- <button type="submit" class="btn btn-danger" style="width: 100%;">Order</button> -->
                            <input type="submit" class="btn btn-danger" style="width: 100%" value="Order">
                        </div>
                    </div>
                </div>
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
</body>
</html>