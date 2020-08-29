<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM `product` WHERE `id` = '$id'";
    if($con->query($query)){
        return header("Location: ../Admin/product_list.php", "Refresh: 0");
        
    }
    else{
        echo mysqli_error($con);
    }
}