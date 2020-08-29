<?php
require_once "dbConnect.php"; 
$con = db_connect();

$image = $_FILES['image']['name'];
$id = $_POST['id'];

$query = "UPDATE `image_product` 
        SET `name`='$image'
        WHERE `id`='$id'";
if($con->query($query)){
    return header("Location: ../Admin/image_product_list.php");
} else {
    echo mysqli_error($con);
}