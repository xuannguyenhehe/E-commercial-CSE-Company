<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    $Name = $_POST["name"];
    $Material = $_POST["material"];
    $Color = $_POST["color"];
    $OtherDesign = $_POST["otherdesign"];
    $OtherFeature = $_POST["otherfeature"];
    $Note = $_POST["note"];
    $Price = $_POST["price"];
    $Image = $_POST["image"];
    $sql = "INSERT INTO ord (Name, Material, Color, OtherDesign, OtherFeature, Note, Price, Image, Status) VALUES ('$Name', '$Material', '$Color', '$OtherDesign', '$OtherFeature', '$Note', '$Price', '$Image', 'ACTIVE')";
    if (mysqli_query($dbhandle, $sql)){
        header("Location: product.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>