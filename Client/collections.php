<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
require_once '../Client/template/css.php'; 
require_once '../PHP/dbConnect.php';

$con = db_connect();
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $product = getProductById($con, $id);
    $image = loadImageById($con, $id);
}


if(isset($_POST['addCart'])){
    $cart_id = $_POST['id_product'];
    $quantity = $_POST['quantity'];
    $myProduct = getProductById($con, $cart_id);
    $row = mysqli_fetch_assoc($myProduct);
    
    if(!isset($_SESSION['cart'][$cart_id])){
        echo '<script>$("#myCart").css("color", "rgba(0,0,0,.5)");</script>';
        $_SESSION['cart'][$cart_id] = array(
            'id' => $cart_id,
            'name' => $row['name'],
            'image' => ($val['price'] - ($val['price']*($val['discount'])/100)),
            'price' => $row['price'],
            'quantity' => $quantity
        );
    }
    else{
        echo '<script>$("#myCart").css("color", "red");</script>';
        $_SESSION['cart'][$cart_id]['quantity'] += $quantity;
    }

    header("location: cart.php");
}

// ?>

<body>
    <div id="wrapper bg-light">
        <!-- Page Header -->
        <?php require_once '../Client/template/header.php'; ?>
        <?php require_once '../Client/template/carousel.php'; ?>
        <!-- <div class="py-4"></div> -->
        <div class="py-4"></div>
        <!-- Page Content -->
        <div class="collections mt-2">
            <div class="container-xl container-lg container-md container-sm">
                <div class="row">

                    <div class="container-sm container-xl">
                        
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <?php foreach($product as $val){ ?>
                                    <div class="collections-img">
                                        <div class="img-rounded">
                                            <img src="../uploads/<?php echo $val['image'] ?>" alt="<?php echo $val['name'] ?>" title="<?php echo $val['name'] ?>" id="getImg">
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="row">
                                    <div class="collections-box">
                                        <?php foreach($image as $val){ ?>
                                        <div class="collections-list">
                                            <div class="img-rounded">
                                                <img src="../uploads/<?php echo $val['name'] ?>" alt="" id="changeImg" onclick="changeImg(this.src)">
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                                <div class="row ">
                                    <div class="collections-body mb-4 w-100">
                                        <?php foreach($product as $val){ ?>
                                        <div class="collections-body__name">
                                           
                                            <?php echo $val['name'] ?>
                                        </div>
                                        <?php if($val['quantity'] >= 1){
                                            $status = "Còn hàng";
                                        }else{
                                            $status = "Hết hàng";
                                        
                                        } ?>
                                        <div class="collections-body__status py-2 "><?php echo $status ?></div>
                                        <?php ?>
                                        <div class="collections-body__quantity">Số lượng còn: <span><?php echo $val['quantity']; ?></span></div>
                                        <div class="collections-body__price"><?php echo number_format($val['price'] - ($val['price']*($val['discount'])/100));?><span>₫</span></div>
                                        <?php }?>
                                        <form action="" method="POST">
                                            
                                            <div class="form-group py-5">
                                                <label class="pt-2">Số lượng: </label>
                                                <input style="width: 40%;" type="number" name="quantity" class="form-control"  value="1" min="1"  max="<?php echo $val['quantity']; ?>" required="required" title="">
                                            </div>
                                            <input type="hidden" name="max-quantity" value="<?php echo $val['quantity']; ?>">
                                            <input type="hidden" name="id_product" value="<?php echo $val['id'] ?>">
                                            <input type="submit" name="addCart" value="Thêm vào giỏ" class="btn btn-warning px-4 text-white btn-addProduct">
                                        </form>
                                        <div class="collections-body__category pt-2">
                                            Danh mục: <span>Mô hình</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="py-4">
                    <hr>
                </div>
                <div class="row">
                    <?php foreach($product as $val){ ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="h2 mb-2 mt-4 w-25 pb-2 border-bottom">Mô tả</div>
                        <div class="row mt-5 pl-2">

                            <div class="col-xs-4 col-sm-12 col-md-4 col-lg-4">
                                <div class="h3 pl-3">Thông tin về sản phẩm</div>
                            </div>

                            <div class="col-xs-8 col-sm-12 col-md-8 col-lg-8">
                                <div class="border-left description-product pl-3">
                                <?php echo $val['description']; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>


    </div>
    <?php require_once '../Client/template/footer.php' ?>

        <?php require_once '../Client/template/script.php' ?>
        <!-- PROBLEM -->
        
        
        <!-- <script>alert("cc");</script> -->
        <!-- ... -->
        <!-- <script> $("#myCart").css("color", "red");</script> -->
</body>
</html>