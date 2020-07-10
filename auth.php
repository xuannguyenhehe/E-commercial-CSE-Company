<?php
require("db_connect.php");
class Auth {

    // table ACCOUNT
    // query user ny username from ACCOUNT table
    function getUserByUsername($username) {
        $db_handle = new DBController();
        $query = "Select * from account where Username = ?";
        $result = $db_handle->runQuery($query, 's', array($username));
        return $result;
    }

    // table ACCOUNT
    function addNewUser($username, $pwd,$fullname, $sex, $tel,$email){
        $db_handle = new DBController();
        $role = "MEMBER";
        $query = "INSERT INTO account (Username, Pwd, Fullname ,Sex, Tel, Email, Permit) VALUES (?, ?, ?,?,?,?,?)";
        $sql = "INSERT INTO cart (Username) VALUES (?)";
        $result = $db_handle->insert($query, 'sssssss', array($username, $pwd, $fullname, $sex, $tel, $email, $role));
        $rsql = $db_handle->insert($sql, 's', array($username));
        return $result;
    }

    //table AUTHTOKEN
	function getTokenByUsername($username,$expired) {
	    $db_handle = new DBController();
	    $query = "Select * from tbl_token_auth where username = ? and is_expired = ?";
	    $result = $db_handle->runQuery($query, 'si', array($username, $expired));
	    return $result;
    }
    //table AUTHTOKEN
    function markAsExpired($tokenId) {
        $db_handle = new DBController();
        $query = "UPDATE tbl_token_auth SET is_expired = ? WHERE id = ?";
        $expired = 1;
        $result = $db_handle->update($query, 'ii', array($expired, $tokenId));
        return $result;
    }
    //table AUTHTOKEN
    function insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date) {
        $db_handle = new DBController();
        $query = "INSERT INTO tbl_token_auth (username, password_hash, selector_hash, expiry_date) VALUES (?, ?, ?,?)";
        $result = $db_handle->insert($query, 'ssss', array($username, $random_password_hash, $random_selector_hash, $expiry_date));
        return $result;
    }
    
    function update($query) {
        mysqli_query($this->conn,$query);
    }
}
?>