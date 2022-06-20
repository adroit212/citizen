<?php
session_start();
include '../resources/sessions.php';
$ses = new Sessions();
if (!isset($_SESSION['uid']) || !isset($_SESSION['role'])) {
    header("location:../index.php");
}
$role = $_SESSION['role'];
$uid = $_SESSION['uid'];
$page_status = "hidden";
$url_cid = isset($_GET['cid']) ? base64_decode($_GET['cid']) : "";
$citizen = "";

$medical_key = "";
$security_key = "";
$admin_key = "";

if ($role == "medical") {
    $medical_key = "";
    $security_key = "hidden";
} elseif ($role == "security") {
    $medical_key = "hidden";
    $security_key = "";
} elseif ($role == "admin") {
    $medical_key = "";
    $security_key = "";
    $admin_key = "hidden";
}

if ($url_cid != "") {
    $page_status = "";
    $citizen = $ses->getSingleCitizenByNIN($url_cid);
}

if (isset($_POST['search'])) {
    $nin = $_POST['nin'];
    $checker = $ses->checkCitizen($nin);
    if ($checker) {
        $enc_cid = base64_encode($nin);
        header("location:search_citizen.php?cid=$enc_cid");
    } else {
        echo "<script>alert('Citizen not found!');</script>";
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
                                    <h3>Search Citizens</h3>
                                </div>
                                <form method="post" name="regsector">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8 form-group">
                                                <label>National Identification Number (NIN):</label>
                                                <input value="<?php echo $url_cid; ?>" type="number" name="nin" class="form-control" required/>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>&nbsp;</label><br/>
                                                <button type="submit" name="search" class="btn btn-primary">
                                                    <i class="glyphicon glyphicon-search"></i> 
                                                    Search Citizen
                                                </button>
                                            </div>
                                        </div>
                                        <div <?php echo $page_status ?> class="row">
                                            <div class="col-md-12"><hr/></div>
                                            <div <?php echo $admin_key ?> class="col-md-12">
                                                <span <?php echo $security_key ?>><a hidden href="reg_case_issue.php?cid=<?php echo $_GET['cid'] ?>" class="btn btn-primary">
                                                        New Case Issues
                                                    </a></span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span <?php echo $medical_key ?>><a href="reg_health_issue.php?cid=<?php echo $_GET['cid'] ?>" class="btn btn-info">
                                                        New Health Issues
                                                    </a></span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span <?php echo $medical_key ?>><a href="reg_health_record.php?cid=<?php echo $_GET['cid'] ?>" class="btn btn-success">
                                                        Update Health Record
                                                    </a></span>
                                            </div>
                                            <div class="col-md-12">
                                                <h3>Citizen Details</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>National Identity Number:</strong> <?php echo $citizen['nin'] ?></p>
                                                <p><strong>Full Name:</strong> <?php echo $citizen['fullname'] ?></p>
                                                <p><strong>Email Address:</strong> <?php echo $citizen['email'] ?></p>
                                                <p><strong>Mobile Number:</strong> <?php echo $citizen['mobile'] ?></p>
                                                <p><strong>Gender:</strong> <?php echo $citizen['gender'] ?></p>
                                                <p><strong>Date of Birth:</strong> <?php echo date_format(date_create($citizen['dob']), "d M Y") ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Marital Status:</strong> <?php echo $citizen['marital_status'] ?></p>
                                                <p><strong>Children:</strong> <?php echo $citizen['children'] ?></p>
                                                <p><strong>State:</strong> <?php echo $citizen['state'] ?></p>
                                                <p><strong>LGA:</strong> <?php echo $citizen['lga'] ?></p>
                                                <p><strong>Citizen Status:</strong> <?php echo $citizen['citizen_status'] ?></p>
                                                <p><strong>Current Home Address:</strong> <?php echo $citizen['current_address'] ?></p>
                                                <p><strong>Permanent Home Address:</strong> <?php echo $citizen['home_address'] ?></p>
                                            </div>
                                            <div <?php echo $medical_key ?> class="col-md-12">
                                                <hr/>
                                                <h3>Citizen Health Record</h3>
                                            </div>
                                            <?php
                                            $health_record = $ses->getSingleHealthByNIN($url_cid);
                                            $allergies = "";
                                            $genotype = "";
                                            $bloodgroup = "";
                                            $virus = "";
                                            $handicap = "";
                                            $last_update = "";

                                            if ($health_record != "") {
                                                $allergies = $health_record['allergies'];
                                                $genotype = $health_record['genotype'];
                                                $bloodgroup = $health_record['blood_group'];
                                                $virus = $health_record['virus'];
                                                $handicap = $health_record['handicap'];
                                                $last_update = date_format(date_create($health_record['last_update']), "d M Y");
                                            }
                                            ?>
                                            <div <?php echo $medical_key ?> class="col-md-6">
                                                <p><strong>Allergies:</strong> <?php echo $allergies ?></p>
                                                <p><strong>Genotype</strong> <?php echo $genotype ?></p>
                                                <p><strong>Blood Group:</strong> <?php echo $bloodgroup ?></p>
                                            </div>
                                            <div <?php echo $medical_key ?> class="col-md-6">
                                                <p><strong>Virus:</strong> <?php echo $virus ?></p>
                                                <p><strong>Handicap:</strong> <?php echo $handicap ?></p>
                                                <p><strong>Last Update:</strong> <?php echo $last_update ?></p>
                                            </div>
                                            <div <?php echo $security_key ?> class="col-md-12">
                                                <hr/>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="6">
                                                                <h3>Case Issues</h3>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Offences</th>
                                                            <th>Court Result</th> <!--guilty not-guilty not-charged-->
                                                            <th>Penalty</th>
                                                            <th>Issue Date</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $all_cases = $ses->getAllCaseIssueByNIN($url_cid);
                                                        $case_counter = 1;
                                                        foreach ($all_cases as $single_case) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $case_counter ?></td>
                                                                <td><?php echo $single_case['offences'] ?></td>
                                                                <td><?php echo $single_case['result'] ?></td>
                                                                <td><?php echo $single_case['penalty'] ?></td>
                                                                <td><?php echo date_format(date_create($single_case['case_date']), "d M Y") ?></td>
                                                            </tr>
                                                            <?php
                                                            $case_counter++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div <?php echo $medical_key ?> class="col-md-12">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="6">
                                                                <h3>Health Issues</h3>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Illness</th>
                                                            <th>Tests</th>
                                                            <th>Test Result</th>
                                                            <th>Issue Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $all_healthI = $ses->getAllHealthIssueByNIN($url_cid);
                                                        $healthI_counter = 1;
                                                        foreach ($all_healthI as $healthI) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $healthI_counter ?></td>
                                                                <td><?php echo $healthI['illness'] ?></td>
                                                                <td><?php echo $healthI['all_tests'] ?></td>
                                                                <td><?php echo $healthI['test_result'] ?></td>
                                                                <td><?php echo date_format(date_create($healthI['issue_date']), "d M Y") ?></td>
                                                            </tr>
                                                            <?php
                                                            $healthI_counter++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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