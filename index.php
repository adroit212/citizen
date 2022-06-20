<?php
session_start();
include 'resources/sessions.php';
$ses = new Sessions();
$stat = isset($_GET['failed']) ? $_GET['failed'] : "";

//login operation
if (isset($_POST['signin'])) {
    $userid = $_POST['userid'];
    $pass = $_POST['pass'];
    $try_login = $ses->login($userid, $pass);

    if ($try_login != NULL) {
        $_SESSION['uid'] = $userid;
        $_SESSION['role'] = $try_login;

        header("location:pages/index.php");
    } else {
       echo "<script>alert('Incorrect sign in details!'); window.location.href='index.php?failed=0';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $ses->APP_TITLE ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
        <style type="text/css" rel="stylesheet">
            img{
                width: 200px;
                border-radius: 20px; 
            }
        </style>
    </head>
    <body class="login-page" style="">
        <div class="login-box">
            <div class="login-logo">
                <div>
                    <img src="images/logo.jpg" alt="error"/>
                </div>
                <a href="#"><b><?php echo $ses->APP_TITLE ?></b></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Incorrect sign in details!</p>
                <?php
                if ($stat == "0") {
                    ?>
                    <p style="padding: 10px;" class="bg-success">
                        Incorrect login details!
                    </p>
                    <?php
                }
                ?>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input name="userid" type="text" class="form-control" placeholder="Username" required/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="pass" type="password" class="form-control" placeholder="Password" required/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">
                                <label>
                                    <!--<input type="checkbox"> Remember Me-->
                                </label>
                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" name="signin" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>