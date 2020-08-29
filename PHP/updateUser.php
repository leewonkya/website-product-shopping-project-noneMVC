<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_POST['username'],$_POST['password'],$_POST['name'],$_POST['address'],)){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date("Y/m/d h:i:sa");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $query = "UPDATE `user` 
    SET `password`='$password',`name`='$name',`address`='$address',`update_at`= '$date'
    WHERE `username` = '$username'";

    if($con->query($query)){
        return header("location: ../Admin/user_list.php");
    }
    else{
        echo $username;
        echo $password;
        echo $address;
        echo $name;
        echo '<script>window.alert("ngu vc")</script>';
        echo mysqli_error($con);
    }
}