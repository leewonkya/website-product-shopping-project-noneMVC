<?php
require_once "dbConnect.php"; 
$con = db_connect();

$id = $_POST['id'];
$name = $_POST['name'];
$price=  $_POST['price'];
$quantity = $_POST['quantity'];
$discount = $_POST['discount'];
$image = $_POST['image_Update'];
$description = $_POST['description'];
$id_cate = $_POST['id_cate'];
$query = "UPDATE `product` 
SET `name`='$name',`price`='$price',`quantity`='$quantity',`image`='$image', `discount`='$discount',`description`='$description', `id_cate` = '$id_cate'
WHERE `id`= '$id'";

if($con->query($query)){
    return header("Location: ../Admin/product_list.php");
}
else{
    echo mysqli_error($con);
}