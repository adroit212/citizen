<?php
$side_ses = new Sessions();
$side_role = $_SESSION['role'];
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../images/user.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['uid'] ?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-info"></i> Dashboard</a></li>
            <li><a href="search_citizen.php"><i class="fa fa-circle-o text-info"></i> Search Citizen</a></li>

            <?php
            if ($side_role == "admin") {
                ?>
                <li><a href="reg_sector.php"><i class="fa fa-circle-o text-info"></i> Register Sectors</a></li>
                <li><a href="view_sector.php"><i class="fa fa-circle-o text-info"></i> View Sectors</a></li>
                <?php
            } else if ($side_role == "medical") {
                ?>
                <li><a href="reg_citizen.php"><i class="fa fa-circle-o text-info"></i> Register Citizen</a></li>
                <?php
            } else if ($side_role == "security") {
                ?>
                <li><a href="reg_citizen.php"><i class="fa fa-circle-o text-info"></i> Register Citizen</a></li>
                <?php
            }
            ?>
            <li><a href="../logout.php"><i class="fa fa-circle-o text-info"></i>Sign Out</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>