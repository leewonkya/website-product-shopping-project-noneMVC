<?php
require_once "dbConnect.php"; 
$con = db_connect();

    $name = $_POST['name'];
    $price=  $_POST['price'];
    $quantity = $_POST['quantity'];
    $discount = $_POST['discount'];
    $image = $_FILES['image']['name'];
    $description = $_POST['description'];
    $id_cate = $_POST['id_cate'];
    
    $query = "INSERT INTO `product`(`name`, `price`, `quantity`, `image`, `status`, `discount`, `description`, `id_cate`) 
    VALUES ('$name','$price','$quantity','$image', '1', '$discount','$description','$id_cate')";
    if($con->query($query)){
        return header("Location: ../Admin/product_list.php");
    }
    else{
        echo mysqli_error($con);
    }
    