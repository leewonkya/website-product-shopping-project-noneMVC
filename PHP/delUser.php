<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_GET['username'])){
    $username = $_GET['username'];
    $query = "DELETE FROM User WHERE `username` = '$username'";
    if($con->query($query)){
        return header("Location: ../Admin/user_list.php", "Refresh: 0");
    }
    else{
        echo mysqli_error($con);
    }
}