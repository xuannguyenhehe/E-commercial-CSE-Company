<?php 
    $user = $_COOKIE["user_login"];
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    $PID = $_POST["choose"];
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");

    $sqlSelect = "SELECT CID FROM cart WHERE Username = '$user'";
    $resultSelect = mysqli_query($dbhandle, $sqlSelect);
    $rowSelect = mysqli_fetch_assoc($resultSelect);
    $CID = $rowSelect["CID"];

    $sqlCheck = "SELECT PID FROM owning_pid_cart WHERE CID = '$CID'";
    $resultCheck = mysqli_query($dbhandle, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        while($rowCheck = mysqli_fetch_assoc($resultCheck)) {
            if ($rowCheck["PID"] == $PID){
                header("Location: cart.php");
                return;
            }
        }
    }

    $sqlCheck2 = "SELECT Status FROM ord WHERE PID = '$PID'";
    $resultCheck2 = mysqli_query($dbhandle, $sqlCheck2);
    $rowCheck2 = mysqli_fetch_assoc($resultCheck2);
    $Status = $rowCheck2["Status"];
    if ($Status == "EXPIRED"){
        header("Location: cart.php");
        return;
    }

    $sql = "INSERT INTO owning_pid_cart (PID, CID, Quantity) VALUES ('$PID', '$CID', 0)";
    if (mysqli_query($dbhandle, $sql)){
        header("Location: cart.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>