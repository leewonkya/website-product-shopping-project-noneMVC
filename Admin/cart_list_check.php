
<!DOCTYPE html>
<html lang="">
    <?php 
        $title = "DANH MỤC GIỎ HÀNG";
        require_once './template/css.php'; 
        require_once '../PHP/dbConnect.php';
        $con = db_connect();
        $result = getCartCheck($con);
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
                        <h1 class="page-header">Danh sách
                            <small>Giỏ hàng đã thanh toán</small>
                        </h1>
                        <!-- <form action="">
                            <input type="submit">
                        </form> -->
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th></th>                                
                                <th>Tên</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Ngày Đặt</th>
                                <th>Ngày thanh toán</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng mua</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <tr class="even gradeC " align="center ">
                                <td><input type="checkbox" value="<?php echo $row['id'] ?>"></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['createAt'] ?></td>
                                <td><?php echo $row['successAt'] ?></td>
                                <td><?php echo $row['pname'] ?></td>
                                <td><?php echo number_format($row['price']) ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                                <td><?php echo number_format($row['price'] * $row['quantity']); ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
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
