<?php 
    $user = $_COOKIE["user_login"];
    $TotalName = $_POST["order"];
    $fullname = $_POST["fullname"];
    $address = $_POST["address"];
    $tel = $_POST["tel"];
    $name = explode(' ', $TotalName);
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");

    $sqlCID = "SELECT CID FROM cart WHERE Username = '$user'";
    $resultCID = mysqli_query($dbhandle, $sqlCID);
    $rowCID = mysqli_fetch_assoc($resultCID);
    $CID = $rowCID["CID"]; 
    $total = 0;
    for ($i = 1; $i < count($name); $i++){
        $temp = $name[$i];
        $sqlPID = "SELECT PID FROM ord WHERE Name='$temp'";
        $resultPID = mysqli_query($dbhandle, $sqlPID);
        $rowPID = mysqli_fetch_assoc($resultPID);
        $PID = $rowPID["PID"]; 
        $quanPID = $_POST["quantity"][$i - 1];

        $sqlPrice = "SELECT Price FROM ord WHERE PID='$PID'";
        $resultPrice = mysqli_query($dbhandle, $sqlPrice);
        $rowPrice = mysqli_fetch_assoc($resultPrice);
        $Price = $rowPrice["Price"]; 
        $total = $total + $Price*$quanPID;

    }
    $time = date("Y-m-d");
    $sqlOrd = "INSERT INTO main_ord (Username, Address, TimeOrder, Tel, Total, Status) VALUES ('$user', '$address', '$time', '$tel', '$total', 'NOT YET')";
    if (mysqli_query($dbhandle, $sqlOrd)){
        $OID = mysqli_insert_id($dbhandle);
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }

    for ($i = 1; $i < count($name); $i++){
        $temp = $name[$i];
        $sqlPID = "SELECT PID FROM ord WHERE Name='$temp'";
        $resultPID = mysqli_query($dbhandle, $sqlPID);
        $rowPID = mysqli_fetch_assoc($resultPID);
        $PID = $rowPID["PID"]; 
        $quanPID = $_POST["quantity"][$i - 1];

        $sqlHaving = "INSERT INTO having_pid_oid (PID, OID, Quantity) VALUES ('$PID', '$OID', '$quanPID')";
        if (mysqli_query($dbhandle, $sqlHaving)){
            // header("Location: product.php");
        }
        else {
            echo "Error deleting record: " . mysqli_error($dbhandle);
        }
    }

    for ($i = 1; $i < count($name); $i++){
        $temp = $name[$i];
        $sqlPID = "SELECT PID FROM ord WHERE Name='$temp'";
        $resultPID = mysqli_query($dbhandle, $sqlPID);
        $rowPID = mysqli_fetch_assoc($resultPID);
        $PID = $rowPID["PID"]; 
        echo $PID.' '.$CID;
        $sqlDelCart ="DELETE FROM owning_pid_cart WHERE PID='$PID' AND CID='$CID'";
        if (mysqli_query($dbhandle, $sqlDelCart)){
        }
        else {
            echo "Error deleting record: " . mysqli_error($dbhandle);
        }
    }
    header("Location: cart.php");
?>