
<!DOCTYPE html>
<html lang="">
    <?php 
    $title = "Thêm ảnh cho sản phẩm";
    require_once './template/css.php';
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $result = getImageProductById($con, $id);
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
                        <h1 class="page-header">Cập nhật hình ảnh cho
                            <small>Sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <form action="../PHP/updateImageProduct.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <label>Hình ảnh</label>
                                <input type="file" name="image">
                            </div>
                            <button type="submit" class="btn btn-default">Cập nhật</button>
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
    <script>
    tinyMCE.init({
        selector: '#content',
        height: 300,
        entity_encoding: "raw",
        relative_urls: false,

        inline_styles: true,
        image_advtab: true,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code colorpicker textcolor responsivefilemanager'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor | backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link  image fullscreen | responsivefilemanager |',
        external_filemanager_path: "http://localhost:8088/product-Shop-project/Source/Admin/filemanager/",
        external_plugins: {
            "filemanager": "http://localhost:8088/product-Shop-project/Source/Admin/filemanager/plugin.min.js"
        },
        filemanager_title: "Responsive File Manager",
        filemanager_access_key: 'f970ce5bc016b5c5ca08e2e39c2cc937&foldr=',
    });</script>
    </body>
</html>
