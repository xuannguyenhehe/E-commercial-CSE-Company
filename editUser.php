<?php 
    $servername = "localhost";
    $username = "xuannguyenhehe";
    $password = "nguyen2808";
    $dbhandle = mysqli_connect($servername, $username, $password)
    or die("Unable to connect to MySQL<br>");
    echo "";
    $selected = mysqli_select_db($dbhandle, "cse_corporation_1")
    or die("Could not select cse_corporation_1");
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $fullname = $_POST["fullname"];
    $sex = $_POST["sex"];
    $tel = $_POST["tel"];
    $permit = $_POST["permit"];

    $sqlSelect = "SELECT Username, Pwd, Fullname, Sex, Tel, Email, Permit FROM account WHERE username = '$username'";
    $result = mysqli_query($dbhandle, $sqlSelect);
    $row = mysqli_fetch_assoc($result);
    $username_s = $row["username"];
    $pwd_s = $row["pwd"];
    $fullname_s = $row["fullname"];
    $sex_s = $row["sex"];
    $tel_s = $row["tel"];
    $permit_s = $row["permit"];
    

    if (strlen($username) == 0) $username = $username_s;
    if (strlen($pwd) == 0) $pwd = $pwd_s;
    if (strlen($fullname) == 0) $fullname = $fullname_s;
    if (strlen($sex) == 0) $sex = $sex_s;
    if (strlen($tel) == 0) $tel = $tel_s;
    if (strlen($permit) == 0) $permit = $permit_s;
    
    $sql = "UPDATE account SET Username = '$username', Pwd = '$pwd' ,fullname = '$fullname', sex = '$sex', tel = '$tel', permit = '$permit' WHERE username='$username'";
    if (mysqli_query($dbhandle, $sql)){
        header("Location: admin.php");
    }
    else {
        echo "Error deleting record: " . mysqli_error($dbhandle);
    }
?>