
<!DOCTYPE html>
<html lang="">
<?php 
    $title = "Danh mục sản phẩm";
    require_once './template/css.php'; 
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    $result = getProduct($con);
    $status = "";
    ?>
    </head>
    <body>
        
    <div id="wrapper">
        
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include_once './template/header.php';
                  include_once './template/menu.php'
            ?>
            
            
            <!-- /.navbar-static-side -->
        </nav>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách
                            <small>Sản phẩm</small>
                        </h1>
                    </div>
                    <form action="../PHP/disable.php" method="POST">
                            <input type="submit" name="disable" value="Vô hiệu" class="btn btn-primary btn-sm" style="margin-bottom: 10px;">
                            <input type="submit" name="enable" value="Cho phép" class="btn btn-primary btn-sm" style="margin-bottom: 10px;">
                    <!-- /.col-lg-12 -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th></th>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th>Vô hiệu</th>
                                <th>Giảm giá</th>
                                <th>Thêm ảnh</th>
                                <th>Xóa</th>
                                <th>Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) {
                                
                                ?>

                            <tr class=" odd gradeX " align="center ">
                                <td><input type="checkbox" name="id[<?php echo $row['id'] ?>]" value="<?php echo $row['id'] ?>"></td>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo number_format($row['price'])?></td>
                                <td><?php echo $row['quantity']?></td>
                                <td><img style="width:100px" src="../uploads/<?php echo $row['image']?>" alt="<?php echo $row['name']?>"></td>
                                <td><?php
                                
                                if($row['quantity'] != 0){
                                    $value = "Còn hàng";
                                    echo '<div class="alert" role="alert" style="background-color: #0d5d1f; color: #fff;">'.$value.'</div>';
                                }
                                else{
                                    $value = "Hết hàng";
                                    echo '<div class="alert" role="alert" style="background-color: #dd4b39; color: #fff;">'.$value.'</div>';
                                }
                                ?>
                                </td>
                                <td><?php
                                
                                if($row['enable'] != 0){
                                    $value = "Cho phép";
                                    echo '<div class="alert" role="alert" style="background-color: #0d5d1f; color: #fff;">'.$value.'</div>';
                                }
                                else{
                                    $value = "Vô hiệu";
                                    echo '<div class="alert" role="alert" style="background-color: #dd4b39; color: #fff;">'.$value.'</div>';
                                }
                                ?>
                                </td>
                                <td><?php echo $row['discount']?>%</td>
                                <td class="center "><i class="fa fa-plus-square-o fa-fw "></i><a href="image_product_add.php?id=<?php echo $row['id'] ?>"> Thêm ảnh</a></td>
                                <td class="center "><i class="fa fa-trash-o fa-fw "></i><a href="../PHP/delProduct.php?id=<?php echo $row['id'] ?>"> Xóa</a></td>
                                <td class="center "><i class="fa fa-pencil fa-fw "></i> <a href="product_edit.php?id=<?php echo $row['id'] ?>">Cập nhật</a></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
                                
    <?php require_once './template/script.php'; ?>
    </body>
</html>
