<?php
require_once "dbConnect.php"; 
$con = db_connect();

if (isset($_POST['name'], $_POST['id'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    
    $query = "UPDATE CATEGORY SET `name` = '$name' WHERE `id` = '$id'";
    if ($con->query($query)) {
        return header("Location: ../Admin/cate_list.php");
    } else {
        echo mysqli_error($con);
    }
}
    