<?php
session_start();
include "_config.php";

if(auth($_SESSION['uuid']) == 0){
    header("Location: /");
}elseif(auth($_SESSION['uuid']) == 2){
    header("Location: /admin/worker_index");
}elseif(auth($_SESSION['uuid']) == 1){
    // By @cryptostudio_dev
}else{
    header("Location: https://t.me/cryptostudio_dev");
}

if(isset($_POST['min_dstack'])){
    saveSettings('min_dstack', $_POST['min_dstack']);
}
if(isset($_POST['max_dstack'])){
    saveSettings('max_dstack', $_POST['max_dstack']);
}

if(isset($_POST['stack_eth'])){
    saveSettings('stack_eth', $_POST['stack_eth']);
}
if(isset($_POST['stack_usdt'])){
    saveSettings('stack_usdt', $_POST['stack_usdt']);
}
if(isset($_POST['stack_usdc'])){
    saveSettings('stack_usdc', $_POST['stack_usdc']);
}
if(isset($_POST['stack_bnb'])){
    saveSettings('stack_bnb', $_POST['stack_bnb']);
}
if(isset($_POST['stack_ada'])){
    saveSettings('stack_ada', $_POST['stack_ada']);
}
if(isset($_POST['stack_trx'])){
    saveSettings('stack_trx', $_POST['stack_trx']);
}
if(isset($_POST['stack_algo'])){
    saveSettings('stack_algo', $_POST['stack_algo']);
}
if(isset($_POST['stack_matic'])){
    saveSettings('stack_matic', $_POST['stack_matic']);
}
if(isset($_POST['stack_sol'])){
    saveSettings('stack_sol', $_POST['stack_sol']);
}
if(isset($_POST['stack_dot'])){
    saveSettings('stack_dot', $_POST['stack_dot']);
}
if(isset($_POST['stack_avax'])){
    saveSettings('stack_avax', $_POST['stack_avax']);
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
                        <li><a href="/">Index</a></li>
                        <li class="active">Settings site</li>
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
                <div class="white-box">
                    <h3 class="box-title m-b-0">Settings stack</h3>
                    <form class="form-horizontal" method="post">

                        <p class="text-muted m-b-20">format <code>1</code> 1 - min day</p>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Min. number of days*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="min_dstack" id="inputEmail3" placeholder="Min. number of days" value="<?=getSettings('min_dstack');?>"> </div>
                        </div>
                        <p class="text-muted m-b-20">format <code>15</code> 15 - max day</p>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Max. number of days*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="max_dstack" id="inputEmail3" placeholder="Max. number of days" value="<?=getSettings('max_dstack');?>"> </div>
                        </div>

                        <h3 class="box-title m-b-0">Personal settings stacking</h3>

                        <p class="text-muted m-b-20">format <code>5|10|100</code> 1 - min percent, 15 - max percent, 100 - min stack $</p>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ETH stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_eth" id="inputEmail3" placeholder="eth" value="<?=getSettings('stack_eth');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDT stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_usdt" id="inputEmail3" placeholder="usdt" value="<?=getSettings('stack_usdt');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDC stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_usdc" id="inputEmail3" placeholder="usdc" value="<?=getSettings('stack_usdc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BNB stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_bnb" id="inputEmail3" placeholder="bnb" value="<?=getSettings('stack_bnb');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ADA stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_ada" id="inputEmail3" placeholder="ada" value="<?=getSettings('stack_ada');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TRX stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_trx" id="inputEmail3" placeholder="trx" value="<?=getSettings('stack_trx');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ALGO stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_algo" id="inputEmail3" placeholder="algo" value="<?=getSettings('stack_algo');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">MATIC stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_matic" id="inputEmail3" placeholder="matic" value="<?=getSettings('stack_matic');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">SOL stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_sol" id="inputEmail3" placeholder="sol" value="<?=getSettings('stack_sol');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">DOT stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_dot" id="inputEmail3" placeholder="dot" value="<?=getSettings('stack_dot');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">AVAX stack*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stack_avax" id="inputEmail3" placeholder="avax" value="<?=getSettings('stack_avax');?>"> </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Save</button>
                            </div>
                        </div>
                    </form>
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
