<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
require_once '../Client/template/css.php'; 
require_once '../PHP/dbConnect.php';


$con = db_connect();

// echo $_POST['id_cate'];
if(isset($_GET['id_cate'])){
    $id_cate = $_GET['id_cate'];
}
else{
    $id_cate = null;
}
// $id_cate = 3;
$product = get6Product($con, $id_cate);
$cateParent = getParentCate($con);
// $cate = getCate($con);

?>

<body>
    <div id="wrapper bg-light">
        <!-- Page Header -->
        <?php require_once '../Client/template/header.php'; ?>
        <?php require_once '../Client/template/carousel.php'; ?>
        <div class="py-4"></div>

        <!-- Page Content -->
        <div class="content mt-2">
            <div class="container-xl container-lg container-md container-sm">
                <hr>
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <button id="btnShowSidebar" class="btn" style="font-size: 150%;"><i
                                class="fas fa-bars"></i></button>

                        <ul class="sidebar">
                            <button id="btnHideSidebar" class="btn" style="font-size: 150%;"><i
                                    class="far fa-window-close"></i></button>
                            <?php foreach($cateParent as $val){ ?>
                            <li id="dropdownToggle">
                                <div class="h3"><?php echo $val['name'] ?></div>
                                <?php
                                $cate = getCateByIdParent($con, $val['id']);
                                ?>
                                <?php foreach($cate as $val){ ?>
                                <ul class="sidebar-box">
                                    <li class="sidebar-box__item">
                                        <a href="index.php?id_cate=<?php echo $val['id'] ?>"
                                            id="row_<?php echo $id_cate ?>" data-id="<?php echo $val['id'] ?>"
                                            type="submit" onclick="clickLi(<?php echo $val['id']; ?>)"
                                            class="sidebar-box__link"><?php echo $val['name']; ?></a>
                                    </li>
                                </ul>
                                <?php } ?>
                            </li>
                                <?php } ?>
                        </ul>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row" id="loadmore">
                                    <!-- <form action="" method="POST"> -->
                                    <?php while($val = mysqli_fetch_array($product)){ ?>
                                    <div class="col-xs-4 col-sm-6 col-md-6 col-lg-4">
                                        <div class="row">
                                            <div class="product d-block my-4">
                                                <div class="product-img" style="position: relative;">
                                                    <div class="img-rounded">
                                                        <a href="#" class=""><img
                                                                src="../uploads/<?php echo $val['image']; ?>"
                                                                alt="<?php echo $val['name']; ?>"
                                                                title="<?php echo $val['name']; ?>"></a>
                                                    </div>
                                                    <?php if($val['discount'] >= 10){ ?>
                                                    <span><button class="btn btn-sm btn-danger px-3"
                                                            style="position: absolute; top: 5px; left: 5px;"><?php echo $val['discount']; ?><span>%</span></button></span>
                                                    <?php }?>
                                                    <?php if($val['quantity'] == 0){ ?>
                                                    <span><button class="btn btn-sm btn-dark text-center w-100"
                                                            style="position: absolute; top: 40%; left: 0;">HET
                                                            HANG</button></span>
                                                    <?php }else{?>
                                                    <span></span>
                                                    <?php }?>
                                                </div>
                                                <div class="product-body">
                                                    <div class="product-body__name mt-1 w-100">
                                                        <a
                                                            title="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></a>
                                                    </div>
                                                    <?php if($val['discount'] >=10){ ?>
                                                    <div class="product-body__DiscountPrice">
                                                        <?php echo number_format($val['price'] - ($val['price']*($val['discount'])/100));?><span>₫</span>
                                                    </div>
                                                    <?php } else{?>
                                                    <div class="product-body__DiscountPrice"></div>
                                                    <?php }?>

                                                    <div class="product-body__price" style="<?php
                                                    if($val['discount'] >= 10){ echo "text-decoration: line-through;";} else{ echo "";}
                                                    ?>"><?php echo number_format($val['price']); ?><span>₫</span></div>

                                                    <div class="product-body__action">
                                                        <form action="collections.php" method="POST">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $val['id']; ?>">
                                                            <!-- <a type="submit" name="loadId" href="cc.php" class="btn btn-sm btn-warning px-4 text-white btn-addProduct">
                                                                <span>
                                                                    <i class="fas fa-eye"></i>
                                                                </span> Xem chi tiết
                                                            </span>
                                                        </a> -->
                                                            <input type="submit" name="loadId"
                                                                class="btn btn-sm btn-warning px-4 text-white btn-addProduct"
                                                                value="Xem chi Tiết">
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>

                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once '../Client/template/footer.php'; ?>
        </div>

        <?php require_once '../Client/template/script.php'; ?>
        <!-- PROBLEM -->

        <script>
        $(document).ready(function() {
            var item = 6;

            $(window).scroll(function() {
                if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
                    $.ajax({
                        type: "GET",
                        url: "loadmore.php",
                        data: {
                            'offset': item,
                            'limit': 6
                        },
                        success: function(response) {
                            $("#loadmore").append(response);
                            item += 6;
                        }
                    });
                }
            });

        });
        </script>


        <!-- <script>alert("cc");</script> -->
        <!-- ... -->
        <!-- <script> $("#myCart").css("color", "red");</script> -->
</body>

</html>