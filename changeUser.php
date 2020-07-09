<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    if (isset($_POST["change"])){
        $Username = $_POST["change"];
        echo $Username;
        $sql = "SELECT Permit FROM account WHERE Username = '$Username'";
        $result = mysqli_query($dbhandle, $sql);
        $row = mysqli_fetch_assoc($result);
        $Permit = $row["Permit"];
        if ($Permit == "STAFF") $Permit = "MEMBER";
        else $Permit = "STAFF";

        $sqlUpdate = "UPDATE account SET Permit = '$Permit' WHERE Username = '$Username'";
        if (mysqli_query($dbhandle, $sqlUpdate)){
            header("Location: admin.php");
        }
        else {
            echo "Error deleting record: " . mysqli_error($dbhandle);
        }
    }
    else if (isset($_POST["delete"])){
        $Username = $_POST["delete"];
        $sql = "DELETE FROM account WHERE Username = '$Username'";
        if (mysqli_query($dbhandle, $sql)){
            header("Location: admin.php");
        }
        else {
            echo "Error deleting record: " . mysqli_error($dbhandle);
        }
    }
?>