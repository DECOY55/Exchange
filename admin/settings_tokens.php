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

if(isset($_POST['dep_tokens'])){
    saveDepTokens($_POST['dep_tokens']);
}

if(isset($_POST['BTC_fee'])){
    $token = 'BTC';
    saveWithTokens($token, $_POST['BTC_fee']);
}
if(isset($_POST['ETH_fee'])){
    $token = 'ETH';
    saveWithTokens($token, $_POST['ETH_fee']);
}
if(isset($_POST['LTC_fee'])){
    $token = 'LTC';
    saveWithTokens($token, $_POST['LTC_fee']);
}
if(isset($_POST['BCH_fee'])){
    $token = 'BCH';
    saveWithTokens($token, $_POST['BCH_fee']);
}
if(isset($_POST['BAT_fee'])){
    $token = 'BAT';
    saveWithTokens($token, $_POST['BAT_fee']);
}
if(isset($_POST['ETC_fee'])){
    $token = 'ETC';
    saveWithTokens($token, $_POST['ETC_fee']);
}
if(isset($_POST['ZEC_fee'])){
    $token = 'ZEC';
    saveWithTokens($token, $_POST['ZEC_fee']);
}
if(isset($_POST['LINK_fee'])){
    $token = 'LINK';
    saveWithTokens($token, $_POST['LINK_fee']);
}
if(isset($_POST['USDT_fee'])){
    $token = 'USDT';
    saveWithTokens($token, $_POST['USDT_fee']);
}
if(isset($_POST['USDC_fee'])){
    $token = 'USDC';
    saveWithTokens($token, $_POST['USDC_fee']);
}
if(isset($_POST['BUSD_fee'])){
    $token = 'BUSD';
    saveWithTokens($token, $_POST['BUSD_fee']);
}
if(isset($_POST['BNB_fee'])){
    $token = 'BNB';
    saveWithTokens($token, $_POST['BNB_fee']);
}
if(isset($_POST['TRX_fee'])){
    $token = 'TRX';
    saveWithTokens($token, $_POST['TRX_fee']);
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
                    <h3 class="box-title m-b-0">Settings</h3>
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Deposit tokens*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="dep_tokens" id="inputEmail3" placeholder="BTC, USDT, ETH" value="<?=getDepTokens();?>">
                                <p class="text-muted m-b-20">Active tokens: <code>BTC, ETH, LTC, BCH, BAT, ETC, ZEC, LINK, USDT, USDC, BUSD, BNB, TRX</code></p>
                            </div>
                        </div>

                        <h3 class="box-title m-b-0">Withdraw fee</h3>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BTC fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="BTC_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('BTC');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ETH fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ETH_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('ETH');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">LTC fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="LTC_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('LTC');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BCH fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="BCH_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('BCH');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BAT fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="BAT_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('BAT');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ETC fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ETC_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('ETC');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ZEC fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ZEC_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('ZEC');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">LINK fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="LINK_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('LINK');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDT fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="USDT_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('USDT');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDC fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="USDC_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('USDC');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BUSD fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="BUSD_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('BUSD');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BNB fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="BNB_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('BNB');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TRX fee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="TRX_fee" id="inputEmail3" placeholder="10" value="<?=getWithTokens('TRX');?>">
                            </div>
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
