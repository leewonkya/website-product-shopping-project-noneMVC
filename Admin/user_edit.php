
<!DOCTYPE html>
<html lang="">
<?php 
    $title = "Chỉnh sửa Users";
    require_once './template/css.php'; 
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    
    $result = getUserByUsername($con, $username);
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
                        <h1 class="page-header">User
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    <?php foreach($result as $val){ ?>
                        <form action="../PHP/updateUser.php" method="POST">
                            <div class="form-group">
                                <label>UserName</label>
                                <input class="form-control" name="username" value="<?php echo $val['username'];?>" readonly/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" value="<?php echo $val['password'];?>" placeholder="Please Enter password"/>
                            </div>
                            <div class="form-group">
                            <label>Tên</label>
                                <input class="form-control" name="name" value="<?php echo $val['name']; ?>" placeholder="Please Enter Name" />
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address" value="<?php echo $val['address'];?>" placeholder="Please Enter Address" />
                            </div>
                            <button type="submit" class="btn btn-default">Product Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <form>
                    <?php }?>
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
