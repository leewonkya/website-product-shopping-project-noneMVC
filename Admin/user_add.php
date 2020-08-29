
<!DOCTYPE html>
<html lang="">
<?php 
    $title = "Thêm sản phẩm";
    require_once './template/css.php';      
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
                        <h1 class="page-header">Thêm
                            <small>User</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="../PHP/addUser.php" method="POST">
                            <div class="form-group">
                                <label>Tài khoản</label>
                                <input class="form-control" name="username" value="" placeholder="Please Enter UserName" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" name="password" value="" placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                            <label>Tên</label>
                                <input class="form-control" name="name" value="" placeholder="Please Enter Name" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address" value="" placeholder="Please Enter Address" />
                            </div>
                            <button type="submit" class="btn btn-default">Product Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <form>
                    </div>
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
