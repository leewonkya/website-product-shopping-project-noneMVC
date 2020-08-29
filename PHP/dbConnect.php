<?php 
    function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "manage_shop");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
    }

    function getAllCategory($con){
        $query = "SELECT * FROM category";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getAllUser($con){
        $query = "SELECT * FROM USER";
        $result = mysqli_query($con, $query);
        return $result;
    }   
    
    function getUserByUsername($con, $username){
        $query = "SELECT * FROM USER WHERE `username` = '$username'";
        $result = mysqli_query($con, $query);
        return $result;
    }
    
    function getCate($con){
        $query = "SELECT * FROM category 
        WHERE `id` NOT IN (SELECT `id` FROM category WHERE id_parent IS NULL)";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCateByIdParent($con, $id){
        $query = "SELECT * FROM category WHERE `id_parent` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getParentCate($con){
        $query = "SELECT * FROM CATEGORY WHERE `id_parent` IS NULL";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCateById($con, $id){
        $query = "SELECT * FROM CATEGORY WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCountProduct($con){
        $query = "SELECT COUNT(*) AS countProduct FROM `product`";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCountUser($con){
        $query = "SELECT COUNT(*) AS countUser FROM `User`";
        $result = mysqli_query($con, $query);
        return $result;
    }


    function getProductByIdCate($con, $id){
        $query = "SELECT * FROM PRODUCT WHERE `id_cate` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }
    
    function getCateByIdProduct($con, $id_product){
        $query = "SELECT `c.name` as name FROM product p INNER JOIN category c ON `c.id` = `p.id_cate` WHERE `p.id_cate` = '$id_product'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getProduct($con){
        $query = "SELECT * FROM PRODUCT";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getQuantityById($con, $id){
        $query = "SELECT `quantity` as quanti FROM PRODUCT WHERE `id` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function loadImageById($con, $id){
        $query = "SELECT * FROM `image_product` WHERE `id_product` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getProductById($con, $id){
        $query = "SELECT * FROM PRODUCT WHERE `id` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getImageProduct($con){
        $query = "SELECT * FROM `image_product`";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getImageProductById($con, $id){
        $query = "SELECT * FROM `image_product` WHERE `id` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function get6Product($con, $id_cate = null){
        if($id_cate == null){
            $query = "SELECT * FROM PRODUCT WHERE `enable` = 1 LIMIT 0, 6";
        }
        else {
            $query = "SELECT * FROM PRODUCT WHERE `id_cate` = '$id_cate' AND `enable` = 1 LIMIT 0, 6";
        }
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getUser($con, $username){
        $query = "SELECT * FROM `user` WHERE `username` = '$username'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function getPassword($con, $password){
        $query = "SELECT * FROM `user` WHERE `password` = '$password'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function getCartUnCheck($con){
        $query = "SELECT c.id as id, c.name as name, c.address as address,
        c.phone as phone, c.create_at as createAt, p.name as pname,
        p.price as price, cd.quantity as quantity, cd.total as total
        FROM cart AS c
        INNER JOIN cart_details cd ON c.id = cd.id_cart
        INNER JOIN product p ON p.id = cd.id_product
        WHERE cd.status = 0";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCart($con){
        $query = "SELECT * FROM CART";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getDetailsById($con, $id){
        $query = "SELECT c.id as id, p.name as pname,
        p.image as image, p.price as price, cd.quantity as quantity, cd.total as total
        FROM cart AS c
        INNER JOIN cart_details cd ON c.id = cd.id_cart
        INNER JOIN product p ON p.id = cd.id_product
        WHERE cd.status = 0 AND c.id = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getIdDetailsById($con, $id){
        $query = "SELECT `id` as id FROM CART_DETAILS WHERE `id_cart` = '$id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCartCheck($con){
        $query = "SELECT c.id as id, c.name as name, c.address as address,
        c.phone as phone, c.create_at as createAt, 
        c.success_at as successAt, p.name as pname,
        p.price as price, cd.quantity as quantity, cd.total as total
        FROM cart AS c
        INNER JOIN cart_details cd ON c.id = cd.id_cart
        INNER JOIN product p ON p.id = cd.id_product
        WHERE c.status = 1 AND cd.status = 1";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCountCartCheck($con){
        $query = "SELECT COUNT(*) as countCartCheck FROM CART WHERE `status` = 1";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getCountCartUnCheck($con){
        $query = "SELECT COUNT(*) as countCartUn FROM CART WHERE `status` = 0";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getIdProductById($con, $id, $quantity){
        $query = "SELECT `id_product` AS id, `id` AS id_details FROM CART_DETAILS WHERE `id_cart` = '$id' AND `quantity` = '$quantity'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function getQuantityCartById($con, $id){
        $query = "SELECT `quantity` FROM CART_DETAILS WHERE `id_cart` = '$id'";
        $result = mysqli_query($con, $id);
        return $result;
    }


    // function getPriceProductById($id){
    //     $con = db_connect();
    //     $query = "SELECT `price` FROM PRODUCT BY `id` = '$id'";
    //     $result = mysqli_query($con, $query);
    //     $val = mysqli_fetch_assoc($result);
    //     return $val['price'];
    // }

    // function total_price($cart){
    //     $price = 0;
    //     if(is_array($cart)){
    //         foreach($cart as $key => $val){
    //             $getPrice = getPriceProductById($key);
    //             if($getPrice){
    //                 $price += $getPrice * $val;
    //             }
    //         }
    //     }
    //     return $price;
    // }

    // function total_quantity($cart){
    //     $temp = 0;
    //     if(is_array($cart)){
    //         foreach($cart as $key => $val){
    //             $temp += $val;
    //         }
    //     }
    //     return $temp;
    // }