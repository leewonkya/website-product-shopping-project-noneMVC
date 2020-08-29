<!DOCTYPE html>
<html lang="en">

<?php 
require_once '../Client/template/css.php'; 
require_once '../PHP/dbConnect.php';
$count = 1;

$con = db_connect();

// echo $_POST['id_cate'];
if(isset($_GET['id_cate'])){
    $id_cate = $_GET['id_cate'];
}
else{
    $id_cate = null;
}
// $id_cate = 3;
$product = get6Product($con, $id_cate);
$cateParent = getParentCate($con);
$cate = getCate($con);

?>

<body>
    <div id="wrapper bg-light">
        <!-- Page Header -->
        <?php require_once '../Client/template/header.php'; ?>
        <div class="py-4"></div>

        <!-- Page Content -->
        <div class="content mt-2">
            <div class="container-xl container-lg container-md container-sm">
                <hr>
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <button id="btnShowSidebar" class="btn" style="font-size: 150%;"><i class="fas fa-bars"></i></button>
                        
                        <ul class="sidebar">
                            <button id="btnHideSidebar" class="btn" style="font-size: 150%;"><i class="far fa-window-close"></i></button>
                            <li id="dropdownToggle">
                                <?php foreach($cateParent as $val){ ?>
                                    <div class="h3"><?php echo $val['name'] ?></div>
                                <?php } ?>
                                <?php foreach($cate as $val){ ?>
                                    <ul class="sidebar-box">
                                        <li class="sidebar-box__item">
                                            <!-- <input type="text" name="id_cate" value="<?php echo $val['id']; ?> ">                                         -->
                                            <a data-id="<?php echo $id_cate ?>" type="submit" href="index.php?id_cate=<?php echo $val['id']; ?>" class="sidebar-box__link"><?php echo $val['name']; ?></a>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </li>
                        </ul>
                    
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row" id="loadmore">
                                   
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <a href="#" class="h2 btn btn-lg btn-outline-warning text-center border w-100 py-2" id="btn--addMore">
                                            <span><i class="fas fa-angle-double-down"></i></span> More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Footer -->
            <footer class="footer"></footer>
        </div>

        <?php require_once '../Client/template/script.php' ?>
        <!-- PROBLEM -->
        <?php 
        if($count != 1){    
            echo '<script>$("#myCart").css("color", "red");</script>';
        }
        ?>
        <script>
        $(document).ready(function () {            
            var item = 0;

            
            $(".sidebar-box__link").on("click", function(){
                // var id_cate = $(this).attr("data-id");
                alert("haha");
            })l
            $.ajax({
                    type: "GET",
                    url: "loadmore.php",
                    data: {
                        'offset' : 0,
                        'limit' : 6,
                        'id_cate' : id_cate
                    },  
                    success: function (response) {
                        $("#loadmore").append(response);
                        item+=6;
                    }
            });
            
            $(window).scroll(function(){    

                if($(window).scrollTop() >= $(document).height() - $(window).height()){
                    $.ajax({
                    type: "GET",
                    url: "loadmore.php",
                    data: {
                        'offset' : item,
                        'limit' : 6,
                        'id_cate' : id_cate
                    },  
                    success: function (response) {
                        $("#loadmore").append(response);
                        item+=6;
                    }
                    });
                }

            });
        });
        </script>
        <!-- <script>alert("cc");</script> -->
        <!-- ... -->
        <!-- <script> $("#myCart").css("color", "red");</script> -->
</body>

</html>