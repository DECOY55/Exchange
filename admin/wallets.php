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

if(isset($_POST['btc'])){
    saveWallets('btc', $_POST['btc']);
}
if(isset($_POST['btc_bep20'])){
    saveWallets('btc_bep20', $_POST['btc_bep20']);
}
if(isset($_POST['eth'])){
    saveWallets('eth', $_POST['eth']);
}
if(isset($_POST['eth_bep20'])){
    saveWallets('eth_bep20', $_POST['eth_bep20']);
}
if(isset($_POST['ltc'])){
    saveWallets('ltc', $_POST['ltc']);
}
if(isset($_POST['btcc'])){
    saveWallets('btcc', $_POST['btcc']);
}
if(isset($_POST['bat'])){
    saveWallets('bat', $_POST['bat']);
}
if(isset($_POST['etc'])){
    saveWallets('etc', $_POST['etc']);
}
if(isset($_POST['usdt_trc20'])){
    saveWallets('usdt_trc20', $_POST['usdt_trc20']);
}
if(isset($_POST['usdt_bep20'])){
    saveWallets('usdt_bep20', $_POST['usdt_bep20']);
}
if(isset($_POST['usdt_erc20'])){
    saveWallets('usdt_erc20', $_POST['usdt_erc20']);
}
if(isset($_POST['usdc_erc20'])){
    saveWallets('usdc_erc20', $_POST['usdc_erc20']);
}
if(isset($_POST['usdc_bep20'])){
    saveWallets('usdc_bep20', $_POST['usdc_bep20']);
}
if(isset($_POST['usdc_trc20'])){
    saveWallets('usdc_trc20', $_POST['usdc_trc20']);
}
if(isset($_POST['busd_erc20'])){
    saveWallets('busd_erc20', $_POST['busd_erc20']);
}
if(isset($_POST['busd_bep20'])){
    saveWallets('busd_bep20', $_POST['busd_bep20']);
}
if(isset($_POST['bnb_bep20'])){
    saveWallets('bnb_bep20', $_POST['bnb_bep20']);
}
if(isset($_POST['bnb_erc20'])){
    saveWallets('bnb_erc20', $_POST['bnb_erc20']);
}
if(isset($_POST['link'])){
    saveWallets('link', $_POST['link']);
}
if(isset($_POST['trx'])){
    saveWallets('trx', $_POST['trx']);
}
if(isset($_POST['zec'])){
    saveWallets('zec', $_POST['zec']);
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
                    <h3 class="box-title m-b-0">Settings Wallets</h3>
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Bitcoin*</label>
                            <div class="col-sm-9">
                                <input type="text" name="btc" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('btc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Bitcoin BEP20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="btc_bep20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('btc_bep20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ETHEREUM*</label>
                            <div class="col-sm-9">
                                <input type="text" name="eth" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('eth');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">ETHEREUM BEP20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="eth_bep20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('eth_bep20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">LITECOIN*</label>
                            <div class="col-sm-9">
                                <input type="text" name="ltc" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('ltc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BITCOINCASH*</label>
                            <div class="col-sm-9">
                                <input type="text" name="btcc" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('btcc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Basic Attention Token*</label>
                            <div class="col-sm-9">
                                <input type="text" name="bat" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('bat');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Ethereum Classic*</label>
                            <div class="col-sm-9">
                                <input type="text" name="etc" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('etc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDT ERC20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="usdt_erc20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('usdt_erc20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDT BEP20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="usdt_bep20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('usdt_bep20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDT TRC20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="usdt_trc20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('usdt_trc20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDC ERC20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="usdc_erc20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('usdc_erc20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDC BEP20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="usdc_bep20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('usdc_bep20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">USDC TRC20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="usdc_trc20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('usdc_trc20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BUSD BEP20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="busd_bep20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('busd_bep20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BUSD ERC20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="busd_erc20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('busd_erc20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BNB BEP20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="bnb_bep20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('bnb_bep20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">BNB ERC20*</label>
                            <div class="col-sm-9">
                                <input type="text" name="bnb_erc20" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('bnb_erc20');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Chainlink*</label>
                            <div class="col-sm-9">
                                <input type="text" name="link" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('link');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Zcash*</label>
                            <div class="col-sm-9">
                                <input type="text" name="zec" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('zec');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TRON*</label>
                            <div class="col-sm-9">
                                <input type="text" name="trx" class="form-control" id="inputEmail3" placeholder="" value="<?=getWallets('trx');?>"> </div>
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
