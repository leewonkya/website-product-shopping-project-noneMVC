
<!DOCTYPE html>
<html lang="">
<?php 
    $title = "Thêm loại sản phẩm";
    require_once './template/css.php'; 
    require_once '../PHP/dbConnect.php';
    $con = db_connect();
    $result = getParentCate($con);
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
                            <small>Loại sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="../PHP/addCate.php" method="POST">
                        

                            <div class="form-group">
                                <label>Category Parent</label>
                                <select class="form-control" name="id">
                                    <option value="">None</option>
                                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="name" value="" placeholder="Please Enter Category Name" />
                            </div>
                            <button type="submit" class="btn btn-default">Category Add</button>
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
