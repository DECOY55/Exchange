<?php
session_start();
include "_config.php";

if(auth($_SESSION['uuid']) == 0){
    header("Location: /");
}elseif(auth($_SESSION['uuid']) == 2){
    header("Location: /admin/worker_users_verifed");
}elseif(auth($_SESSION['uuid']) == 1){
    // By @cryptostudio_dev
}else{
    header("Location: https://t.me/cryptostudio_dev");
}

$pages = isset($_GET['pages']) ? $_GET['pages'] : 1;

switch($pages) {
    case 1:
        $page_active1 = 'active';
        break;
    case 2:
        $page_active2 = 'active';
        break;
    case 3:
        $page_active3 = 'active';
        break;
    case 4:
        $page_active4 = 'active';
        break;
    case 5:
        $page_active5 = 'active';
        break;
    default:
        $page_active1 = 'active';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>AdminPanel | Dev @cryptostudio_dev</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <? include "menu_cfg.php"; ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid" style="margin-top: -70px;">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">AdminPanel</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="index">AdminPanel</a></li>
                        <li class="active">Users</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- Other sales widgets -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Demo table -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">MANAGE USERS</div>
                        <div class="table-responsive">
                            <table class="table table-hover manage-u-table">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 70px">№</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>INFO</th>
                                    <th style="width: 250px">LOG</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?
                                $pagesID = 0;
                                if ($stmt = $db->prepare('SELECT * FROM verifed WHERE status = 0')) {
                                    $result = $stmt->execute();
                                    while ($arrs = $result->fetchArray(SQLITE3_ASSOC)) {
                                        if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="'.$arrs['uuid'].'"')) {
                                            $result = $stmt->execute();
                                            $arr = $result->fetchArray(SQLITE3_ASSOC);
                                        }
                                        if($pagesID < 10*$pages) {
                                            echo '
                                                                        <tr>
                                    <td class="text-center">' . $arr['id'] . '</td>
                                    <td><span class="font-medium"><a href="user_info?id=' . $arr['id'] . '">' . $arr['name'] . '</a></span></td>
                                    <td>' . $arr['email'] . '</td>
                                    <td><span class="btn btn-info btn-outline"><a href="user_info?id=' . $arr['id'] . '">Settings</a></span></td>
                                    <td>' . $arrs['text'] . '</td>
                                </tr>
                                        ';
                                        }
                                        $pagesID++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            <ul class="pagination pagination-lg m-b-0">
                                <li class="disabled"> <a href="#"><i class="fa fa-angle-left"></i></a> </li>
                                <li class="<?=$page_active1;?>"> <a href="?pages=1">1</a> </li>
                                <li class="<?=$page_active2;?>"> <a href="?pages=2">2</a> </li>
                                <li class="<?=$page_active3;?>"> <a href="?pages=3">3</a> </li>
                                <li class="<?=$page_active4;?>"> <a href="?pages=4">4</a> </li>
                                <li class="<?=$page_active5;?>"> <a href="?pages=5">5</a> </li>
                                <li> <a href="?pages=<? echo $pages + 1;?>"><i class="fa fa-angle-right"></i></a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2023 &copy; AdminPanel By @cryptostudio_dev </footer>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--Counter js -->
<script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Vector map JavaScript -->
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js"></script>
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<!-- chartist chart -->
<script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- sparkline chart JavaScript -->
<script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<script src="js/dashboard3.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
