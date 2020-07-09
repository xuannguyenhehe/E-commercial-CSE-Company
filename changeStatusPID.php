<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    $PID = $_POST["change"];
    $sql = "SELECT Status FROM ord WHERE PID = '$PID'";
    $result = mysqli_query($dbhandle, $sql);
    $row = mysqli_fetch_assoc($result);
    $Status = $row["Status"];
    if ($Status == "EXPIRED") $Status = "ACTIVE";
    else $Status = "EXPIRED";

    $sqlUpdate = "UPDATE ord SET Status = '$Status' WHERE PID = '$PID'";
    if (mysqli_query($dbhandle, $sqlUpdate)){
        header("Location: product.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>