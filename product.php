<?php
session_start();

require_once("auth.php");
require_once("util.php");

$auth = new Auth();
$db_handle = new DBController();
$util = new AuthUtils();

$isLoginUser = false;
$permission = "STAFF";
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
    <title>Product | CSE Corporation</title>
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
                <li class="nav-item active">
                  <a class="nav-link" href="product.php">PRODUCT <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="order.php">ORDER </span></a>
                </li>
                <?php
                    if($permission == "ADMIN"){
                        ?>
                        <li class="nav-item active">
                          <a class="nav-link" href="admin.php">USER CONTROL <span class="sr-only"></span></a>
                        </li>
                      <?php
                    }
                ?>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACCOUNT
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
            </ul>
        </div>
    </nav>
    <div id="product-content">
      <h1>Product</h1>
      <button id="btnAdd" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add New Product</button>
      <button id="btnAdd" type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Edit Product</button>
      <br>
      <input type="text" id="nameSearch" onkeyup="searchName()" placeholder="Search for anything you want..">

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form action="addNewPID.php" method="POST">
                <div class="form-group">
                  <label for="name" class="col-form-label">Name:</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                  <label for="material" class="col-form-label">Material:</label>
                  <input type="text" class="form-control" id="material" name="material">
                </div>
                <div class="form-group">
                  <label for="color" class="col-form-label">Color:</label>
                  <input type="color" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                  <label for="otherdesign" class="col-form-label">Other design:</label>
                  <input type="text" class="form-control" id="otherdesign" name="otherdesign">
                </div>
                <div class="form-group">
                  <label for="otherfeature" class="col-form-label">Other feature:</label>
                  <input type="text" class="form-control" id="otherfeature" name="otherfeature">
                </div>
                <div class="form-group">
                  <label for="note" class="col-form-label">Note:</label>
                  <textarea class="form-control" id="note" name="note"></textarea>
                </div>
                <div class="form-group">
                  <label for="price" class="col-form-label">Price:</label>
                  <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                  <label for="name" class="col-form-label">Image:</label>
                  <input type="file" id="myfile" class="form-control" name="image">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form action="editPID.php" method="POST">
                <div class="form-group">
                  <label for="pid" class="col-form-label">PID:</label>
                  <input type="number" class="form-control" id="pid" name="pid">
                </div>
                <div class="form-group">
                  <label for="name" class="col-form-label">Name:</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                  <label for="material" class="col-form-label">Material:</label>
                  <input type="text" class="form-control" id="material" name="material">
                </div>
                <div class="form-group">
                  <label for="color" class="col-form-label">Color:</label>
                  <input type="color" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                  <label for="otherdesign" class="col-form-label">Other design:</label>
                  <input type="text" class="form-control" id="otherdesign" name="otherdesign">
                </div>
                <div class="form-group">
                  <label for="otherfeature" class="col-form-label">Other feature:</label>
                  <input type="text" class="form-control" id="otherfeature" name="otherfeature">
                </div>
                <div class="form-group">
                  <label for="note" class="col-form-label">Note:</label>
                  <textarea class="form-control" id="note" name="note"></textarea>
                </div>
                <div class="form-group">
                  <label for="price" class="col-form-label">Price:</label>
                  <input type="number" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                  <label for="name" class="col-form-label">Image:</label>
                  <input type="file" id="myfile" class="form-control" name="image">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Material</th>
            <th scope="col">Color</th>
            <th scope="col">Other design</th>
            <th scope="col">Other feature</th>
            <th scope="col">Note</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
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
                $Status = $row["Status"];
                if ($Status == "ACTIVE") {
                  echo "
                    <form action='changeStatusPID.php' method='POST'>
                      <tr>
                        <td><input type='checkbox' required></td>
                        <th scope='row'>$PID</th>
                        <td>$Name</td>
                        <td>$Material</td>
                        <td>$Color</td>
                        <td>$OtherDesign</td>
                        <td>$OtherFeature</td>
                        <td>$Note</td>
                        <td>$Price đ</td>
                        <td>$Image</td>
                        <td><button name='change' class='btn btn-success' type='submit' value='$PID'>$Status</button></td>
                      </tr>
                      </form>
                      ";  
                }
                else {
                  echo "
                    <form action='changeStatusPID.php' method='POST'>
                      <tr>
                        <td><input type='checkbox'></td>
                        <th scope='row'>$PID</th>
                        <td>$Name</td>
                        <td>$Material</td>
                        <td>$Color</td>
                        <td>$OtherDesign</td>
                        <td>$OtherFeature</td>
                        <td>$Note</td>
                        <td>$Price đ</td>
                        <td>$Image</td>
                        <td><button name='change' class='btn btn-warning' type='submit' value='$PID'>$Status</button></td>
                      </tr>
                    </form>
                      ";
                }
              }
            }
          ?>
          
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
