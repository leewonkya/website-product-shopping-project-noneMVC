
<!DOCTYPE html>
<html lang="">
    <?php 
    $title = "Danh mục loại sản phẩm";
    require_once './template/css.php'; 
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    $result = getImageProduct($con);
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
                        <h1 class="page-header">Danh sách
                            <small>ảnh của Sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>ID_Product</th>
                                <th>Xóa</th>
                                <th>Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row=mysqli_fetch_assoc($result)){ ?>
                        
                            <tr class="odd gradeX" align="center">
                                <td><?php echo $index ?></td>
                                <td><img style="width:100px" src="../uploads/<?php echo $row['name']; ?>" alt="Mô hình">
                                
                                </td>
                                <td><?php echo $row['id_product']; ?></td>
                                <td class="center">
                                    <i class="fa fa-trash-o  fa-fw"></i>
                                    <a  href="../PHP/delImageProduct.php?id=<?php echo $row['id']; ?>">Xóa</a>
                                </td>
                                <td class="center">
                                    <i class="fa fa-pencil fa-fw"></i> 
                                    <a href="image_product_edit.php?id=<?php echo $row['id']; ?>">Cập nhật</a>
                                </td>
                            </tr>
                        <?php $index++; ?>
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
