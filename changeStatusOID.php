<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    $OID = $_POST["change"];
    $sql = "SELECT Status FROM main_ord WHERE OID = '$OID'";
    $result = mysqli_query($dbhandle, $sql);
    $row = mysqli_fetch_assoc($result);
    $Status = $row["Status"];
    if ($Status == "NOT YET") $Status = "DONE";

    $sqlUpdate = "UPDATE main_ord SET Status = '$Status' WHERE OID = '$OID'";
    if (mysqli_query($dbhandle, $sqlUpdate)){
        header("Location: order.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>