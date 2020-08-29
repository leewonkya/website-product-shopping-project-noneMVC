<?php
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_POST['name'], $_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    if($id == null){
        $query = "INSERT INTO `category`(`name`) 
    VALUES ('$name')";
    }
    else{
        
        $query = "INSERT INTO `category`(`name`, `id_parent`) 
    VALUES ('$name', '$id')";
    }
     
    
    if($con->query($query)){
        return header("Location: ../Admin/cate_list.php");
    }
    else{
        echo '<script>window.alert("ngu vc")</script>';
        echo mysqli_error($con);
    }
}