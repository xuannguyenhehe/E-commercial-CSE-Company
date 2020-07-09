<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    $Username = $_POST["username"];
    $Pwd = $_POST["pwd"];
    $Fullname = $_POST["fullname"];
    $Sex = $_POST["sex"];
    $Tel = $_POST["tel"];
    $Email = $_POST["email"];
    $Permit = $_POST["permit"];
    $sql = "INSERT INTO account (Username, Pwd, Fullname, Sex, Tel, Email, Permit) VALUES ('$Username', '$Pwd', '$Fullname', '$Sex', '$Tel', '$Email', '$Permit')";
    if (mysqli_query($dbhandle, $sql)){
        header("Location: admin.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>