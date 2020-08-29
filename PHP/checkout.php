<?php 
require_once "dbConnect.php";
$con = db_connect();
if(isset($_POST['id'])){
    $arrId = $_POST['id'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $success = date("Y/m/d h:i:sa");
    foreach($arrId as $key => $val){
        
        $id = getIdProductById($con, $key, $val);
        $id_product = mysqli_fetch_assoc($id);
        $myId = $id_product['id'];
        $id_details = $id_product['id_details'];    
        
        $quanti = mysqli_fetch_assoc(getQuantityById($con, $myId));
        
        if($quanti['quanti'] >= $val){
            $update = "UPDATE CART SET `status` = 1, `success_at` = '$success' WHERE `id` = '$key'";
            if($con->query($update)){
                
                $query = "UPDATE PRODUCT 
                SET 
                `discount` = 0,
                `quantity` = CASE WHEN `quantity` - '$val' <= 0 THEN 0 ELSE `quantity` - '$val' END,
                `status` = 
                CASE WHEN `quantity` <= 0 THEN 0 ELSE 1 END            
                WHERE `id` = '$myId'";
    
                if($con->query($query)){
                    $update_details = "UPDATE CART_DETAILS 
                    SET `status` = 1 WHERE `id` = $id_details";
                    if($con->query($update_details)){
                        return header("location: ../Admin/cart_list_check.php");
                    }
                }
            }
        }
        else{
            echo '<script>alert("Số lượng đặt không lớn hơn số lượng hiện tại")</script>';
        }
    }
}