<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_GET['id'])){
    $id_cart = $_GET['id'];
    $result = mysqli_fetch_assoc(getIdDetailsById($con, $id_cart));
    $id = $result['id'];
   
    $query = "DELETE FROM Cart_Details WHERE `id` = '$id'";
    if($con->query($query)){
        return header("Location: ../Admin/cart_list_uncheck.php", "Refresh: 0");
    }
    else{
        echo mysqli_error($con);
    }
}