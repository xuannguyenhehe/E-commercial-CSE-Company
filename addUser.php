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
    $Pwd = md5($_POST["pwd"]);
    $RePwd = md5($_POST["repwd"]);
    $Fullname = $_POST["fullname"];
    $Sex = $_POST["sex"];
    $Tel = $_POST["tel"];
    $Email = $_POST["email"];
    $Permit = $_POST["permit"];

    // if ($Pwd != $RePwd){
    //     echo "Please press password again!";
    //     header("Location: admin.php");
    //     return;
    // }

    $sql = "INSERT INTO account (Username, Pwd, Fullname, Sex, Tel, Email, Permit) VALUES ('$Username', '$Pwd', '$Fullname', '$Sex', '$Tel', '$Email', '$Permit')";
    if (mysqli_query($dbhandle, $sql)){
        $sqlCart = "INSERT INTO cart (Username) VALUES ('$Username')";
        if (mysqli_query($dbhandle, $sqlCart)){
            header("Location: admin.php");
        }
        else {
            echo "Error deleting record: " . mysqli_error($dbhandle);    
        }
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>