<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    $PID = $_POST["pid"];
    $Name = $_POST["name"];
    $Material = $_POST["material"];
    $Color = $_POST["color"];
    $OtherDesign = $_POST["otherdesign"];
    $OtherFeature = $_POST["otherfeature"];
    $Note = $_POST["note"];
    $Price = $_POST["price"];
    $Image = $_POST["image"];

    $sqlSelect = "SELECT Name, Material, Color, OtherDesign, OtherFeature, Note, Price, Image, Status FROM ord WHERE PID = '$PID'";
    $result = mysqli_query($dbhandle, $sqlSelect);
    $row = mysqli_fetch_assoc($result);
    $Name_s = $row["Name"];
    $Material_s = $row["Material"];
    $Color_s = $row["Color"];
    $OtherDesign_s = $row["OtherDesign"];
    $OtherFeature_s = $row["OtherFeature"];
    $Note_s = $row["Note"];
    $Price_s = $row["Price"];
    $Image_s = $row["Image"];

    if (strlen($Name) == 0) $Name = $Name_s;
    if (strlen($Material) == 0) $Material = $Material_s;
    if (strlen($Color) == 0) $Color = $Color_s;
    if (strlen($OtherDesign) == 0) $OtherDesign = $OtherDesign_s;
    if (strlen($OtherFeature) == 0) $OtherFeature = $OtherFeature_s;
    if (strlen($Note) == 0) $Note = $Note_s;
    if (strlen($Price) == 0) $Price = $Price_s;
    if (strlen($Image) == 0) $Image = $Image_s;
    
    $sql = "UPDATE ord SET Name = '$Name', Material = '$Material', Color = '$Color', OtherDesign = '$OtherDesign', OtherFeature = '$OtherFeature', Note = '$Note', Price = '$Price', Image = '$Image' WHERE PID='$PID'";
    if (mysqli_query($dbhandle, $sql)){
        header("Location: product.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>