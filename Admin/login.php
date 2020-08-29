<!DOCTYPE html>
<html lang="en">
<?php 
require_once '../PHP/dbConnect.php';
$con = db_connect();
$msg = '';
session_start();

?>
<?php

if(isset($_POST['signIn'])){
    // if(isset($_SESSION['login']) && !empty($_POST['username']) && !empty($_POST['password'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $name = $_POST['username'];
        $pass = $_POST['password'];

        if(!isset($_SESSION['login'][$name])){
            $_SESSION['login'][$name] = array(
                'name' => $name,
                'pass' => $pass
            );
        }

        $check = getUser($con, $name);
        if($check){            
            $checkPassword = getPassword($con, $pass);    
                
            if($checkPassword){
                
                // return header("location: index.php");
                return header("location: index.php");
            }
            else{               
                echo '<script>alert("Mật khẩu không chính xác");</script>';                
                return header("refresh: 0");
            }
        }
        else{
            echo '<script>alert("Tài khoản không tồn tại");</script>';     
        }
    }
    else{
        echo '<script>alert("Vui lòng nhập tài khoản và mật khẩu");</script>';
    }
    // }
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Core CSS -->
    <link href="./assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form .btn {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form .btn:hover,
        .form .btn:active,
        .form .btn:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        body {
            background: #76b852;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(right, #76b852, #8DC26F);
            background: -moz-linear-gradient(right, #76b852, #8DC26F);
            background: -o-linear-gradient(right, #76b852, #8DC26F);
            background: linear-gradient(to left, #76b852, #8DC26F);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="form">
            <!-- <form class="register-form" action="../PHP/signup.php" method="POST">
      <input name="" value="" type="text" placeholder="name"/>
      <input name="" value="" type="password" placeholder="password"/>
      <input name="" value="" type="text" placeholder="phone number"/>
      <input class="btn btn-signUp" type="submit" name="signUp" value="Tạo tài khoản">
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form> --> 
            <form class="login-form" action="" method="POST">
                <input name="username" value="" type="text" placeholder="Tài khoản" />
                <input name="password" value="" type="password" placeholder="Mật khẩu" />
                <input class="btn btn-signIn" type="submit" name="signIn" value="Đăng nhập">
                <!-- <p class="message">Not registered? <a href="#">Create an account</a></p> -->
            </form>
        </div>
    </div>
    <!-- jQuery -->
    <script src="./assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
    $('.message a').click(function() {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });
    </script>
    

</body>

</html>