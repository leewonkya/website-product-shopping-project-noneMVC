
<!DOCTYPE html>
<html lang="">
    <?php 
        $title = "DANH MỤC GIỎ HÀNG";
        require_once './template/css.php'; 
        require_once '../PHP/dbConnect.php';
        $con = db_connect();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $result = getDetailsById($con, $id);
        $index = 1;
    ?>
    </head>
    <body>
    <div id="wrapper">
        
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php 
            include_once './template/header.php';
            include_once './template/menu.php';
            ?>
        </nav>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết 
                            <small>Giỏ hàng</small>
                        </h1>
                        <!-- <form action="">
                            <input type="submit">
                        </form> -->
                    </div>
                    <form action="../PHP/checkout.php" method="POST">
                            <input type="submit" name="checkOut" value="Xác nhận" class="btn btn-primary btn-sm" style="margin-bottom: 10px;">
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th></th>                      
                                <th>STT</th>          
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng đặt</th>
                                <th>Tổng tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <tr class="even gradeC " align="center ">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <td><input type="checkbox" name="id[<?php echo $row['id'] ?>]" value="<?php echo $row['quantity'] ?>"></td>
                                <td><?php echo $index; ?></td>
                                <td><?php echo $row['pname'] ?></td>
                                <td><img style="width:100px" src="../uploads/<?php echo $row['image']; ?>" alt="Mô hình">
                                <td><?php echo number_format($row['price']) ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                                <td><?php echo number_format($row['price'] * $row['quantity']) ?></td>                               
                                <td><a href="../PHP/delCartDetails.php?id=<?php echo $row['id'] ?>">Xóa</a></td>
                            </tr>
                                <?php $index++; ?>
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
    <script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    </script>
    </body>
</html>
