
<!DOCTYPE html>
<html lang="">
<?php 
    $title = "Danh sách user ";
    require_once './template/css.php'; 
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    $result = getAllUser($con);    
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
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Username</th>
                                <th>Password</th>
                                <th>Full name</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhật</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $val){ ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo $val['username'] ?></td>
                                <td><?php echo $val['password'] ?></td>
                                <td><?php echo $val['name'] ?></td>
                                <td><?php echo $val['address'] ?></td>
                                <td><?php echo $val['create_at'] ?></td>
                                <td><?php echo $val['update_at'] ?></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="../PHP/delUser.php?username=<?php echo $val['username'] ?>"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="../Admin/user_edit.php?username=<?php echo $val['username']; ?>">Edit</a></td>
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
