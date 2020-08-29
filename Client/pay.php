<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
// session_destroy();
require_once '../Client/template/css.php'; 
require_once '../PHP/dbConnect.php';

$con = db_connect();
$totalProduct = 0;
$total = 0;
$index = 0;

$totalCart = 0;
$totalProduct_Cart = 0;
function getTotalPrice($cart){
    $totalPrice = 0;
    $currentPrice = 0;
    if(is_array($cart)){
        foreach($cart as $key => $val){
            $productPrice = getPriceProductById($key);
            $currentPrice += ($val['quantity'] * $productPrice);
            $totalPrice += $currentPrice;
        }
    }
    return $totalPrice;
}

if(isset($_POST['name'], $_POST['address'], $_POST['phone'])){
        $name = $_POST['name']; 
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $createAt = date("Y/m/d h:i:sa");
        $createCart = "INSERT INTO `cart`(`name`, `address`, `phone`, `create_at`) VALUES ('$name','$address','$phone','$createAt')";
        if($con->query($createCart)){
            $id_cart = mysqli_insert_id($con);
            foreach($_SESSION['cart'] as $key => $val){
                $myProduct = getProductById($con, $key);
                $value = mysqli_fetch_assoc($myProduct);
                $curPrice = $value['price'] - ($value['price'] * $value['discount'])/100;
                $totalProduct_Cart = $val['quantity'] * $curPrice;
                $total += $totalProduct_Cart;
            }
            $totalCart = $total;
            foreach($_SESSION['cart'] as $key => $val){
                $quantity = $val['quantity'];
                $query = "INSERT INTO `cart_details`(`id_cart`, `id_product`,`quantity`, `total`) VALUES ('$id_cart','$key', '$quantity' ,'$totalCart')";
                if($con->query($query)){
                    echo '<script>alert("haha");</script>';
                }
                unset($_SESSION['cart']);                    
            }
        }
}   

?>

<body>
<div class="pay">
        <div class="container container-sm">
            <div class="row">

                <div class="col-xs-5 col-sm-12 col-md-5 col-lg-5">
                    <div class="mt-5">
                        <div class="row">
                            <div class="pay-send w-100 h-100">
                                <div class="container">
                                    <a href="index.php">
                                        <div class="pay-send__title">
                                            KT - SHOP | Shopping Online | Product is very cheap
                                        </div>
                                    </a>
                                    <div class="pay-send__info py-4">
                                        THÔNG TIN CỦA BẠN
                                    </div>
                                    <form action="pay.php" method="POST">
                                        <div class="form-group">
                                            <label for="">Họ và tên: </label>
                                            <input type="text" name="name" class="form-control" placeholder="Joh lie Ars">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Địa chỉ: </label>
                                            <input type="text" class="form-control" name="address" placeholder="213 Pham Huu Lau street, Cao Lanh City">
                                        </div>
                                            <div class="form-group">
                                                <label for="">Số điện thoại: </label>
                                                <input type="text" class="form-control" name="phone" placeholder="0123...">
                                            </div>
                                        <a href="cart.php" class="btn btn-sm text-primary float-left"><span><i class="fas fa-arrow-left"></i></span> Trở lại giỏ hàng</a>
                                        <button type="submit" class="btn btn-outline-primary float-right">Hoàn tất mua hàng</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if(empty($_SESSION['cart'])){
                    
                    header("location: cart.php");
                }
                if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    
                   
                ?>
                <div class=" col-xs-7 col-sm-12 col-md-7 col-lg-7 ">
                    <div class="container-lg">

                        <div class="mt-5"></div>
                        <?php 
                        foreach($cart as $key => $val){
                            $product = getProductById($con, $key);
                            $row = mysqli_fetch_assoc($product);
                            $curPrice = $row['price'] - ($row['price'] * $row['discount'])/100;
                            $totalProduct = $val['quantity'] * $curPrice;
                            $total += $totalProduct;
                        ?>
                        <div class="row">
                            <div class="pay-product mt-2">
                                <div class="container">
                                    <div class="pay-pdBox pb-3 clearfix">

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="pay-pdBox__img float-left">
                                                <img src="../uploads/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>" title="<?php echo $row['name'] ?>" class="img-thumbnail img-fluid ">
                                            </div>
                                            <div title="<?php echo $row['name'] ?>" class="pl-3 pt-4 pay-pdBox__name float-left"><?php echo $row['name'] . " x " . $val['quantity'] ?></div>
                                            <div class="pl-3 pt-4 pay-pdBox__price float-right"><?php echo number_format($totalProduct) ?><span>₫</span></div>
                                            <div class="clear"></div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="py-3">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="pay-ttBox mt-3 w-100 pb-5">
                                <div class="container">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="pay-ttBox__total float-left pl-2">Tổng cộng</div>
                                        <div class="pay-ttBox__price float-right"><?php echo number_format($total); ?><span>₫</span></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>

        </div>
    </div>

        <?php require_once '../Client/template/script.php' ?>
        <!-- PROBLEM -->


        <!-- <script>alert("cc");</script> -->
        <!-- ... -->
        <!-- <script> $("#myCart").css("color", "red");</script> -->
</body>

</html>