
<!DOCTYPE html>
<html lang="">
    <?php 
        $title = "DANH MỤC GIỎ HÀNG";
        require_once './template/css.php'; 
        require_once '../PHP/dbConnect.php';
        $con = db_connect();
        // $result = getCartUnCheck($con);
        $cart = getCart($con);
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }

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
                            <small>Giỏ hàng</small>
                        </h1>
                        <!-- <form action="">
                            <input type="submit">
                        </form> -->
                    </div>
                    <form action="../PHP/checkout.php" method="POST">
                            <!-- <input type="submit" name="checkOut" value="Xác nhận" class="btn btn-primary btn-sm" style="margin-bottom: 10px;"> -->
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <!-- <th></th>                                 -->
                                <th>Tên</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Ngày Đặt</th>
                                <th>Xem chi tiết</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_assoc($cart)){ ?>
                            <tr class="even gradeC " align="center ">
                                <!-- <td><input type="checkbox" name="id[][<?php echo $row['id'] ?>]" value="<?php echo $row['quantity'] ?>"></td> -->
                                <!-- <td>></td> -->
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['create_at'] ?></td>
                                <td><a href="cart_details.php?id=<?php echo $row['id']; ?>">Xem</a></td>
                                <td><a href="../PHP/delCart.php?id=<?php echo $row['id'] ?>">Xóa</a></td>
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
    <script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    </script>
    </body>
</html>
