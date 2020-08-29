<?php
require_once "dbConnect.php"; 
$con = db_connect();

$image = $_FILES['image']['name'];
$id_product = $_POST['id'];

$query = "INSERT INTO `image_product`(`name`, `id_product`) VALUES ('$image','$id_product')";
    if($con->query($query)){
        return header("Location: ../Admin/product_list.php");
    }
    else{
        echo mysqli_error($con);
    }