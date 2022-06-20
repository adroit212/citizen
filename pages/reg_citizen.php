<?php
session_start();
include '../resources/sessions.php';
$ses = new Sessions();
if (!isset($_SESSION['uid']) || !isset($_SESSION['role'])) {
    header("location:../index.php");
}
$role = $_SESSION['role'];
$uid = $_SESSION['uid'];

$citizen_count = count($ses->getAllCitizen());

if (isset($_POST['reg'])) {
    $nin = $_POST['nin'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital_status'];
    $children = $_POST['children'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    $permanent_address = $_POST['permanent_address'];
    $current_address = $_POST['current_address'];

    $checker = $ses->checkCitizen($nin);
    if (!$checker) {
        $ses->addCitizen($nin, $fullname, $gender, $dob, $marital_status, 
                $children, $state, $lga, $permanent_address, $current_address, 
                "alife", $email, $mobile);
        $enc_cid = base64_encode($nin);
        echo "<script>alert('Citizen registered successfully!'); window.location.href='search_citizen.php?cid=$enc_cid';</script>";
    } else {
        echo "<script>alert('NIN has already been used!');</script>";
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
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <div class="wrapper">
            <!--Header-->
            <?php include '../resources/header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include '../resources/sidebar.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3>Register Citizen</h3>
                                </div>
                                <form method="post" name="regsector">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>National Identity Number (NIN):</label>
                                                <input type="text" name="nin" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Full Name:</label>
                                                <input type="text" name="fullname" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Email:</label>
                                                <input type="text" name="email" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Mobile:</label>
                                                <input type="text" name="mobile" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Gender:</label>
                                                <select name="gender" class="form-control" required>
                                                    <option></option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Date of Birth:</label>
                                                <input type="datetime-local" name="dob" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Marital Status:</label>
                                                <select name="marital_status" class="form-control" required>
                                                    <option></option>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="divorced">Divorced</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Children:</label>
                                                <input type="number" name="children" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>State:</label>
                                                <input type="text" name="state" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>LGA:</label>
                                                <input type="text" name="lga" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Permanent Home Address:</label>
                                                <textarea style="resize: none;" rows="4" type="text" name="permanent_address" class="form-control" required></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Current Home Address:</label>
                                                <textarea style="resize: none;" rows="4" type="text" name="current_address" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer text-right">
                                        <button type="submit" name="reg" class="btn btn-primary">Register Citizen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!--Footer-->
            <?php include '../resources/footer.php'; ?>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!-- Morris.js charts -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='../plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.min.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../dist/js/pages/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js" type="text/javascript"></script>
    </body>
</html>