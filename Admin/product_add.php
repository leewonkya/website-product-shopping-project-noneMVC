<!DOCTYPE html>
<html lang="">

<?php 
    $title = "Thêm sản phẩm";
    require_once './template/css.php'; 
    require_once "../PHP/dbConnect.php"; 
    $con = db_connect();
    $result = getCate($con);
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
                            <small>sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="../PHP/addProduct.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control" name="id_cate">
                                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập vào tên sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" name="price" placeholder="Nhập vào giá" />
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" name="quantity" class="form-control" value=""
                                    placeholder="Nhập vào số lượng" min="{0}" } max="" step="" required="required"
                                    title="">
                            </div>

                            <div class="form-group">
                                <label>Giảm giá</label>
                                <input type="number" name="discount" class="form-control" value="" min="{0}" }
                                    max="{100}" placeholder="Thêm giảm giá" required="required" title="">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="image">

                            </div>
                            <div class="form-group">
                                <label>Chi tiết sản phẩm</label>
                                <textarea class="form-control" id="content" name="description" rows="3"></textarea> 
                                
                            </div>
                            <button type="submit" name="add" class="btn btn-default">Product Add</button>
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
    });
    </script>
</body>

</html>