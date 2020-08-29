
<!DOCTYPE html>
<html lang="">
    <?php 
    $title = "Danh mục loại sản phẩm";
    require_once './template/css.php'; 
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    $result = getAllCategory($con);
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
                            <small>Loại sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>ID_Parent</th>
                                <th>Xóa</th>
                                <th>Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row=mysqli_fetch_assoc($result)){ ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                <?php 
                                if($row['id_parent'] == null){
                                    echo "------";
                                }
                                else{
                                    echo $row['id_parent']; 
                                }
                                ?></td>
                                <td class="center">
                                    <i class="fa fa-trash-o  fa-fw"></i>
                                    <a  href="../PHP/delCate.php?id=<?php echo $row['id']; ?>">Xóa</a>
                                </td>
                                <td class="center">
                                    <i class="fa fa-pencil fa-fw"></i> 
                                    <a href="cate_edit.php?id=<?php echo $row['id']; ?>">Cập nhật</a>
                                </td>
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
