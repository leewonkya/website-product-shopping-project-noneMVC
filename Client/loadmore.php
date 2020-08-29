<?php 
require_once '../PHP/dbConnect.php';
$con = db_connect();

if(isset($_GET['offset']) && isset($_GET['limit'])){
    
    $offset = $_GET['offset'];
    $limit   = $_GET['limit'];

    
    
    
    $query = "SELECT * FROM PRODUCT WHERE `enable` = 1 LIMIT $offset, $limit";
    $result = mysqli_query($con, $query);   
    
}

?>
<!-- <form action="" method="POST"> -->
    <?php while($val = mysqli_fetch_array($result)){ ?>
<div class="col-xs-4 col-sm-6 col-md-6 col-lg-4">
    <div class="row">
        <div class="product d-block my-4">
            <div class="product-img" style="position: relative;">
                <div class="img-rounded">
                    <a href="#" class=""><img src="../uploads/<?php echo $val['image']; ?>"
                            alt="<?php echo $val['name']; ?>" title="<?php echo $val['name']; ?>"></a>
                </div>
                <?php if($val['discount'] >= 10){ ?>
                <span><button class="btn btn-sm btn-danger px-3"
                        style="position: absolute; top: 5px; left: 5px;"><?php echo $val['discount']; ?><span>%</span></button></span>
                <?php }?>
                <?php if($val['quantity'] == 0){ ?>
                <span><button class="btn btn-sm btn-dark text-center w-100"
                        style="position: absolute; top: 40%; left: 0;">HET HANG</button></span>
                <?php }else{?>
                <span></span>
                <?php }?>
            </div>
            <div class="product-body">
                <div class="product-body__name mt-1 w-100">
                    <a title="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></a>
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
                        <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                        <!-- <a type="submit" name="loadId" href="cc.php" class="btn btn-sm btn-warning px-4 text-white btn-addProduct">
                                                                <span>
                                                                    <i class="fas fa-eye"></i>
                                                                </span> Xem chi tiết
                                                            </span>
                                                        </a> -->
                        <input type="submit" name="loadId" class="btn btn-sm btn-warning px-4 text-white btn-addProduct"
                            value="Xem chi Tiết">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php }?>

<!-- </form> -->