
<!DOCTYPE html>
<html lang="">
    

    <?php 
    session_start();
    $title = "Admin";
    require_once './template/css.php'; 
    require_once '../PHP/dbConnect.php';
    $con = db_connect();

    if(!isset($_SESSION['login'])){
        header("location: login.php");
    }
    else{

    if(isset($_POST['logout'])){
        unset($_SESSION['login']);
        header("location: index.php");
    }

    $countProduct = getCountProduct($con);
    $countP = mysqli_fetch_array($countProduct);
    $countUser = getCountUser($con);
    $countU = mysqli_fetch_array($countUser);
    $countCartUn = mysqli_fetch_assoc(getCountCartUnCheck($con));
    $countCartCheck = mysqli_fetch_assoc(getCountCartCheck($con));
    ?>
    
    <!-- Style -->
    <style>
        .info-box{
            display: block;
            min-height: 90px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: 2px;
            margin-bottom: 15px;
        }
        .info-box-icon{
            border-top-left-radius: 2px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 2px;
            display: block;
            float: left;
            height: 90px;
            width: 90px;
            text-align: center;
            font-size: 45px;
            line-height: 90px;
            background: rgba(0,0,0,0.2);
            margin-right: 10px;

        }
        .info-box-content{
            padding: 5px 10px;
        }
        .info-box-text{
            display: block;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .info-box-number{
            display: block;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
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
                        <h1 class="page-header">Dashboard
                        </h1>
                    </div>
                    <div class="py-2"></hr></div>
                    <!-- /.col-lg-12 -->
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                <div class="info-box">
                                    <span class="info-box-icon" style="background-color: #00c0ef !important;">
                                    <i class="fa fa-shopping-cart fa-fw" style="color: #fff"></i>
                                    </span>                   
                                    <div class="info-box-content">
                                        <span class="info-box-text">Các giao địch dang chờ</span>
                                        <span class="info-box-number"><?php echo $countCartUn['countCartUn'] ?></span>
                                        <span><a href="cart_list_uncheck.php" class="btn btn-sm btn-primary">Kiểm tra</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="info-box">
                                    <span class="info-box-icon" style="background-color: #00a65a !important;">
                                    <i class="fa fa-cube fa-fw" style="color: #fff"></i>
                                    </span>                   
                                    <div class="info-box-content">
                                        <span class="info-box-text">Các giao dịch thành công</span>
                                        
                                        <span class="info-box-number"><?php echo $countCartCheck['countCartCheck'] ?></span>
                                        <span><a href="cart_list_check.php" class="btn btn-sm btn-success">Kiểm tra</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="info-box">
                                    <span class="info-box-icon" style="background-color: #dd4b39 !important;">
                                    <i class="fa fa-users fa-fw" style="color: #fff"></i>
                                    </span>                   
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tổng sản phẩm</span>
                                        <span class="info-box-number"><?php echo $countP['countProduct'] ?></span>
                                        <span><a href="product_list.php" class="btn btn-sm btn-danger">Kiểm tra</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="info-box">
                                    <span class="info-box-icon" style="background-color: #f39c12 !important;">
                                    <i class="fa fa-users fa-fw" style="color: #fff"></i>
                                    </span>                   
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tổng thành viên</span>
                                        <span class="info-box-number"><?php echo $countU['countUser'] ?></span>
                                        <span><a href="user_list.php" class="btn btn-sm btn-warning">Kiểm tra</a></span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
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
    <?php }?>
</html>
