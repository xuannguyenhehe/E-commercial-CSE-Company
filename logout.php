<?php
session_start();

require("util.php");
$util = new AuthUtils();

//Clear Session
$_SESSION["user_id"] = "";
session_destroy();

// clear cookies
$util->clearAuthCookie();

$util->redirect('home.php'); 
?>