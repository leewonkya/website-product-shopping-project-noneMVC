<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
// session_destroy();
require_once '../Client/template/css.php'; 
require_once '../PHP/dbConnect.php';

$con = db_connect();
$msg = "";


?>

<body>
    <div id="wrapper bg-light">
        <!-- Page Header -->
        <?php require_once '../Client/template/header.php'; ?>
        <?php require_once '../Client/template/carousel.php'; ?>
        <!-- <div class="py-4"></div> -->
        <div class="py-4"></div>
        <!-- Page Content -->
        <!-- Page Cart -->
        <div class="cart mt-4">
            <div class="container-xl container-lg container-md container-sm">
                <div class="row">
                    <div class="h2 mb-4 page-title w-100">Giỏ hàng của Tôi</div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="index.php" class="h5 cart-back"><span><i class="fas fa-backward"></i></span> Tiếp tục
                            mua sắm</a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="row">

                                    <div class="cart-title ml-4 clearfix pl-5 pt-4">
                                        Sản phẩm
                                    </div>


                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="row">

                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="cart-price__text w-100 h-100 pt-4 mt-1">Giá</div>
                                    </div>

                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="cart-count__text w-100 h-100 text-center clearfix pt-4">
                                            Số lượng
                                        </div>
                                    </div>


                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="cart-afterUpdate__text w-100 h-100 pt-4">Tổng giá</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <hr>
                </div>
                <?php 

                if(isset($_GET['cart-id'])){
                    $id = $_GET['cart-id'];
                    unset($_SESSION['cart'][$id]);
                    // echo '<script>alert("Đã xóa thành công Sản phẩm '. $id .'")</script>';
                }

                if(isset($_POST['quantity'])){
                    $quantity = $_POST['quantity'];
                    foreach($quantity as $key => $val){
                        if($val <= 0){
                            unset($_SESSION['cart'][$key]);
                        }
                        else{
                            $_SESSION['cart'][$key]['quantity'] = $val;
                        }
                    }
                    
                }
                

                if(isset($_SESSION['cart'])){
                    
                    $total_price = 0;
                    $end_price = 0;
                    // echo '<pre>';
                    // print_r($_SESSION['cart']);
                    foreach($_SESSION['cart'] as $key => $val) {
                    $product = getProductById($con, $key);
                    $row = mysqli_fetch_assoc($product);
                    $curPrice = $row['price'] - ($row['price'] * $row['discount'])/100;
                    $total_price = $val['quantity'] * $curPrice;
                    $end_price += $total_price;
                ?>
                <form action="cart.php" method="POST">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row my-4">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="cart-heading ml-4 clearfix">
                                            
                                       
                                            <a href="cart.php?cart-id=<?php echo $key ?>" class="btn btn-sm float-left pt-4" style="color: red">
                                                <i class="fas fa-times-circle"></i>
                                            </a>

                                            <div class="cart-heading__img w-100 float-left">
                                                
                                                <div class="img-rounded">
                                                    <img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name'] ?>" title="<?php echo $row['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="cart-heading__name h-100 pt-4">
                                                <?php echo $row['name'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="cart-price w-100 h-100 pt-4 mt-1"><?php echo number_format($curPrice); ?><span>₫</span></div>
                                        </div>

                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="cart-box w-100 h-100 mt-2 text-center clearfix pt-2">
                                                <input type="number" name="quantity[<?php echo $key ?>]" class="form-control" max="<?php echo $row['quantity'] ?>"
                                                    min="0" value="<?php echo $val['quantity'] ?>" required="required" title="số lượng">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="cart-after-price w-100 h-100 pt-4 mt-1"><?php echo number_format($total_price) ?></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    <div class="row">


                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div>&nbsp;</div>
                        </div>


                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 float-right">
                            <div class="row">
                                <div class="container">

                                    <div class="cart-pay w-100 h-100 py-3 mt-4 d-inline-flex flex-row" style="box-shadow: rgb(150, 150, 150) 0px 0px 3px;
                                margin: 5px;;">
                                        <small class="px-2 mt-3">Tổng cộng</small>
                                        <div class="cart-price-total h5 mt-3"><?php echo number_format($end_price) ?><span>₫</span></div>
                                        
                                        <input type="hidden" name="id-cart" value="<?php echo $key ?>">
                                        <input type="submit" name="update" value="Cập nhật"
                                            class="ml-5 btn btn btn-outline-warning">
                                        <a href="pay.php" class="ml-5 btn btn-outline-warning">Thanh Toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                                            </form>
                <?php }else{
                    echo '<script>alert("Giỏ hàng trống");</script>';
                }?>

            </div>
        </div>
        <!-- Page Footer -->
        <?php require_once '../Client/template/footer.php' ?>

        <?php require_once '../Client/template/script.php' ?>
        <!-- PROBLEM -->


        <!-- <script>alert("cc");</script> -->
        <!-- ... -->
        <!-- <script> $("#myCart").css("color", "red");</script> -->
</body>

</html>