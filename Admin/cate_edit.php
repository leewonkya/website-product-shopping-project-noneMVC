
<!DOCTYPE html>
<html lang="">
    <?php 
    $title = "Danh mục sản phẩm";
    require_once './template/css.php';
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $result = getCateById($con, $id);
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
                        <h1 class="page-header">Category
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <form action="../PHP/updateCate.php" method="POST">                            
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <label>Category Name</label>
                                <input class="form-control" name="name" value="<?php echo $row['name'] ?>" placeholder="Please Enter Category Name" />
                            </div>
                            <button type="submit" class="btn btn-default">Category Edit</button>
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
