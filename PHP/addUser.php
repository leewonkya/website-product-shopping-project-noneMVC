<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_POST['username'],$_POST['password'],$_POST['name'],$_POST['address'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $query = "INSERT INTO `user`(`username`, `password`, `name`, `address`) 
            VALUES ('$username','$password','$name','$address')";
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