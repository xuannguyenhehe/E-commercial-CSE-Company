<!DOCTYPE html>
<html>
<head>
    <title>Order | CSE Corporation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/table.css">
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
                <li class="nav-item">
                    <a class="nav-link" href="home.php">BACK HOME </span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="product.php">PRODUCT </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="order.php">ORDER <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin.php">USER CONTROL </a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACCOUNT
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="login.php" target="_blank">Login/Signup</a>
                        <a class="dropdown-item" href="#" target="_blank">Administrator</a>
                        <a class="dropdown-item" href="#" target="_blank">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="product-content">
      <h1>Order</h1>
      <input type="text" id="nameSearch" onkeyup="searchName()" placeholder="Search for anything you want..">
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Bought</th>
            <th scope="col">Address</th>
            <th scope="col">Date</th>
            <th scope="col">Tel</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        <?php 
            $servername = "localhost";
            $username = "xuannguyenhehe";
            $password = "nguyen2808";
            $dbhandle = mysqli_connect($servername, $username, $password)
            or die("Unable to connect to MySQL<br>");
            echo "";
            $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
            or die("Could not select cse_corporation_1");

            $sql = "SELECT OID, Username, Address, TimeOrder, Tel, Total, Status FROM main_ord";
            $result = mysqli_query($dbhandle, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $OID = $row['OID'];
                $sqlHaving = "SELECT PID, Quantity FROM having_pid_oid WHERE OID='$OID'";
                $bought = '';
                $resultHaving = mysqli_query($dbhandle, $sqlHaving);
                if (mysqli_num_rows($resultHaving) > 0) {
                  while($rowHaving = mysqli_fetch_assoc($resultHaving)) {
                    $PID = $rowHaving["PID"];
                    $sqlPID = "SELECT Name FROM ord WHERE PID='$PID'";
                    $resultPID = mysqli_query($dbhandle, $sqlPID);
                    $rowPID = mysqli_fetch_assoc($resultPID);
                    $Name = $rowPID["Name"];
                    $Quantity = $rowHaving["Quantity"];
                    $bought = $bought.$Quantity.' '.$Name.' ';
                  }
                }
                $Userame = $row["Username"];
                $Address = $row["Address"];
                $TimeOrder = $row["TimeOrder"];
                $Tel = $row["Tel"];
                $Total = $row["Total"];
                $Status = $row["Status"];
                if ($Status == "DONE") {
                  echo "
                    <form action='changeStatusOID.php' method='POST'>
                      <tr>
                        <td><input type='checkbox' required></td>
                        <th scope='row'>$OID</th>
                        <td>$Userame</td>
                        <td>$bought</td>
                        <td>$Address</td>
                        <td>$TimeOrder</td>
                        <td>$Tel</td>
                        <td>$Total</td>
                        <td><button name='change' disabled class='btn btn-light' type='submit' value='$OID'>No Action</button></td>
                      </tr>
                      </form>
                      ";  
                }
                else {
                  echo "
                    <form action='changeStatusOID.php' method='POST'>
                      <tr>
                        <td><input type='checkbox' required></td>
                        <th scope='row'>$OID</th>
                        <td>$Userame</td>
                        <td>$bought</td>
                        <td>$Address</td>
                        <td>$TimeOrder</td>
                        <td>$Tel</td>
                        <td>$Total</td>
                        <td><button name='change' class='btn btn-success' type='submit' value='$OID'>DONE</button></td>
                      </tr>
                    </form>
                      ";
                }
              }
            }
          ?>
          <!-- <tr>
            <td><input type="checkbox"></td>
            <th scope="row">1</th>
            <td>#01</td>
            <td>nickpham2808</td>
            <td>2 books</td>
            <td>Nha Trang City, Khanh Hoa Province</td>
            <td></td>
            <td>07/07/2020</td>
            <td>0123456789</td>
            <td>300.000đ</td>
            <td>NOT YET</td>
            <td>
                <button class="btn btn-success">Done</button>
                <button class="btn btn-danger">Delete</button>
            </td>
        </tr>
          <tr>
            <td><input type="checkbox"></td>
            <th scope="row">2</th>
            <td>#02</td>
            <td>dongphuong</td>
            <td>3 skincares</td>
            <td>Ho Chi Minh City</td>
            <td></td>
            <td>01/07/2020</td>
            <td>0123456789</td>
            <td>500.000đ</td>
            <td>NOT YET</td>
            <td>
                <button class="btn btn-success">Done</button>
                <button class="btn btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <th scope="row">3</th>
            <td>#03</td>
            <td>nickpham2808</td>
            <td>1 laptop</td>
            <td>Ho Chi Minh City</td>
            <td></td>
            <td>28/08/2019</td>
            <td>0123456789</td>
            <td>30.000.000đ</td>
            <td>DONE</td>
            <td>
                <button class="btn btn-success">Done</button>
                <button class="btn btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <th scope="row">4</th>
            <td>#04</td>
            <td>dongphuong</td>
            <td>5 cat foods</td>
            <td>Ho Chi Minh City</td>
            <td></td>
            <td>01/01/2020</td>
            <td>0123456789</td>
            <td>400.000đ</td>
            <td>DONE</td>
            <td>
                <button class="btn btn-success">Done</button>
                <button class="btn btn-danger">Delete</button>
            </td>
          </tr> -->
        </tbody>
      </table>  
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
  <script src="./js/search.js"></script>
</body>
</html>
