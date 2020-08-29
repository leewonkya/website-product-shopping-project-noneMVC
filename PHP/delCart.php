<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM CART WHERE `id` = '$id'";
    if($con->query($query)){
        return header("Location: ../Admin/cart_list_uncheck.php", "Refresh: 0");
    }
    else{
        echo mysqli_error($con);
    }
}