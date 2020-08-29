<?php 
require_once "dbConnect.php"; 
$con = db_connect();
if(isset($_POST['id'])){
    if(isset($_POST['disable'])){
        $id = $_POST['id'];
        foreach($id as $key => $val)
        {
            $query = "UPDATE PRODUCT SET `enable` = 0 WHERE `id` = '$key'";
            if($con->query($query)){
                return header("location: ../Admin/product_list.php");
            }
        }
    }
    elseif(isset($_POST['enable'])){
        $id = $_POST['id'];
        foreach($id as $key => $val)
        {
            $query = "UPDATE PRODUCT SET `enable` = 1 WHERE `id` = '$key'";
            if($con->query($query)){
                return header("location: ../Admin/product_list.php");
            }
        }
    }

}